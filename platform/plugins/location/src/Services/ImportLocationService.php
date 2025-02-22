<?php

namespace Botble\Location\Services;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Location\Enums\ImportType;
use Botble\Location\Events\ImportedCityEvent;
use Botble\Location\Events\ImportedCountryEvent;
use Botble\Location\Events\ImportedStateEvent;
use Botble\Location\Models\City;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ImportLocationService
{
    protected Collection $countries;

    protected Collection $states;

    protected int $count = 0;

    public function __construct()
    {
        $this->countries = collect();
        $this->states = collect();
    }

    public function handle(array $rows, bool $skipExistingRecords = false): void
    {
        foreach ($rows as $row) {
            match ($row['import_type'] ?: ImportType::STATE) {
                ImportType::COUNTRY => $this->storeCountry($row, $skipExistingRecords),
                ImportType::CITY => $this->storeCity($row, $skipExistingRecords),
                default => $this->storeState($row, $skipExistingRecords),
            };
        }
    }

    protected function storeCountry(array $row, bool $skipExistingRecords = false): void
    {
        /**
         * @var Country $country
         */
        $country = Country::query()->where('name', $row['name'])->first();

        if ($country && $skipExistingRecords) {
            return;
        }

        if (! $country) {
            /**
             * @var Country $country
             */
            $country = Country::query()->updateOrCreate(
                [
                    'name' => $row['name'],
                ],
                [
                    'name' => $row['name'],
                    'order' => $row['order'] ?: 0,
                    'status' => $row['status'],
                    'nationality' => $row['nationality'],
                ]
            );
        }

        $this->countries->push($country);
        $this->count++;

        if ($country->wasRecentlyCreated) {
            event(new ImportedCountryEvent($row, $country));
        }
    }

    protected function storeState(array $row, bool $skipExistingRecords = false): void
    {
        /**
         * @var State $state
         */
        $state = State::query()
            ->where('name', $row['name'])
            ->where('country_id', $countryId = $this->getCountryId($row['country']))
            ->first();

        if ($state && $skipExistingRecords) {
            return;
        }

        if (! $state) {
            /**
             * @var State $state
             */
            $state = State::query()->updateOrCreate(
                [
                    'name' => $row['name'],
                ],
                [
                    'name' => $row['name'],
                    'country_id' => $countryId,
                    'abbreviation' => $row['abbreviation'],
                    'slug' => Str::slug($row['slug'] ?: $row['name']),
                    'order' => $row['order'] ?: 0,
                    'status' => $row['status'],
                ]
            );
        }

        $this->states->push($state);
        $this->count++;

        if ($state->wasRecentlyCreated) {
            event(new ImportedStateEvent($row, $state));
        }
    }

    protected function storeCity(array $row, bool $skipExistingRecords = false): void
    {
        /**
         * @var City $city
         */
        $city = City::query()
            ->where('name', $row['name'])
            ->where('country_id', $countryId = $this->getCountryId($row['country']))
            ->where('state_id', $stateId = $this->getStateId($row['state'], $countryId))
            ->first();

        if ($city && $skipExistingRecords) {
            return;
        }

        if (! $city) {
            /**
             * @var City $city
             */
            $city = City::query()->updateOrCreate(
                [
                    'name' => $row['name'],
                ],
                [
                    'name' => $row['name'],
                    'country_id' => $countryId,
                    'state_id' => $stateId,
                    'slug' => Str::slug($row['slug'] ?: $row['name']),
                    'order' => $row['order'] ?: 0,
                    'status' => $row['status'],
                ]
            );
        }

        $this->count++;

        if ($city->wasRecentlyCreated) {
            event(new ImportedCityEvent($row, $city));
        }
    }

    protected function getCountryId(string|int $value): string
    {
        $country = $this->countries->firstWhere('name', $value);

        if (! $country) {
            $column = is_numeric($value) ? 'id' : 'name';
            $country = Country::query()->where($column, $value)->first();

            if (! $country) {
                $country = Country::query()->create([
                    'name' => $value,
                    'nationality' => $this->getNationality($value),
                    'status' => BaseStatusEnum::PUBLISHED,
                ]);
            }
        }

        return $country->id;
    }

    protected function getStateId(string|int $value, string|int $countryId): string
    {
        $state = $this->states
            ->where('country_id', $countryId)
            ->firstWhere('name', $value);

        if (! $state) {
            $column = is_numeric($value) ? 'id' : 'name';

            $state = State::query()
                ->where($column, $value)
                ->where('country_id', $countryId)
                ->first();

            if (! $state) {
                $state = State::query()->create([
                    'name' => $value,
                    'country_id' => $countryId,
                ]);
            }
        }

        return $state->id;
    }

    protected function getNationality(string $name): string
    {
        $explode = explode(' ', $name);

        if (count($explode) > 2) {
            return Str::substr($explode[0], 0, 1) . Str::substr($explode[1], 0, 1);
        }

        return Str::substr($name, 0, 2);
    }

    public function count(): int
    {
        return $this->count;
    }
}

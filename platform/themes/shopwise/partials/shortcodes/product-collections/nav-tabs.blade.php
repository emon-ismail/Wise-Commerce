<ul class="nav nav-tabs justify-content-center {{ Arr::get($attributes ?? [], 'class') }}" id="tabmenubar" role="tablist" aria-label="Collections list">
    @foreach ($collections as $collection)
        <li class="nav-item" role="tab" aria-controls="{{ $collection->slug }}" aria-selected="true"
            id="{{ $collection->slug }}-tab"
            aria-labelledby="#tabmenubar">
            <a @class([
                'nav-link',
                'active' => $collection->id == $collectionId,
            ])
            data-toggle="tab"
            href="#{{ $collection->slug }}"
            @if ($collection->id == $collectionId) data-loaded @endif data-ref="{{ $collection->slug }}"
            data-url="{{ route('public.ajax.products', ['collection_id' => $collection->id, 'limit' => $limit]) }}">{{ $collection->name }}</a>
        </li>
    @endforeach
</ul>

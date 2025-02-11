<?php

use Botble\Media\Facades\RvMedia;
use Botble\SimpleSlider\Forms\SimpleSliderItemForm;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Botble\Theme\Typography\TypographyItem;

register_page_template([
    'homepage' => __('Homepage'),
    'blog-sidebar' => __('Blog Sidebar'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => __('Footer sidebar'),
    'description' => __('Sidebar in the footer of site'),
]);

RvMedia::addSize('medium', 540, 600)
    ->addSize('small', 540, 300);

app()->booted(function (): void {
    ThemeSupport::registerToastNotification();
    ThemeSupport::registerPreloader();
    ThemeSupport::registerSiteCopyright();

    Theme::typography()
        ->registerFontFamily(
            new TypographyItem('primary', __('Primary'), theme_option('primary_font', 'Poppins'), [200, 300, 400, 500, 600, 700, 800, 900]),
        );

    if (is_plugin_active('simple-slider')) {
        SimpleSliderItemForm::extend(function (SimpleSliderItemForm $form): void {
            $form
                ->addAfter('description', 'sub_title', 'text', [
                    'label' => __('Subtitle'),
                    'metadata' => true,
                    'attr' => [
                        'placeholder' => __('Enter subtitle'),
                    ],
                ])
                ->addAfter('link', 'button_text', 'text', [
                    'label' => __('Button text'),
                    'metadata' => true,
                    'attr' => [
                        'placeholder' => __('Ex: Shop now'),
                    ],
                ]);
        }, 124);
    }
});

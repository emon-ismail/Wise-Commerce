<!DOCTYPE html>
<html {!! Theme::htmlAttributes() !!}>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {!! Theme::typography()->renderCssVariables() !!}

        <style>
            :root {
                --color-1st: {{ theme_option('primary_color', '#FF324D') }};
                --primary-color: {{ theme_option('primary_color', '#FF324D') }};
                --color-2nd: {{ theme_option('secondary_color', '#1D2224') }};
                --secondary-color: {{ theme_option('secondary_color', '#1D2224') }};
            }
        </style>

        {!! Theme::header() !!}
    </head>
    <body {!! Theme::bodyAttributes() !!}>
    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    <div id="alert-container"></div>

    @if (is_plugin_active('newsletter') && theme_option('enable_newsletter_popup', 'yes') === 'yes')
        <div data-session-domain="{{ config('session.domain') ?? request()->getHost() }}"></div>
        <div class="modal fade subscribe_popup" id="newsletter-modal" data-time="{{ (int)theme_option('newsletter_show_after_seconds', 10) * 1000 }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-label="Subscribe popup" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="ion-ios-close-empty"></i></span>
                        </button>
                        <div class="row no-gutters">
                            <div class="col-sm-5">
                                @if (theme_option('newsletter_image'))
                                    <div class="background_bg h-100" data-img-src="{{ RvMedia::getImageUrl(theme_option('newsletter_image')) }}"></div>
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <div class="popup_content">
                                    <div class="popup-text">
                                        <div class="heading_s4">
                                            <h4>{{ __('Subscribe and Get 25% Discount!') }}</h4>
                                        </div>
                                        <p>{{ __('Subscribe to the newsletter to receive updates about new products.') }}</p>
                                    </div>
                                    {!!
                                        \Botble\Newsletter\Forms\Fronts\NewsletterForm::create()
                                            ->setFormInputClass('form-control rounded-0 mb-3')
                                            ->modify('email', 'email', [
                                                'attr' => ['placeholder' => __('Enter Your Email')],
                                            ])
                                            ->modify('submit', 'submit', [
                                                'attr' => [
                                                    'class' => 'btn btn-block text-uppercase rounded-0"',
                                                    'style' => 'background: #333; color: #fff;',
                                                ],
                                            ])
                                            ->renderForm()
                                    !!}
                                    <div class="chek-form text-left form-group">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="dont_show_again" id="dont_show_again" value="">
                                            <label class="form-check-label" for="dont_show_again"><span>{{ __("Don't show this popup again!") }}</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <header class="header_wrap @if (Theme::get('transparentHeader')) dd_dark_skin transparent_header @endif">
        <div class="top-header d-none d-md-block">
            <div class="container">
                <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                @if (is_plugin_active('language'))
                                    <div class="language-wrapper">
                                        {!! Theme::partial('language-switcher') !!}
                                    </div>
                                @endif
                                @if (is_plugin_active('ecommerce'))
                                    @php $currencies = get_all_currencies(); @endphp
                                    @if (count($currencies) > 1)
                                        <div class="language-wrapper choose-currency mr-3">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle btn-select-language" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    {{ get_application_currency()->title }}
                                                    <span class="language-caret"></span>
                                                </button>
                                                <ul class="dropdown-menu language_bar_chooser">
                                                    @foreach ($currencies as $currency)
                                                        <li>
                                                            <a href="{{ route('public.change-currency', $currency->title) }}" @if (get_application_currency_id() == $currency->id) class="active" @endif><span>{{ $currency->title }}</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (theme_option('hotline'))
                                    <ul class="contact_detail text-center text-lg-left">
                                        <li><i class="ti-mobile"></i><span>{{ theme_option('hotline') }}</span></li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-end">
                            @if (is_plugin_active('ecommerce'))
                                <ul class="header_list">
                                    @if (EcommerceHelper::isCompareEnabled())
                                        <li><a href="{{ route('public.compare') }}"><i class="ti-control-shuffle"></i><span>{{ __('Compare') }}</span></a></li>
                                    @endif
                                    @if (!auth('customer')->check())
                                        <li><a href="{{ route('customer.login') }}"><i class="ti-user"></i><span>{{ __('Login') }}</span></a></li>
                                    @else
                                        <li><a href="{{ route('customer.overview') }}"><i class="ti-user"></i><span>{{ auth('customer')->user()->name }}</span></a></li>
                                        <li><a href="{{ route('customer.logout') }}"><i class="ti-lock"></i><span>{{ __('Logout') }}</span></a></li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="middle-header dark_skin">
            <div class="container">
                <div class="nav_block">
                    <a class="navbar-brand" href="{{ route('public.index') }}">
                        <img class="logo_dark" src="{{ RvMedia::getImageUrl(theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" loading="lazy" />
                    </a>
                    @if (theme_option('hotline'))
                        <div class="contact_phone order-md-last">
                            <i class="linearicons-phone-wave"></i>
                            <span>{{ theme_option('hotline') }}</span>
                        </div>
                    @endif
                    @if (is_plugin_active('ecommerce'))
                        <div class="product_search_form">
                            <form action="{{ route('public.products') }}" data-ajax-url="{{ route('public.ajax.search-products') }}" method="GET">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="custom_select">
                                            <select name="categories[]" class="first_null product-category-select" aria-label="Product categories">
                                                <option value="">{{ __('All') }}</option>
                                                {!! ProductCategoryHelper::renderProductCategoriesSelect() !!}
                                            </select>
                                        </div>
                                    </div>
                                    <input class="form-control input-search-product" name="q" value="{{ BaseHelper::stringify(request()->query('q')) }}" placeholder="{{ __('Search Product') }}..." required  type="text">
                                    <button type="submit" class="search_btn" title="{{ __('Search') }}"><i class="linearicons-magnifier"></i></button>
                                </div>
                                <div class="panel--search-result"></div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="bottom_header light_skin main_menu_uppercase @if (! Theme::get('transparentHeader')) bg_dark @endif @if (url()->current() === route('public.index')) mb-4 @endif">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-4">
                        @if (is_plugin_active('ecommerce'))
                            <div class="categories_wrap">
                                <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false" class="categories_btn">
                                    <i class="linearicons-menu"></i><span>{{ __('All Categories') }} </span>
                                </button>
                                @php
                                    $categories = ProductCategoryHelper::getProductCategoriesWithUrl();
                                @endphp
                                    <div id="navCatContent" class="@if (Theme::get('collapsingProductCategories')) nav_cat @endif navbar collapse">
                                        <ul>
                                            {!! Theme::partial('product-categories-dropdown', ['categories' => $categories]) !!}
                                        </ul>
                                    @if (count($categories) > 10)
                                        <div class="more_categories">{{ __('More Categories') }}</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-6 col-8">
                        @include(Theme::getThemeNamespace('partials.header-menu'))
                    </div>
                </div>
            </div>
        </div>

        @if (theme_option('enable_sticky_header', 'yes') == 'yes')
            <div class="bottom_header bottom_header_sticky light_skin main_menu_uppercase bg_dark fixed-top header_with_topbar d-none">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-4">
                            <a class="navbar-brand" href="{{ route('public.index') }}">
                                <img src="{{ RvMedia::getImageUrl(theme_option('logo_footer') ? theme_option('logo_footer') : theme_option('logo')) }}" alt="{{ theme_option('site_title') }}" loading="lazy" />
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-6 col-8">
                            @include(Theme::getThemeNamespace('partials.header-menu'))
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </header>

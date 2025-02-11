@php Theme::set('pageName', __('Products')) @endphp

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9" data-bb-toggle="product-list">
                <div class="row align-items-center mb-4 pb-1">
                    <div class="col-12">
                        <div class="product_header">
                            @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.sort')
                        </div>
                    </div>
                </div>
                <div class="row shop_container grid bb-product-items-wrapper">
                    @include(Theme::getThemeNamespace('views.ecommerce.includes.product-items'))
                </div>
            </div>
            <div class="col-lg-3 order-lg-first mt-4 pt-2 mt-lg-0 pt-lg-0">
                <div class="sidebar">
                    @include(Theme::getThemeNamespace() . '::views.ecommerce.includes.filters')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->

<div class="product_header_left">
    <div class="custom_select">
        <select class="form-control form-control-sm" name="sort-by" id="sort-by" data-bb-toggle="product-form-filter-item">
            @foreach (EcommerceHelper::getSortParams() as $key => $name)
                <option value="{{ $key }}" @if (request()->input('sort-by') == $key) selected @endif>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="product_header_right">
    <div class="products_view">
        <a href="javascript:void(0);" class="shorting_icon grid active"><i class="ti-view-grid"></i></a>
        <a href="javascript:void(0);" class="shorting_icon list"><i class="ti-layout-list-thumb"></i></a>
    </div>
    <div class="custom_select">
        <select class="form-control form-control-sm" name="num" data-bb-toggle="product-form-filter-item">
            <option value="">{{ __('Showing') }}</option>
            @foreach(EcommerceHelper::getShowParams() as $key => $name)
                <option value="{{ $key }}" @selected(request()->input('num') == $key)>{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

@if (is_plugin_active('blog') && $categories->isNotEmpty())
    <div class="widget">
        <h3 class="widget_title">{!! BaseHelper::clean($config['name'] ?: __('Categories')) !!}</h3>
        <ul class="ps-list--categories">
            @foreach ($categories as $category)
                <li>
                    <a
                        href="{{ $category->url }}"
                        title="{{ $category->name }}"
                    >{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

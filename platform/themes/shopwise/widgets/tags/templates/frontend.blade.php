<div class="widget">
    <h3 class="widget_title">{{ $config['name'] }}</h3>
    <div class="tags">
        @foreach (get_popular_tags($config['number_display']) as $tag)
            <a href="{{ $tag->url }}" class="tag-link">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>

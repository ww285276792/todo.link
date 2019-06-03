@foreach($items as $item)
    <div@lm-attrs($item) @if($item->hasChildren())class ="dropdown"@endif @lm-endattrs>
    @if($item->link) <a class="item" @lm-attrs($item->link) @lm-endattrs href="{!! $item->url() !!}">
    {!! $item->title !!}
    @if($item->hasChildren()) <b class="caret"></b> @endif
    </a>
    @else
        {!! $item->title !!}
    @endif
    @if($item->hasChildren())
        <div class="menu">
            @include(config('laravel-menu.views.semantic-items'),
    array('items' => $item->children()))
        </div>
        @endif
        </div>
        @if($item->divider)
            <li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
        @endif
@endforeach

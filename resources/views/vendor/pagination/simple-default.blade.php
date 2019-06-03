@if ($paginator->hasPages())
    <ul class="am-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled am-pagination-prev"><span>@lang('pagination.previous')</span></li>
        @else
            <li class="am-pagination-prev"><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="am-pagination-next"><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="disabled am-pagination-next"><span>@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif

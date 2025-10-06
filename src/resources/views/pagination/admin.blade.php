@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Pagination Navigation">
    {{-- Prev --}}
    @if ($paginator->onFirstPage())
        <span class="pager__btn" aria-disabled="true">‹</span>
    @else
        <a class="pager__btn" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
    @endif

    {{-- Numbers --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="pager__num" aria-disabled="true">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="pager__num is-current" aria-current="page">{{ $page }}</span>
                @else
                    <a class="pager__num" href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a class="pager__btn" href="{{ $paginator->nextPageUrl() }}" rel="next">›</a>
    @else
        <span class="pager__btn" aria-disabled="true">›</span>
    @endif
</nav>
@endif

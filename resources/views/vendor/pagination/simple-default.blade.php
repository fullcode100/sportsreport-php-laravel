@if ($paginator->hasPages())
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span>&nbsp;</span>
        @else
            <a class="nav-link float-left" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;Newer Highlights</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="nav-link float-right" href="{{ $paginator->nextPageUrl() }}" rel="next">Older Highlights&gt;</a>
        @else
            <span>&nbsp;</span>
        @endif
    </div>
@endif

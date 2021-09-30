<div class="d-flex justify-content-between">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <div class="w-32 d-flex justify-content-between align-items-center position-relative px-3 py-2 border fs-6 rounded-3 text-muted bg-light">
        <x-icons.arrow-left />
        Previous
    </div>
    @else
    <a class="w-32 d-flex justify-content-between align-items-center position-relative px-3 py-2 border fs-6 rounded-3 text-secondary bg-white hover:text-muted focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150" href="{{ $paginator->previousPageUrl() }}" rel="prev">
        <x-icons.arrow-left />
        Previous
    </a>
    @endif


    <!-- Next Page pnk -->
    @if ($paginator->hasMorePages())
    <a class="w-32 d-flex justify-content-between align-items-center position-relative px-3 py-2 border fs-6 rounded-3 text-secondary bg-white hover:text-muted focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150" href="{{ $paginator->nextPageUrl() }}" rel="next">
        Next
        <x-icons.arrow-right />
    </a>
    @else
    <div class="w-32 d-flex justify-content-between align-items-center position-relative px-3 py-2 border fs-6 rounded-3 text-muted bg-light">
        Next
        <x-icons.arrow-right class="d-inline" />
    </div>
    @endif
</div>
<div class="pagination d-flex rounded border overflow-hidden divide-x divide-gray-300">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
    <button class="position-relative d-inline-flex align-items-center px-2 py-2 bg-white fs-6 text-dark border-0" disabled>
        <span>&laquo;</span>
    </button>
    @else
    <button wire:click="previousPage" class="border-0 position-relative d-inline-flex align-items-center px-2 py-2 bg-white fs-6 text-dark focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150">
        <span>&laquo;</span>
    </button>
    @endif

    <div class="divide-x divide-gray-300">
        @foreach ($elements as $element)
        @if (is_string($element))
        <button class="border-0 border-left -ml-px position-relative d-inline-flex align-items-center px-3 py-2 bg-white fs-6 text-dark" disabled>
            <span>{{ $element }}</span>
        </button>
        @endif

        <!-- Array Of Links -->

        @if (is_array($element))
        @foreach ($element as $page => $url)
        <button wire:click="gotoPage({{ $page }})" class="-mx-1 border-top-0 border-bottom-0 position-relative d-inline-flex align-items-center px-3 py-2 fs-6 text-dark hover:text-muted focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 {{$page === 1 ? 'border-left-0' : ''}} {{ $page === $paginator->currentPage() ? 'bg-muted' : 'bg-white' }}">
            {{ $page }}
        </button>
        @endforeach
        @endif
        @endforeach
    </div>

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
    <button wire:click="nextPage" class="border-0 border-left -ml-px position-relative d-inline-flex align-items-center px-2 py-2 bg-white fs-6 text-dark focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150">
        <span>&raquo;</span>
    </button>
    @else
    <button class="border-0 -ml-px position-relative d-inline-flex align-items-center px-2 py-2 bg-white fs-6 text-dark " disabled><span>&raquo;</span></button>
    @endif
</div>

<style>

    .divide-gray-300> :not(template)~ :not(template) {
        border-color: #d2d6dc;
    }

    .-ml-px {
        margin-left: -1px;
    }

    .-mx-1 {
        margin-left: -0.25rem;
        margin-right: -0.25rem;
    }

    .bg-muted {
        background-color: #e5e7eb;
    }
</style>
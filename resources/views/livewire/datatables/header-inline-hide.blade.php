<div wire:click.prefetch="toggle('{{ $index }}')" class="@if($column['hidden']) position-relative d-table-cell h-12 w-3 bg-blue-100 hover:bg-blue-300 overflow-none align-top group @else d-none @endif" style="min-width:12px; max-width:12px">
    <button class="position-relative h-12 w-3 border-0 bg-transparent focus:outline-none">
        <span class="w-32 d-none group-hover:inline-block position-absolute z-10 top-0 left-0 ms-2.5 bg-blue-300 font-medium initialism text-start text-primary transform focus:outline-none">
            {{ str_replace('_', ' ', $column['label']) }}
        </span>
    </button>
    <svg class="position-absolute text-light fill-current w-100 left-0 right-0 bottom-0" viewBox="0 0 314.16 207.25">
        <path stroke-miterlimit="10" d="M313.66 206.75H.5V1.49l157.65 204.9L313.66 1.49v205.26z" />
    </svg>
</div>
<div class="@if($column['hidden']) d-none @else position-relative h-12 overflow-hidden align-top d-table-cell @endif {{$index === 0 ? '' : 'border-left'}}">
    <button wire:click.prefetch="sort('{{ $index }}')" class="w-100 h-100 px-4 py-2.5 border-0 bg-transparent border-bottom bg-light initialism font-medium text-secondary d-flex justify-content-between align-items-center focus:outline-none">
        <span class="d-inline flex-grow-1 @if($column['align'] === 'right') text-start @elseif($column['align'] === 'center') text-center @endif"">{{ str_replace('_', ' ', $column['label']) }}</span>
        <span class=" d-inline fs-6 text-blue-400">
            @if($sort === $index)
            @if($direction)
            <x-icons.chevron-up class="h-6 w-6 text-success stroke-current" />
            @else
            <x-icons.chevron-down class="h-6 w-6 text-success stroke-current" />
            @endif
            @endif
        </span>
    </button>
    <button wire:click.prefetch="toggle('{{ $index }}')" class="position-absolute bottom-1 end-1 border-0 bg-transparent focus:outline-none">
        <x-icons.arrow-circle-left class="h-3 w-3 text-gray-300 hover:text-blue-400" />
    </button>
</div>
<style>
    .ms-2\.5 {
        margin-left: 0.75rem;
    }

    .text-blue-400 {
        color: #76a9fa;
    }

    .text-gray-300 {
        color: #d2d6dc;
    }

    .hover\:text-blue-400:hover {
        color: #76a9fa;
    }
</style>
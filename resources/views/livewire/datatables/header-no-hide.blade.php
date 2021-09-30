@if($column['hidden'])
@else
<div class="position-relative d-table-cell h-12 overflow-hidden align-top">
    <button wire:click.prefetch="sort('{{ $index }}')" class="w-100 h-100 px-4 py-2.5 border-0 border-bottom border-left bg-light text-start initialism text-secondary d-flex align-items-center focus:outline-none {{$index === 0 ? 'border-left-0' : ''}} @if($column['align'] === 'right') d-flex justify-content-end @elseif($column['align'] === 'center') d-flex justify-content-center @endif">
        <span class="d-inline">{{ str_replace('_', ' ', $column['label']) }}</span>
        <span class="d-inline fs-6 text-primary">
            @if($sort === $index)
            @if($direction)
            <x-icons.chevron-up wire:loading.remove class="h-6 w-6 text-success stroke-current" />
            @else
            <x-icons.chevron-down wire:loading.remove class="h-6 w-6 text-success stroke-current" />
            @endif
            @endif
        </span>
    </button>
</div>
@endif
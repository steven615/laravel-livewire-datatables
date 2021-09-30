<div x-data class="d-flex flex-column">
    <div class="d-flex">
        <select x-ref="select" name="{{ $name }}" class="m-1 fs-6 flex-grow-1 form-control" wire:input="doBooleanFilter('{{ $index }}', $event.target.value)" x-on:input="$refs.select.value=''">
            <option value=""></option>
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>

    <div class="d-flex flex-wrap space-x-1">
        @isset($this->activeBooleanFilters[$index])
        @if($this->activeBooleanFilters[$index] == 1)
        <button wire:click="removeBooleanFilter('{{ $index }}')" class="m-1 pl-1 d-flex align-items-center text-uppercase bg-light text-white hover:bg-danger rounded-full focus:outline-none fs-6 space-x-1">
            <span>YES</span>
            <x-icons.x-circle />
        </button>
        @elseif(strlen($this->activeBooleanFilters[$index]) > 0)
        <button wire:click="removeBooleanFilter('{{ $index }}')" class="m-1 pl-1 d-flex align-items-center text-uppercase bg-light text-white hover:bg-danger rounded-full focus:outline-none fs-6 space-x-1">
            <span>No</span>
            <x-icons.x-circle />
        </button>
        @endif
        @endisset
    </div>
</div>
<div x-data class="d-flex flex-column">
    <div class="d-flex">
        <input x-ref="input" type="text" class="m-1 fs-6 flex-grow-1 form-control " wire:change="doTextFilter('{{ $index }}', $event.target.value)" x-on:change="$refs.input.value = ''" />
    </div>
    <div class="d-flex flex-wrap space-x-1">
        @foreach($this->activeTextFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')" class="m-1 pl-1 d-flex align-items-center text-uppercase bg-light text-white hover:bg-danger rounded-full focus:outline-none fs-6 space-x-1">
            <span>{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
</div>
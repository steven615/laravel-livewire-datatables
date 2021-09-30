<div class="d-flex flex-column">
    <div x-data class="position-relative d-flex">
        <input x-ref="input" type="number" wire:input.debounce.500ms="doNumberFilterStart('{{ $index }}', $event.target.value)" class="m-1 pr-4 fs-6 flex-grow-1 form-control" placeholder="MIN" />
        <div class="position-absolute top-0 bottom-0 right-0 pr-2 d-flex align-items-center">
            <button x-on:click="$refs.input.value=''" wire:click="doNumberFilterStart('{{ $index }}', '')" class="d-inline-flex border-0 bg-transparent text-muted hover:text-danger focus:outline-none" tabindex="-1">
                <x-icons.x-circle class="h-3 w-3 stroke-current" />
            </button>
        </div>
    </div>

    <div x-data class="position-relative d-flex">
        <input x-ref="input" type="number" wire:input.debounce.500ms="doNumberFilterEnd('{{ $index }}', $event.target.value)" class="m-1 pr-4 fs-6 flex-grow-1 form-control" placeholder="MAX" />
        <div class="position-absolute top-0 bottom-0 right-0 pr-2 d-flex align-items-center">
            <button x-on:click="$refs.input.value=''" wire:click="doNumberFilterEnd('{{ $index }}', '')" class="d-inline-flex border-0 bg-transparent text-muted hover:text-danger focus:outline-none" tabindex="-1">
                <x-icons.x-circle class="h-3 w-3 stroke-current" />
            </button>
        </div>
    </div>
</div>
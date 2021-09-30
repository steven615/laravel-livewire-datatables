<div x-data class="d-flex flex-column">
    <div class="w-100 position-relative d-flex">
        <input x-ref="start" class="m-1 fs-6 pt-1 pr-4 flex-grow-1 form-control" type="time"
            wire:change="doTimeFilterStart('{{ $index }}', $event.target.value)" style="padding-bottom: 5px" />
            <div class="position-absolute top-0 bottom-0 right-0 pr-2 d-flex align-items-center">
            <button x-on:click="$refs.start.value=''" wire:click="doTimeFilterStart('{{ $index }}', '')" class="d-inline-flex border-0 bg-transparent -mt-1 p-0 text-muted hover:text-danger focus:outline-none" tabindex="-1">
                <x-icons.x-circle class="h-3 w-3 stroke-current" />
            </button>
        </div>
    </div>
    <div class="w-100 position-relative d-flex">
        <input x-ref="end" class="m-1 fs-6 pt-1 pr-4 flex-grow-1 form-control" type="time"
            wire:change="doTimeFilterEnd('{{ $index }}', $event.target.value)" style="padding-bottom: 5px" />
            <div class="position-absolute top-0 bottom-0 right-0 pr-2 d-flex align-items-center">
            <button x-on:click="$refs.end.value=''" wire:click="doTimeFilterEnd('{{ $index }}', '')" class="d-inline-flex border-0 bg-transparent -mt-1 p-0 text-muted hover:text-danger focus:outline-none" tabindex="-1">
                <x-icons.x-circle class="h-3 w-3 stroke-current" />
            </button>
        </div>
    </div>
</div>

<style>
    .-mt-1 {
        margin-top: -2px;
    }
</style>
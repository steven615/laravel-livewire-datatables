<div x-data="{ show: false }" class="d-flex flex-column align-items-center">
    <div class="d-flex flex-column align-items-center position-relative">
        <button x-on:click="show = !show" class="px-3 py-2 border border-info rounded-3 bg-white text-primary initialism hover:bg-blue-200 focus:outline-none">
            <div class="d-flex align-items-center h-5" style="height: 1.25rem;">
                Show / Hide Columns
            </div>
        </button>
        <div x-show="show" x-on:click.away="show = false" class="position-absolute mt-6 -mr-4 shadow-lg top-100 bg-white z-40 w-96 left-0 rounded max-h-select overflow-y-auto" x-cloak>
            <div class="d-flex flex-column w-100">
                @foreach($this->columns as $index => $column)
                <div>
                    <div class="@unless($column['hidden']) d-none @endif cursor-pointer w-100 border-secondary border-bottom bg-secondary text-muted hover:bg-primary" wire:click="toggle({{$index}})">
                        <div class="position-relative d-flex w-100 align-items-center p-2">
                            <div class=" w-100 align-items-center d-flex">
                                <div class="mx-2 leading-6">{{ $column['label'] }}</div>
                            </div>
                            <div class="position-absolute top-0 bottom-0 right-0 pr-2 d-flex alignt-items-center">
                                <x-icons.check-circle class="h-3 w-3 stroke-current text-secondary" />
                            </div>
                        </div>
                    </div>
                    <div class="@if($column['hidden']) d-none @endif cursor-pointer w-100 border-secondary border-bottom bg-secondary text-white hover:bg-danger" wire:click="toggle({{$index}})">
                        <div class="position-relative d-flex w-100 align-items-center p-2">
                            <div class=" w-100 align-items-center d-flex">
                                <div class="mx-2 leading-6">{{ $column['label'] }}</div>
                            </div>
                            <div class="position-absolute top-0 bottom-0 right-0 pr-2 d-flex align-items-center">
                                <x-icons.x-circle class="h-3 w-3 stroke-current text-secondary" />
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .max-h-select {
        max-height: 300px;
    }

    .hover\:bg-blue-200:hover {
        background-color: #c3ddfd;
    }

    .mt-6 {
        margin-top: 4rem;
    }

    .-mr-4 {
        margin-right: -1rem;
    }

    .z-40 {
        z-index: 40;
    }

    .overflow-y-auto {
        overflow-y: auto;
    }

    .leading-6 {
        line-height: 1.5rem;
    }

</style>
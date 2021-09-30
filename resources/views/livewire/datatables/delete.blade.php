<div x-data="{ open: {{ isset($open) && $open ? 'true' : 'false' }}, working: false }" x-cloak wire:key="{{ $value }}">
    <span x-on:click="open = true">
        <button class="p-1 text-danger rounded hover:bg-danger hover:text-white">
            <x-icons.trash />
        </button>
    </span>

    <div x-show="open" class="position-fixed z-50 bottom-0 left-0 right-0 px-3 pb-3 d-flex d-sm-blcok align-items-center justify-content-center">
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="position-fixed inset-0 transition-opacity">
            <div class="position-absolute inset-0 bg-secondary opacity-75"></div>
        </div>

        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative bg-gray-100 rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div class="d-sm-none d-block position-absolute top-0 right-0 pt-3 pr-3">
                <button @click="open = false" type="button" class="text-muted focus:outline-none transition ease-in-out duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="w-100">
                <div class="mt-2.5 text-center">
                    <h3 class="fs-6 font-medium text-secondary">
                        Delete {{ $value }}
                    </h3>
                    <div class="mt-2">
                        <div class="mt-4.5 text-secondary">
                            Are you sure?
                        </div>
                        <div class="mt-4.5 d-flex justify-content-center">
                            <span class="mr-2">
                                <button x-on:click="open = false" x-bind:disabled="working" class="w-32 rounded-md shadow-sm d-inline-flex justify-content-center align-items-center px-2.5 py-2 border border-transparent fs-6 font-medium text-white bg-secondary focus:outline-none focus:shadow-outline-teal transition ease-in-out duration-150">
                                    No
                                </button>
                            </span>
                            <span x-on:click="working = !working">
                                <button wire:click="delete({{ $value }})" class="w-32 rounded-md shadow-sm d-inline-flex justify-content-center align-items-center px-2.5 py-2 border border-transparent fs-6 font-medium text-white bg-danger focus:outline-none focus:shadow-outline-teal transition ease-in-out duration-150">
                                    Yes
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover\:text-white:hover {
        color: #fff !important;
    }

    .z-50 {
        z-index: 50;
    }

    .inset-0 {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
    }

    .mt-2\.5 {
        margin-top: 0.75rem;
    }
</style>
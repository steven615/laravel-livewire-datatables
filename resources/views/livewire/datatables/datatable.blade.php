<div>
    @if($beforeTableSlot)
    <div class="mt-8">
        @include($beforeTableSlot)
    </div>
    @endif
    <div class="position-relative">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div class="flex-grow-1 h-10 d-flex align-items-center">
                @if($this->searchableColumns()->count())
                <div class="w-96 d-flex rounded-lg shadow-sm">
                    <div class="position-relative flex-grow-1">
                        <div class="position-absolute top-0 bottom-0 left-0 pl-3 d-flex align-items-center pe-none">
                            <svg class="h-5 w-5 text-muted" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input wire:model.debounce.500ms="search" class="form-control d-block bg-light focus:bg-white w-100 rounded-md ps-4.5 fs-6 transition ease-in-out duration-150" placeholder="Search in {{ $this->searchableColumns()->map->label->join(', ') }}" />
                        <div class="position-absolute top-0 bottom-0 right-0 pr-2.5 d-flex align-items-center">
                            <button wire:click="$set('search', null)" class="text-muted border-0 bg-white hover:text-danger focus:outline-none">
                                <x-icons.x-circle class="w-5 h-5 stroke-current" />
                            </button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="d-flex align-items-center space-x-1">
                <x-icons.cog wire:loading class="animate-spin text-muted" />

                @if($exportable)
                <div x-data="{ init() {
                    window.livewire.on('startDownload', link => window.open(link,'_blank'))
                } }" x-init="init">
                    <button wire:click="export" class="d-flex align-items-center space-x-2 px-2.5 border rounded-3 bg-white text-success initialism border-success focus:outline-none"><span>Export</span>
                        <x-icons.excel class="m-2" />
                    </button>
                </div>
                @endif

                @if($hideable === 'select')
                @include('datatables::hide-column-multiselect')
                @endif
            </div>
        </div>

        @if($hideable === 'buttons')
        <div class="p-2 d-grid grid-cols-8 gap-2">
            @foreach($this->columns as $index => $column)
            <button wire:click.prefetch="toggle('{{ $index }}')" class="px-2.5 py-2 rounded text-white fs-6 focus:outline-none
            {{ $column['hidden'] ? 'bg-light hover:bg-info text-primary' : 'bg-info hover:bg-primary' }}">
                {{ $column['label'] }}
            </button>
            @endforeach
        </div>
        @endif

        <div class="rounded-lg shadow bg-white overflow-x-scroll">
            <div class="rounded-lg @unless($this->hidePagination) rounded-top @endif">
                <div class="d-table align-middle min-w-100">
                    @unless($this->hideHeader)
                    <div class="d-table-row divide-x divide-gray-200">
                        @foreach($this->columns as $index => $column)
                        @if($hideable === 'inline')
                        @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort])
                        @elseif($column['type'] === 'checkbox')
                        <div class="position-relative d-table-cell h-12 w-32 overflow-hidden align-top px-4 py-2.5 border-bottom bg-light text-start initialism text-muted d-flex align-items-center focus:outline-none">
                            <div class="w-100 px-2.5 py-1 rounded @if(count($selected)) bg-warning @else bg-gray @endif text-white text-center">
                                {{ count($selected) }}
                            </div>
                        </div>
                        @else
                        @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                        @endif
                        @endforeach
                    </div>

                    <div class="d-table-row divide-x divide-blue-200 bg-blue-100">
                        @foreach($this->columns as $index => $column)
                        @if($column['hidden'])
                        @if($hideable === 'inline')
                        <div class="d-table-cell w-5 overflow-hidden align-top bg-blue-100"></div>
                        @endif
                        @elseif($column['type'] === 'checkbox')
                        <div class="w-32 overflow-hidden align-top bg-blue-100 px-4 py-3.5 border-bottom text-start initialism text-secondary d-flex h-100 flex-column align-items-center space-y-2 focus:outline-none">
                            <div>SELECT ALL</div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" id="select_all" wire:click="toggleSelectAll" @if(count($selected)===$this->results->total()) checked @endif class="custom-control-input mt-1 h-4 w-4 transition duration-150 ease-in-out" />
                                <label class="custom-control-label" for="select_all"></label>
                            </div>
                        </div>
                        @else
                        <div class="d-table-cell overflow-hidden align-top border-left">
                            @isset($column['filterable'])
                            @if( is_iterable($column['filterable']) )
                            <div wire:key="{{ $index }}">
                                @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                            </div>
                            @else
                            <div wire:key="{{ $index }}">
                                @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                            </div>
                            @endif
                            @endisset
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @forelse($this->results as $result)
                    <div class="d-table-row p-1 divide-x divide-gray-100 {{ isset($result->checkbox_attribute) && in_array($result->checkbox_attribute, $selected) ? 'bg-orange-100' : ($loop->even ? 'bg-gray-100' : 'bg-gray-50') }}">
                        @foreach($this->columns as $column)
                        @if($column['hidden'])
                        @if($hideable === 'inline')
                        <div class="d-table-cell w-5 overflow-hidden align-top"></div>
                        @endif
                        @elseif($column['type'] === 'checkbox')
                        @include('datatables::checkbox', ['value' => $result->checkbox_attribute])
                        @else
                        <div class="px-4 py-2 text-nowrap fs-6 text-secondary d-table-cell @if($column['align'] === 'right') text-end @elseif($column['align'] === 'center') text-center @else text-start @endif">
                            {!! $result->{$column['name']} !!}
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @empty
                    <p class="p-2.5 fs-6 text-teal-600">
                        There's Nothing to show at the moment
                    </p>
                    @endforelse
                </div>
            </div>
            @unless($this->hidePagination)
            <div class="rounded-lg rounded-t-none border-bottom bg-white">
                <div class="p-2 d-block d-sm-flex align-items-center justify-content-between">
                    {{-- check if there is any data --}}
                    @if($this->results[1])
                    <div class="my-0 my-sm-2 d-flex align-items-center">
                        <select name="perPage" class="mt-1 form-control d-block w-100 pl-3 pe-4.5 py-2 fs-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300" wire:model="perPage">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="99999999">All</option>
                        </select>
                    </div>

                    <div class="my-0 my-sm-3">
                        <div class="d-block d-lg-none">
                            <span class="space-x-2">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
                        </div>

                        <div class="d-none d-lg-flex justify-content-center">
                            <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end text-secondary">
                        Results {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} of
                        {{ $this->results->total() }}
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @if($afterTableSlot)
    <div class="mt-8">
        @include($afterTableSlot)
    </div>
    @endif
</div>

<style>
    /* 
     * Custom css
     *
     * @Added by monkeyflytiger@gmail.com
     */
    .pe-none {
        pointer-events: none !important;
    }

    .left-0 {
        left: 0;
    }

    .right-0 {
        right: 0 !important;
    }

    .top-0 {
        top: 0 !important;
    }

    .bottom-0 {
        bottom: 0 !important;
    }

    .w-3 {
        width: 0.75rem !important;
    }

    .w-4 {
        width: 1rem !important;
    }

    .w-5 {
        width: 1.25rem !important;
    }

    .w-6 {
        width: 1.5rem !important;
    }

    .w-32 {
        width: 8rem !important;
    }

    .w-96 {
        width: 24rem !important;
    }

    .h-3 {
        height: 0.75rem !important;
    }

    .h-4 {
        height: 1rem !important;
    }

    .h-5 {
        height: 1.25rem !important;
    }

    .h-6 {
        height: 1.5rem !important;
    }

    .h-10 {
        height: 2.5rem !important;
    }

    .h-12 {
        height: 3rem !important;
    }

    .min-w-100 {
        min-width: 100% !important;
    }

    F .p-2\.5 {
        padding: 0.75rem !important;
    }

    .ps-4\.5 {
        padding-left: 2.5rem !important;
    }

    .pr-2\.5 {
        padding-right: 0.75rem !important;
    }

    .pe-4\.5 {
        padding-right: 2.5rem !important;
    }

    .py-3\.5 {
        padding-top: 1.25rem !important;
        padding-bottom: 1.25rem !important;
    }

    .px-2\.5 {
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }

    .py-2\.5 {
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
    }

    .mt-4\.5 {
        margin-top: 2rem !important;
    }

    .-mx-2 {
        margin-left: -0.5rem !important;
        margin-right: -0.5rem !important;
    }

    .-my-1 {
        margin-top: -0.25rem !important;
        margin-bottom: -0.25rem !important;
    }

    .space-x-1> :not(template)~ :not(template) {
        margin-right: 0 !important;
        margin-left: 0.25rem !important;
    }

    .space-x-2> :not(template)~ :not(template) {
        margin-right: 0 !important;
        margin-left: 0.5rem !important;
    }

    .space-y-2> :not(template)~ :not(template) {
        margin-top: 0.5rem !important;
        margin-bottom: 0 !important;
    }
    
    .font-medium {
        font-weight: 500 !important;
    }

    .text-teal-600 {
        color: #047481 !important;
    }

    .hover\:text-white:hover {
        color: #fff !important;
    }

    .hover\:text-danger:hover {
        color: #dc3545 !important;
    }

    .hover\:text-muted:hover {
        color: #6c757d !important;
    }

    .bg-blue-100 {
        background-color: #e1effe !important;
    }

    .bg-blue-300 {
        background-color: #a4cafe !important;
    }

    .bg-gray-100 {
        background-color: #f4f5f7 !important;
    }

    .bg-orange-100 {
        --bg-opacity: 1 !important;
        background-color: #feecdc !important;
        background-color: rgba(254, 236, 220, var(--bg-opacity)) !important;
    }

    .bg-gray {
        background-color: #e5e7eb !important;
    }

    .bg-gray-50 {
        background-color: #f9fafb !important;
    }

    .focus\:bg-white:focus {
        background-color: #ffffff !important;
    }

    button.bg-light:hover {
        background-color: #f8f9fa !important;
    }

    .hover\:bg-primary:hover {
        background-color: #0d6efd !important;
    }

    .hover\:bg-info:hover {
        background-color: #0dcaf0 !important;
    }

    .hover\:bg-blue-100:hover {
        background-color: #e1effe !important;
    }

    .hover\:bg-blue-300:hover {
        background-color: #a4cafe !important;
    }

    .hover\:bg-danger:hover {
        background-color: #dc3545 !important;
    }

    .border-blue-200 {
        border-color: #c3ddfd !important;
    }

    .hover\:border-blue-500:hover {
        border-color: #3f83f8 !important;
    }

    .focus\:border-blue-300:focus {
        border-color: #a4cafe !important;
    }

    .focus\:shadow-outline-blue:focus {
        box-shadow: 0 0 0 3px rgba(164, 202, 254, 0.45) !important;
    }

    .stroke-current {
        stroke: currentColor !important;
    }

    .focus\:outline-none:focus {
        outline: 2px solid transparent !important;
        outline-offset: 2px !important;
    }

    .grid-cols-8 {
        grid-template-columns: repeat(8, minmax(0, 1fr)) !important;
    }

    .gap-2 {
        grid-gap: 0.5rem !important;
        gap: 0.5rem !important;
    }

    .group:hover .group-hover\:inline-block {
        display: inline-block !important;
    }

    .cursor-pointer {
        cursor: pointer !important;
    }

    .z-10 {
        z-index: 10 !important;
    }

    .overflow-x-scroll {
        overflow-x: scroll !important;
    }

    .bottom-1 {
        bottom: 0.25rem !important;
    }

    .end-1 {
        right: 0.25rem !important;
    }

    .border-transparent {
        border-color: transparent !important;
    }

    .focus\:border-secondary:focus {
        border-color: #6c757d !important;
    }

    .focus\:border-danger:focus {
        border-color: #dc3545 !important;
    }

    .border-left {
        border-left: 1px solid #dee2e6 !important;
    }

    .border-bottom {
        border-bottom: 1px solid #dee2e6 !important;
    }

    .rounded-3 {
        border-radius: 0.3rem !important;
    }

    .rounded-t-none {
        border-top-left-radius: 0 !important;
        border-top-right-radius: 0 !important;
    }

    .divide-x> :not(template)~ :not(template) {
        border-right-width: 0 !important;
        border-left-width: 1px !important;
    }

    .divide-gray-100> :not(template)~ :not(template) {
        border-color: #f4f5f7 !important;
    }

    .divide-gray-200> :not(template)~ :not(template) {
        border-color: #e5e7eb !important;
    }

    .divide-blue-200> :not(template)~ :not(template),
    .border-blue-200 {
        border-color: #c3ddfd !important;
    }

    .rounded-md {
        border-radius: 0.375rem !important;
    }

    .rounded-lg {
        border-radius: 0.5rem !important;
    }

    .rounded-full {
        border-radius: 9999px !important;
    }

    .focus\:shadow-outline-teal:focus {
        box-shadow: 0 0 0 3px rgba(126, 220, 226, 0.45) !important;
    }

    .opacity-0 {
        opacity: 0 !important;
    }

    .opacity-75 {
        opacity: 0.75 !important;
    }

    .opacity-100 {
        opacity: 1 !important;
    }

    .animate-spin {
        -webkit-animation: spinner-border 1s linear infinite !important;
        animation: spinner-border 1s linear infinite !important;
    }

    .ease-out {
        transition-timing-function: cubic-bezier(0, 0, 0.2, 1) !important;
    }

    .ease-in {
        transition-timing-function: cubic-bezier(0.4, 0, 1, 1) !important;
    }

    .ease-in-out {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .duration-150 {
        transition-duration: 150ms !important;
    }

    .duration-200 {
        transition-duration: 200ms !important;
    }

    .duration-300 {
        transition-duration: 300ms !important;
    }

    .transition {
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform !important;
    }

    .transition-opacity {
        transition-property: opacity !important;
    }

    .transition-all {
        transition-property: all !important;
    }

    .translate-y-0 {
        --transform-translate-y: 0 !important;
    }

    .scale-95 {
        --transform-scale-x: .95 !important;
        --transform-scale-y: .95 !important;
    }

    .scale-100 {
        --transform-scale-x: 1 !important;
        --transform-scale-y: 1 !important;
    }

    .transform {
        --transform-translate-x: 0 !important;
        --transform-translate-y: 0 !important;
        --transform-rotate: 0 !important;
        --transform-skew-x: 0 !important;
        --transform-skew-y: 0 !important;
        --transform-scale-x: 1 !important;
        --transform-scale-y: 1 !important;
        transform: translateX(var(--transform-translate-x)) translateY(var(--transform-translate-y)) rotate(var(--transform-rotate)) skewX(var(--transform-skew-x)) skewY(var(--transform-skew-y)) scaleX(var(--transform-scale-x)) scaleY(var(--transform-scale-y)) !important;
    }

    @media (min-width: 576px) {
        .translate-y-sm-0 {
            --transform-translate-y: 0 !important;
        }

        .translate-y-sm-4 {
            --transform-translate-y: 1rem !important;
        }

        .scale-sm-0 {
            --transform-scale-x: 0 !important;
            --transform-scale-y: 0 !important;
        }

        .sm\:max-w-lg {
            max-width: 32rem !important;
        }

        .w-sm-100 {
            width: 100% !important;
        }
    }
</style>
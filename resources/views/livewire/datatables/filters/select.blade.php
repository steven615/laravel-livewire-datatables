<div x-data class="d-flex flex-column">
    <div class="d-flex">
        <select x-ref="select" name="{{ $name }}" class="m-1 fs-6 flex-grow-1 form-control" wire:input="doSelectFilter('{{ $index }}', $event.target.value)" x-on:input="$refs.select.value=''">
            <option value=""></option>
            @foreach($options as $value => $label)
            @if(is_object($label))
            <option value="{{ $label->id }}">{{ $label->name }}</option>
            @elseif(is_array($label))
            <option value="{{ $label['id'] }}">{{ $label['name'] }}</option>
            @elseif(is_numeric($value))
            <option value="{{ $label }}">{{ $label }}</option>
            @else
            <option value="{{ $value }}">{{ $label }}</option>
            @endif
            @endforeach
        </select>
    </div>

    <div class="d-flex flex-wrap space-x-1">
        @foreach($this->activeSelectFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeSelectFilter('{{ $index }}', '{{ $key }}')" x-on:click="$refs.select.value=''" class="m-1 pl-1 d-flex align-items-center text-uppercase bg-light text-white hover:danger rounded-full focus:outline-none fs-6 space-x-1">
            <span>{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
</div>
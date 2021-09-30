<div class="d-flex justify-content-center">
    <div class="custom-control custom-checkbox">
        <input type="checkbox"  id="check_{{ $value }}" wire:model="selected" value="{{ $value }}" class="custom-control-input mt-1 h-4 w-4 transition duration-150 ease-in-out" />
        <label class="custom-control-label" for="check_{{ $value }}"></label>
    </div>
</div>
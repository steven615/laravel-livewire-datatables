<span class="position-relative group cursor-pointer">
    <span class="d-flex align-items-center">{{ Str::limit($slot, $length) }}</span>
    <span class="d-none group-hover:block position-absolute z-10 -ml-28 w-96 mt-2 p-2 fs-6 text-nowrap rounded-lg bg-light border shadow-lg text-secondary text-start">{{ $slot }}</span>
</span>

<style>
    .group:hover .group-hover\:block {
        display: block;
    }

    .-ml-28 {
        margin-left: -7rem;
    }
</style>
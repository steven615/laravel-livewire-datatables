<a href="{{ $href }}" class="border-2 border-transparent text-primary hover:border-blue-500 hover:bg-blue-100 hover:shadow-lg rounded-3 px-3 py-1">{{ $slot }}</a>
<style>
a {
  text-decoration: none;
}
.hover\:shadow-lg:hover {
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}
</style>
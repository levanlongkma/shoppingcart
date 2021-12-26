@if (request()->session()->has('success'))
<div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    class="bg-gradient-warning text-center text-white py-2 px-4 h2">
    <p>{{ request()->session()->get('success') }}</p>
</div>
@endif
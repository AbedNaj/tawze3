@props(['title'])
<section class="px-6 py-6 mt-6 bg-white shadow-sm rounded-lg max-w-2xl mx-auto border border-gray-100">
    <p class="text-lg mb-4 font-semibold text-gray-900">
        {{ $title ?? 'عنوان' }}

    </p>

    {{ $slot }}
</section>

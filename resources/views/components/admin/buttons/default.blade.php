@props(['href' => '', 'span' => '', 'click' => ''])

<button @click="{{ $click }}"
    class="relative hover:cursor-pointer inline-flex items-center justify-center px-6 py-3.5 overflow-hidden font-medium rounded-xl group transition-all duration-300 shadow-lg hover:shadow-xl">

    <span
        class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-300 ease-in-out group-hover:from-blue-600 group-hover:to-indigo-700"></span>

    <span
        class="absolute top-0 left-0 w-12 h-full -ml-16 bg-white/30 transform -skew-x-12 transition-all duration-700 ease-in-out group-hover:translate-x-96"></span>


    <span
        class="absolute inset-0 rounded-xl border border-white/30 transition-all duration-300 group-hover:border-white/50"></span>


    <span
        class="relative flex items-center text-white font-bold tracking-wide transform transition-transform duration-300 group-hover:-translate-y-0.5">
        <span class="ml-2">{{ $span }}</span>
        {{ $slot }}


    </span>
</button>

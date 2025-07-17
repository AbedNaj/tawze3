@props(['click' => ''])
<button type="submit" @click="{{ $click }}"
    class="relative hover:cursor-pointer inline-flex items-center px-4 py-2.5 overflow-hidden text-sm font-medium rounded-xl group transition-all duration-300 shadow-sm hover:shadow-md">

    <span
        class="absolute inset-0 w-full h-full bg-red-600 transition-all duration-300 ease-in-out group-hover:bg-red-700"></span>


    <span
        class="absolute bottom-0 left-0 w-full h-0.5 bg-red-400 transition-all duration-500 ease-in-out group-hover:h-full group-hover:bg-red-500/20 opacity-80"></span>


    <span class="relative flex items-center text-white">
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
            </path>
        </svg>
        <span>حذف</span>
    </span>
</button>

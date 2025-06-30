<div class="w-64 bg-white  shadow-xl hidden md:block relative">
    <aside class="">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-50/50 to-purple-50/50"></div>
        <div class="relative z-10">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center space-x-3 space-x-reverse">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white text-lg font-bold">👑</span>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">لوحة التحكم</h2>
                </div>
            </div>
            <nav class="p-6 space-y-3">

                <x-super-admin.side-bar-button href="{{ route('dashboard.index') }}" :is_active="request()->routeIs('dashboard*')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                    </x-slot>
                    الرئيسيه</x-super-admin.side-bar-button>

                <x-super-admin.side-bar-button href="{{ route('company.index') }}" :is_active="request()->routeIs('company*')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-building2-icon lucide-building-2">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z" />
                            <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" />
                            <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2" />
                            <path d="M10 6h4" />
                            <path d="M10 10h4" />
                            <path d="M10 14h4" />
                            <path d="M10 18h4" />
                        </svg>
                    </x-slot>
                    الشركات</x-super-admin.side-bar-button>



                <div class="pt-4 border-t border-slate-200 mt-6">
                    <a href="#"
                        class="group flex items-center px-4 py-3 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl transition-all duration-200">
                        <span class="text-xl ml-3">🚪</span>
                        <span class="font-medium">تسجيل الخروج</span>
                    </a>
                </div>
            </nav>
        </div>
    </aside>

</div>

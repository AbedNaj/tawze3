<header class="bg-white/80 backdrop-blur-sm shadow-sm border-b border-slate-200 p-6">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4 space-x-reverse">
            <div
                class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center">
                <span class="text-white text-xl">👑</span>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">مرحبًا بك، Super Admin</h1>
                <p class="text-slate-500 text-sm">إدارة شاملة لجميع الشركات والأنظمة</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 space-x-reverse">
            <x-super-admin.button href="{{ route('company.create') }}">
                شركه جديده
            </x-super-admin.button>
        </div>
    </div>
</header>

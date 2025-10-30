<div class="fixed inset-y-0 right-0 z-50 w-72 bg-white/95 backdrop-blur-2xl border-l border-gray-200/30 shadow-xl transform transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0"
    :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full md:translate-x-0'">

    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black/30 md:hidden" @click="sidebarOpen = false">
    </div>

    <aside class="h-full flex flex-col">

        <div class="relative p-5 border-b border-white/30 bg-gradient-to-r from-blue-500 to-indigo-600">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-md shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0h4M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">نظام التوزيع</h2>
                        <p class="mt-1 text-xs text-white/90">لوحة التحكم الرئيسية</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-white/80 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>


        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <x-admin.side-bar-button :icon="view('components.icons.home')" :is_active="request()->routeis('admin.dashboard*')" href="{{ route('admin.dashboard') }}">
                {{ __('sidebar.admin.main') }}
            </x-admin.side-bar-button>

            <x-admin.side-bar-dropdown :label="__('sidebar.admin.sale')" :is_active="request()->routeIs('admin.sales*') || request()->routeIs('admin.paymentMethods*')" :icon="view('components.icons.sales')">
                <x-admin.side-bar-sub-link href="{{ route('admin.sales.index') }}" :is_active="request()->routeIs('admin.sales*')">
                    {{ __('sidebar.admin.sales') }}
                </x-admin.side-bar-sub-link>


                <x-admin.side-bar-sub-link href="{{ route('admin.paymentMethods.index') }}" :is_active="request()->routeIs('admin.paymentMethods*')">
                    {{ __('sidebar.admin.payment_method') }}
                </x-admin.side-bar-sub-link>

            </x-admin.side-bar-dropdown>

            <x-admin.side-bar-dropdown :label="__('sidebar.admin.inventory')" :is_active="request()->routeIs('admin.inventory*') || request()->routeIs('admin.employeeInventory*')" :icon="view('components.icons.inventory')">
                <x-admin.side-bar-sub-link href="{{ route('admin.inventory.index') }}" :is_active="request()->routeIs('admin.inventory.index*') || request()->routeIs('admin.inventory.show*')">
                    {{ __('sidebar.admin.inventory_list') }}
                </x-admin.side-bar-sub-link>

                <x-admin.side-bar-sub-link href="{{ route('admin.employeeInventory.index') }}" :is_active="request()->routeIs('admin.employeeInventory*') ||
                    request()->routeIs('admin.inventory.transfer*')">
                    {{ __('sidebar.admin.employee_inventory_list') }}
                </x-admin.side-bar-sub-link>
            </x-admin.side-bar-dropdown>



            <x-admin.side-bar-dropdown :label="__('sidebar.admin.products')" :is_active="request()->routeIs('admin.product-types*') || request()->routeIs('admin.product*')" :icon="view('components.icons.shopping-basket')">
                <x-admin.side-bar-sub-link href="{{ route('admin.products.index') }}" :is_active="request()->routeIs('admin.products*')">
                    {{ __('sidebar.admin.products_list') }}
                </x-admin.side-bar-sub-link>

                <x-admin.side-bar-sub-link href="{{ route('admin.product-types.index') }}" :is_active="request()->routeIs('admin.product-types*')">
                    {{ __('sidebar.admin.products_type') }}
                </x-admin.side-bar-sub-link>
            </x-admin.side-bar-dropdown>





            <x-admin.side-bar-dropdown :label="__('sidebar.admin.customer')" :is_active="request()->routeis('admin.customers*') || request()->routeis('admin.locations*')" :icon="view('components.icons.customers')">
                <x-admin.side-bar-sub-link href="{{ route('admin.customers.index') }}" :is_active="request()->routeis('admin.customers*')">
                    {{ __('sidebar.admin.customers_list') }}
                </x-admin.side-bar-sub-link>

                <x-admin.side-bar-sub-link href="{{ route('admin.locations.index') }}" :is_active="request()->routeis('admin.locations*')">
                    {{ __('sidebar.admin.location') }}
                </x-admin.side-bar-sub-link>
            </x-admin.side-bar-dropdown>


            <x-admin.side-bar-button :icon="view('components.icons.employees')" :is_active="request()->routeis('admin.employees*') || request()->routeis('admin.employeeUser*')" href="{{ route('admin.employees.index') }}">
                {{ __('sidebar.admin.employees') }}
            </x-admin.side-bar-button>






            <div class="my-4 border-t border-gray-200/40"></div>


            <form method="POST" action="">
                @csrf
                <button type="submit"
                    class="group w-full flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-red-600 hover:bg-red-50 hover:text-red-700">
                    <div
                        class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center ml-3 group-hover:bg-red-200 transition-colors shadow-inner">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    <span>{{ __('common.logout') }}</span>
                </button>
            </form>
        </nav>


        <div class="p-4 border-t border-gray-200/40 bg-white/60 backdrop-blur-sm">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center shadow-sm">
                        <span class="text-white font-semibold text-sm">أ</span>
                    </div>
                    <div class="absolute bottom-0 left-0 w-2.5 h-2.5 bg-green-400 rounded-full border-2 border-white">
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">أحمد المدير</p>
                    <p class="text-xs text-gray-500 truncate">admin@company.com</p>
                </div>
            </div>
        </div>
    </aside>
</div>

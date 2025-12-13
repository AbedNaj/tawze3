    <div x-data="{
        editing: false,
        activeTab: 'info'
    }" class="">
        @php
            $query = http_build_query([
                'employee' => $employee->id,
            ]);
        @endphp

        <x-common.show-header>
            <x-slot name="info">
                <div class="flex items-center gap-6">

                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-4xl font-bold">
                        {{ strtoupper(substr($employee->name, 0, 2)) }}
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $employee->name }}</h1>
                        <div class="flex items-center gap-4 text-blue-100">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $employee->phone }}
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>

                            </span>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="buttons">
                <x-button x-show="!editing" @click="editing = true" icon="pencil" :label="__('common.edit')"></x-button>
                <x-button wire:navigate :label="__('inventory.transfer')"
                    href="{{ route('admin.inventory.transfer') . '?' . $query }}"></x-button>

                <x-button wire:navigate :label="__('employee.employee_account')"
                    href="{{ route('admin.employeeUser.show', ['employeeUser' => $employee->user_id]) }}"></x-button>

            </x-slot>
        </x-common.show-header>


        <div class="bg-white border-b shadow-sm">
            <div class="flex gap-1 px-6">

                <x-admin.navbar-button tabName="info" :icon="view('components.icons.employees')" :label="__('employee.info')" />
                <x-admin.navbar-button wireClick="fetchSales" tabName="sales" :icon="view('components.icons.sales')" :label="__('employee.sales')" />
                <x-admin.navbar-button wireClick="fetchInventories" tabName="inventories" :icon="view('components.icons.inventory')"
                    :label="__('employee.inventories')" />

            </div>
        </div>

        <section x-show="activeTab == 'info'">
            <div x-show="!editing ">
                <div class="bg-white  p-6 rounded-lg shadow relative">




                    <div class="flex flex-wrap gap-6">
                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.employees')" color="blue" :label="__('employee.name')"
                                :data="$employee->name" />
                        </div>

                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.phone')" color="green" :label="__('employee.phone')"
                                :data="$employee->phone" />
                        </div>

                    </div>


                </div>
            </div>




            <div x-show="editing" x-cloak>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4"> {{ __('common.edit') }}</h2>
                    <form action="{{ route('admin.employees.update', [$employee->id]) }}" method="POST"
                        class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <x-input name="name" :label="__('employee.name')" :value="$employee->name" />

                        <x-input name="phone" :label="__('employee.phone')" :value="$employee->phone" />

                        <div class="flex items-center gap-4">
                            <x-button primary type="submit" :label="__('inventory.save')" />
                            <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                        </div>

                    </form>


                </div>
            </div>
        </section>

        <section x-cloak class="bg-white p-6 rounded-lg shadow relative" x-show="activeTab == 'sales'">

            @include('admin.partials.employee.sales-history')
        </section>



        <section x-cloak class="bg-white p-6 rounded-lg shadow relative" x-show="activeTab == 'inventories'">

            @include('admin.partials.employee.inventories-history')
        </section>
    </div>

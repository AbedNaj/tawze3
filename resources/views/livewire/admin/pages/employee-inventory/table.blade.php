<div>

    <div class="flex flex-wrap py-2 max-w-md space-x-2">

        <x-select :options="$employees" option-label="name" option-value="id" wire:model.live="selectedEmployee"
            placeholder="{{ __('employee.select') }}" label="{{ __('employee.name') }}" />
        @if ($selectedEmployee)
            <x-input type="text" wire:model.live="productName" placeholder="{{ __('common.search') }}"
                label="{{ __('product.name') }}" />
        @endif

    </div>



    @if ($selectedEmployee)
        <section class="bg-white rounded-2xl shadow-xl border border-slate-200/50 overflow-hidden backdrop-blur-sm">


            <div
                class="p-6 border-b border-slate-200/70 bg-gradient-to-br from-slate-50 via-white to-slate-50/80 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-purple-500/5"></div>
                <div class="relative z-10">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">
                                {{ __('employee.employee_inventory') . ' - ' . $employeeName }}</h2>

                        </div>

                    </div>
                </div>
            </div>


            <div class="overflow-x-auto">
                <div class="hidden lg:block">
                    <table class="w-full min-w-[720px]">
                        <thead class="bg-gradient-to-r from-slate-50 to-slate-100/80">
                            <tr>
                                <th
                                    class="px-6 py-4 text-right text-slate-600 font-semibold border-b border-slate-200/70 whitespace-nowrap">
                                    {{ __('employee.product_name') }}

                                </th>
                                <th
                                    class="px-6 py-4 text-right text-slate-600 font-semibold border-b border-slate-200/70 whitespace-nowrap">
                                    {{ __('employee.inventory.quantity') }}
                                </th>
                                <th
                                    class="px-6 py-4 text-right text-slate-600 font-semibold border-b border-slate-200/70 whitespace-nowrap">
                                    {{ __('employee.inventory.inventory_status') }}
                                </th>
                                <th
                                    class="px-6 py-4 text-center text-slate-600 font-semibold border-b border-slate-200/70 whitespace-nowrap">
                                    {{ __('common.actions') }}
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-200/70">

                            @forelse ($inventories as $inventory)
                                @php

                                    $invStatusEnum = \App\Enums\EmployeeInventoryStatusEnum::tryFrom(
                                        $inventory->status,
                                    );
                                    $label = $invStatusEnum->label() ?? __('employee.inventory.status.unknown');
                                    $color = $invStatusEnum->color() ?? 'gray';
                                @endphp


                                <tr
                                    class="hover:bg-gradient-to-r hover:from-slate-50 hover:to-blue-50/30 transition-all duration-300 group">
                                    <td class="px-6 py-4 text-right align-middle">
                                        <span class="text-slate-700">{{ $inventory->product->name }} </span>
                                    </td>
                                    <td class="px-6 py-4 text-right align-middle">
                                        <span class="text-slate-700">{{ $inventory->quantity }} </span>
                                    </td>
                                    <td class="px-6 py-4 text-right align-middle">
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full shadow-sm bg-{{ $color }}-100 text-{{ $color }}-800 border border-{{ $color }}-200">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center align-middle">
                                        <button
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 shadow-sm transition-all duration-300">
                                            {{ __('common.show') }}
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-12 text-center">
                                        <div class="flex flex-col items-center space-y-4">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <h3 class="text-lg font-medium text-slate-600">
                                                    {{ __('common.no_data') }}
                                                </h3>
                                                <p class="text-slate-500 mt-1">
                                                    {{ __('employee.inventory.empty') }}

                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse



                        </tbody>
                    </table>
                </div>


                <div class="lg:hidden p-4 space-y-4">
                    @forelse ($inventories as  $inventory)
                        <div
                            class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="flex justify-between items-start">
                                <div class="text-right">
                                    <div class="text-sm font-medium text-slate-500"> {{ __('employee.product_name') }}
                                    </div>
                                    <div class="mt-1 text-slate-700">{{ $inventory->product->name }}</div>
                                </div>

                                <div class="text-right">
                                    <div class="text-sm font-medium text-slate-500"> {{ __('employee.quantity') }}
                                    </div>
                                    <div class="mt-1 text-slate-700">{{ $inventory->quantity }}</div>
                                </div>
                            </div>

                            <div class="mt-3">
                                @php
                                    $statusEnum = App\Enums\EmployeeInventoryStatusEnum::tryFrom($inventory->status);
                                    $label = $statusEnum?->label() ?? __('employee.inventory.status.unknown');
                                    $color = $statusEnum?->color() ?? 'gray';

                                @endphp
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-medium text-slate-500">
                                        {{ __('employee.inventory.inventory_status') }}</div>
                                    <div>
                                        <span
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg- {{ $color }}-100 text- {{ $color }}-800 border border- {{ $color }}-200">
                                            {{ $label }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-200">
                                <button
                                    class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 shadow-sm transition-all duration-300">
                                    عرض التفاصيل
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="flex flex-col items-center space-y-4">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                        </path>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <h3 class="text-lg font-medium text-slate-600">{{ __('common.no_data') }}</h3>
                                    <p class="text-slate-500 mt-1">
                                        {{ __('employee.inventory.empty') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforelse




                </div>
            </div>


            {{ $inventories->links() }}
        </section>
    @else
        <div class="mt-6 p-12 text-center bg-white rounded-2xl shadow-xl border border-slate-200/50">
            <div class="flex flex-col items-center space-y-4">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                </div>
                <div class="text-center">
                    <h3 class="text-lg font-medium text-slate-600">{{ __('employee.select_employee_message') }}</h3>
                    <p class="text-slate-500 mt-1">{{ __('employee.select_employee_sub_message') }}</p>
                </div>
            </div>
        </div>
    @endif


</div>

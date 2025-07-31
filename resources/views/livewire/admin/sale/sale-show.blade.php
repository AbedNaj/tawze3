<div>
    @php

        $statusEnum = App\Enums\SaleStatusEnum::tryFrom($sale->status);
        $label = $statusEnum ? $statusEnum->label() : '---';
        $color = $statusEnum ? $statusEnum->color() : 'gray';
    @endphp
    @if ($sale->status == App\Enums\SaleStatusEnum::DRAFT->value)
        <div class="container mx-auto px-4 py-8" x-data="invoiceData()">

            <div class="mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center">
                        <i class="fas fa-receipt mx-3 text-blue-600"></i>
                        {{ __('sale.sale.sale_details') }}
                    </h1>
                    <p class="text-gray-600">{{ __('sale.sale.invoice_number') }}: #{{ $sale->invoice_number }}</p>
                </div>

                <div class="mt-4 lg:mt-0 flex items-center space-x-4">
                    <x-admin.sale.status-badegt color="{{ $color }}" label="{{ $label }}" />

                </div>
            </div>


            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 lg:p-8">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                        @include('admin.partials.sale.invoice-card')
                        @include('admin.partials.sale.employee-card')
                        @include('admin.partials.sale.customer-card')

                    </div>


                    @include('admin.partials.sale.add-product')

                    @include('admin.partials.sale.sale-table')

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        @include('admin.partials.sale.summery')
                    </div>


                    <div
                        class="flex flex-col sm:flex-row  space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">

                        @include('admin.partials.sale.buttons')
                    </div>
                </div>
            </div>

        </div>

        <script>
            function invoiceData() {
                return {
                    isForEmployee: false,
                    addProduct: false,
                    selectedCustomer: '',
                    invoiceDate: new Date().toISOString().split('T')[0],
                    discount: 0,
                    products: [],



                }
            }
        </script>
    @elseif (
        $sale->status == App\Enums\SaleStatusEnum::CONFIRMED->value ||
            $sale->status == App\Enums\SaleStatusEnum::CANCELLED->value)
        <div class="container mx-auto px-4 py-8">

            <div class="mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center">
                        <i class="fas fa-receipt mx-3 text-blue-600"></i>
                        {{ __('sale.sale.sale_details') }}
                    </h1>
                    <p class="text-gray-600">{{ __('sale.sale.invoice_number') }}: #{{ $sale->invoice_number }}</p>
                </div>

                <div class="mt-4 lg:mt-0 flex items-center space-x-4">
                    <x-admin.sale.status-badegt color="{{ $color }}" label="{{ $label }}" />

                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 lg:p-8">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                        <x-admin.sale.card>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-blue-600"></i>
                                {{ __('sale.sale.invoice_details') }}
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span
                                        class="text-sm font-medium text-gray-600">{{ __('sale.sale.invoice_number') }}:</span>
                                    <span class="text-sm font-bold text-gray-800">#{{ $sale->invoice_number }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span
                                        class="text-sm font-medium text-gray-600">{{ __('sale.sale.invoice_date') }}:</span>
                                    <span class="text-sm text-gray-800">{{ $sale->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span
                                        class="text-sm font-medium text-gray-600">{{ __('sale.sale.completed_at') }}:</span>
                                    <span
                                        class="text-sm text-gray-800">{{ $sale->updated_at->format('Y-m-d H:i') }}</span>
                                </div>
                            </div>
                        </x-admin.sale.card>


                        <x-admin.sale.card>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-user-tie mr-2 text-green-600"></i>
                                {{ __('sale.sale.employee') }}
                            </h3>
                            <div class="space-y-3">
                                @if ($sale->employee)
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $sale->employee->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $sale->employee->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-user-slash text-gray-400 text-2xl mb-2"></i>
                                        <p class="text-sm text-gray-500">{{ __('sale.sale.no_employee_assigned') }}</p>
                                    </div>
                                @endif
                            </div>
                        </x-admin.sale.card>

                        <x-admin.sale.card>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-users mr-2 text-purple-600"></i>
                                {{ __('sale.sale.customer') }}
                            </h3>
                            <div class="space-y-3">
                                @if ($sale->customer)
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $sale->customer->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $sale->customer->phone }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-user-times text-gray-400 text-2xl mb-2"></i>
                                        <p class="text-sm text-gray-500">{{ __('sale.sale.walk_in_customer') }}</p>
                                    </div>
                                @endif
                            </div>
                        </x-admin.sale.card>
                    </div>


                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-shopping-cart mr-2 text-orange-600"></i>
                            {{ __('sale.sale.sold_products') }}
                        </h3>

                        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">

                            <div class="md:hidden space-y-4 p-4" dir="rtl">
                                @foreach ($sale->items as $index => $item)
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex-1">
                                                <h3 class="font-medium text-gray-900 text-right">
                                                    {{ $item->product->name }}</h3>
                                                <span class="text-sm text-gray-500">#{{ $index + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-4">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 mb-1">{{ __('sale.sale.price') }}</label>
                                                <div class="text-sm font-medium">${{ $item->product->price }}</div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 mb-1">{{ __('sale.sale.quantity') }}</label>
                                                <div class="text-sm font-medium">{{ $item->quantity }}</div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 mb-1">{{ __('sale.sale.total') }}</label>
                                                <div class="text-sm font-medium text-green-600">
                                                    ${{ $item->total_price }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full min-w-full border-collapse" dir="rtl">
                                    <thead class="bg-gradient-to-l from-gray-50 to-gray-100">
                                        <tr>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                #</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                {{ __('sale.sale.product') }}</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                {{ __('sale.sale.price') }}</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                {{ __('sale.sale.quantity') }}</th>
                                            <th
                                                class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                                {{ __('sale.sale.total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-100">
                                        @foreach ($sale->items as $index => $item)
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td
                                                    class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                                    {{ $index + 1 }}</td>
                                                <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                                    {{ $item->product->name }}</td>
                                                <td
                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                                    ${{ $item->product->price }}</td>
                                                <td
                                                    class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                                    {{ $item->stock }}</td>
                                                <td
                                                    class="px-4 py-4 whitespace-nowrap text-sm font-medium text-green-600 text-right">
                                                    ${{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                        <div class="lg:col-span-2">
                            <x-admin.sale.card>
                                <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-sticky-note mr-2 text-yellow-600"></i>
                                    {{ __('sale.sale.notes') }}
                                </h4>
                                @if ($sale->note)
                                    <p class="text-gray-700 leading-relaxed">{{ $sale->note }}</p>
                                @else
                                    <p class="text-gray-500 italic">{{ __('sale.sale.no_notes_added') }}</p>
                                @endif
                            </x-admin.sale.card>
                        </div>


                        <div class="lg:col-span-1">
                            <div
                                class="bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-xl text-white shadow-lg">
                                <h4 class="text-lg font-semibold mb-4 flex items-center">
                                    <i class="fas fa-calculator mr-2"></i>
                                    {{ __('sale.sale.final_summary') }}
                                </h4>
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center pb-3 border-b border-green-400">
                                        <span class="text-green-100">{{ __('sale.sale.total') }}:</span>
                                        <span class="font-medium">${{ $sale->price }}</span>
                                    </div>
                                    @if ($sale->discount > 0)
                                        <div class="flex justify-between items-center pb-3 border-b border-green-400">
                                            <span class="text-green-100">{{ __('sale.sale.discount') }}:</span>
                                            <span class="font-medium">-${{ $sale->discount }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between items-center text-xl font-bold pt-2">
                                        <span>{{ __('sale.sale.total_paid') }}:</span>
                                        <span>${{ $sale->total }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div
                        class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                        <div>
                            <a href="{{ route('admin.sales.index') }}"
                                class="px-6 py-3 bg-gradient-to-r hover:cursor-pointer from-blue-500 to-blue-500 text-white rounded-lg hover:from-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 font-medium">
                                <i class="fas fa-arrow-left  mx-2"></i>{{ __('sale.sale.back_to_sales') }}
                            </a>
                        </div>
                        @if ($sale->status == App\Enums\SaleStatusEnum::CONFIRMED->value)
                            <div class="space-x-4">
                                <button wire:click='saleCancel'
                                    class="px-6 py-3 border border-gray-300 hover:cursor-pointer text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                                    <i class="fas fa-trash mx-2"></i>{{ __('sale.sale.cancel_sale') }}
                                </button>
                                <button wire:click='saleDelete'
                                    class="px-6 py-3 bg-blue-600 hover:cursor-pointer text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                    <i class="fas fa-print mr-2"></i>
                                    {{ __('sale.sale.print_invoice') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

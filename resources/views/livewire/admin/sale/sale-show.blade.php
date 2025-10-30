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
                        @include('admin.partials.sale.show.invoice-card')
                        @include('admin.partials.sale.show.employee-card')

                        @include('admin.partials.sale.show.customer-card')



                    </div>
                    @include('admin.partials.sale.show.sale-table')


                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        @include('admin.partials.sale.show.summery')

                    </div>



                    <div
                        class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                        @include('admin.partials.sale.show.buttons')
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<div class="container mx-auto px-4 py-8" x-data="invoiceData()">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="fas fa-receipt mr-3 text-blue-600"></i>
            {{ __('sale.sale.create_new_sale') }}
        </h1>
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


            <div class="flex flex-col sm:flex-row  space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">

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

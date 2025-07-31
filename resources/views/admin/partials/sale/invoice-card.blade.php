<x-admin.sale.card>
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-info-circle mr-2 text-blue-600"></i>
        {{ __('sale.sale.invoice_details') }}
    </h3>
    <div class="space-y-3">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('sale.sale.invoice_number') }}</label>
            <input type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                value="{{ $sale->invoice_number }}" readonly>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('sale.sale.invoice_date') }}</label>
            <input type="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                x-model="invoiceDate">
        </div>
    </div>
</x-admin.sale.card>

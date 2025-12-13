<x-admin.sale.card>
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fa-solid fa-warehouse text-green-600"></i>
        {{ __('sale.sale.storage_location') }}
    </h3>

    <div class="space-y-3">

        <div class="flex items-center">
            <div class="w-10 h-10 mx-2 bg-green-500 rounded-full flex items-center justify-center mr-3">
                <i class="fa-solid fa-warehouse text-white text-sm"></i>
            </div>
            <div>
                <p class="font-medium text-gray-800">
                    {{ $sale->sourceable->name }}
                </p>

            </div>
        </div>

    </div>
</x-admin.sale.card>

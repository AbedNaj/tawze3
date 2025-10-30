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
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                {{ $index + 1 }}</td>
                            <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                {{ $item->product->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                ${{ $item->product->price }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                {{ $item->stock }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-green-600 text-right">
                                ${{ $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

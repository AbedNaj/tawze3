<div class="mb-8">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 lg:mb-0 flex items-center">
            <i class="fas fa-shopping-cart mr-2 text-orange-600"></i> {{ __('sale.sale.products') }}
        </h3>
        <button type="button"
            class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 hover:cursor-pointer text-white rounded-lg hover:from-cyan-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 font-medium"
            @click="addProduct = true">
            <i class="fas fa-plus mr-2"></i>
            {{ __('sale.sale.add_product') }}
        </button>
    </div>


    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">
        <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm">

            <div class="bg-white rounded-lg shadow-lg overflow-hidden">

                <div class="md:hidden space-y-4 p-4" dir="rtl">
                    @forelse ($saleItems as $index => $item)
                        <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-900 text-right">
                                        {{ $item['product']['name'] ?? '---' }}
                                    </h3>
                                    <span class="text-sm text-gray-500">#{{ $index + 1 }}</span>
                                </div>
                                <button
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs transition-colors"
                                    wire:click="removeProduct({{ $item['id'] }})">
                                    <i class="fas fa-trash mr-1"></i>{{ __('sale.sale.remove') }}
                                </button>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">السعر</label>
                                    <div class="truncate">

                                        ${{ $item['product']['price'] }}
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-500 mb-1">المجموع</label>
                                    <div class="px-2 py-1 bg-gray-100 rounded text-sm text-center font-medium">
                                        ${{ $item['price'] ?? '---' }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-xs font-medium text-gray-500 mb-1">الكمية</label>
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs shrink-0"
                                        wire:click="decreaseQuantity({{ $item['id'] }})">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" min="1"
                                        class="w-16 px-2 py-1 border border-gray-300 rounded text-sm text-center focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shrink-0 ltr"
                                        wire:model.lazy="saleItems.{{ $index }}.stock">
                                    <button type="button"
                                        class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs shrink-0"
                                        wire:click="increaseQuantity({{ $item['id'] }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                            <p class="text-lg font-medium"> {{ __('sale.sale.no_added_products') }}</p>
                            <p class="text-sm"> {{ __('sale.sale.no_added_products_subtitle') }}</p>
                        </div>
                    @endforelse
                </div>



                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full min-w-full border-collapse table-fixed" dir="rtl">
                        <thead class="bg-gradient-to-l from-gray-50 to-gray-100">
                            <tr>
                                <th
                                    class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-16">
                                    #</th>
                                <th
                                    class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 min-w-0 max-w-xs">
                                    {{ __('sale.sale.product') }}</th>
                                <th
                                    class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-32">
                                    {{ __('sale.sale.price') }}</th>
                                <th
                                    class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-40">
                                    {{ __('sale.sale.quantity') }}</th>
                                <th
                                    class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-32">
                                    {{ __('sale.sale.total') }}</th>
                                <th
                                    class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 w-28">
                                    {{ __('sale.sale.actions') }}</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($saleItems as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td
                                        class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                        <div class="truncate" title="{{ $item['product']['name'] ?? '---' }}">
                                            {{ $item['product']['name'] ?? '---' }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-right">
                                        <div class="truncate">

                                            ${{ $item['product']['price'] }}
                                        </div>
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button type="button"
                                                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs shrink-0 transition-colors"
                                                wire:click="decreaseQuantity({{ $item['id'] }})">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" min="1"
                                                class="w-16 px-2 py-1 border border-gray-300 rounded text-sm text-center focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shrink-0 ltr"
                                                wire:model.lazy="saleItems.{{ $index }}.stock">
                                            <button type="button"
                                                class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-xs shrink-0 transition-colors"
                                                wire:click="increaseQuantity({{ $item['id'] }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>

                                    <td
                                        class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                        ${{ $item['price'] ?? '---' }}
                                    </td>

                                    <td class="px-4 py-4 whitespace-nowrap text-right">
                                        <button type="button"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors text-xs font-medium"
                                            wire:click="removeProduct({{ $item['id'] }})">
                                            <i class="fas fa-trash mr-1"></i>{{ __('sale.sale.remove') }}
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                                        <p class="text-lg font-medium">
                                            {{ __('sale.sale.no_added_products') }}</p>
                                        <p class="text-sm">
                                            {{ __('sale.sale.no_added_products_subtitle') }}</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>


        </div>

    </div>
</div>

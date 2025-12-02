                    <x-admin.sale.card>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-users mx-2 text-purple-600"></i>
                            {{ __('sale.sale.customer') }}
                        </h3>
                        <div class="space-y-3 ">
                            @if ($sale->customer)
                                <div class="flex space-x-2 items-center">
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

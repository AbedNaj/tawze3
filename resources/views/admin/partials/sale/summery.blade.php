                <div class="lg:col-span-2">

                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-6 hover:shadow-xl transition-all duration-300">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-sticky-note mr-2 text-yellow-600"></i>
                            {{ __('sale.sale.additional_notes') }}
                        </h4>
                        <textarea wire:model.live.debounce.500ms='note'
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                            rows="4" placeholder="{{ __('sale.sale.additional_notes_placeholder') }}"></textarea>
                    </div>

                </div>

                <div class="lg:col-span-1">

                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 p-6 rounded-lg text-white shadow-lg">
                        <h4 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="fas fa-calculator mr-2"></i>{{ __('sale.sale.invoice_summery') }}
                        </h4>
                        <div class="space-y-3">



                            <div class="flex justify-between items-center text-xl font-bold pt-2">
                                <span>{{ __('sale.sale.total') }} : </span>
                                <span>${{ $total }} </span>
                            </div>
                        </div>
                    </div>
                </div>

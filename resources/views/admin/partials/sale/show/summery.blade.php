<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div>
        <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">

                    <svg class="w-6 h-6 text-emerald-500" viewBox="0 0 24 24" fill="none" aria-hidden>
                        <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor"
                            stroke-width="1.5" />
                        <path d="M7 7h10M7 11h10M7 15h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <h4 class="text-lg font-semibold text-gray-800">{{ __('sale.sale.financial_summary') }}</h4>
                </div>

                @php
                    $paymentStatus = App\Enums\SalePaymentStatusEnum::tryFrom($sale->payment_status);
                @endphp
                <div>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $paymentStatus && $paymentStatus->value === App\Enums\SalePaymentStatusEnum::Paid->value ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $paymentStatus?->label() ?? __('common.no_data') }}
                    </span>
                </div>
            </div>

            @php
                $total = (float) $sale->price;
                $paid = (float) $sale->total_paid;
                $discount = (float) $sale->discount ?? 0;
                $net = max(0, $total - $discount);
                $debt = max(0, $net - $paid);
                $progress = $net > 0 ? min(100, round(($paid / $net) * 100)) : 100;
            @endphp

            <div class="mt-5 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">{{ __('sale.sale.total') }}</div>
                    <div class="font-medium text-gray-800">${{ number_format($total, 2) }}</div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">{{ __('sale.sale.discount') }}</div>
                    <div class="font-medium text-gray-800">- ${{ number_format($discount, 2) }}</div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">{{ __('sale.sale.net_total') }}</div>
                    <div class="font-bold text-gray-900">${{ number_format($net, 2) }}</div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">{{ __('sale.sale.total_paid') }}</div>
                    <div class="font-medium text-gray-800">${{ number_format($paid, 2) }}</div>
                </div>


                <div>
                    <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                        <div class="h-2 rounded-full"
                            style="width: {{ $progress }}%; background: linear-gradient(90deg, #10b981, #06b6d4);">
                        </div>
                    </div>
                    <div class="mt-2 text-xs text-gray-500 flex justify-between">
                        <span>{{ $progress }}% {{ __('sale.sale.paid_progress') ?? 'paid' }}</span>
                        <span class="text-gray-400">${{ number_format(max(0, $net - $paid), 2) }}
                            {{ __('sale.sale.remaining') ?? 'remaining' }}</span>
                    </div>
                </div>

                <div class="pt-3 border-t flex border-gray-100  items-center justify-between gap-3">

                    <div>
                        @if ($debt > 0)
                            <div class="text-sm my-2 text-rose-600 font-semibold">
                                {{ __('sale.sale.debt') ?? 'Debt' }}:
                                ${{ number_format($debt, 2) }}</div>

                            <x-common.modal name="debtPay" buttomWireClick="fetchPaymentMethods" saveWireClick="debtPay"
                                buttonColor="green" size="md" buttonIcon="banknotes" :saveLabel="__('sale.sale.pay')"
                                :buttonLabel="__('sale.sale.pay_debt')" :title="__('sale.sale.pay_debt')">

                                <x-input wire:model='debtPaiedAmount' :label="__('sale.sale.paid_amount')"></x-input>
                                <x-select :label="__('sale.sale.payment_method')" wire:model.live='paymentMethod' :placeholder="__('sale.sale.payment_method_placeholder')"
                                    :options="$paymentMethods" option-label="name" option-value="id" />
                            </x-common.modal>
                        @else
                            <div
                                class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full text-sm font-semibold">

                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" aria-hidden>
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ __('sale.sale.fully_paid') ?? 'Paid' }}
                            </div>

                            <button disabled class="px-4 py-2 bg-gray-100 text-gray-500 rounded-md text-sm">
                                {{ __('sale.sale.no_action_needed') ?? 'No action' }}
                            </button>
                        @endif

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="lg:col-span-1">
        <x-admin.sale.card class="h-full">
            <div class="flex items-start justify-between gap-4">
                <div class="flex items-center gap-3">

                    <svg class="w-6 h-6 text-yellow-500" viewBox="0 0 24 24" fill="none" aria-hidden>
                        <path d="M4 7a2 2 0 0 1 2-2h8l6 6v7a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7z" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 3v6h6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <h4 class="text-lg font-semibold text-gray-800">{{ __('sale.sale.notes') }}</h4>
                </div>
                <span class="text-sm text-gray-500">{{ $sale->created_at?->format('Y-m-d') }}</span>
            </div>

            <div class="mt-4">
                @if ($sale->note)
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $sale->note }}</p>
                @else
                    <p class="text-gray-500 italic">{{ __('sale.sale.no_notes_added') }}</p>
                @endif
            </div>
        </x-admin.sale.card>
    </div>
</div>

<div class="mb-8">
    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">

        {{ __('customer.debt_history') }}
    </h3>

    <div class="overflow-x-auto bg-white rounded-lg border border-gray-200 shadow-sm ">

        <div class="md:hidden space-y-4 p-4">
            @forelse ($debts as $index => $item)
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900 text-right">
                            </h3>
                            <span class="text-sm text-gray-500">#{{ $index + 1 }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 mb-1">{{ __('sale.sale.invoice_number') }}</label>
                            <div class="text-sm font-medium">{{ $item->sale->invoice_number ?? '' }}</div>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 mb-1">{{ __('debt.debt_amount') }}</label>
                            <div class="text-sm font-medium">{{ $item->debt_amount }}</div>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 mb-1">{{ __('debt.paid_amount') }}</label>
                            <div class="text-sm font-medium">
                                ${{ $item->paid_amount }}</div>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-medium text-gray-500 mb-1">{{ __('debt.remaining_amount') }}</label>
                            <div class="text-sm font-medium">
                                ${{ $item->remaining_amount }}</div>
                        </div>
                        @php
                            $debtStatus = App\Enums\DebtStatusEnum::tryFrom($item->status);
                        @endphp
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">{{ __('debt.status') }}</label>
                            <div class="text-sm font-medium text-{{ $debtStatus->color() }}-600">
                                {{ $debtStatus->label() }}</div>
                        </div>
                    </div>
                </div>

            @empty
                <x-common.no-data />
            @endforelse
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full min-w-full border-collapse">
                <thead class="bg-gradient-to-l from-gray-50 to-gray-100">
                    <tr>
                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            #</th>
                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            {{ __('sale.sale.invoice_number') }}</th>
                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            {{ __('debt.debt_amount') }}</th>
                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            {{ __('debt.paid_amount') }}</th>
                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            {{ __('debt.remaining_amount') }}</th>
                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            {{ __('debt.status') }}</th>

                        <th
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                            {{ __('common.actions') }}</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($debts as $index => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                {{ $index + 1 }}</td>
                            <td class="px-4 py-4 text-sm text-gray-900 text-right">
                                {{ $item->sale->invoice_number ?? __('sale.sale.no_invoice_number') }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                {{ $item->debt_amount }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                {{ $item->paid_amount }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                {{ $item->remaining_amount }}</td>
                            @php
                                $debtStatus = App\Enums\DebtStatusEnum::tryFrom($item->status);
                            @endphp
                            <td class="px-4 py-4  text-sm ">

                                <p
                                    class="inline-flex items-center px-3  bg-{{ $debtStatus->color() }}-100    text-{{ $debtStatus->color() }}-800 py-1.5 text-xs font-medium rounded-full shadow-sm">
                                    {{ $debtStatus->label() }}
                                </p>

                            </td>

                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-right">

                                <x-button wire:navigate sm href="{{ route('admin.sales.show', $item->sale->id ?? 1) }}"
                                    :label="__('sale.sale.show')"></x-button>
                            </td>
                        </tr>
                    @empty
                        <x-common.no-data />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

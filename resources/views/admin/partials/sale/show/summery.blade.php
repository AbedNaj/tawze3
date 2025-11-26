<div class="lg:col-span-2">
    <x-admin.sale.card>
        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-sticky-note mr-2 text-yellow-600"></i>
            {{ __('sale.sale.notes') }}
        </h4>
        @if ($sale->note)
            <p class="text-gray-700 leading-relaxed">{{ $sale->note }}</p>
        @else
            <p class="text-gray-500 italic">{{ __('sale.sale.no_notes_added') }}</p>
        @endif
    </x-admin.sale.card>
</div>


<div class="lg:col-span-1">
    <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-6 rounded-xl text-white shadow-lg">
        <h4 class="text-lg font-semibold mb-4 flex items-center">
            <i class="fas fa-calculator mx-2"></i>
            {{ __('sale.sale.financial_summary') }}
        </h4>
        <div class="space-y-4">
            <div class="flex justify-between items-center pb-3  border-green-400">
                <span class="text-green-100">{{ __('sale.sale.total') }}:</span>
                <span class="font-medium">${{ $sale->price }}</span>
            </div>
            <div class="flex justify-between items-center pb-3  border-green-400">
                <span class="text-green-100">{{ __('sale.sale.total_paid') }}:</span>
                <span class="font-medium">${{ $sale->total_paid }}</span>
            </div>
            @if ($sale->discount > 0)
                <div class="flex justify-between items-center pb-3  border-green-400">
                    <span class="text-green-100">{{ __('sale.sale.discount') }}:</span>
                    <span class="font-medium">-${{ $sale->discount }}</span>
                </div>
            @endif
            <div class="flex justify-between items-center text-xl font-bold pt-2 border-t  border-green-400">
                @php
                    $paymentStatus = App\Enums\SalePaymentStatusEnum::tryFrom($sale->payment_status);
                @endphp
                <span>{{ __('sale.sale.payment_status') }}:</span>
                <span>{{ $paymentStatus->label() }}</span>
            </div>
        </div>
    </div>
</div>

<x-button wire:click='fetchPaymentMethods' xl icon="check" :label="__('sale.sale.invoice_create')" x-on:click="$openModal('confirmModal');  "
    class="bg-gradient-to-r hover:cursor-pointer from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 " />

<x-modal-card :title="__('sale.sale.confirm_sale')" name="confirmModal">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">


        <x-select :label="__('sale.sale.payment_method')" wire:model.live='paymentMethod' :placeholder="__('sale.sale.payment_method_placeholder')" :options="$paymentMethods"
            option-label="name" option-value="id" />
        <x-input :label="__('sale.sale.paid_amount')" wire:model.live='paidAmount' :placeholder="__('sale.sale.paid_amount_placeholder')"
            description="{{ __('sale.sale.sale_amount') . ' : ' . $total }}" />


    </div>

    <x-slot name="footer" class="flex justify-between gap-x-4">


        <div class="flex gap-x-4">
            <x-button flat :label="__('common.cancel')" x-on:click="close" />

            <x-button @click="confirmSale = true" wire:click='saleConfirm' primary :label="__('sale.sale.invoice_create')" />
        </div>
    </x-slot>
</x-modal-card>

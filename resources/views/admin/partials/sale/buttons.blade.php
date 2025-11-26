     @include('admin.partials.sale.confirm-modal')


     <x-button xl href="{{ route('admin.sales.index') }}" icon="bookmark" :label="__('sale.sale.save_draft')"></x-button>
     <x-common.delete-modal buttonSize="xl" :buttonLabel="__('sale.sale.delete_sale')" livewireClick="saleDelete"></x-common.delete-modal>

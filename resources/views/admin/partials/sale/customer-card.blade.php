                <x-admin.sale.card>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-users mr-2 text-purple-600"></i>{{ __('sale.sale.customer') }}
                    </h3>
                    <div class=" flex flex-col space-y-3">


                        <x-select wire:model.live='customer' label="{{ __('sale.sale.select_customer') }}"
                            placeholder="{{ __('common.select') }}" :async-data="route('api.v1.customers')" option-label="name"
                            option-value="id" />


                        <x-button wire:navigate icon="plus" :label="__('sale.sale.add_new_customer')" :href="route('admin.customers.create')"></x-button>
                    </div>
                </x-admin.sale.card>

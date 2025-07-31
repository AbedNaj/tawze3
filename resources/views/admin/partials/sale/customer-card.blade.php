                <x-admin.sale.card>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-users mr-2 text-purple-600"></i>{{ __('sale.sale.customer') }}
                    </h3>
                    <div class=" flex flex-col space-y-3">
                        <x-admin.sale.select name="customer" :options="$customers" :label="__('sale.sale.select_customer')" />
                        <x-admin.sale.button
                            :href="route('admin.customers.create')">{{ __('sale.sale.add_new_customer') }}</x-admin.sale.button>
                    </div>
                </x-admin.sale.card>

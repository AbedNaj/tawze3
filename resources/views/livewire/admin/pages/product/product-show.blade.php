    <div x-data="{
        editing: false,
        activeTab: 'info'
    }" class="">


        <x-common.show-header>
            <x-slot name="info">
                <div class="flex items-center gap-6">

                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-4xl font-bold">
                        {{ strtoupper(substr($product->name, 0, 2)) }}
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center gap-4 text-blue-100">


                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="buttons">
                <x-button x-show="!editing" @click="editing = true" icon="pencil" :label="__('common.edit')"></x-button>

            </x-slot>
        </x-common.show-header>


        <div class="bg-white border-b shadow-sm">
            <div class="flex gap-1 px-6">

                <x-admin.navbar-button tabName="info" :icon="view('components.icons.employees')" :label="__('employee.info')" />
                <x-admin.navbar-button wireClick="fetchInventories" tabName="inventories" :icon="view('components.icons.inventory')"
                    :label="__('product.inventory_list')" />

            </div>
        </div>

        <section x-show="activeTab == 'info'">
            <div x-show="!editing ">
                <div class="bg-white  p-6 rounded-lg shadow relative">

                    <div class="flex flex-wrap gap-6">
                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.shopping-basket')" color="blue" :label="__('product.name')"
                                :data="$product->name" />
                        </div>

                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.info')" color="yellow" :label="__('product.product_type')"
                                :data="$product->productType->name" />
                        </div>

                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.wallet')" color="green" :label="__('product.price')"
                                :data="$product->price" />
                        </div>
                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.qr-code')" color="gray" :label="__('product.qr_code')"
                                :data="$product->qr_code ?? __('product.no_qr_code')" />
                        </div>
                    </div>


                </div>
            </div>




            <div x-show="editing" x-cloak>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4"> {{ __('common.edit') }}</h2>
                    <form action="{{ route('admin.products.update', [$product->id]) }}" method="POST"
                        class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <x-input name="name" :label="__('product.name')" :value="$product->name" />

                        <x-select wire:model='selectedProductType' name="product_type_id" :label="__('product.product_type')"
                            :options="$productTypes" option-label="name" option-value="id" :value="$product->productType->id"
                            :placeholder="__('common.select')" />

                        <x-input name="price" :label="__('product.price')" :value="$product->price" type="number" />
                        <div class="flex items-center gap-4">
                            <x-button primary type="submit" :label="__('inventory.save')" />
                            <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                        </div>

                    </form>


                </div>
            </div>
        </section>



        <section x-cloak class="bg-white p-6 rounded-lg shadow relative" x-show="activeTab == 'inventories'">
            @include('admin.partials.product.product-inventories-table')
        </section>
    </div>

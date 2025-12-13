    <div x-data="{
        editing: false,
        activeTab: 'info'
    }" class="">


        <x-common.show-header>
            <x-slot name="info">
                <div class="flex items-center gap-6">

                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-4xl font-bold">
                        {{ strtoupper(substr($wareHouse->name, 0, 2)) }}
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $wareHouse->name }}</h1>
                        <div class="flex items-center gap-4 text-blue-100">


                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="buttons">
                <x-button x-show="!editing" @click="editing = true" icon="pencil" :label="__('common.edit')"></x-button>
                <x-common.delete-modal :route="route('admin.ware-houses.destroy', ['ware_house' => $wareHouse->id])" />
            </x-slot>
        </x-common.show-header>


        <div class="bg-white border-b shadow-sm">
            <div class="flex gap-1 px-6">

                <x-admin.navbar-button tabName="info" :icon="view('components.icons.employees')" :label="__('employee.info')" />

                <x-admin.navbar-button wireClick="fetchInventories" tabName="inventories" :icon="view('components.icons.inventory')"
                    :label="__('warehouse.inventory_list')" />

            </div>
        </div>

        <section x-show="activeTab == 'info'">
            <div x-show="!editing ">
                <div class="bg-white  p-6 rounded-lg shadow relative">

                    <div class="flex flex-wrap gap-6">
                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.shopping-basket')" color="blue" :label="__('warehouse.name')"
                                :data="$wareHouse->name" />
                        </div>

                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.info')" color="yellow" :label="__('warehouse.location')"
                                :data="$wareHouse->location_name" />
                        </div>

                        <div class="w-full md:w-[calc(50%-0.75rem)]">
                            <x-common.readonly-show :icon="view('components.icons.wallet')" color="green" :label="__('warehouse.address')"
                                :data="$wareHouse->address" />
                        </div>

                    </div>


                </div>
            </div>




            <div x-show="editing" x-cloak>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h2 class="text-lg font-semibold mb-4"> {{ __('common.edit') }}</h2>
                    <form action="{{ route('admin.ware-houses.update', [$wareHouse->id]) }}" method="POST"
                        class="space-y-4">
                        @csrf
                        @method('PATCH')
                        <x-input name="name" :label="__('warehouse.name')" :value="$wareHouse->name" />

                        <x-select name="location" wire:model='selectedLocationID' :value="$wareHouse->location->id ?? null" :label="__('warehouse.location')"
                            :async-data="route('api.v1.locations')" option-label="name" option-value="id" />

                        <x-input name="address" :label="__('warehouse.address')" :value="$wareHouse->address" />
                        <div class="flex items-center gap-4">
                            <x-button primary type="submit" :label="__('inventory.save')" />
                            <x-button type="button" @click="editing = false" :label="__('common.cancel')" />
                        </div>

                    </form>


                </div>
            </div>
        </section>



        <section x-cloak class="bg-white p-6 rounded-lg shadow relative" x-show="activeTab == 'inventories'">
            @include('admin.partials.ware-house.inventories-table')
        </section>
    </div>

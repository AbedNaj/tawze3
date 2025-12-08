    <div x-data="{
        editing: false,
        activeTab: 'info'
    }" class="max-w-7xl mx-auto">


        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-t-2xl shadow-lg p-8 text-white">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-6">

                    <div
                        class="w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-4xl font-bold">
                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $customer->name }}</h1>
                        <div class="flex items-center gap-4 text-blue-100">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $customer->phone }}
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $customer->location->name }}
                            </span>
                        </div>
                    </div>
                </div>


                <div class="flex gap-3">

                    <x-button x-show="!editing" @click="editing = true" icon="pencil" :label="__('common.edit')"></x-button>
                    <x-common.delete-modal :route="route('admin.customers.delete', ['customer' => $customer->id])" :description="__('customer.delete_warning')"
                        :title="__('customer.delete_customer')"></x-common.delete-modal>

                </div>
            </div>
        </div>


        <div class="bg-white border-b shadow-sm">
            <div class="flex gap-1 px-6">

                <x-admin.navbar-button tabName="info" :icon="view('components.icons.customers')" :label="__('customer.info')" />
                <x-admin.navbar-button wireClick="fetchSales" tabName="sales" :icon="view('components.icons.clipboard')" :label="__('customer.sales_history')" />
                <x-admin.navbar-button wireClick="fetchDebts" tabName="debts" :icon="view('components.icons.wallet')" :label="__('customer.debt_history')" />

            </div>
        </div>


        <div class="bg-white rounded-b-2xl shadow-lg">


            <div x-show="activeTab === 'info' && !editing" class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">
                                {{ __('customer.basic_info') }}</h3>
                            <div class="space-y-4">
                                <x-common.readonly-show :icon="view('components.icons.customers')" :label="__('customer.name')" :data="$customer->name"
                                    color="blue" />

                                <x-common.readonly-show :icon="view('components.icons.phone')" :label="__('customer.phone')" :data="$customer->phone"
                                    color="green" />

                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">
                                {{ __('customer.location_info') }}</h3>
                            <div class="space-y-4">


                                <x-common.readonly-show :icon="view('components.icons.location')" :label="__('customer.city')" :data="$customer->location->name"
                                    color="purple" />
                                <x-common.readonly-show :icon="view('components.icons.home')" :label="__('customer.address')" :data="$customer->address"
                                    color="orange" />


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div x-show="activeTab === 'info' && editing" x-cloak class="p-8">
                <form action="{{ route('admin.customers.update', ['customer' => $customer->id]) }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <x-input name="name" :label="__('customer.name')" :value="$customer->name" />

                        <x-input name="phone" :label="__('customer.phone')" :value="$customer->phone" />


                        <x-select name="location" :label="__('customer.city')" :async-data="route('api.v1.locations')" option-label="name"
                            option-value="id" />

                        <x-input name="address" :label="__('customer.address')" :value="$customer->address" />

                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">
                        <x-button type="submit" right-icon="check" lg :label="__('common.save')" />
                        <x-button secondary lg :label="__('common.cancel')" @click="editing = false" />
                    </div>

                </form>

            </div>


            <div x-cloak x-show="activeTab === 'sales'" class="p-8">
                <div class="mb-6">
                    @include('admin.partials.customer.sales-history')
                </div>
            </div>



            <div x-cloak x-show="activeTab === 'debts'" class="p-8">
                <div class="mb-6">


                    @include('admin.partials.customer.debt-history')


                </div>
            </div>
        </div>

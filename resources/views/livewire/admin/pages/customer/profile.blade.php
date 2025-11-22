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
                <button @click="activeTab = 'info'"
                    :class="activeTab === 'info' ? 'border-b-2 border-blue-600 text-blue-600' :
                        'text-gray-600 hover:text-gray-800'"
                    class="px-6 py-4 font-medium transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ __('customer.info') }}
                </button>

                <button wire:click='fetchSales' @click="activeTab = 'sales'"
                    :class="activeTab === 'sales' ? 'border-b-2 border-blue-600 text-blue-600' :
                        'text-gray-600 hover:text-gray-800'"
                    class="px-6 py-4 font-medium transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    {{ __('customer.sales_history') }}
                </button>
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
                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">{{ __('customer.name') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $customer->name }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">{{ __('customer.phone') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $customer->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">
                                {{ __('customer.location_info') }}</h3>
                            <div class="space-y-4">
                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">{{ __('customer.city') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $customer->location->name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">{{ __('customer.address') }}</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $customer->address }}</p>
                                    </div>
                                </div>
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
                        <x-admin.form.input name="name" :label="__('customer.name')" :value="$customer->name" />
                        <x-admin.form.input name="phone" :label="__('customer.phone')" :value="$customer->phone" />
                        <x-admin.form.select name="location_id" :label="__('customer.location')" :value="$customer->location_id"
                            :options="$locations" />
                        <x-admin.form.input name="address" :label="__('customer.address')" :value="$customer->address" />
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t">

                        <x-button type="submit" right-icon="check" lg @click="editing = false" :label="__('common.save')" />
                        <x-button secondary lg @click="editing = false" :label="__('common.cancel')" />
                    </div>
                </form>
            </div>


            <div x-show="activeTab === 'sales'" class="p-8">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('customer.sales_history') }}</h3>
                    <p class="text-gray-600">{{ __('customer.view_all_sales') }}</p>
                </div>

                @if (isset($sales) && $sales->count() > 0)
                    <div class="space-y-4">
                        @foreach ($sales as $sale)
                            @php
                                $saleStatus = App\Enums\SaleStatusEnum::tryFrom($sale->status);
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">
                                                {{ __('sale.sale.invoice_number') }}
                                                #{{ $sale->invoice_number }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $sale->created_at->format('Y-m-d') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-2xl font-bold text-gray-900">
                                            {{ number_format($sale->price, 2) . ' : ' }}
                                            {{ __('sale.sale.price') }}</p>
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-medium rounded-full  bg-{{ $saleStatus->color() }}-100 text-{{ $saleStatus->color() }}-800">
                                            {{ $saleStatus->label() }}
                                        </span>
                                    </div>
                                </div>

                                <x-button href="{{ route('admin.sales.show', ['sale' => $sale->id]) }}" wire:navigate
                                    label="{{ __('common.show') }}"></x-button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('customer.no_sales') }}</h3>
                        <p class="text-gray-600">{{ __('customer.no_sales_message') }}</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

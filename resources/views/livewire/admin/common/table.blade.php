<div class="bg-white rounded-2xl shadow-xl border border-slate-200/50 overflow-hidden backdrop-blur-sm">

    <div
        class="p-6 border-b border-slate-200/70 bg-gradient-to-br from-slate-50 via-white to-slate-50/80 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-purple-500/5"></div>
        <div class="relative z-10">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center space-x-3 space-x-reverse">

                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800 tracking-tight">{{ $title }}</h2>
                </div>

                @if ($allowSearch == true)
                    <div class="w-full sm:w-auto">
                        <div class="relative">
                            <input wire:model.live="search" placeholder="البحث..."
                                class="w-full sm:w-64 px-4 py-2.5 pl-10 text-slate-700 bg-white/80 backdrop-blur-sm border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 shadow-sm hover:shadow-md" />
                            <svg class="absolute left-3 top-3 h-4 w-4 text-slate-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="overflow-x-auto">

        <div class="hidden lg:block">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100/80">
                    <tr>
                        @foreach ($columns as $column)
                            <th
                                class="px-6 py-4 text-right text-slate-600 font-semibold border-b border-slate-200/70 whitespace-nowrap">
                                <span>{{ $column['label'] }}</span>
                            </th>
                        @endforeach
                        <th
                            class="px-6 py-4 text-center text-slate-600 font-semibold border-b border-slate-200/70 whitespace-nowrap">
                            الإجرائات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/70">
                    @forelse($rows as $row)
                        <tr
                            class="hover:bg-gradient-to-r hover:from-slate-50 hover:to-blue-50/30 transition-all duration-300 group">
                            @foreach ($columns as $column)
                                <td class="px-6 py-4 text-right align-middle">
                                    @php
                                        $value = data_get($row, $column['field']) ?? __('common.no_data');
                                    @endphp

                                    @if (isset($column['enum']) && enum_exists($column['enum']))
                                        @php
                                            $enumClass = $column['enum'];
                                            $enumValue = $enumClass::tryFrom($value);
                                        @endphp

                                        @if ($enumValue)
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-full shadow-sm
                                                bg-{{ $enumValue->color() }}-100 
                                                text-{{ $enumValue->color() }}-800
                                                border border-{{ $enumValue->color() }}-200">
                                                {{ $enumValue->label() }}
                                            </span>
                                        @else
                                            <span class="text-slate-700">{{ $value }}</span>
                                        @endif
                                    @else
                                        <span class="text-slate-700">{{ $value }}</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-6 py-4 text-center align-middle">
                                <a href="{{ route($detailsRouteName, $row->id) }}" wire:navigate
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    عرض
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 1 }}" class="p-12 text-center">
                                <div class="flex flex-col items-center space-y-4">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium text-slate-600">لا توجد بيانات</h3>
                                        <p class="text-slate-500 mt-1">لا توجد بيانات متاحة حاليًا للعرض</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="lg:hidden">
            <div class="p-4 space-y-4">
                @forelse($rows as $row)
                    <div
                        class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md transition-all duration-300">
                        <div class="space-y-3">
                            @foreach ($columns as $column)
                                <div class="flex justify-between items-start">
                                    <span class="text-sm font-medium text-slate-500">{{ $column['label'] }}:</span>
                                    <div class="text-right">
                                        @php
                                            $value = data_get($row, $column['field']);
                                        @endphp

                                        @if (isset($column['enum']) && enum_exists($column['enum']))
                                            @php
                                                $enumClass = $column['enum'];
                                                $enumValue = $enumClass::tryFrom($value);
                                            @endphp

                                            @if ($enumValue)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full
                                                    bg-{{ $enumValue->color() }}-100 
                                                    text-{{ $enumValue->color() }}-800
                                                    border border-{{ $enumValue->color() }}-200">
                                                    {{ $enumValue->label() }}
                                                </span>
                                            @else
                                                <span class="text-slate-700">{{ $value }}</span>
                                            @endif
                                        @else
                                            <span class="text-slate-700">{{ $value }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-200">
                            <a href="{{ route($detailsRouteName, $row->id) }}" wire:navigate
                                class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/20 shadow-sm hover:shadow-md transition-all duration-300">
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                            </div>
                            <div class="text-center">
                                <h3 class="text-lg font-medium text-slate-600">لا توجد بيانات</h3>
                                <p class="text-slate-500 mt-1">لا توجد بيانات متاحة حاليًا للعرض</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


    <div class="p-4 bg-gradient-to-r from-slate-50 to-slate-100/80 border-t border-slate-200/70">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="order-2 sm:order-1">
                {{ $rows->links() }}
            </div>
        </div>
    </div>
</div>

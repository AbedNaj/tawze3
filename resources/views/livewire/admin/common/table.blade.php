<div>
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 to-slate-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 space-x-reverse">

                    <h2 class="text-xl font-bold text-slate-800">{{ $title }}</h2>
                </div>
                <div class="flex items-center space-x-2 space-x-reverse">


                    @if ($allowSearch == true)
                        <div>


                            <input wire:model.live="search"
                                class="px-4 py-2 text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors duration-200" />


                        </div>
                    @endif

                </div>
            </div>
        </div>

        <div>
            <table class="w-full">
                <thead class="bg-slate-50">
                    <tr>

                        @foreach ($columns as $column)
                            <th class="p-4 text-right text-slate-600 font-semibold border-b border-slate-200">
                                {{ $column['label'] }}
                            </th>
                        @endforeach
                        <th class="p-4 text-right text-slate-600 font-semibold border-b border-slate-200">
                            الإجرائات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($rows as $row)
                        <tr class="hover:bg-slate-50 transition-colors duration-200">
                            @foreach ($columns as $column)
                                <td class="p-4 text-right">
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
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded 
                                bg-{{ $enumValue->color() }}-100 
                                text-{{ $enumValue->color() }}-800">
                                                {{ $enumValue->label() }}
                                            </span>
                                        @else
                                            {{ $value }}
                                        @endif
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            @endforeach
                            <td class="p-4 text-center">
                                <a href="{{ route($detailsRouteName, $row->id) }}" wire:navigate
                                    class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 hover:cursor-pointer shadow-sm transition-all duration-300">
                                    عرض
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 1 }}" class="p-6 text-center text-slate-500">
                                لا توجد بيانات حاليًا.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="p-4 bg-slate-50 border-t border-slate-200">
            {{ $rows->links() }}
        </div>
    </div>

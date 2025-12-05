                   @props(['icon' => '', 'label' => 'label', 'data' => 'data', 'color' => 'gray'])
                   <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                       <div
                           class="w-10 h-10 text-{{ $color }}-600 bg-{{ $color }}-100 rounded-lg flex items-center justify-center flex-shrink-0">
                           {!! $icon !!}
                       </div>
                       <div class="flex-1">
                           <p class="text-sm text-gray-500">{{ $label }}</p>
                           <p class="text-lg font-semibold text-gray-900">{{ $data ?? __('element.no_data') }}</p>
                       </div>
                   </div>

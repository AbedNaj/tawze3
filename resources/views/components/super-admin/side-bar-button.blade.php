          @props(['is_active' => false, 'href' => '#'])
          @php

              $class =
                  'group flex items-center px-4 py-3 text-slate-700
                     hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all duration-200 relative overflow-hidden' .
                  ($is_active ? ' bg-blue-100 text-blue-600' : '');
          @endphp


          <a wire:navigate href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
              <span class="text-xl ml-3">
                  {{ $icon }}
              </span>
              <span class="font-medium">{{ $slot }}</span>
              <div
                  class="absolute right-0 top-0 h-full w-1 bg-gradient-to-b from-blue-500 to-purple-500 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-200">
              </div>
          </a>

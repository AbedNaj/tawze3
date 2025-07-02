      @props(['is_active' => false, 'href' => '#', 'notificatins' => 0])

      @php

          $class = $is_active
              ? 'group flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 bg-blue-50 text-blue-700 border border-blue-200 shadow-sm hover:shadow-md hover:bg-blue-100 hover:-translate-x-1'
              : 'group flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 text-gray-700 hover:bg-gray-50 hover:text-gray-900 hover:-translate-x-1 hover:shadow-md';
      @endphp

      <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
          <div
              class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center ml-3 group-hover:bg-gray-200 transition-colors">
              {{ $icon }}

          </div>
          <span>{{ $slot }}</span>
          <div class="mr-auto">
              @if ($notificatins > 0)
                  <span
                      class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">{{ $notificatins }}</span>
              @elseif($is_active === true)
                  <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
              @endif

          </div>
      </a>

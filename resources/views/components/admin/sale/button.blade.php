                @props([
                    'href' => $href,
                ])
                <a href="{{ $href }}"
                    class="w-full px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                    <i class="fas fa-plus mr-1"></i>{{ $slot }}
                </a>

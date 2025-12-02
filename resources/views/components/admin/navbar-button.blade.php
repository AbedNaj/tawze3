      @props(['tabName' => '', 'icon' => '', 'label' => 'label', 'wireClick' => ''])

      <button wire:click='{{ $wireClick }}' @click="activeTab = '{{ $tabName }}'"
          :class="activeTab === '{{ $tabName }}' ? 'border-b-2 border-blue-600 text-blue-600' :
              'text-gray-600 hover:text-gray-800'"
          class="px-6 py-4 font-medium transition flex items-center gap-2">
          {!! $icon !!}
          {{ $label }}
      </button>

  @props([
      'buttonLabel' => __('common.delete'),
      'title' => __('common.delete'),
      'description' => __('common.delete_warning'),
      'route' => '',
      'livewireClick' => '',
      'buttonSize' => 'md',
  ])

  <x-button size="{{ $buttonSize }}" label="{{ $buttonLabel }}"
      class="bg-red-600 hover:cursor-pointer text-white rounded-lg hover:bg-red-700"
      x-on:click="$openModal('deleteModal')" negative icon="trash" />
  <div class="flex items-center justify-between ">




      <x-modal-card title="{{ $title }}" name="deleteModal">

          <div class="space-y-3">
              <p
                  class="text-sm text-red-500 leading-relaxed bg-red-50 dark:bg-red-900/20 p-3 rounded-md border border-red-200 dark:border-red-700">
                  {{ $description }}
              </p>
          </div>


          <x-slot name="footer" class="flex justify-between gap-x-4">
              <div class="flex items-center gap-2">
                  @if ($livewireClick)
                      <x-button wire:click='{{ $livewireClick }}' icon="trash" type="submit" negative
                          label="{{ $buttonLabel }}" />
                  @else
                      <form action={{ $route }} method="post">
                          @method('DELETE')
                          @csrf
                          <x-button icon="trash" type="submit" negative label="{{ $buttonLabel }}" />

                      </form>
                  @endif





                  <x-button flat label="{{ __('common.cancel') }}" x-on:click="close" />
              </div>
          </x-slot>
      </x-modal-card>



  </div>

       @props([
           'show' => '',
           'title' => '',
           'clickAway' => false,
       ])

       <div @if ($clickAway) @click.outside="{{ $show }} = false" @endif
           x-show="{{ $show }}" x-transition.opacity
           class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50" x-cloak>

           <div x-transition class="bg-white p-6 rounded-xl shadow-xl max-w-md w-full relative">

               <button @click="{{ $show }} = false"
                   class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
                   <i class="fas fa-times"></i>
               </button>


               <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ $title }} </h2>
               {{ $slot }}

           </div>
       </div>

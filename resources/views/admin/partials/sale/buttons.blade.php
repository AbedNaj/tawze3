              <button @click="confirmSale = true" wire:click='saleConfirm'
                  class="px-6 py-3 bg-gradient-to-r hover:cursor-pointer from-green-500 to-emerald-500 text-white rounded-lg hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 font-medium">
                  <i class="fas fa-check mx-2"></i>{{ __('sale.sale.invoice_create') }}
              </button>

              <a href="{{ route('admin.sales.index') }}"
                  class="px-6 py-3 border border-gray-300 hover:cursor-pointer text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                  <i class="fas fa-save mx-2"></i>{{ __('sale.sale.save_draft') }}
              </a>
              <button wire:click='saleDelete'
                  class="px-6 py-3 bg-red-600 hover:cursor-pointer text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                  <i class="fas fa-trash mx-2"></i>{{ __('sale.sale.delete_sale') }}
              </button>

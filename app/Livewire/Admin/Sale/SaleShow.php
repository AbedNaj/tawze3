<?php

namespace App\Livewire\Admin\Sale;

use App\DTOs\Admin\Sale\SaleConfirmData;
use App\Enums\SalePaymentStatusEnum;
use Livewire\Component;
use App\Enums\SaleStatusEnum;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Payment;
use App\Models\Tenants\PaymentMethod;
use App\Models\Tenants\Product;
use App\Models\Tenants\ProductType;
use App\Models\Tenants\SaleItem;
use App\Models\Tenants\WareHouse;
use App\Services\Sale\SaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\ValidationException;

class SaleShow extends Component
{

    public $customers = [];

    public $productTypes = [], $products = [];

    public $sale;

    public $selectedProducts = [];

    public $product, $quantity = 0;

    public $note, $customer, $invoiceDate, $price;

    public $saleItems = [], $total = 0;

    public $productInventory;

    public $paymentMethods = [], $paymentMethod, $paidAmount = 0;
    public $selectedProductType;
    public $wareHouse, $wareHouses = [], $warehouseName = '';

    public $debtPaiedAmount;
    public bool $withDebt = false;
    public $payments = [];
    protected $rules = [
        'product' => 'required|integer|exists:products,id',
        'quantity' => 'nullable|numeric|min:1',
        'note' => 'nullable|string|max:1000',
        'customer' => 'required|exists:customers,id',
        'invoiceDate' => 'date',
        'paymentMethod' => 'required|integer|exists:payment_methods,id',
        'paidAmount' => 'required|numeric|min:0',

    ];


    public function updatedInvoiceDate()
    {

        $this->validateOnly('invoiceDate');
        $this->sale->update([
            'invoice_date' => $this->invoiceDate,
        ]);
    }

    public function updatedWareHouse($value)
    {
        $this->sale->update([
            'sourceable_type' => WareHouse::class,
            'sourceable_id' => $value
        ]);
        $this->warehouseName = WareHouse::where('id', '=', $this->wareHouse)->value('name');
    }




    public function UpdatedCustomer()
    {

        $this->sale->update([
            'customer_id' => $this->customer ?:  null
        ]);
    }
    public function UpdatedNote()
    {
        $this->validateOnly('note');

        $this->sale->update([
            'note' => $this->note
        ]);
    }

    public function fetchPaymentMethods()
    {


        $this->paymentMethods = PaymentMethod::select('id', 'name')->get();
    }

    public function fetchWareHouses()
    {


        $this->wareHouses = WareHouse::select('id', 'name')->get();
    }


    public function fetchPayments()
    {
        $this->payments = Payment::select('id', 'sale_id', 'payment_method_id', 'paid_amount', 'created_at')
            ->with('paymentMethod:id,name')
            ->where('sale_id', $this->sale->id)->get();
    }
    public function UpdatedSelectedProductType()
    {

        $this->products = Product::select('name', 'id')->where('product_type_id', '=', $this->selectedProductType)->get();
    }
    public function updatedProduct($value)
    {
        $this->validateOnly('product');
        $this->productInventory = $this->getInventory($value)->value('quantity') ?? 0;
    }

    public function saleConfirm(SaleService $saleService)
    {



        $this->validate([
            'customer' => 'required|exists:customers,id',
            'paymentMethod' => 'required|integer|exists:payment_methods,id',
            'paidAmount' => 'required|numeric|min:0',
        ]);

        if (count($this->saleItems) == 0) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: __('sale.sale.add_products_message')
            );
            return;
        } elseif ($this->paidAmount > $this->total) {
            throw ValidationException::withMessages(['paidAmount' => __('sale.sale.paid_amount_error')]);
        }

        $data = new SaleConfirmData(
            $this->sale,
            $this->saleItems,
            $this->total,
            $this->withDebt ? $this->paidAmount : $this->total,
            $this->paymentMethod,
            Auth::guard('admin')->user()
        );
        $saleService->saleConfirm(
            $data
        );


        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.success_product_add')
        );

        return redirect()->route('admin.sales.show', ['sale' => $this->sale->id]);
    }


    public function productItemCreate()
    {


        $this->validate([
            'product' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|numeric|min:1',
            'wareHouse' => 'required|integer|exists:ware_houses,id'
        ]);

        $saleItems = collect($this->saleItems)
            ->where('product_id', $this->product);

        if ($saleItems->count() > 0) {

            $itemQuantity = 0;

            foreach ($saleItems as $item) {
                $itemQuantity += $item['stock'];
            }

            $newQuantity = $this->quantity + $itemQuantity;

            if ($newQuantity > $this->productInventory) {

                throw ValidationException::withMessages(['quantity' => __('sale.sale.quantity_error')]);
            }


            SaleItem::where('product_id', $this->product)->update(['stock' => $newQuantity]);
        } else {

            $saleItem =   SaleItem::create(
                [
                    'sale_id' => $this->sale->id,
                    'product_id' => $this->product,
                    'stock' => $this->quantity,
                ]
            );
        }

        $this->reset([
            'product',
            'quantity',
            'productInventory'

        ]);

        $this->fetchSaleItems();

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.success_product_add')
        );
    }
    public function cancelItemCreate()
    {
        $this->reset([
            'product',
            'quantity',
            'selectedProductType',
            'productInventory'

        ]);
    }
    public function fetchSaleItems()
    {

        $this->saleItems = SaleItem::select('id', 'product_id', 'stock', 'price', 'sale_id')
            ->with('product:id,name,price')
            ->where('sale_id', '=',  $this->sale->id)->get()->toArray();

        $this->total = 0;

        foreach ($this->saleItems as $item) {
            $this->total  += $item['price'];
        }
    }

    public function increaseQuantity($saleID)
    {
        $saleItem = SaleItem::find($saleID);

        $inventory = $this->getInventory($saleItem['product_id'])->value('quantity');

        if ($inventory <= $saleItem['stock']) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: __('sale.sale.out_of_stock')
            );
            return;
        }

        $saleItem->stock += 1;
        $saleItem->save();


        $this->fetchSaleItems();
    }

    public function decreaseQuantity($saleID)
    {
        $saleItem = SaleItem::find($saleID);


        if ($saleItem->stock == 1) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: __('sale.sale.decrease_fail')
            );
            return;
        }
        $saleItem->stock -= 1;
        $saleItem->save();

        $this->fetchSaleItems();
    }


    public function removeProduct($saleID)
    {
        $sale = SaleItem::find($saleID);

        $sale->delete();

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.remove_message')
        );
        $this->fetchSaleItems();
    }

    public function getInventory($productId)
    {

        return Inventory::where('product_id',  '=', $productId)
            ->where('locationable_type', '=', $this->sale->sourceable_type)
            ->where('locationable_id', '=', $this->sale->sourceable_id);
    }
    public function fetchSaleData()
    {
        $this->productTypes = ProductType::select('id', 'name')->get();



        if ($this->sale->status == SaleStatusEnum::DRAFT->value) {

            $this->wareHouse = $this->sale->sourceable->id ?? null;
            $this->warehouseName = WareHouse::where('id', '=', $this->sale->sourceable_id)->value('name');
            $this->customer = $this->sale->customer_id;
            $this->note = $this->sale->note;

            $this->invoiceDate = $this->sale->invoice_date;
            $this->fetchSaleItems();
        }
    }
    public function debtPay(SaleService $saleService)
    {

        $this->validate([
            'debtPaiedAmount' => 'required|numeric|min:0',
            'paymentMethod' => 'required|integer|exists:payment_methods,id',
        ]);

        if ($this->debtPaiedAmount > ($this->sale->debt->remaining_amount)) {
            throw ValidationException::withMessages(['debtPaiedAmount' => __('sale.sale.debt_amount_error')]);
        }
        if ($this->debtPaiedAmount > 0) {

            $saleService->debtPay($this->sale, $this->paymentMethod, $this->debtPaiedAmount);


            $this->dispatch(
                'notify',
                type: 'success',
                message: __('sale.sale.paid_successfully')
            );

            $this->fetchPayments();
        }
    }

    public function saleCancel(SaleService $saleService)
    {

        $saleService->saleCancel($this->sale);

        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.cancelled')
        );

        return redirect()->route('admin.sales.show', ['sale' => $this->sale->id]);
    }
    public function saleDelete(SaleService $saleService)
    {

        $saleService->saleDelete($this->sale);
        return redirect()->route('admin.sales.index')->with('success', __('sale.sale.deleted_successfully'));
    }
    public function printInvoice(SaleService $saleService)
    {
        $saleService->printInvoice($this->sale);
    }
    public function mount()
    {
        $this->fetchWareHouses();
        $this->fetchSaleData();
    }
    public function render()
    {
        return view('livewire.admin.sale.sale-show');
    }
}

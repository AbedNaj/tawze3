<?php

namespace App\Livewire\Admin\Sale;

use App\Enums\SalePaymentStatusEnum;
use App\Events\Admin\Sale\SaleCreated;
use Livewire\Component;

use App\Enums\SaleStatusEnum;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Employee;
use App\Models\Tenants\EmployeeInventory;
use App\Models\Tenants\Inventory;
use App\Models\Tenants\Payment;
use App\Models\Tenants\PaymentMethod;
use App\Models\Tenants\Product;
use App\Models\Tenants\ProductType;
use App\Models\Tenants\Sale;
use App\Models\Tenants\SaleItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SaleShow extends Component
{

    public $customers = [], $employees = [];

    public $productTypes = [], $products = [];

    public $sale;
    public $isForEmployee = false;
    public $selectedProducts = [];

    public $product, $quantity = 0;

    public $note, $customer, $employee, $invoiceDate, $price;

    public $saleItems = [], $total = 0;

    public $productInventory, $employeeName;

    public $paymentMethods = [], $paymentMethod, $paidAmount = 0;
    public $selectedProductType;

    public $debtPaiedAmount;

    public $payments = [];
    protected $rules = [
        'product' => 'required|integer|exists:products,id',
        'quantity' => 'nullable|numeric|min:1',
        'note' => 'nullable|string|max:1000',
        'customer' => 'required|exists:customers,id',
        'employee' => 'nullable|exists:employees,id',
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
    public function updatedisForEmployee()
    {

        if ($this->isForEmployee == false) {

            $this->sale->update([
                'employee_id' => null,
            ]);
        }
    }

    public function UpdatedEmployee()
    {
        $this->validateOnly('employee');

        $this->sale->update([
            'employee_id' => $this->employee
        ]);

        $this->employeeName = Employee::where('id', '=',  $this->employee)->value('name');
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
    public function updatedProduct()
    {
        $this->validateOnly('product');
        $this->productInventory = $this->getInventory($this->product)->value('quantity') ?? 0;
    }

    public function saleConfirm()
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


        DB::transaction(function () {

            $this->sale->update(
                [
                    'status' => SaleStatusEnum::CONFIRMED,
                    'total_paid' => $this->paidAmount,
                    'price' => $this->total,
                ]
            );

            event(new SaleCreated(
                $this->sale,
                $this->paymentMethod,
                $this->paidAmount,
                $this->saleItems,
                $this->employee
            ));
        });



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
        return $this->isForEmployee
            ? EmployeeInventory::where('employee_id', $this->employee)->where('product_id', $productId)
            : Inventory::where('product_id', $productId);
    }
    public function fetchSaleData()
    {
        $this->productTypes = ProductType::select('id', 'name')->get();



        if ($this->sale->status == SaleStatusEnum::DRAFT->value) {
            $this->customer = $this->sale->customer_id;
            $this->employee = $this->sale->employee_id;
            $this->note = $this->sale->note;
            $this->employeeName = $this->sale->employee ? Employee::find($this->sale->employee_id)->name : null;
            $this->invoiceDate = $this->sale->invoice_date;
            $this->fetchSaleItems();
        }
    }
    public function debtPay()
    {

        $this->validate([
            'debtPaiedAmount' => 'required|numeric|min:0',
            'paymentMethod' => 'required|integer|exists:payment_methods,id',
        ]);

        if ($this->debtPaiedAmount > ($this->sale->debt->remaining_amount)) {
            throw ValidationException::withMessages(['debtPaiedAmount' => __('sale.sale.debt_amount_error')]);
        }
        if ($this->debtPaiedAmount > 0) {

            DB::transaction(function () {

                $payment = Payment::create([
                    'sale_id' => $this->sale->id,
                    'payment_method_id' => $this->paymentMethod,
                    'paid_amount' => $this->debtPaiedAmount,
                ]);

                $debt = Debt::where('sale_id', $this->sale->id)->first();
                $debt->paid_amount += $this->debtPaiedAmount;
                $debt->remaining_amount -= $this->debtPaiedAmount;
                $debt->save();

                $this->sale->total_paid += $this->debtPaiedAmount;
                $this->sale->save();
            });

            $this->dispatch(
                'notify',
                type: 'success',
                message: __('sale.sale.paid_successfully')
            );

            $this->fetchPayments();
        }
    }

    public function saleCancel()
    {

        DB::transaction(function () {

            $this->sale->update([
                'status' => SaleStatusEnum::CANCELLED,
                'total_paid' => 0,
                'price' => 0,
                'payment_status' => SalePaymentStatusEnum::Unpaid->value,

            ]);

            $this->sale->items()->delete();
            $this->sale->payments()->delete();
            $this->sale->debt()->delete();
        });


        $this->dispatch(
            'notify',
            type: 'success',
            message: __('sale.sale.cancelled')
        );

        return redirect()->route('admin.sales.show', ['sale' => $this->sale->id]);
    }
    public function saleDelete()
    {

        DB::transaction(function () {

            $this->sale->items()->delete();
            $this->sale->payments()->delete();
            $this->sale->debt()->delete();
            $this->sale->delete();
            return redirect()->route('admin.sales.index')->with('success', __('sale.sale.deleted_successfully'));
        });
    }
    public function mount()
    {

        $this->fetchSaleData();
    }
    public function render()
    {
        return view('livewire.admin.sale.sale-show');
    }
}

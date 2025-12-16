<?php

namespace App\Services\Sale;

use App\DTOs\Admin\Sale\SaleConfirmData;
use App\Enums\SalePaymentStatusEnum;
use App\Enums\SaleStatusEnum;
use App\Enums\StockMovementEnums;
use App\Events\Admin\Sale\SaleCreated;
use App\Events\StockMovementMade;
use App\Models\Tenants\Debt;
use App\Models\Tenants\Payment;
use App\Models\Tenants\Sale;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class SaleService
{


    public function saleConfirm(SaleConfirmData $data)
    {
        DB::transaction(function () use ($data) {

            $data->sale->update(
                [
                    'status' => SaleStatusEnum::CONFIRMED,
                    'total_paid' => $data->paidAmount,
                    'price' => $data->salePrice,
                ]
            );

            event(new SaleCreated(
                $data->sale,
                $data->paymentMethodId,
                $data->paidAmount,
                $data->saleItems,
            ));

            foreach ($data->saleItems as $item) {

                event(new StockMovementMade(
                    StockMovementEnums::sale_out->value,
                    $item['product_id'],
                    $data->sale->id,
                    null,
                    null,
                    $item['stock'],
                    $item['price'],
                    $data->performedBy->id
                ));
            }
        });
    }

    public function debtPay($sale, $paymentMethod, $paidAmount)
    {
        DB::transaction(function () use ($sale, $paymentMethod, $paidAmount) {

            Payment::create([
                'sale_id' => $sale->id,
                'payment_method_id' => $paymentMethod,
                'paid_amount' => $paidAmount,
            ]);

            $debt = Debt::where('sale_id', $sale->id)->first();
            $debt->paid_amount += $paidAmount;
            $debt->remaining_amount -= $paidAmount;
            $debt->save();

            $sale->total_paid += $paidAmount;
            $sale->save();
        });
    }

    // Only Used Before Confirm The Sale
    public function saleDelete(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            $sale->items()->delete();
            $sale->payments()->delete();
            $sale->debt()->delete();
            $sale->delete();
        });
    }

    // only used when the sale status = Confirmed
    public function saleCancel(Sale $sale)
    {

        DB::transaction(function () use ($sale) {

            $sale->update([
                'status' => SaleStatusEnum::CANCELLED,
                'total_paid' => 0,
                'price' => 0,
                'payment_status' => SalePaymentStatusEnum::Unpaid->value,

            ]);

            $sale->items()->delete();
            $sale->payments()->delete();
            $sale->debt()->delete();
        });
    }

    public function printInvoice(Sale $sale)
    {
        $sale->load('items.product');


        $html = view('admin.pages.sale.invoice-pdf', [
            'sale' => $sale
        ])->render();


        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'directionality' => 'rtl',
            'default_font' => 'cairo',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
        ]);


        $mpdf->WriteHTML($html);

        return response($mpdf->Output(
            'invoice-' . $sale->invoice_number . '.pdf',
            'S'
        ))
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                'inline; filename="invoice-' . $sale->invoice_number . '.pdf"'
            );
    }
}

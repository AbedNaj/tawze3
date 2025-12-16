<!DOCTYPE html>
<html lang="{{ App()->getLocale() }}" dir="{{ App()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


    <title>{{ __('invoice.title') }} - {{ $sale->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {


            color: #333;
            padding: 40px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 20px;
        }

        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .company-info {
            font-size: 11px;
            color: #7f8c8d;
            margin-top: 8px;
        }

        .invoice-title {
            background: #2c3e50;
            color: white;
            padding: 12px;
            font-size: 22px;
            font-weight: bold;
            margin: 30px 0 20px 0;
            text-align: center;
        }

        .invoice-details {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .detail-row {
            display: table-row;
        }

        .detail-label {
            display: table-cell;
            padding: 8px 15px;
            background: #ecf0f1;
            font-weight: bold;
            width: 30%;
            border: 1px solid #bdc3c7;
        }

        .detail-value {
            display: table-cell;
            padding: 8px 15px;
            background: white;
            border: 1px solid #bdc3c7;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table.items thead {
            background: #34495e;
            color: white;
        }

        table.items th {
            padding: 12px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #2c3e50;
        }

        table.items td {
            padding: 10px;
            font-size: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table.items tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        table.items tbody tr:hover {
            background: #e8f4f8;
        }

        .totals-section {
            margin-top: 30px;
            float: left;
            width: 350px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        .total-row.subtotal {
            background: #ecf0f1;
            font-size: 14px;
        }

        .total-row.grand-total {
            background: #2c3e50;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            margin-top: 5px;
        }

        .footer {
            clear: both;
            margin-top: 80px;
            padding-top: 20px;
            border-top: 2px solid #ecf0f1;
            text-align: center;
            font-size: 11px;
            color: #7f8c8d;
        }

        .notes {
            margin-top: 40px;
            padding: 15px;
            background: #fff9e6;
            border-right: 4px solid #f39c12;
            font-size: 12px;
        }

        .notes-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #f39c12;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="company-name">{{ __('invoice.company_name') }}</div>
        <div class="company-info">
            {{ __('invoice.company_address') }} |
            {{ __('invoice.company_phone') }} |
            {{ __('invoice.company_email') }}
        </div>
    </div>


    <div class="invoice-title">{{ __('invoice.sales_invoice') }}</div>


    <div class="invoice-details">
        <div class="detail-row">
            <div class="detail-label">{{ __('invoice.invoice_number') }}</div>
            <div class="detail-value">{{ $sale->invoice_number }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">{{ __('invoice.invoice_date') }}</div>
            <div class="detail-value">{{ $sale->invoice_date }}</div>
        </div>
        @if (isset($sale->customer_name))
            <div class="detail-row">
                <div class="detail-label">{{ __('invoice.customer_name') }}</div>
                <div class="detail-value">{{ $sale->customer_name }}</div>
            </div>
        @endif
    </div>


    <table class="items">
        <thead>
            <tr>
                <th style="width: 8%;">#</th>
                <th style="width: 42%;">{{ __('invoice.product') }}</th>
                <th style="width: 15%;">{{ __('invoice.quantity') }}</th>
                <th style="width: 17%;">{{ __('invoice.unit_price') }}</th>
                <th style="width: 18%;">{{ __('invoice.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: right;">{{ $item->product->name }}</td>
                    <td>{{ number_format($item->stock, 0) }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->stock * $item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="totals-section">
        <div class="total-row subtotal">
            <span>{{ __('invoice.subtotal') }}</span>
            <span>{{ number_format($sale->price, 2) }}</span>
        </div>
        @if (isset($sale->discount) && $sale->discount > 0)
            <div class="total-row">
                <span>{{ __('invoice.discount') }}</span>
                <span>{{ number_format($sale->discount, 2) }}</span>
            </div>
        @endif
        @if (isset($sale->tax) && $sale->tax > 0)
            <div class="total-row">
                <span>{{ __('invoice.tax') }}</span>
                <span>{{ number_format($sale->tax, 2) }}</span>
            </div>
        @endif
        <div class="total-row grand-total">
            <span>{{ __('invoice.grand_total') }}</span>
            <span>{{ number_format($sale->price, 2) }}</span>
        </div>
    </div>


    @if (isset($sale->notes) && $sale->notes)
        <div class="notes">
            <div class="notes-title">{{ __('invoice.notes') }}</div>
            {{ $sale->notes }}
        </div>
    @endif


    <div class="footer">
        <p>{{ __('invoice.thanks_message') }}</p>
        <p>{{ __('invoice.footer_text') }}</p>
    </div>
</body>

</html>

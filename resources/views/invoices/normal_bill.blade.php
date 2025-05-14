<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Y P BICHIYA</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            border: 1px solid black;
            padding: 10px;
            max-width: 800px;
            margin: 0 auto;
        }
        .top-invocations {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .top-invocations {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.top-invocations .left-aligned {
    text-align: left;
    padding-right:310px;
}

.top-invocations .right-aligned {
    text-align: right;
}
    .header {
        text-align: center;
    }

        .header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            border: 1px solid black;
            padding: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .no-border-left {
            border-left: none;
            
        }
        .no-border-right {
            border-right: none;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 10px;
            border-top: 1px solid black;
            padding-top: 5px;
        }
</style>
</head>
<body>
<div class="container">
<div class="top-invocations">
            <span class="left-aligned">|| Shri Ganeshay Namah ||</span>
            <span class="right-aligned">|| Jai Matadi ||</span>
        </div>
        <div class="header">
        Y P BICHIYA
        </div>
        <table class="invoice-details">
            <tr>
                <td><strong>M/s.</strong> {{ $invoice->client->name }}</td>
                <td><strong>Bill No.:</strong> {{ $invoice->id }}</td>
            </tr>
            <tr>
                <td>{{ $invoice->client->address }}{{ $invoice->client->city }}</td>
                <td><strong>Date:</strong> {{ $invoice->invoice_date }}</td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php
                $totalquantity = 0;
                    $totalAmount = 0;
                    $totalGstAmount = 0;
                @endphp
                @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->total }}</td>
                   
                </tr>
                @php
                    $totalquantity += $item->quantity;
                    $totalAmount += $item->total;
                    $totalGstAmount += $item->gst_amount;
                @endphp
                @endforeach
        
            </tbody>
            <tfoot>
    <tr>
        <td colspan="2" class="no-border"></td>
        <td class="text-right">Total</td>
        <td>{{ $totalquantity }}</td>
        <td>{{ $totalAmount }}</td>
    </tr>
    <tr>
        <td colspan="4" class="no-border"></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3" class="no-border"></td>
        <td class="text-right">Grand Total</td>
        <td>{{ $totalAmount }}</td>
    </tr>
</tfoot>
        </table>
        <div class="footer">
            <!-- <p>Payment is due by MM/DD/YYYY</p> -->
        </div>
    </div>
</body>
</html>
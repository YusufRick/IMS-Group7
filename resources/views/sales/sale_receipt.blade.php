<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sale Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; }
        .details, .items { width: 100%; margin-bottom: 20px; }
        .items table { width: 100%; border-collapse: collapse; }
        .items th, .items td { padding: 10px; border: 1px solid #ddd; }
        .total { text-align: right; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sale Receipt</h1>
        <p>Branch: {{ $branch }}</p>
        <p>Salesperson: {{ $user }}</p>
        <p>Date: {{ $sale_date }}</p>
    </div>

    <div class="details">
        <strong>Sale ID:</strong> {{ $sale->sale_id }}<br>
        <strong>Total Amount:</strong> {{ number_format($total_amount, 2) }}
    </div>

    <div class="items">
        <h2>Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <strong>Total:</strong> {{ number_format($total_amount, 2) }}
    </div>
</body>
</html>

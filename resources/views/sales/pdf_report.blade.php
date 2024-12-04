<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header, .footer { text-align: center; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Sales Report</h2>
        <p>From {{ $startDate }} to {{ $endDate }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>User</th>
                <th>Branch</th>
                <th>Sale Date</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
            <tr>
                <td>{{ $sale->sale_id }}</td>
                <td>{{ $sale->user->first_name ?? 'No User' }}</td>
                <td>{{ $sale->branch->branch_name ?? 'No Branch' }}</td>
                <td>{{ $sale->sale_date }}</td>
                <td>{{ $sale->total_amount }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="total">Total Amount:</td>
                <td class="total">{{ $totalAmount }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Generated on {{ now()->format('Y-m-d H:i') }}</p>
    </div>
</body>
</html>

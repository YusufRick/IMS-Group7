<div class="card-content">
    <div class="card-body card-dashboard">
<table class="table table-bordered">
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
            <td colspan="4" class="text-right"><strong>Total Amount:</strong></td>
            <td><strong>{{ $totalAmount }}</strong></td>
        </tr>
    </tfoot>
</table>
    </div>
</div>
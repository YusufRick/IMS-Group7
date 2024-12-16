@extends('admin.app')

@section('content')
<div class="container">
    <h1>Sales Report</h1>
    <form id="reportForm">
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <button type="button" id="generateReport" class="btn btn-primary mt-2">Generate Report</button>
            </div>
        </div>
    </form>

    <div id="reportResults" class="card">
        <!-- Report Table goes here -->
    </div>

    <button id="downloadPdf" class="btn btn-primary d-none">Download PDF</button>
</div>
@endsection

@section('js')
<script> // generate pdf report
document.getElementById('generateReport').addEventListener('click', function () {
    let startDate = document.getElementById('startDate').value;
    let endDate = document.getElementById('endDate').value;

    fetch('{{ route("sales.generateReport") }}', { // Post request made by API to sales.generatereport
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // data of the report is send into JSON format
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // CRSF attacks prevention , laravel requires this
        },
        body: JSON.stringify({ start_date: startDate, end_date: endDate })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('reportResults').innerHTML = data.html;
        document.getElementById('downloadPdf').classList.remove('d-none');
    });
});

document.getElementById('downloadPdf').addEventListener('click', function () { // get event to download pdf
    window.location.href = '{{ route("sales.downloadReport") }}?start_date=' +
        document.getElementById('startDate').value + '&end_date=' + document.getElementById('endDate').value;
});
</script>
@endsection

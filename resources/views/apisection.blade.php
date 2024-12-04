@extends('admin.app')

@section('content')
<div class="container mt-4">
    <h1>API Documentation for Branch Management</h1>
    <p>This API is designed for branch-specific operations. All routes require the authenticated user’s <code>branch_id</code> and <code>user_id</code>.</p>
    
    <hr>

    @php
        $authBranchId = auth()->user()->branch_id ?? '{branch_id}';
        $authUserId = auth()->user()->id ?? '{user_id}';
        $baseUrl = url('/'); // Get the base URL of the app
    @endphp

    {{-- List of API Endpoints --}}
    <div class="api-section">
        <h2>1. Get All Branches</h2>
        <p><strong>Endpoint:</strong> <code>GET /api/branches</code></p>
        <p><strong>Description:</strong> Retrieves all available branches.</p>
        <pre><code class="language-http">GET /api/branches</code></pre>
        <button class="copy-btn" data-text="/api/branches">Copy</button>
    </div>

    <hr>

    <div class="api-section">
        <h2>2. Show Branch</h2>
        <p><strong>Endpoint:</strong> <code>GET /api/branches/{branch}</code></p>
        <p><strong>Description:</strong> Retrieves details for a specific branch.</p>
        <pre><code class="language-http">GET /api/branches/{{ $authBranchId }}</code></pre>
        <button class="copy-btn" data-text="/api/branches/{{ $authBranchId }}">Copy</button>
    </div>

    <hr>

    <div class="api-section">
        <h2>3. Get Products for a Branch</h2>
        <p><strong>Endpoint:</strong> <code>GET /api/branches/{branch}/products</code></p>
        <p><strong>Description:</strong> Retrieves all products available at a specific branch.</p>
        <pre><code class="language-http">GET /api/branches/{{ $authBranchId }}/products</code></pre>
        <button class="copy-btn" data-text="/api/branches/{{ $authBranchId }}/products">Copy</button>
    </div>

    <hr>

    <div class="api-section">
        <h2>4. Get Users in a Branch</h2>
        <p><strong>Endpoint:</strong> <code>GET /api/branches/{branch}/users</code></p>
        <p><strong>Description:</strong> Retrieves all users associated with a specific branch.</p>
        <pre><code class="language-http">GET /api/branches/{{ $authBranchId }}/users</code></pre>
        <button class="copy-btn" data-text="/api/branches/{{ $authBranchId }}/users">Copy</button>
    </div>

    <hr>

    <div class="api-section">
        <h2>5. Get Sales for a Branch</h2>
        <p><strong>Endpoint:</strong> <code>GET /api/branches/{branch}/sales</code></p>
        <p><strong>Description:</strong> Retrieves all sales records for a specific branch.</p>
        <pre><code class="language-http">GET /api/branches/{{ $authBranchId }}/sales</code></pre>
        <button class="copy-btn" data-text="/api/branches/{{ $authBranchId }}/sales">Copy</button>
    </div>

    <hr>

    <div class="api-section">
        <h2>6. Get User Sales within a Branch</h2>
        <p><strong>Endpoint:</strong> <code>GET /api/branches/{branch}/users/{user}/sales</code></p>
        <p><strong>Description:</strong> Retrieves sales made by a specific user within a branch.</p>
        <pre><code class="language-http">GET /api/branches/{{ $authBranchId }}/users/{{ $authUserId }}/sales</code></pre>
        <button class="copy-btn" data-text="/api/branches/{{ $authBranchId }}/users/{{ $authUserId }}/sales">Copy</button>
    </div>

    <hr>

    <div class="api-section">
        <h2>7. Create a New Sale</h2>
        <p><strong>Endpoint:</strong> <code>POST /api/branches/{branch}/sales/{user}</code></p>
        <p><strong>Description:</strong> Creates a new sale for a specified user in a branch.</p>
        <p><strong>Example Request:</strong></p>
        <pre><code class="language-http">POST /api/branches/{{ $authBranchId }}/sales/{{ $authUserId }}
Content-Type: application/json

{
    "items": [
        {
            "product_id": 1,
            "quantity": 2
        },
        {
            "product_id": 2,
            "quantity": 1
        }
    ]
}</code></pre>
        <button class="copy-btn" data-text="/api/branches/{{ $authBranchId }}/sales/{{ $authUserId }}">Copy</button>
    </div>
</div>
@endsection

@section('js')
<script>
    document.querySelectorAll('.copy-btn').forEach(button => {
        button.addEventListener('click', function() {
            const text = this.getAttribute('data-text');
            const baseUrl = window.location.origin;  // Get the base URL dynamically
            const fullUrl = `${baseUrl}${text}`; // Combine base URL with the endpoint path
            navigator.clipboard.writeText(fullUrl).then(() => {
                toastr.success('Copied to clipboard!');
            }).catch(() => {
                toastr.error('Failed to copy text to clipboard.');
            });
        });
    });
</script>
@endsection

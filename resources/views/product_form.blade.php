<!DOCTYPE html>
<html>
<head>
    <title>Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h3>Add Product</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="/add-product" method="POST" class="card p-4 shadow-sm mt-3">
        @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Add Product</button>
    </form>

    <a href="/notifications" class="btn btn-dark mt-3">
        View Notifications ({{ auth()->user()->unreadNotifications->count() }})
    </a>

</div>

</body>
</html>

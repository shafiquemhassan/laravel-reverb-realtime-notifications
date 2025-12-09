<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h3>Your Notifications</h3>

    <a href="/mark-read" class="btn btn-primary mb-3">Mark all as read</a>

    @forelse($notifications as $note)
        <div class="alert alert-info">
            {{ $note->data['message'] }}
        </div>
    @empty
        <p>No unread notifications</p>
    @endforelse

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Users</h1>
        <div class="mb-3 d-flex justify-content-between">
            <a href="/create" class="btn btn-primary">Add User</a>
            <a href="/logout" class="btn btn-danger">Logout</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['name']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td>
                        <a href="/edit/<?= $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/delete/<?= $user['id']; ?>" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

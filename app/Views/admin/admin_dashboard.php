<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Portal</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text text-white me-3">
                    Welcome, <?= esc($user['name']) ?>
                </span>
                <a href="<?= base_url('announcements') ?>" class="btn btn-outline-light btn-sm me-2">Announcements</a>
                <a href="<?= base_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <h1 class="display-4 text-danger">Welcome, Admin!</h1>
                        <p class="lead mt-3">You are logged in as: <strong><?= esc($user['name']) ?></strong></p>
                        <p class="text-muted">Role: <?= esc(ucfirst($user['role'])) ?></p>
                        <hr class="my-4">
                        <p>This is your admin dashboard. Here you can manage users, courses, and system settings.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>My WebSystem</title>
    <!-- Bootstrap (optional, but kept for styling) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Simple Header -->
    <nav class="bg-light border-bottom mb-3">
        <div class="container py-2 d-flex justify-content-between">
            <a href="<?= base_url('/') ?>" class="fw-bold text-dark text-decoration-none">MyCI</a>
            <div>
                <a class="mx-2 text-dark text-decoration-none" href="<?= base_url('/') ?>">Home</a>
                <a class="mx-2 text-dark text-decoration-none" href="<?= base_url('/about') ?>">About</a>
                <a class="mx-2 text-dark text-decoration-none" href="<?= base_url('/contact') ?>">Contact</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>

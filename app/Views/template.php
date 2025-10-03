<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $this->renderSection('title') ?> - MyCI</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Body background gradient */
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      min-height: 100vh;
      color: #f1f1f1;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Navbar */
    .navbar {
      background-color: rgba(20, 20, 20, 0.85);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .navbar-brand {
      font-size: 1.6rem;
      font-weight: 700;
      color: #ffffff;
      letter-spacing: 1.2px;
      text-transform: uppercase;
    }

    .navbar .nav-link {
      color: #e0e0e0;
      font-size: 1.1rem;
      margin: 0 8px;
      transition: all 0.3s ease;
    }

    .navbar .nav-link:hover {
      color: #0d6efd;
      text-decoration: underline;
    }

    /* Page container */
    .container {
      margin-top: 60px;
      background: rgba(30, 30, 30, 0.9);
      padding: 30px 25px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.5);
    }

    /* Dashboard should be full-width but keep the same look */
    .page-dashboard {
      margin-top: 60px;
      background: rgba(30, 30, 30, 0.9);
      padding: 30px 25px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.5);
      min-height: calc(100vh - 120px); /* fill screen minus top margin and footer space */
    }

    /* Optional: footer style */
    footer {
      text-align: center;
      padding: 15px 0;
      color: #cfcfcf;
      font-size: 0.9rem;
      margin-top: 50px;
    }

    /* Make buttons stand out */
    .btn-primary {
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      border: none;
    }

    .btn-primary:hover {
      opacity: 0.9;
    }

  </style>
</head>
<body>
  <?php $uri = service('uri'); $isDashboard = ($uri->getSegment(1) === 'dashboard'); ?>
  <?php if (! $isDashboard): ?>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url('/') ?>">MyCI</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/about') ?>">About</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('/contact') ?>">Contact</a></li>
          <?php $role = session('userRole'); ?>
          <?php if (session('isLoggedIn')): ?>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
            <?php if ($role === 'admin'): ?>
              <li class="nav-item"><a class="nav-link disabled" href="#">Admin Tools</a></li>
            <?php elseif ($role === 'teacher'): ?>
              <li class="nav-item"><a class="nav-link disabled" href="#">My Courses</a></li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link disabled" href="#">Enrollments</a></li>
            <?php endif; ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>">Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= site_url('login') ?>">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php endif; ?>

  <!-- Page Content -->
  <div class="<?= $isDashboard ? 'container-fluid page-dashboard' : 'container' ?>">
    <?= $this->renderSection('content') ?>
  </div>

  <!-- Optional footer -->
  <footer>
    &copy; <?= date('Y') ?> MyCI. All rights reserved.
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

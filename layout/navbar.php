
<nav class="navbar navbar-expand-lg" style="background-color:#81BFDA;">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">
      <img src="img/logoPerpus.png" alt="" style="width: 45px;"> Perpus
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="beranda.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <?php if (isset($_SESSION['username'])): ?>
            <a class="nav-link active" aria-current="page" href="pengembalian.php">Pengembalian</a>
          <?php else: ?>
            <a class="nav-link disabled" aria-current="page" href="#" tabindex="-1" aria-disabled="true">Pengembalian</a>
          <?php endif; ?>
        </li>
        <li class="nav-item">
    <?php if (isset($_SESSION['username'])): ?>
        <a class="nav-link" href="history.php">Riwayat</a>
    <?php else: ?>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Riwayat</a>
    <?php endif; ?>
      </li>
      </ul>
      <form class="d-flex" role="search">
        <?php if (isset($_SESSION['username'])): ?>
          <button type="button" class="btn btn-outline-black" data-bs-toggle="modal" data-bs-target="#profileModal">
            <i class="bi bi-person-fill"></i>
          </button>
        <?php else: ?>
          <button class="btn btn-outline-black" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">
            <b><i class="bi bi-box-arrow-in-right"></i> Login</b>
          </button>
        <?php endif; ?>
      </form>
    </div>
  </div>
</nav>

<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form Login -->
        <form method="POST" action="login.php">
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="loginEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginPassword" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <!-- Redirect to Register -->
        <div class="text-center mt-3">
          <p>Don't have an account? <a href="#" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">Register here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Register</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form Register -->
        <form method="POST" action="register.php">
          <div class="mb-3">
            <label for="registerUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="registerUsername" name="username" required>
          </div>
          <div class="mb-3">
            <label for="registerEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="registerEmail" name="email" required>
          </div>
          <div class="mb-3">
            <label for="registerPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="registerPassword" name="password" required>
          </div>
          <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Profile (shows username and logout button) -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <!-- Logout Button -->
        <a href="logout.php" class="btn btn-danger w-100">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

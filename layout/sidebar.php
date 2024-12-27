<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" id="toggleSidebar"><i class="bi bi-chevron-left"></i></button>
    <div class="profile">
        <i class="bi bi-person-fill"></i>
        <div class="username" id="profileName"><?php echo $_SESSION['username']; ?></div>
        <div class="dropdown-menu" id="profileMenu">
            <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
            <a href="settings.php"><i class="bi bi-gear-fill"></i> Settings</a>
        </div>
    </div>
    <ul class="nav flex-column">
        <!-- Menu Dashboard -->
        <li class="nav-item">
            <a href="../admin/dashboard.php">
                <i class="bi bi-book-fill"></i> Dashboard
            </a>
        </li>
        <!-- Menu Buku -->
        <li class="nav-item">
            <a href="../buku/index.php">
                <i class="bi bi-book-fill"></i> Buku
            </a>
        </li>
        <!-- Menu Profile -->
        <li class="nav-item">
            <a href="profile.php">
                <i class="bi bi-person-fill"></i> Profile
            </a>
        </li>
        <!-- Menu Total Transaction -->
        <li class="nav-item">
            <a href="transaction.php">
                <i class="bi bi-person-fill"></i> Transaction
            </a>
        </li>
    </ul>
    <div class="logout-btn">
        <a href="../logout.php" class="btn btn-danger w-100">Logout</a>
    </div>
</div>
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Jika bukan admin, redirect ke halaman utama
    exit();
}

// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "uas"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan jumlah buku
$sqlBuku = "SELECT COUNT(*) as total_buku FROM books"; // Menggunakan tabel books
$resultBuku = $conn->query($sqlBuku);
$rowBuku = $resultBuku->fetch_assoc();
$totalBuku = $rowBuku['total_buku'];

// Query untuk mendapatkan jumlah pengguna
$sqlUsers = "SELECT COUNT(*) as total_users FROM users"; // Menggunakan tabel users
$resultUsers = $conn->query($sqlUsers);
$rowUsers = $resultUsers->fetch_assoc();
$totalUsers = $rowUsers['total_users'];

// Query untuk mendapatkan jumlah pengguna yang sudah melakukan peminjaman
$sqlBorrowedUsers = "SELECT COUNT(DISTINCT id) as total_borrowed_users FROM borrowings"; // Menghitung jumlah user yang meminjam buku
$resultBorrowedUsers = $conn->query($sqlBorrowedUsers);
$rowBorrowedUsers = $resultBorrowedUsers->fetch_assoc();
$totalBorrowedUsers = $rowBorrowedUsers['total_borrowed_users'];

// Query untuk mendapatkan informasi pengguna
$userId = $_SESSION['id']; // Asumsikan ID pengguna disimpan dalam session
$sqlUser = "SELECT * FROM users WHERE id = '$userId'";
$resultUser = $conn->query($sqlUser);
$userData = $resultUser->fetch_assoc();

if (!$userData) {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="../img/logoPerpus.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>

    <!-- sidebar content -->
    <?php include '../layout/sidebar.php' ?>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <h1>Welcome to the Dashboard, <?php echo $_SESSION['username']; ?></h1>
        
        <div class="row">
            <!-- Card for Buku count -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total Buku</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalBuku; ?> Buku</h5>
                        <p class="card-text">Jumlah buku yang tersedia di sistem.</p>
                    </div>
                </div>
            </div>

            <!-- Card for Users count -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Users</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalUsers; ?> Users</h5>
                        <p class="card-text">Jumlah pengguna yang terdaftar di sistem.</p>
                    </div>
                </div>
            </div>

            <!-- Card for Borrowed Books -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Total Peminjaman</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $totalBorrowedUsers; ?> Transaction</h5>
                        <p class="card-text">Jumlah total yang sudah melakukan peminjaman.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        // Toggle sidebar visibility
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
    
        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('minimized');
            mainContent.classList.toggle('sidebar-minimized');
            const isMinimized = sidebar.classList.contains('minimized');
            toggleSidebar.innerHTML = isMinimized ? '<i class="bi bi-chevron-right"></i>' : '<i class="bi bi-chevron-left"></i>';
        });

        // Dropdown menu toggle for profile
        const profileIcon = document.getElementById('profileIcon');
        const profileMenu = document.getElementById('profileMenu');

        profileIcon.addEventListener('click', () => {
            profileMenu.classList.toggle('show');
        });
    </script>
</body>
</html>

<?php
// Menutup koneksi ke database setelah selesai
$conn->close();
?>

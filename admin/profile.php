<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Jika bukan admin, redirect ke halaman utama
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uas";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    <title>Profile</title>
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
        <h1>Profile - <?php echo $_SESSION['username']; ?></h1>

        <div class="row">
            <!-- Profile Information -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">User Information</div>
                    <div class="card-body">
                        <h5 class="card-title">Name: <?php echo $userData['username']; ?></h5>
                        <p class="card-text">Email: <?php echo $userData['email']; ?></p>
                        <p class="card-text">Role: <?php echo $userData['role']; ?></p>
                        <p class="card-text">Joined: <?php echo $userData['created_at']; ?></p>
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
    </script>
</body>
</html>

<?php
// Menutup koneksi ke database setelah selesai
$conn->close();
?>

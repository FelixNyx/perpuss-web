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

// Query untuk mendapatkan semua transaksi peminjaman, termasuk denda
$sqlTransactions = "SELECT borrowings.id, borrowings.user_id, borrowings.book_id, borrowings.status, borrowings.borrow_date, borrowings.fine, users.username, books.title 
                    FROM borrowings
                    JOIN users ON borrowings.user_id = users.id
                    JOIN books ON borrowings.book_id = books.id
                    ORDER BY borrowings.borrow_date DESC"; // Menampilkan transaksi yang terbaru
$resultTransactions = $conn->query($sqlTransactions);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
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
        <h1>Transaction History</h1>

                <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Status</th>
                    <th>Tanggal Pinjam</th>
                    <th>Denda</th> <!-- Kolom Denda -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultTransactions->num_rows > 0) {
                    while ($row = $resultTransactions->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . ucfirst($row['status']) . "</td>";
                        echo "<td>" . $row['borrow_date'] . "</td>";
                        echo "<td>";
                        // Mengecek denda dan menampilkannya
                        if ($row['fine'] == 0) {
                            echo "Tidak Kena Denda";
                        } else {
                            echo number_format($row['fine'], 2);
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No transactions found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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

<?php
session_start();

// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'uas';

$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['id']; // Ambil ID pengguna dari session

// Ambil data riwayat peminjaman berdasarkan user_id
$sql = "SELECT borrowings.id, books.title, borrowings.borrow_date, borrowings.return_date, borrowings.status 
        FROM borrowings 
        JOIN books ON borrowings.book_id = books.id 
        WHERE borrowings.user_id = ? 
        ORDER BY borrowings.borrow_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'layout/navbar.php'; ?>

<div class="container py-5">
    <h2 class="text-center mb-4">Riwayat Peminjaman Buku</h2>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                while ($row = $result->fetch_assoc()): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['borrow_date']) ?></td>
                    <td><?= htmlspecialchars($row['return_date']) ?></td>
                    <td>
                        <?php 
                        if ($row['status'] === 'returned') {
                            echo '<span class="badge bg-success">Dikembalikan</span>';
                        } else {
                            echo '<span class="badge bg-warning text-dark">Belum Dikembalikan</span>';
                        }
                        ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='dashboard.php';" class="btn btn-danger mt-3">Kembali</button>
    <?php else: ?>
        <div class="alert alert-info text-center">Belum ada riwayat peminjaman.</div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

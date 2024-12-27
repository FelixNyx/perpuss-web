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

// Mendapatkan data peminjaman pengguna
$userId = $_SESSION['id']; // Pastikan user_id disimpan di session saat login
$sql = "SELECT b.title, b.author, br.id AS borrowing_id, br.return_date, 
        DATEDIFF(CURDATE(), br.return_date) AS late_days
        FROM borrowings br
        JOIN books b ON br.book_id = b.id
        WHERE br.user_id = ? AND br.status = 'borrowed'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Pesan sukses atau error
$message = '';
$error = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$conn->close();
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengembalian Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'layout/navbar.php'; ?>
<div class="container py-5">
    <h1 class="text-center mb-5">Pengembalian Buku</h1>

    <!-- Alert untuk pesan -->
    <?php if ($message): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): 
                        $lateDays = $row['late_days'];
                        $denda = $lateDays > 0 ? $lateDays * 5000 : 0;
                    ?>
                        <tr>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['author'] ?></td>
                            <td><?= $row['return_date'] ?></td>
                            <td><?= $denda > 0 ? "Rp " . number_format($denda, 0, ',', '.') : "Tidak Ada" ?></td>
                            <td>
                                <form action="proses_pengembalian.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="borrowing_id" value="<?= $row['borrowing_id'] ?>">
                                    <input type="hidden" name="denda" value="<?= $denda ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada buku yang sedang dipinjam.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button onclick="window.location.href='dashboard.php';" class="btn btn-danger mt-3">Kembali</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

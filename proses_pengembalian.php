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

// Proses pengembalian
if (isset($_POST['borrowing_id'], $_POST['denda'])) {
    $borrowingId = $_POST['borrowing_id'];
    $denda = (int)$_POST['denda'];

    $sql = "SELECT book_id FROM borrowings WHERE id = ? AND status = 'borrowed'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $borrowingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $bookId = $data['book_id'];

        // Update status peminjaman
        $sqlUpdate = "UPDATE borrowings SET status = 'returned', return_date = NOW(), fine = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $denda, $borrowingId);

        if ($stmtUpdate->execute()) {
            // Tambah jumlah buku yang tersedia
            $sqlUpdateBook = "UPDATE books SET available = available + 1 WHERE id = ?";
            $stmtUpdateBook = $conn->prepare($sqlUpdateBook);
            $stmtUpdateBook->bind_param("i", $bookId);
            $stmtUpdateBook->execute();

            $_SESSION['message'] = $denda > 0 
                ? "Buku berhasil dikembalikan. Anda dikenakan denda sebesar Rp " . number_format($denda, 0, ',', '.')
                : "Buku berhasil dikembalikan tanpa denda.";
        } else {
            $_SESSION['error'] = "Gagal mengembalikan buku.";
        }
    } else {
        $_SESSION['error'] = "Data peminjaman tidak valid.";
    }
} else {
    $_SESSION['error'] = "Permintaan tidak valid.";
}

$conn->close();
header("Location: pengembalian.php");
exit();
?>

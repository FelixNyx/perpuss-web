<?php
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM books WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil dihapus'); window.location = 'index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi setelah proses selesai
$conn->close();
?>

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

// Proses form input data buku
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $available = $_POST['available'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    $sql = "INSERT INTO books (title, author, available, image, description) VALUES ('$title', '$author', '$available', '$image', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Buku berhasil ditambahkan'); window.location = 'index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi setelah proses selesai
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Tambah Buku Baru</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="available" class="form-label">Jumlah Buku</label>
                <input type="number" class="form-control" id="available" name="available" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Buku (URL)</label>
                <input type="text" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Buku</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Tambah Buku</button>
        </form>
        <!-- Tombol Kembali -->
        <button onclick="window.location.href='index.php';" class="btn btn-danger mt-3">Kembali</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

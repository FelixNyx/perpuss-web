<?php
session_start()
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda - Perpustakaan Asal Jadi</title>
    <link rel="icon" href="img/logoPerpus.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'layout/navbar.php'; ?>

<!-- Header -->
<header class="bg-light text-white py-3">
    <div class="container" style="background-color: #81BFDA;">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
            </div>
            <h1 class="m-0" style="color: black;">Perpustakaan Sukamaju</h1>
            <nav>
            </nav>
        </div>
    </div>
</header>

<header class=" text-white py-5">
    <div class="text-center" style="color: black;">
        <h1 class="display-4">Selamat Datang di Perpustakaan Sukamaju</h1>
        <p class="lead">Tempat terbaik untuk menemukan buku favorit Anda!</p>
    </div>
</header>

<div class="container py-5" style="background-color: white;">
    <h2 class="text-center mb-4">Langkah Menggunakan Aplikasi</h2>
    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <i class="bi bi-person-circle display-1 text-primary"></i>
            <h4 class="mt-3">1. Daftar / Login</h4>
            <p>Daftar akun baru atau masuk menggunakan akun yang sudah ada untuk mengakses semua fitur.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <i class="bi bi-book display-1 text-success"></i>
            <h4 class="mt-3">2. Pilih Buku</h4>
            <p>Jelajahi koleksi buku yang tersedia dan pilih buku yang ingin Anda pinjam.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <i class="bi bi-arrow-right-circle display-1 text-danger"></i>
            <h4 class="mt-3">3. Pinjam Buku</h4>
            <p>Isi tanggal kembali, dan konfirmasi peminjaman untuk mendapatkan buku.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <i class="bi bi-clock-history display-1 text-warning"></i>
            <h4 class="mt-3">4. Cek Riwayat</h4>
            <p>Lihat riwayat peminjaman untuk mengelola buku yang telah Anda pinjam.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <i class="bi bi-calendar-check display-1 text-info"></i>
            <h4 class="mt-3">5. Kembalikan Buku</h4>
            <p>Kembalikan buku tepat waktu untuk menghindari denda atau keterlambatan.</p>
        </div>
        <div class="col-md-4 text-center mb-4">
            <i class="bi bi-stars display-1 text-secondary"></i>
            <h4 class="mt-3">6. Nikmati Fasilitas</h4>
            <p>Nikmati fitur lain seperti rekomendasi buku atau ulasan dari pembaca lain.</p>
        </div>
    </div>
</div>

<!-- footer -->
<footer class=" text-white py-4 mt-5" style="background-color: #2E5077;">
    <div class=" text-center">
        <p class="m-0">&copy; 2024 Perpustakaan Asal Jadi. All Rights Reserved.</p>
        <p class="m-0">Dikembangkan dengan saya sendiri Annas Syafarudin.</p>
        <div class="mt-2">
            <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

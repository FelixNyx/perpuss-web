<?php
session_start()
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil - Perpustakaan Asal Jadi</title>
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

<header class="text-black py-5">
    <div class="text-center">
        <h1 class="display-4">Tentang Perpustakaan Sukamaju</h1>
        <p class="lead">Mengenal lebih dekat aplikasi perpustakaan yang kami bangun.</p>
    </div>
</header>

<div class="container py-5" style="background-color: #81BFDA;">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="mb-4">Apa itu Perpustakaan Sukamaju?</h2>
            <p>
                <strong>Perpustakaan Sukamaju</strong> adalah sebuah aplikasi berbasis web yang dirancang untuk mempermudah proses peminjaman, pengelolaan, dan pengembalian buku. Aplikasi ini dibuat untuk membantu pengguna mengakses berbagai koleksi buku dengan mudah, kapan saja dan di mana saja.
            </p>
            <p>
                Dengan antarmuka yang sederhana dan fitur yang lengkap, aplikasi ini dapat digunakan oleh semua kalangan, baik siswa, mahasiswa, maupun masyarakat umum yang ingin memperluas wawasan mereka melalui buku.
            </p>
        </div>
        <div class="col-md-6">
            <img src="./img/ilustperpus.jpg" alt="Ilustrasi Perpustakaan" class="img-fluid rounded shadow">
        </div>
    </div>
    <div class="row py-5">
        <div class="col-md-12">
            <h3 class="mb-4 text-center">Fitur Utama Aplikasi</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <i class="bi bi-person-circle text-primary me-2"></i> <strong>Registrasi dan Login</strong>: Pengguna dapat mendaftar dan masuk untuk menggunakan aplikasi.
                </li>
                <li class="list-group-item">
                    <i class="bi bi-book text-success me-2"></i> <strong>Koleksi Buku</strong>: Menyediakan katalog buku yang dapat dijelajahi dengan mudah.
                </li>
                <li class="list-group-item">
                    <i class="bi bi-arrow-right-circle text-danger me-2"></i> <strong>Peminjaman Buku</strong>: Pengguna dapat meminjam buku sesuai dengan jumlah ketersediaan.
                </li>
                <li class="list-group-item">
                    <i class="bi bi-clock-history text-warning me-2"></i> <strong>Riwayat Peminjaman</strong>: Melihat daftar buku yang telah dipinjam dan tanggal kembali.
                </li>
                <li class="list-group-item">
                    <i class="bi bi-calendar-check text-info me-2"></i> <strong>Pengembalian Buku</strong>: Memastikan buku yang dipinjam dikembalikan tepat waktu.
                </li>
            </ul>
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

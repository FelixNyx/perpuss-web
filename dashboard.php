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

// Query untuk mendapatkan data buku
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

// Cek pesan sukses atau error
$message = '';
$error = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Hapus error setelah ditampilkan
}

$conn->close();
?>

<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Asal Jadi</title>
    <link rel="icon" href="img/logoPerpus.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <? include 'layout/header.php'; ?>
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

<!-- Alert untuk pesan sukses -->
<?php if ($message): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
        <?= $message ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Alert untuk pesan error -->
<?php if ($error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
        <?= $error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<center>
    <div class="flex justify-center py-10">
        <div id="carouselExampleSlidesOnly" class="carousel slide relative" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="img/Desain poster HARDIKNAS.jpeg" class="d-block w-full h-64 object-cover" alt="Komik 1">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="img/Trên trời rơi xuống trăm triệu vì sao.jpeg" class="d-block w-full h-48 object-cover" alt="Komik 2">
                </div>
                <div class="carousel-item" data-bs-interval="4000">
                    <img src="img/carousel3.jpeg" class="d-block w-full h-56 object-cover" alt="Komik 3">
                </div>
            </div>
        </div>
    </div>
</center>

<br>
<div class="container py-5" style="background-color: #81BFDA;">
<h2 class="text-center mb-5 text-dark">Buku Tersedia untuk Peminjaman</h2>
<div class="row justify-content-center">
<?php while ($row = $result->fetch_assoc()) : ?>
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
            <img src="<?= $row['image'] ?>" class="card-img-top" alt="Buku Cover">
            <div class="card-body">
                <h5 class="card-title"><?= $row['title'] ?></h5>
                <p class="card-text"><?= $row['author'] ?></p>
                <p class="card-text"><?= $row['description'] ?></p>
                <p class="card-text"><strong>Jumlah Tersedia:</strong> <?= $row['available'] ?></p>

                <?php if (isset($_SESSION['username'])) : ?>
                    <!-- Tombol Pinjam Buku, disable jika jumlah buku 0 -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pinjamModal" 
                            data-book-id="<?= $row['id'] ?>" data-book-title="<?= $row['title'] ?>" 
                            data-book-available="<?= $row['available'] ?>"
                            <?= $row['available'] == 0 ? 'disabled' : '' ?>>
                        Pinjam Buku
                    </button>
                <?php else : ?>
                    <!-- Tombol yang membuka modal login jika belum login -->
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#loginModal">Login jika ingin pinjam</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>
</div>

<!-- Modal Peminjaman Buku -->
<div class="modal fade" id="pinjamModal" tabindex="-1" aria-labelledby="pinjamModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pinjamModalLabel">Peminjaman Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="peminjaman.php" method="POST">
            <input type="hidden" name="book_id" id="book_id">
            <input type="hidden" name="book_title" id="book_title">
            <div class="mb-3">
                <label for="return_date" class="form-label">Tanggal Kembali</label>
                <input type="date" name="return_date" id="return_date" class="form-control" required>
            </div>
            <div id="book_available" class="text-muted mb-3"></div>
            <button type="submit" class="btn btn-primary">Pinjam Buku</button>
        </form>
      </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
// JavaScript untuk mengisi modal dengan informasi buku dan memeriksa ketersediaan
const pinjamModal = document.getElementById('pinjamModal');
pinjamModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const bookId = button.getAttribute('data-book-id');
    const bookTitle = button.getAttribute('data-book-title');
    const available = button.getAttribute('data-book-available');

    const modalBookId = pinjamModal.querySelector('#book_id');
    const modalBookTitle = pinjamModal.querySelector('#book_title');
    const modalBookAvailable = pinjamModal.querySelector('#book_available');
    const submitButton = pinjamModal.querySelector('button[type="submit"]');

    modalBookId.value = bookId;
    modalBookTitle.value = bookTitle;
    modalBookAvailable.textContent = `Jumlah Tersedia: ${available}`;

    // Menonaktifkan tombol submit jika buku habis
    submitButton.disabled = available == 0;
});

// Fungsi untuk menghilangkan alert otomatis dalam 3 detik
window.addEventListener('load', function() {
    const successAlert = document.getElementById('alert-success');
    const errorAlert = document.getElementById('alert-error');

    if (successAlert) {
        setTimeout(function() {
            successAlert.classList.remove('show');
        }, 2000); // 2 detik
    }

    if (errorAlert) {
        setTimeout(function() {
            errorAlert.classList.remove('show');
        }, 2000); // 2 detik
    }
});
</script>
</body>
</html>

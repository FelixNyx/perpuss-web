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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $bookId = intval($_POST['book_id']);
    $borrowDate = date('Y-m-d'); // Tanggal peminjaman otomatis
    $returnDate = $_POST['return_date']; // Tanggal pengembalian yang diminta
    $userId = $_SESSION['id']; // ID pengguna yang login

    // Query untuk mendapatkan data buku
    $sqlBook = "SELECT * FROM books WHERE id = $bookId";
    $resultBook = $conn->query($sqlBook);

    if ($resultBook && $resultBook->num_rows > 0) {
        $book = $resultBook->fetch_assoc();

        // Cek apakah buku masih tersedia
        if ($book['available'] > 0) {
            // Menambahkan peminjaman ke tabel borrowings
            $sqlBorrow = "INSERT INTO borrowings (user_id, book_id, borrow_date, return_date, status) 
                          VALUES ($userId, $bookId, '$borrowDate', '$returnDate', 'borrowed')";

            if ($conn->query($sqlBorrow) === TRUE) {
                // Mengurangi jumlah buku yang tersedia
                $sqlUpdateBooks = "UPDATE books SET available = available - 1 WHERE id = $bookId";
                $conn->query($sqlUpdateBooks);

                $_SESSION['message'] = "Buku berhasil dipinjam!";
                header("Location: dashboard.php"); // Redirect ke halaman utama
                exit();
            } else {
                $_SESSION['error'] = "Terjadi kesalahan saat meminjam buku.";
            }
        } else {
            $_SESSION['error'] = "Buku tidak tersedia.";
        }
    } else {
        $_SESSION['error'] = "Buku tidak ditemukan.";
    }
}

$conn->close();
?>

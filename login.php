<?php
session_start();
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'uas';

$conn = new mysqli($host, $username, $password, $dbname);

// Pastikan form login sudah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa email dan password
    $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika ditemukan pengguna
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session data
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; // Menyimpan role pengguna

            // Redirect berdasarkan role
            if ($_SESSION['role'] === 'admin') {
                echo "<script>alert('Login successful as Admin'); window.location.href = 'admin/dashboard.php';</script>";
            } else {
                echo "<script>alert('Login successful!'); window.location.href = 'dashboard.php';</script>";
            }
            exit();
        } else {
            echo "<script>alert('Incorrect password'); window.location.href = 'dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('User not found'); window.location.href = 'dashboard.php';</script>";
    }
}
?>

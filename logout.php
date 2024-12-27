<?php
session_start();
session_destroy(); // Menghancurkan session pengguna
echo "<script>alert('You have logged out successfully!'); window.location.href = 'dashboard.php'; </script>";
exit();
?>

<?php
$conn = new mysqli("localhost", "root", "", "nasya");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

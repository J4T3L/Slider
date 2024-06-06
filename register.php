<?php
require 'koneksi.php';

// Mengambil nilai dari formulir HTML
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

// Validasi input (contoh: memastikan tidak ada yang kosong)
if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
    echo "Mohon isi semua data.";
    exit; // Menghentikan eksekusi skrip jika ada data yang kosong
}

// Membuat prepared statement
$stmt = $conn->prepare("INSERT INTO tbl_users (fullname, username, email, password) VALUES (?, ?, ?, ?)");

if ($stmt) {
    // Membind parameter ke prepared statement
    $stmt->bind_param("ssss", $fullname, $username, $email, $password);

    // Menjalankan prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil!');</script>";
        echo "<script>window.location.href='/Slider/index.html';</script>";
        exit; // Pastikan untuk keluar setelah mengarahkan pengguna
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        echo "Pendaftaran Gagal : " . $stmt->error;
    }

    // Menutup prepared statement
    $stmt->close();
} else {
    // Jika prepared statement gagal dibuat, tampilkan pesan kesalahan
    echo "Pendaftaran Gagal : " . $conn->error;
}

// Menutup koneksi
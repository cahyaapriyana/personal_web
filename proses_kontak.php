<?php
include "koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = mysqli_real_escape_string($db, $_POST['nama']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $subjek = mysqli_real_escape_string($db, $_POST['subjek']);
    $pesan = mysqli_real_escape_string($db, $_POST['pesan']);

    
    if (empty($nama) || empty($email) || empty($subjek) || empty($pesan)) {
        $_SESSION['error'] = "Semua field harus diisi!";
        header('location:kontak.php');
        exit;
    }
 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Format email tidak valid!";
        header('location:kontak.php');
        exit;
    }

 
    $sql = "INSERT INTO tbl_kontak (nama, email, subjek, pesan) VALUES ('$nama', '$email', '$subjek', '$pesan')";
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['success'] = "Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.";
    } else {
        $_SESSION['error'] = "Gagal mengirim pesan. Silakan coba lagi nanti.";
    }

    header('location:kontak.php');
    exit;
} else {
    header('location:kontak.php');
    exit;
}
?>

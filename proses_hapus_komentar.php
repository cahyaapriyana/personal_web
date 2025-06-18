<?php
include "koneksi.php";
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Anda harus login untuk menghapus komentar.";
    header('location:admin/login.php');
    exit;
}

if (isset($_GET['id_komentar']) && isset($_GET['id_artikel'])) {
    $id_komentar = mysqli_real_escape_string($db, $_GET['id_komentar']);
    $id_artikel = mysqli_real_escape_string($db, $_GET['id_artikel']);
    $username_session = $_SESSION['username'];
    $user_role = $_SESSION['role'];

    // Ambil data komentar untuk verifikasi
    $sql_get_comment = "SELECT username FROM tbl_komentar WHERE id_komentar = '$id_komentar'";
    $query_get_comment = mysqli_query($db, $sql_get_comment);
    $comment_data = mysqli_fetch_assoc($query_get_comment);

    if ($comment_data) {
        // Cek apakah user adalah pemilik komentar atau admin
        if ($comment_data['username'] === $username_session || $user_role === 'admin') {
            $sql_delete = "DELETE FROM tbl_komentar WHERE id_komentar = '$id_komentar'";
            $query_delete = mysqli_query($db, $sql_delete);

            if ($query_delete) {
                $_SESSION['success'] = "Komentar berhasil dihapus.";
            } else {
                $_SESSION['error'] = "Gagal menghapus komentar.";
            }
        } else {
            $_SESSION['error'] = "Anda tidak memiliki izin untuk menghapus komentar ini.";
        }
    } else {
        $_SESSION['error'] = "Komentar tidak ditemukan.";
    }

    // Redirect kembali ke halaman artikel setelah proses
    header('location:artikel.php?id=' . $id_artikel);
    exit;
} else {
    // Jika parameter tidak lengkap, redirect ke halaman utama
    header('location:index.php');
    exit;
}
?>

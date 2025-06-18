<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = "Anda harus login untuk berkomentar.";
    header('location:admin/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_artikel = mysqli_real_escape_string($db, $_POST['id_artikel']);
    $username = $_SESSION['username'];
    $komentar = mysqli_real_escape_string($db, $_POST['komentar']);

    $parent_id_sql = "NULL"; // Default value for SQL
    if (isset($_POST['parent_id']) && !empty($_POST['parent_id'])) {
        $parent_id = mysqli_real_escape_string($db, $_POST['parent_id']);
        // Validasi tambahan: Pastikan parent_id adalah angka yang valid
        if (is_numeric($parent_id) && $parent_id > 0) {
            $parent_id_sql = "'" . $parent_id . "'"; // Gunakan string untuk SQL jika valid
        }
    }

    // Selalu gunakan satu query INSERT, dengan nilai parent_id_sql
    $sql = "INSERT INTO tbl_komentar (id_artikel, username, komentar, parent_id) VALUES ('$id_artikel', '$username', '$komentar', $parent_id_sql)";
    
    $query = mysqli_query($db, $sql);

    if ($query) {
        $_SESSION['success_comment'] = "Komentar berhasil ditambahkan.";
        header('location:artikel.php?id=' . $id_artikel);
    } else {
        $_SESSION['error_comment'] = "Gagal menambahkan komentar: " . mysqli_error($db); // Tambahkan error MySQL untuk debug
        header('location:artikel.php?id=' . $id_artikel); 
    }
    exit; 
} else {
    header('location:index.php');
    exit;
}
?>
<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    $_SESSION['error'] = "Anda tidak memiliki akses untuk menghapus data About.";
    header('location:beranda_admin.php');
    exit;
}
$id = $_GET['id_about'];
$sql = "DELETE FROM tbl_about WHERE id_about = '$id'";
$query = mysqli_query($db, $sql);
if ($query) {
echo "<script>alert('Data About berhasil dihapus.');
window.location='about.php';</script>";
} else {
echo "<script>alert('Gagal menghapus data.'); history.back();</script>";
}
?>
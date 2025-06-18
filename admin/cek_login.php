<?php
include('../koneksi.php');
session_start();
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);
// Cek di database
$sql = "SELECT username, role FROM tbl_user WHERE username='$username' AND\npassword='$password'";
$query = mysqli_query($db, $sql);
if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];
    header('Location: beranda_admin.php');
} else {
$_SESSION['error'] = "Username atau password salah!";
header('Location: login.php');
}
?>
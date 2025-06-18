<?php
include('../koneksi.php');
session_start();

 
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    $_SESSION['error'] = "Anda tidak memiliki akses untuk memproses perubahan peran user.";
    header('location:beranda_admin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $new_role = mysqli_real_escape_string($db, $_POST['role']);

    
    if ($username === $_SESSION['username'] && $new_role !== 'Admin') {
        $_SESSION['error'] = "Anda tidak dapat mengubah peran Anda sendiri dari Admin menjadi non-Admin.";
        header('location:edit_user_role.php?username=' . urlencode($username));
        exit;
    }

    $sql = "UPDATE tbl_user SET role = '$new_role' WHERE username = '$username'";
    $query = mysqli_query($db, $sql);

    if ($query) {
         
        if ($username === $_SESSION['username']) {
            $_SESSION['role'] = $new_role;
        }
        echo "<script>alert('Peran user berhasil diperbarui.');
        window.location='data_user.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui peran user.');
        history.back();</script>";
    }
} else {
    header('location:data_user.php');
    exit;
}
?> 
<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
header('location:login.php');
exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_artikel = $_POST['id_artikel'];
    $nama_artikel = $_POST['nama_artikel'];
    $label = $_POST['label'];
    $isi_artikel = $_POST['isi_artikel'];
    
    $sql = "UPDATE tbl_artikel SET nama_artikel = '$nama_artikel', label = '$label', isi_artikel = '$isi_artikel' WHERE id_artikel = '$id_artikel'";
    
    if (mysqli_query($db, $sql)) {
        echo "<script>
            alert('Artikel berhasil diperbarui!');
            window.location.href='data_artikel.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($db) . "');
            window.location.href='edit_artikel.php?id=" . $id_artikel . "';
        </script>";
    }
}
?>
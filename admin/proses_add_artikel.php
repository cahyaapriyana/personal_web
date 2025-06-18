<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
header('location:login.php');
exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_artikel = $_POST['nama_artikel'];
    $label = $_POST['label'];
    $isi_artikel = $_POST['isi_artikel'];
    
    $sql = "INSERT INTO tbl_artikel (nama_artikel, label, isi_artikel) VALUES ('$nama_artikel', '$label', '$isi_artikel')";
    
    if (mysqli_query($db, $sql)) {
        echo "<script>
            alert('Artikel berhasil ditambahkan!');
            window.location.href='data_artikel.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($db) . "');
            window.location.href='add_artikel.php';
        </script>";
    }
}
?>

<?php include "koneksi.php"; 
session_start();
 
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
$tanggal = date('Y-m-d');

 
$cek = mysqli_query($db, "SELECT id FROM tbl_pengunjung WHERE ip_address='$ip' AND tanggal='$tanggal'");
if(mysqli_num_rows($cek) == 0) {
    mysqli_query($db, "INSERT INTO tbl_pengunjung (tanggal, ip_address, user_agent) VALUES ('$tanggal', '$ip', '".mysqli_real_escape_string($db, $user_agent)."')");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="src/favico.png">
<meta charset="UTF-8">
<title>About | Personal Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-[#E8F1F2] text-gray-800 font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] min-h-screen">
<!-- Header -->
<header class="bg-[#1B4965] border-b-4 border-black text-white text-center py-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-2xl md:text-3xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black">
About Me | Cahya Apriyana
</header>
<!-- Navigation -->
<nav class="bg-[#5FA8A3] border-b-4 border-black text-white py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
<ul class="flex justify-center space-x-10 font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-bold text-lg">
<li><a href="index.php" class="hover:underline hover:text-[#1B4965] transition-all">Artikel</a></li>
<li><a href="gallery.php" class="hover:underline hover:text-[#1B4965] transition-all">Gallery</a></li>
<li><a href="about.php" class="hover:underline hover:text-[#1B4965] transition-all">About</a></li>
<li><a href="kontak.php" class="hover:underline hover:text-[#1B4965] transition-all">Kontak</a></li>
<?php if(isset($_SESSION['username'])) { ?>
    <li><a href="admin/logout.php" class="hover:underline hover:text-[#1B4965] transition-all">Logout</a></li>
<?php } else { ?>
    <li><a href="admin/login.php" class="hover:underline hover:text-[#1B4965] transition-all">Login</a></li>
<?php } ?>
</ul>
</nav>
<!-- About Content -->
<main class="max-w-3xl mx-auto p-4 md:p-6 bg-white border-4 border-black rounded shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] mt-6">
<h2 class="text-2xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black text-[#1B4965] mb-4">Tentang Saya</h2>
<div class="space-y-6">
<?php
$sql = "SELECT * FROM tbl_about ORDER BY id_about DESC";
$query = mysqli_query($db, $sql);
while ($data = mysqli_fetch_array($query)) {
echo "<div class='border-b border-black pb-4'>";
echo "<p class='text-gray-700'>" . htmlspecialchars($data['about']) . "</p>";
echo "</div>";
}
?>
</div>
</main>
<!-- Footer -->
<footer class="bg-[#1B4965] border-t-4 border-black text-white text-center py-4 mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)] font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-bold">
&copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
</footer>
</body>
</html>
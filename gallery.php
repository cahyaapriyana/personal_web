<?php 
include "koneksi.php"; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Gallery | Personal Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="src/output.css" rel="stylesheet">

<link rel="icon" href="src/favico.png">
<style>
    
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    cursor: pointer;
}

.modal-content {
    margin: auto;
    display: block;
    max-width: 90%;
    max-height: 90vh;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    object-fit: contain;
}
</style>
</head>
<body class="bg-[#E8F1F2] text-gray-800 font-sans min-h-screen">
<!-- Header -->
<header class="bg-[#1B4965] border-b-2 border-black text-white text-center py-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-2xl md:text-3xl font-black">
Gallery | Cahya Apriyana
</header>
<!-- Navigation -->
<nav class="bg-[#5FA8A3] border-b-2 border-black text-white py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
<ul class="flex justify-center space-x-10 font-bold text-lg">
<li><a href="index.php" class="hover:underline hover:text-[#1B4965] transition-all">Artikel</a></li>
<li><a href="gallery.php" class="hover:underline hover:text-[#1B4965] transition-all">Gallery</a></li>
<li><a href="about.php" class="hover:underline hover:text-[#1B4965] transition-all">About</a></li>
<?php if(isset($_SESSION['username'])) { ?>
    <li><a href="admin/logout.php" class="hover:underline hover:text-[#1B4965] transition-all">Logout</a></li>
<?php } else { ?>
    <li><a href="admin/login.php" class="hover:underline hover:text-[#1B4965] transition-all">Login</a></li>
<?php } ?>
</ul>
</nav>
<!-- Gallery Grid -->
<main class="max-w-7xl mx-auto p-4 md:p-8">
<h2 class="text-2xl font-black text-[#1B4965] mb-8 text-center">Galeri Foto</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
<?php
$sql = "SELECT * FROM tbl_gallery ORDER BY id_gallery DESC";
$query = mysqli_query($db, $sql);
while ($data = mysqli_fetch_array($query)) {
echo "<div class='bg-white border-2 border-black rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-hidden hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] transition-all duration-300'>";
echo "<div class='aspect-w-16 aspect-h-9'>";
echo "<img src='images/{$data['foto']}' class='w-full h-64 object-cover hover:scale-105 transition-transform duration-300 cursor-pointer' onclick='openModal(this.src)' alt='Gambar'>";
echo "</div>";
echo "<div class='p-6 border-t-2 border-black'>";
echo "<h3 class='text-xl font-black text-[#1B4965]'>" . htmlspecialchars($data['judul']) . "</h3>";
echo "</div></div>";
}
?>
</div>
</main>

 
<div id="imageModal" class="modal" onclick="closeModal()">
    <img class="modal-content" id="modalImage">
</div>

<!-- Footer -->
<footer class="bg-[#1B4965] border-t-2 border-black text-white text-center py-4 mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)] font-bold">
&copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
</footer>

<script>
function openModal(imgSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = "block";
    modalImg.src = imgSrc;
}

function closeModal() {
    document.getElementById('imageModal').style.display = "none";
}

 
document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") {
        closeModal();
    }
});
</script>
</body>
</html>
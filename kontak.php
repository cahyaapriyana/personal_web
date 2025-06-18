<?php 
include "koneksi.php"; 
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
<title>Kontak | Personal Web</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-[#E8F1F2] text-gray-800 font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] min-h-screen">
<!-- Header -->
<header class="bg-[#1B4965] border-b-2 border-black text-white text-center py-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-2xl md:text-3xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black">
Kontak | Cahya Apriyana
</header>
<!-- Navigation -->
<nav class="bg-[#5FA8A3] border-b-2 border-black text-white py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
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

<!-- Main Content -->
<main class="max-w-6xl mx-auto p-4 md:p-8 mt-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Form Kontak -->
        <div class="bg-white border-2 border-black p-6 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] max-w-2xl w-full mx-auto">
            <h2 class="text-2xl font-black text-[#1B4965] mb-6">Kirim Pesan</h2>
            
            <?php if(isset($_SESSION['success'])) { ?>
                <div id="successPopup" class="fixed top-1/2 left-1/2 max-w-lg w-[95vw] bg-green-100 border border-green-400 text-green-800 py-6 px-8 rounded-xl shadow-2xl z-50 opacity-0 scale-95 transition-all duration-300 flex flex-col items-center justify-center text-center">
                    <button onclick="closePopup('successPopup')" class="absolute top-2 right-3 text-green-700 hover:text-green-900 text-xl font-bold focus:outline-none">&times;</button>
                    <div class="flex items-center justify-center mb-2">
                        <svg class="w-7 h-7 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="text-base font-medium">
                            <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </span>
                    </div>
                </div>
                <script>
                    const successPopup = document.getElementById('successPopup');
                    setTimeout(() => {
                        successPopup.style.opacity = '1';
                        successPopup.style.transform = 'translate(-50%, -50%) scale(1)';
                    }, 10);
                    setTimeout(function() {
                        if(successPopup) {
                            successPopup.style.opacity = '0';
                            successPopup.style.transform = 'translate(-50%, -50%) scale(0.95)';
                            setTimeout(() => successPopup && successPopup.remove(), 300);
                        }
                    }, 3000);
                    function closePopup(id) {
                        const el = document.getElementById(id);
                        if(el) {
                            el.style.opacity = '0';
                            el.style.transform = 'translate(-50%, -50%) scale(0.95)';
                            setTimeout(() => el && el.remove(), 300);
                        }
                    }
                </script>
            <?php } ?>

            <?php if(isset($_SESSION['error'])) { ?>
                <div id="errorPopup" class="fixed top-1/2 left-1/2 max-w-lg w-[95vw] bg-red-100 border border-red-400 text-red-800 py-6 px-8 rounded-xl shadow-2xl z-50 opacity-0 scale-95 transition-all duration-300 flex flex-col items-center justify-center text-center">
                    <button onclick="closePopup('errorPopup')" class="absolute top-2 right-3 text-red-700 hover:text-red-900 text-xl font-bold focus:outline-none">&times;</button>
                    <div class="flex items-center justify-center mb-2">
                        <svg class="w-7 h-7 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span class="text-base font-medium">
                            <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </span>
                    </div>
                </div>
                <script>
                    const errorPopup = document.getElementById('errorPopup');
                    setTimeout(() => {
                        errorPopup.style.opacity = '1';
                        errorPopup.style.transform = 'translate(-50%, -50%) scale(1)';
                    }, 10);
                    setTimeout(function() {
                        if(errorPopup) {
                            errorPopup.style.opacity = '0';
                            errorPopup.style.transform = 'translate(-50%, -50%) scale(0.95)';
                            setTimeout(() => errorPopup && errorPopup.remove(), 300);
                        }
                    }, 3000);
                </script>
            <?php } ?>

            <form action="proses_kontak.php" method="POST" class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-bold text-gray-700 mb-1">Nama</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           required 
                           class="w-full p-3 border-2 border-black rounded-lg focus:outline-none focus:border-[#5FA8A3] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           class="w-full p-3 border-2 border-black rounded-lg focus:outline-none focus:border-[#5FA8A3] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                </div>

                <div>
                    <label for="subjek" class="block text-sm font-bold text-gray-700 mb-1">Subjek</label>
                    <input type="text" 
                           id="subjek" 
                           name="subjek" 
                           required 
                           class="w-full p-3 border-2 border-black rounded-lg focus:outline-none focus:border-[#5FA8A3] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                </div>

                <div>
                    <label for="pesan" class="block text-sm font-bold text-gray-700 mb-1">Pesan</label>
                    <textarea id="pesan" 
                              name="pesan" 
                              rows="5" 
                              required 
                              class="w-full p-3 border-2 border-black rounded-lg focus:outline-none focus:border-[#5FA8A3] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]"></textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-[#1B4965] text-white px-6 py-3 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold">
                    Kirim Pesan
                </button>
            </form>
        </div>

         
        <div class="space-y-6">
            <div class="bg-white border-2 border-black p-6 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-2xl font-black text-[#1B4965] mb-4">Informasi Kontak</h2>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5FA8A3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-800">Email</h3>
                            <p class="text-gray-600">contact@codemind.id</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5FA8A3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-800">Telepon</h3>
                            <p class="text-gray-600">+62 123 4567 890</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#5FA8A3]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <h3 class="font-bold text-gray-800">Alamat</h3>
                            <p class="text-gray-600">Jl. Raden Ajeng Kartini No.KM. 3, desa nyimplung, Pasirkareumbi<br>Kec. Subang, Kabupaten Subang, Jawa Barat 41285<br>Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border-2 border-black p-6 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h2 class="text-2xl font-black text-[#1B4965] mb-4">Jam Kerja</h2>
                <div class="space-y-2">
                    <p class="text-gray-600">Setiap Hari: 09:00 - 17:00</p>
 
 
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-[#1B4965] border-t-2 border-black text-white text-center py-4 mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)] font-bold">
&copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
</footer>
</body>
</html>

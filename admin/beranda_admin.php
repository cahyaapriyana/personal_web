<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="../src/output.css" rel="stylesheet">
    <link rel="icon" href="../src/favico.png">
</head>
<body class="bg-[#E8F1F2] min-h-screen">

    <header class="bg-[#1B4965] border-b-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="max-w-7xl mx-auto px-4 py-4 md:py-6">
            <h1 class="text-2xl md:text-4xl font-black text-white text-center">Dashboard </h1>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto mt-4 md:mt-8 px-4 gap-4 md:gap-6">
        <aside class="w-full lg:w-1/4 bg-white border-4 border-black p-4 md:p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] h-fit">
            <h2 class="text-xl md:text-2xl font-black text-[#1B4965] mb-4 text-center">MENU</h2>
            <ul class="space-y-2 text-gray-700">
                <li><a href="beranda_admin.php" class="block p-2 md:p-3 bg-[#5FA8A3] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Beranda</a></li>
                <?php if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Editor') { ?>
                <li><a href="data_artikel.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Artikel</a></li>
                <?php } ?>
                <?php if ($_SESSION['role'] === 'Admin') { ?>
                <li><a href="data_gallery.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Gallery</a></li>
                <li><a href="about.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">About</a></li>
                <?php } ?>
                <?php if ($_SESSION['role'] === 'Admin') { ?>
                <li><a href="data_user.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola User</a></li>
                <?php } ?>
                <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="block p-2 md:p-3 bg-[#1B4965] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Logout</a></li>
                <li><a href="../index.php" class="block p-2 md:p-3 bg-[#5FA8A3] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Ke Halaman Utama Website</a></li>
            </ul>
        </aside>

        <main class="w-full lg:w-3/4 bg-white border-4 border-black p-4 md:p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <div class="mb-6 md:mb-8">
                <h2 class="text-2xl md:text-3xl font-black text-[#1B4965] mb-2 md:mb-4">Selamat Datang, <?php echo $_SESSION['username']; ?>! <span class="text-lg">(Role: <?php echo $_SESSION['role']; ?>)</span></h2>
                <p class="text-base md:text-lg text-gray-700">Ini adalah halaman dashboard admin. Silakan pilih menu di sidebar untuk mengelola konten website.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                <div class="bg-[#5FA8A3] border-4 border-black p-4 md:p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="text-lg md:text-xl font-bold text-white mb-2">Total Artikel</h3>
                    <?php
                    $query = mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_artikel");
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <p class="text-2xl md:text-3xl font-black text-white"><?php echo $data['total']; ?></p>
                </div>
                <div class="bg-[#1B4965] border-4 border-black p-4 md:p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <h3 class="text-lg md:text-xl font-bold text-white mb-2">Total Gallery</h3>
                    <?php
                    $query = mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_gallery");
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <p class="text-2xl md:text-3xl font-black text-white"><?php echo $data['total']; ?></p>
                </div>
            </div>

            <div class="border-4 border-black p-4 md:p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl md:text-2xl font-black text-[#1B4965] mb-4">Artikel Terbaru</h3>
                <div class="space-y-4">
                    <?php
                    $query = mysqli_query($db, "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT 3");
                    while($data = mysqli_fetch_assoc($query)) {
                        echo '<div class="bg-white border-2 border-black p-3 md:p-4 hover:bg-[#E8F1F2] transition-colors">';
                        echo '<h4 class="text-base md:text-lg font-bold text-[#1B4965]">' . htmlspecialchars($data['nama_artikel']) . '</h4>';
                        echo '<p class="text-sm md:text-base text-gray-700">' . substr(htmlspecialchars($data['isi_artikel']), 0, 100) . '...</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </main>
    </div>

    <footer class="bg-[#1B4965] border-t-4 border-black text-white text-center py-3 md:py-4 mt-6 md:mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)]">
        &copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
    </footer>
</body>
</html>
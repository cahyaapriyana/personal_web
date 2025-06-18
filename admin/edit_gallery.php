<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    $_SESSION['error'] = "Anda tidak memiliki akses untuk mengedit gambar galeri.";
    header('location:beranda_admin.php');
    exit;
}
$id = $_GET['id_gallery'];
$sql = "SELECT * FROM tbl_gallery WHERE id_gallery = '$id'";
$query = mysqli_query($db, $sql);
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gambar Gallery</title>
    <link href="../src/output.css" rel="stylesheet">
    <link rel="icon" href="../src/favico.png">
</head>
<body class="bg-[#E8F1F2] min-h-screen">

    <header class="bg-[#1B4965] border-b-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="max-w-7xl mx-auto px-4 py-4 md:py-6">
            <h1 class="text-2xl md:text-4xl font-black text-white text-center">// EDIT GAMBAR //</h1>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto mt-4 md:mt-8 px-4 gap-4 md:gap-6">
        <aside class="w-full lg:w-1/4 bg-white border-4 border-black p-4 md:p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] h-fit">
            <h2 class="text-xl md:text-2xl font-black text-[#1B4965] mb-4 text-center">MENU</h2>
            <ul class="space-y-2 text-gray-700">
                <li><a href="beranda_admin.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Beranda</a></li>
                <li><a href="data_artikel.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block p-2 md:p-3 bg-[#5FA8A3] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Gallery</a></li>
                <li><a href="about.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">About</a></li>
                <?php if ($_SESSION['role'] === 'Admin') { ?>
                <li><a href="data_user.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola User</a></li>
                <?php } ?>
                <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="block p-2 md:p-3 bg-[#1B4965] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Logout</a></li>
            </ul>
        </aside>

        <main class="w-full lg:w-3/4 bg-white border-4 border-black p-4 md:p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form action="proses_edit_gallery.php" method="post" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="id_gallery" value="<?php echo $data['id_gallery']; ?>">
                <div>
                    <label for="judul" class="block text-lg font-bold text-[#1B4965] mb-2">Judul Gambar</label>
                    <input type="text" 
                           id="judul" 
                           name="judul" 
                           required
                           value="<?php echo htmlspecialchars($data['judul']); ?>"
                           class="w-full p-3 border-4 border-black focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                </div>
                <div>
                    <label class="block text-lg font-bold text-[#1B4965] mb-2">Gambar Saat Ini</label>
                    <div class="border-4 border-black p-2 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <img src="../images/<?php echo $data['foto']; ?>" 
                             class="h-40 w-full object-cover" 
                             alt="Foto Lama">
                    </div>
                </div>
                <div>
                    <label for="foto" class="block text-lg font-bold text-[#1B4965] mb-2">Ganti Gambar (Opsional)</label>
                    <input type="file" 
                           id="foto" 
                           name="foto" 
                           accept="image/*"
                           class="block w-full p-3 border-4 border-black focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-[#5FA8A3] file:text-white file:font-bold hover:file:bg-[#1B4965] transition-colors">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                            class="bg-[#5FA8A3] text-white px-6 py-3 font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Simpan Perubahan</button>
                    <a href="data_gallery.php"
                       class="bg-[#1B4965] text-white px-6 py-3 font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Batal</a>
                </div>
            </form>
        </main>
    </div>

    <footer class="bg-[#1B4965] border-t-4 border-black text-white text-center py-3 md:py-4 mt-6 md:mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)]">
        &copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
    </footer>
</body>
</html>
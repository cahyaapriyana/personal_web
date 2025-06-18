<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
header('location:login.php');
exit;
}

 
$artikel_per_halaman = 3;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($halaman - 1) * $artikel_per_halaman;

 
$sql_total = "SELECT COUNT(*) as total FROM tbl_artikel";
$query_total = mysqli_query($db, $sql_total);
$data_total = mysqli_fetch_array($query_total);
$total_artikel = $data_total['total'];
$total_halaman = ceil($total_artikel / $artikel_per_halaman);

 
$sql = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT $mulai, $artikel_per_halaman";
$query = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Artikel</title>
    <link href="../src/output.css" rel="stylesheet">
    <link rel="icon" href="../src/favico.png">
</head>
<body class="bg-[#E8F1F2] min-h-screen">
    <!-- Header -->
    <header class="bg-[#1B4965] border-b-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="max-w-7xl mx-auto px-4 py-4 md:py-6">
            <h1 class="text-2xl md:text-4xl font-black text-white text-center">// Kelola Artikel //</h1>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto mt-4 md:mt-8 px-4 gap-4 md:gap-6">
        
        <aside class="w-full lg:w-1/4 bg-white border-4 border-black p-4 md:p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] h-fit">
            <h2 class="text-xl md:text-2xl font-black text-[#1B4965] mb-4 text-center">MENU</h2>
            <ul class="space-y-2 text-gray-700">
                <li><a href="beranda_admin.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Beranda</a></li>
                <li><a href="data_artikel.php" class="block p-2 md:p-3 bg-[#5FA8A3] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Artikel</a></li>
                <li><a href="data_gallery.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Gallery</a></li>
                <li><a href="about.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">About</a></li>
                <?php if ($_SESSION['role'] === 'Admin') { ?>
                <li><a href="data_user.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola User</a></li>
                <?php } ?>
                <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="block p-2 md:p-3 bg-[#1B4965] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Logout</a></li>
            </ul>
        </aside>

     
        <main class="w-full lg:w-3/4 bg-white border-4 border-black p-4 md:p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-xl md:text-2xl font-black text-[#1B4965]">Daftar Artikel</h2>
                <?php if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Editor') { ?>
                <a href="add_artikel.php" class="w-full sm:w-auto bg-[#5FA8A3] text-white font-bold py-2 md:py-3 px-4 md:px-6 border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all text-center">
                    + Tambah Artikel
                </a>
                <?php } ?>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-4 border-black">
                    <thead class="bg-[#1B4965] text-white">
                        <tr>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">No</th>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">Nama Artikel</th>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">Isi Artikel</th>
                            <?php if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Editor') { ?>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">Aksi</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = $mulai + 1;
                        while ($data = mysqli_fetch_array($query)) {
                            echo "<tr class='hover:bg-[#E8F1F2] transition-colors'>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-center text-sm md:text-base'>" . $no++ . "</td>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-sm md:text-base'>" . htmlspecialchars($data['nama_artikel']) . "</td>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-sm md:text-base'>" . htmlspecialchars($data['isi_artikel']) . "</td>";
                            
                            if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Editor') {
                                echo "<td class='border-2 border-black p-2 md:p-3 text-center text-sm md:text-base'>\n";
                                echo "  <div class='flex flex-row justify-center items-center gap-2'>\n";
                                echo "    <a href='edit_artikel.php?id_artikel={$data['id_artikel']}' class='bg-[#5FA8A3] text-white font-bold py-1 md:py-2 px-2 md:px-4 border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all'>Edit</a>\n";
                                if ($_SESSION['role'] === 'Admin') {
                                    echo "    <a href='delete_artikel.php?id_artikel={$data['id_artikel']}' onclick='return confirm(\"Yakin ingin menghapus?\")' class='bg-[#FF6B6B] text-white font-bold py-1 md:py-2 px-2 md:px-4 border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all'>Hapus</a>\n";
                                }
                                echo "  </div>\n";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

             
            <?php if($total_halaman > 1): ?>
            <div class="flex justify-center items-center space-x-2 mt-6">
                <?php if($halaman > 1): ?>
                    <a href="?halaman=<?php echo $halaman - 1; ?>" class="bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold">Previous</a>
                <?php endif; ?>

                <?php for($i = 1; $i <= $total_halaman; $i++): ?>
                    <?php if($i == $halaman): ?>
                        <span class="bg-[#5FA8A3] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold"><?php echo $i; ?></span>
                    <?php else: ?>
                        <a href="?halaman=<?php echo $i; ?>" class="bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if($halaman < $total_halaman): ?>
                    <a href="?halaman=<?php echo $halaman + 1; ?>" class="bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold">Next</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1B4965] border-t-4 border-black text-white text-center py-3 md:py-4 mt-6 md:mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)]">
        &copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
    </footer>
</body>
</html>
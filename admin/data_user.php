<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    $_SESSION['error'] = "Anda tidak memiliki akses ke halaman ini.";
    header('location:beranda_admin.php');
    exit;
}

$sql = "SELECT username, role FROM tbl_user ORDER BY username ASC";
$query = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <link href="../src/output.css" rel="stylesheet">
    <link rel="icon" href="../src/favico.png">
</head>
<body class="bg-[#E8F1F2] min-h-screen">
    <!-- Header -->
    <header class="bg-[#1B4965] border-b-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
        <div class="max-w-7xl mx-auto px-4 py-4 md:py-6">
            <h1 class="text-2xl md:text-4xl font-black text-white text-center">// KELOLA USER //</h1>
        </div>
    </header>

    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto mt-4 md:mt-8 px-4 gap-4 md:gap-6">
        <!-- Sidebar -->
        <aside class="w-full lg:w-1/4 bg-white border-4 border-black p-4 md:p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] h-fit">
            <h2 class="text-xl md:text-2xl font-black text-[#1B4965] mb-4 text-center">MENU</h2>
            <ul class="space-y-2 text-gray-700">
                <li><a href="beranda_admin.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Beranda</a></li>
                <?php if ($_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Editor') { ?>
                <li><a href="data_artikel.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Artikel</a></li>
                <?php } ?>
                <?php if ($_SESSION['role'] === 'Admin') { ?>
                <li><a href="data_gallery.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola Gallery</a></li>
                <li><a href="about.php" class="block p-2 md:p-3 bg-white text-[#1B4965] font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">About</a></li>
                <li><a href="data_user.php" class="block p-2 md:p-3 bg-[#5FA8A3] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Kelola User</a></li>
                <?php } ?>
                <li><a href="logout.php" onclick="return confirm('Apakah anda yakin ingin keluar?');" class="block p-2 md:p-3 bg-[#1B4965] text-white font-bold border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[3px] hover:translate-y-[3px] hover:shadow-none transition-all">Logout</a></li>
            </ul>
        </aside>

       
        <main class="w-full lg:w-3/4 bg-white border-4 border-black p-4 md:p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <h2 class="text-xl md:text-2xl font-black text-[#1B4965] mb-6">Daftar User</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full border-4 border-black">
                    <thead class="bg-[#1B4965] text-white">
                        <tr>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">No</th>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">Username</th>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">Role</th>
                            <th class="p-2 md:p-3 border-2 border-black text-sm md:text-base">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            echo "<tr class='hover:bg-[#E8F1F2] transition-colors'>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-center text-sm md:text-base'>" . $no++ . "</td>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-sm md:text-base'>" . htmlspecialchars($data['username']) . "</td>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-sm md:text-base'>" . htmlspecialchars($data['role']) . "</td>";
                            echo "<td class='border-2 border-black p-2 md:p-3 text-center text-sm md:text-base'>";
                            echo "  <a href='edit_user_role.php?username=" . urlencode($data['username']) . "' class='bg-[#5FA8A3] text-white font-bold py-1 md:py-2 px-2 md:px-4 border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all'>Edit Role</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-[#1B4965] border-t-4 border-black text-white text-center py-3 md:py-4 mt-6 md:mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)]">
        &copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
    </footer>
</body>
</html> 
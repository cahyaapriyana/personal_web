<?php
include "../koneksi.php";
session_start();

 
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header('location:login.php');
    exit;
}

 
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = mysqli_real_escape_string($db, $_GET['id']);
    $action = $_GET['action'];
    
    if ($action === 'read') {
        $sql = "UPDATE tbl_kontak SET status = 'sudah_dibaca' WHERE id_kontak = '$id'";
        mysqli_query($db, $sql);
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM tbl_kontak WHERE id_kontak = '$id'";
        mysqli_query($db, $sql);
    }
    
    header('location:kontak.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pesan Kontak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../src/output.css" rel="stylesheet">
</head>
<body class="bg-[#E8F1F2] text-gray-800 font-sans min-h-screen">
    <div class="max-w-7xl mx-auto p-4 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-black text-[#1B4965]">Pesan Kontak</h1>
            <a href="beranda_admin.php" class="bg-[#1B4965] text-white px-5 py-2 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all font-bold">
                Kembali ke Dashboard
            </a>
        </div>
        <div class="bg-white border-2 border-black rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-x-auto">
            <table class="w-full min-w-[700px]">
                <thead class="bg-[#1B4965] text-white">
                    <tr>
                        <th class="p-4 text-left">Tanggal</th>
                        <th class="p-4 text-left">Nama</th>
                        <th class="p-4 text-left">Email</th>
                        <th class="p-4 text-left">Subjek</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tbl_kontak ORDER BY tanggal DESC";
                    $query = mysqli_query($db, $sql);
                    
                    while ($data = mysqli_fetch_array($query)) {
                        $status_class = $data['status'] === 'belum_dibaca' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800';
                        echo "<tr class='border-b border-gray-200 hover:bg-gray-50'>";
                        echo "<td class='p-4'>" . date('d/m/Y H:i', strtotime($data['tanggal'])) . "</td>";
                        echo "<td class='p-4'>" . htmlspecialchars($data['nama']) . "</td>";
                        echo "<td class='p-4'>" . htmlspecialchars($data['email']) . "</td>";
                        echo "<td class='p-4'>" . htmlspecialchars($data['subjek']) . "</td>";
                        echo "<td class='p-4'><span class='px-2 py-1 rounded-full text-sm " . $status_class . "'>" . 
                             ($data['status'] === 'belum_dibaca' ? 'Belum Dibaca' : 'Sudah Dibaca') . "</span></td>";
                        echo "<td class='p-4 flex gap-2'>";
                        echo "<button onclick='showMessage(\"" . htmlspecialchars($data['pesan']) . "\")' class='bg-[#5FA8A3] text-white px-3 py-1 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all'>Lihat</button>";
                        if ($data['status'] === 'belum_dibaca') {
                            echo "<a href='?id=" . $data['id_kontak'] . "&action=read' class='bg-[#1B4965] text-white px-3 py-1 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all'>Tandai Dibaca</a>";
                        }
                        echo "<a href='?id=" . $data['id_kontak'] . "&action=delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesan ini?\")' class='bg-red-600 text-white px-3 py-1 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg max-w-lg w-full mx-4">
            <h2 class="text-xl font-bold mb-4">Isi Pesan</h2>
            <p id="messageContent" class="text-gray-700 mb-4"></p>
            <button onclick="closeMessage()" class="bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all">Tutup</button>
        </div>
    </div>

    <script>
    function showMessage(message) {
        document.getElementById('messageContent').textContent = message;
        document.getElementById('messageModal').classList.remove('hidden');
        document.getElementById('messageModal').classList.add('flex');
    }

    function closeMessage() {
        document.getElementById('messageModal').classList.add('hidden');
        document.getElementById('messageModal').classList.remove('flex');
    }
    </script>
</body>
</html>

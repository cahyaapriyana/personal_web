<?php
include "koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" href="src/favico.png">
<meta charset="UTF-8">
<title>Personal Web | Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="src/output.css" rel="stylesheet">
</head>
<body class="bg-[#E8F1F2] text-gray-800 font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] min-h-screen">
<!-- Header -->
<header class="bg-[#1B4965] border-b-2 border-black text-white text-center py-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-2xl md:text-3xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black">
Personal Web | Cahya Apriyana
</header>
<!-- Navigation -->
<nav class="bg-[#5FA8A3] border-b-2 border-black text-white py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
<ul class="flex justify-center space-x-10 font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-bold text-lg">
<li><a href="index.php" class="hover:underline hover:text-[#1B4965] transition-all">Artikel</a></li>
<li><a href="gallery.php" class="hover:underline hover:text-[#1B4965] transition-all">Gallery</a></li>
<li><a href="about.php" class="hover:underline hover:text-[#1B4965] transition-all">About</a></li>
<?php if(isset($_SESSION['username'])) {
    echo "<li><a href='admin/logout.php' class='hover:underline hover:text-[#1B4965] transition-all'>Logout</a></li>";
} else {
    echo "<li><a href='admin/login.php' class='hover:underline hover:text-[#1B4965] transition-all'>Login</a></li>";
} ?>
</ul>
</nav>
<!-- Main Content -->
<main class="max-w-7xl mx-auto p-4 md:p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
<!-- Artikel Utama -->
<section class="md:col-span-2 bg-white border-2 border-black p-4 md:p-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded">
<h2 class="text-2xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black text-[#1B4965] mb-4">Artikel Terbaru
<?php
    if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
        echo " (Kategori: " . htmlspecialchars($_GET['kategori']) . ")";
    }
?>
</h2>
<div class="space-y-6">
<?php
// Setingan Page Number
$artikel_per_halaman = 3;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$mulai = ($halaman - 1) * $artikel_per_halaman;

// Fitur Pencarian
$where_conditions = [];
$params = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($db, $_GET['search']);
    $where_conditions[] = "(nama_artikel LIKE '%$search%' OR isi_artikel LIKE '%$search%')";
}

if (isset($_GET['kategori']) && !empty($_GET['kategori'])) {
    $kategori = mysqli_real_escape_string($db, $_GET['kategori']);
    $where_conditions[] = "label = '$kategori'";
}

$where_clause = !empty($where_conditions) ? " WHERE " . implode(" AND ", $where_conditions) : "";


$sql_total = "SELECT COUNT(*) as total FROM tbl_artikel" . $where_clause;
$query_total = mysqli_query($db, $sql_total);
$data_total = mysqli_fetch_array($query_total);
$total_artikel = $data_total['total'];
$total_halaman = ceil($total_artikel / $artikel_per_halaman);


$sql = "SELECT * FROM tbl_artikel" . $where_clause . " ORDER BY id_artikel DESC LIMIT $mulai, $artikel_per_halaman";
$query = mysqli_query($db, $sql);


$pagination_url = "?";
if (isset($_GET['search'])) {
    $pagination_url .= "search=" . urlencode($_GET['search']) . "&";
}
if (isset($_GET['kategori'])) {
    $pagination_url .= "kategori=" . urlencode($_GET['kategori']) . "&";
}


if (isset($_GET['search']) && !empty($_GET['search'])) {
    echo "<div class='mb-4 p-3 bg-[#5FA8A3] text-white rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]'>";
    echo "Hasil pencarian untuk: <strong>" . htmlspecialchars($_GET['search']) . "</strong>";
    echo "</div>";
}

if(mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $isi_artikel = htmlspecialchars($data['isi_artikel']);
        $isi_pendek = substr($isi_artikel, 0, 400) . '...';
        
        echo "<div class='border-b-2 border-black pb-6'>";
        echo "<div class='flex items-center gap-3 mb-3'>";
        echo "<span class='bg-[#5FA8A3] text-white px-3 py-1 rounded-full text-sm font-bold border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]'>" . htmlspecialchars($data['label']) . "</span>";
        echo "<a href='artikel.php?id=" . $data['id_artikel'] . "' class='text-xl font-black text-[#1B4965] hover:text-[#5FA8A3] transition-colors'>" . htmlspecialchars($data['nama_artikel']) . "</a>";
        echo "</div>";
        echo "<p class='text-gray-700 mb-4'>" . $isi_pendek . "</p>";
        echo "<a href='artikel.php?id=" . $data['id_artikel'] . "' class='inline-block bg-[#1B4965] text-white px-6 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Selengkapnya</a>";
        echo "</div>";
    }
} else {
    echo "<p class='text-gray-700 text-center py-4'>";
    if (isset($_GET['search'])) {
        echo "Tidak ditemukan artikel yang sesuai dengan pencarian Anda.";
    } else {
        echo "Belum ada artikel yang ditambahkan.";
    }
    echo "</p>";
}


if($total_halaman > 1) {
    echo "<div class='flex justify-center items-center space-x-2 mt-6'>";
    

    if($halaman > 1) {
        echo "<a href='" . $pagination_url . "halaman=" . ($halaman - 1) . "' class='bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Previous</a>";
    }
    

    for($i = 1; $i <= $total_halaman; $i++) {
        if($i == $halaman) {
            echo "<span class='bg-[#5FA8A3] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] font-bold'>$i</span>";
        } else {
            echo "<a href='" . $pagination_url . "halaman=$i' class='bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>$i</a>";
        }
    }
    

    if($halaman < $total_halaman) {
        echo "<a href='" . $pagination_url . "halaman=" . ($halaman + 1) . "' class='bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Next</a>";
    }
    
    echo "</div>";
}
?>
</div>
</section>
<!-- Sidebar -->
<aside class="space-y-6">
    <!-- Pencarian -->
    <div class="bg-white border-2 border-black p-4 md:p-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded">
        <h2 class="text-xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black text-[#1B4965] mb-4">Pencarian</h2>
        <form action="" method="GET" class="space-y-3">
            <div class="relative">
                <input type="text" 
                       name="search" 
                       placeholder="Cari artikel..." 
                       value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                       class="w-full p-3 pr-12 border-4 border-black focus:outline-none focus:border-[#5FA8A3] shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <button type="submit" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-[#5FA8A3] text-white p-2.5 border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all rounded group">
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </button>
            </div>
        </form>
    </div>

    <!-- Kategori -->
    <div class="bg-white border-2 border-black p-4 md:p-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded">
        <h2 class="text-xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black text-[#1B4965] mb-4">Kategori</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
        <?php
        $labels = ['Teknologi', 'Pendidikan', 'Kesehatan', 'Olahraga', 'Lainnya'];
        $current_category = isset($_GET['kategori']) ? $_GET['kategori'] : '';
        foreach($labels as $label) {
            $sql = "SELECT COUNT(*) as total FROM tbl_artikel WHERE label = '$label'";
            $query = mysqli_query($db, $sql);
            $data = mysqli_fetch_array($query);
            if($data['total'] > 0) {
                $active_class = ($label == $current_category) ? 'bg-[#1B4965]' : 'bg-[#5FA8A3]';
                echo "<a href='?kategori=" . urlencode($label) . "' class='" . $active_class . " text-white px-2 py-1 rounded-full text-xs font-bold border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all text-center'>" . $label . " (" . $data['total'] . ")</a>";
            }
        }
        ?>
        </div>
    </div>

    <!-- Artikel Terbaru -->
    <div class="bg-white border-2 border-black p-4 md:p-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded">
        <h2 class="text-xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black text-[#1B4965] mb-4">Artikel Terbaru</h2>
        <div class="space-y-4">
        <?php
        $sql = "SELECT * FROM tbl_artikel ORDER BY id_artikel DESC LIMIT 3";
        $query = mysqli_query($db, $sql);
        while ($data = mysqli_fetch_array($query)) {
            echo "<div class='border-b-2 border-black pb-3 last:border-0 last:pb-0'>";
            echo "<a href='artikel.php?id=" . $data['id_artikel'] . "' class='hover:text-[#1B4965] transition-colors'>";
            echo "<h3 class='font-bold'>" . htmlspecialchars($data['nama_artikel']) . "</h3>";
            echo "<span class='text-sm text-gray-500'>" . htmlspecialchars($data['label']) . "</span>";
            echo "</a></div>";
        }
        ?>
        </div>  
    </div>


    <div class="bg-white border-2 border-black p-4 md:p-8 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded">
        <h2 class="text-xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black text-[#1B4965] mb-4">Tentang Saya</h2>
        <p class="text-gray-700 mb-4">Selamat datang di website pribadi saya. Saya adalah seorang pengembang web yang bersemangat dalam menciptakan pengalaman digital yang menarik.</p>
        <a href="about.php" class="inline-block bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold text-sm">Baca Selengkapnya</a>
    </div>
</aside>
</main>
<!-- Footer -->
<footer class="bg-[#1B4965] border-t-2 border-black text-white text-center py-4 mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)] font-bold">
&copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
</footer>
</body>
</html>
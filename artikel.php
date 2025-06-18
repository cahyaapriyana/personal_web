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
<meta charset="UTF-8">
<title>
<?php 
 
$page_title = "Personal Web | Artikel"; 

if(isset($_GET['id'])) {
    $id_artikel_current = mysqli_real_escape_string($db, $_GET['id']);
    $sql_article_title = "SELECT nama_artikel FROM tbl_artikel WHERE id_artikel = '$id_artikel_current'";
    $query_article_title = mysqli_query($db, $sql_article_title);
    if(mysqli_num_rows($query_article_title) > 0) {
        $article_data = mysqli_fetch_array($query_article_title);
        $page_title = htmlspecialchars($article_data['nama_artikel']) . " | Personal Web";
    }
}
echo $page_title;
?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="src/output.css" rel="stylesheet">

<link rel="icon" href="src/favico.png">

</head>

<body class="bg-[#E8F1F2] text-gray-800 font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] min-h-screen">
<!-- Header -->
<header class="bg-[#1B4965] border-b-2 border-black text-white text-center py-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-2xl md:text-3xl font-['Segoe UI', 'San Francisco', 'Roboto', sans-serif] font-black">
<?php 
if(isset($article_data['nama_artikel'])) {
    echo htmlspecialchars($article_data['nama_artikel']);
} else {
    echo "Personal Web | Cahya Apriyana";  
}
?>
</header>
<!-- Navigation -->
<nav class="bg-[#5FA8A3] border-b-2 border-black text-white py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
<ul class="flex justify-center space-x-10 font-bold text-lg">
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

<main class="max-w-4xl mx-auto p-4 md:p-8 mt-6">
<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_artikel WHERE id_artikel = '$id'";
    $query = mysqli_query($db, $sql);
    
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
       
        if (!isset($article_data)) {
            $article_data = $data;
        }
        echo "<article class='bg-white border-2 border-black p-6 md:p-8 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]'>";
        echo "<h1 class='text-3xl font-black text-[#1B4965] mb-6'>" . htmlspecialchars($data['nama_artikel']) . "</h1>";
        echo "<div class='prose prose-lg max-w-none'>";
        echo "<p class='text-gray-700 leading-relaxed'>" . nl2br(htmlspecialchars($data['isi_artikel'])) . "</p>";
        echo "</div>";
        echo "</article>";

  
        echo "<div class='mt-8 bg-white border-2 border-black p-6 md:p-8 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]'>";
        echo "<h2 class='text-2xl font-black text-[#1B4965] mb-6'>Komentar</h2>";

      
        if(isset($_SESSION['username'])) {
            echo "<form action='proses_komentar.php' method='POST' class='mb-8'>";
            echo "<input type='hidden' name='id_artikel' value='" . $id . "'>";
            echo "<div class='mb-4'>";
            echo "<textarea name='komentar' rows='4' required class='w-full p-3 border-2 border-black rounded-lg focus:outline-none focus:border-[#5FA8A3]' placeholder='Tulis komentar Anda di sini...'></textarea>";
            echo "</div>";
            echo "<button type='submit' class='bg-[#5FA8A3] text-white px-6 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Kirim Komentar</button>";
            echo "</form>";
        } else {
            echo "<div class='bg-[#E8F1F2] p-4 rounded-lg mb-8'>";
            echo "<p class='text-gray-700'>Silakan <a href='admin/login.php' class='text-[#1B4965] font-bold hover:underline'>login</a> untuk menambahkan komentar.</p>";
            echo "</div>";
        }

  
        $sql_komentar = "SELECT k.*, u.role FROM tbl_komentar k 
                        JOIN tbl_user u ON k.username = u.username 
                        WHERE k.id_artikel = '$id' 
                        ORDER BY k.tanggal ASC";
        $query_komentar = mysqli_query($db, $sql_komentar);

        $comments_data = [];
        $comments_tree = [];
        $top_level_comment_ids = [];

        while($row = mysqli_fetch_assoc($query_komentar)) {
            $comments_data[$row['id_komentar']] = $row;
        }

        foreach ($comments_data as $comment_id => $comment) {
            if (empty($comment['parent_id'])) {
                $top_level_comment_ids[] = $comment_id;
            } else {
                $parent_id = (int)$comment['parent_id'];
                if (isset($comments_data[$parent_id])) {
                    if (!isset($comments_tree[$parent_id])) {
                        $comments_tree[$parent_id] = [];
                    }
                    $comments_tree[$parent_id][] = $comment_id;
                }
            }
        }

        usort($top_level_comment_ids, function($a, $b) use ($comments_data) {
            return strtotime($comments_data[$a]['tanggal']) - strtotime($comments_data[$b]['tanggal']);
        });

        function displayComment($comment_id, $comments_data, $comments_tree, $id_artikel, $db) {
            $komentar = $comments_data[$comment_id];
            $comment_user_role = strtolower($komentar['role']);
            $current_username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            $current_user_role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : '';

            $comment_block_classes = 'bg-white p-4 rounded-lg shadow-md';

            if (!empty($komentar['parent_id'])) {
                $comment_block_classes .= ' ml-8 md:ml-12 pl-4 border-l-4 border-[#5FA8A3]';
            } else {
                $comment_block_classes .= ' border-b-2 border-gray-200';
            }
            
            $parent_username = '';
            if (!empty($komentar['parent_id']) && isset($comments_data[$komentar['parent_id']])) {
                $parent_username = htmlspecialchars($comments_data[$komentar['parent_id']]['username']);
            }

            echo "<div class='" . $comment_block_classes . "'>";
            
            echo "<div class='flex justify-between items-start mb-1'>"; 
            echo "<div>";
            echo "<div class='flex items-center gap-x-2'>";
            echo "<span class='font-bold text-[#1B4965] text-lg'>" . htmlspecialchars($komentar['username']) . "</span>";
            if($comment_user_role === 'admin') { 
                echo "<span class='px-2 py-0.5 bg-[#1B4965] text-white text-xs rounded-full'>Admin</span>"; 
            }
            echo "</div>";
            echo "<span class='text-sm text-gray-500 block mt-0.5'>" . date('d M Y, H:i', strtotime($komentar['tanggal'])) . "</span>"; 
            echo "</div>";

            if (isset($_SESSION['username']) && ($komentar['username'] === $current_username || $current_user_role === 'admin')) { 
                echo "<a href='proses_hapus_komentar.php?id_komentar=" . $komentar['id_komentar'] . "&id_artikel=" . $id_artikel . "' ";
                echo "onclick=\"return confirm('Apakah Anda yakin ingin menghapus komentar ini?');\" ";
                echo "class='text-red-600 hover:text-red-800 transition-colors font-bold text-sm'>Hapus</a>";
            }
            echo "</div>";
            
            echo "<div class='bg-[#F2F2F2] p-3 rounded-lg mt-2'>";
            if (!empty($parent_username)) {
                echo "<p class='text-gray-700'><span class='text-[#5FA8A3] font-bold'>@" . $parent_username . "</span> " . nl2br(htmlspecialchars($komentar['komentar'])) . "</p>";
            } else {
                echo "<p class='text-gray-700'>" . nl2br(htmlspecialchars($komentar['komentar'])) . "</p>"; 
            }
            echo "</div>";
            
            if(isset($_SESSION['username'])) {
                echo "<button onclick=\"toggleReplyForm('replyForm-" . $komentar['id_komentar'] . "')\" class='text-[#1B4965] hover:underline font-semibold text-sm mt-2 px-2 py-1 rounded'>Balas</button>"; 
            }

            echo "<div id='replyForm-" . $komentar['id_komentar'] . "' class='hidden mt-4 bg-[#E8F1F2] p-4 rounded-lg'>";
            echo "<form action='proses_komentar.php' method='POST' class='space-y-3'>";
            echo "<input type='hidden' name='id_artikel' value='" . $id_artikel . "'>";
            echo "<input type='hidden' name='parent_id' value='" . $komentar['id_komentar'] . "'>";
            echo "<div>";
            echo "<textarea name='komentar' rows='3' required class='w-full p-2 border-2 border-black rounded-lg focus:outline-none focus:border-[#5FA8A3]' placeholder='Balas @" . htmlspecialchars($komentar['username']) . "...'></textarea>";
            echo "</div>";
            echo "<button type='submit' class='bg-[#1B4965] text-white px-4 py-2 rounded-lg border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200 font-bold text-sm'>Kirim Balasan</button>";
            echo "</form>";
            echo "</div>";

            if (isset($comments_tree[$comment_id]) && !empty($comments_tree[$comment_id])) {
                echo "<div class=''>"; 
                foreach ($comments_tree[$comment_id] as $child_id) {
                    displayComment($child_id, $comments_data, $comments_tree, $id_artikel, $db);
                }
                echo "</div>";
            }

            echo "</div>";
        }

        if(!empty($top_level_comment_ids)) {
            foreach($top_level_comment_ids as $comment_id) {
                echo "<div class='mb-6'>";
                displayComment($comment_id, $comments_data, $comments_tree, $id, $db);
                echo "</div>";
            }
        } else {
            echo "<p class='text-gray-500 text-center py-4'>Belum ada komentar. Jadilah yang pertama berkomentar!</p>";
        }

        echo "</div>";  

        echo "<div class='mt-8'>";
        echo "<a href='index.php' class='inline-block bg-[#1B4965] text-white px-6 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Kembali ke Artikel</a>";
        echo "</div>";
    } else {
        echo "<div class='bg-white border-2 border-black p-6 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center'>";
        echo "<h2 class='text-2xl font-black text-[#1B4965] mb-4'>Artikel Tidak Ditemukan</h2>";
        echo "<p class='text-gray-700 mb-6'>Maaf, artikel yang Anda cari tidak ditemukan.</p>";
        echo "<a href='index.php' class='inline-block bg-[#1B4965] text-white px-6 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Kembali ke Artikel</a>";
        echo "</div>";
    }
} else {
    echo "<div class='bg-white border-2 border-black p-6 rounded-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center'>";
    echo "<h2 class='text-2xl font-black text-[#1B4965] mb-4'>Parameter Tidak Valid</h2>";
    echo "<p class='text-gray-700 mb-6'>Maaf, parameter artikel tidak valid.</p>";
    echo "<a href='index.php' class='inline-block bg-[#1B4965] text-white px-6 py-2 rounded-lg border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-[2px] hover:translate-y-[2px] transition-all duration-200 font-bold'>Kembali ke Artikel</a>";
    echo "</div>";
}
?>
</main>

<!-- Footer -->
<footer class="bg-[#1B4965] border-t-2 border-black text-white text-center py-4 mt-10 shadow-[0_-4px_0px_0px_rgba(0,0,0,1)] font-bold">
&copy; <?php echo date('Y'); ?> | Created by Cahya Apriyana
</footer>

<script>
function toggleReplyForm(formId) {
    const form = document.getElementById(formId);
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
    } else {
        form.classList.add('hidden');
    }
}
</script>
</body>
</html>
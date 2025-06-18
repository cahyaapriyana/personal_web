-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2025 at 05:35 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cahya_apriyana_d1a240400`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_about`
--

CREATE TABLE `tbl_about` (
  `id_about` int NOT NULL,
  `about` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_about`
--

INSERT INTO `tbl_about` (`id_about`, `about`) VALUES
(9, ' Saya adalah seorang pengembang web yang bersemangat dalam menciptakan pengalaman digital yang menarik.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_artikel`
--

CREATE TABLE `tbl_artikel` (
  `id_artikel` int NOT NULL,
  `nama_artikel` text COLLATE utf8mb4_general_ci NOT NULL,
  `label` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isi_artikel` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_artikel`
--

INSERT INTO `tbl_artikel` (`id_artikel`, `nama_artikel`, `label`, `isi_artikel`) VALUES
(2, 'Perkembangan Teknologi AI di Tahun 2024', 'Teknologi', 'Artificial Intelligence (AI) telah menjadi salah satu teknologi yang paling berkembang pesat di tahun 2024. Dengan kemajuan dalam machine learning dan deep learning, AI telah mengubah cara kita bekerja dan berinteraksi dengan teknologi. Dari asisten virtual hingga sistem rekomendasi, AI telah menjadi bagian tak terpisahkan dari kehidupan sehari-hari. Perusahaan-perusahaan besar seperti Google, Microsoft, dan OpenAI terus mengembangkan model AI yang lebih canggih dan dapat diandalkan.'),
(3, 'Pentingnya Pendidikan Karakter di Era Digital', 'Pendidikan', 'Di era digital yang serba cepat ini, pendidikan karakter menjadi semakin penting untuk membentuk generasi muda yang tangguh dan berakhlak. Pendidikan karakter tidak hanya fokus pada pencapaian akademis, tetapi juga pada pengembangan nilai-nilai moral, etika, dan soft skills. Sekolah-sekolah di Indonesia mulai mengintegrasikan pendidikan karakter dalam kurikulum mereka, dengan fokus pada nilai-nilai seperti kejujuran, tanggung jawab, dan empati.'),
(4, 'Tips Menjaga Kesehatan Mental di Masa Pandemi', 'Kesehatan', 'Pandemi COVID-19 telah memberikan dampak signifikan pada kesehatan mental masyarakat. Banyak orang mengalami stres, kecemasan, dan depresi akibat isolasi sosial dan ketidakpastian. Untuk menjaga kesehatan mental, ada beberapa tips yang bisa diterapkan: pertama, jaga rutinitas harian yang teratur. Kedua, tetap terhubung dengan keluarga dan teman melalui teknologi. Ketiga, lakukan aktivitas fisik secara rutin di rumah.'),
(5, 'Sejarah dan Perkembangan Sepak Bola Indonesia', 'Olahraga', 'Sepak bola memiliki sejarah panjang di Indonesia, dimulai dari era kolonial Belanda. PSSI (Persatuan Sepak Bola Seluruh Indonesia) didirikan pada tahun 1930, menjadikannya salah satu federasi sepak bola tertua di Asia. Sepak bola Indonesia telah mengalami berbagai pasang surut, dari masa kejayaan di era 1950-an hingga berbagai tantangan di era modern.'),
(6, 'Mengenal Budaya Batik Indonesia', 'Lainnya', 'Batik adalah warisan budaya Indonesia yang telah diakui UNESCO sebagai Warisan Budaya Tak Benda. Teknik pembuatan batik melibatkan proses yang rumit dan membutuhkan ketelitian tinggi. Setiap daerah di Indonesia memiliki motif batik khasnya sendiri, seperti batik Solo, Yogyakarta, Pekalongan, dan Cirebon.'),
(7, 'Perkembangan Teknologi Web di Era Modern', 'Teknologi', 'Perkembangan teknologi web telah mengalami transformasi yang signifikan dalam beberapa tahun terakhir. Dari website statis sederhana hingga aplikasi web yang kompleks dan interaktif, teknologi web terus berkembang untuk memenuhi kebutuhan pengguna yang semakin dinamis. Framework modern seperti React, Vue, dan Angular telah merevolusi cara kita membangun aplikasi web.'),
(8, 'Pentingnya Pendidikan Teknologi di Era Digital', 'Pendidikan', 'Di era digital yang semakin berkembang pesat, pendidikan teknologi menjadi salah satu aspek penting yang tidak bisa diabaikan. Kemampuan untuk memahami dan menggunakan teknologi dengan baik telah menjadi kebutuhan dasar dalam berbagai aspek kehidupan. Pendidikan teknologi tidak hanya tentang mempelajari cara menggunakan komputer atau smartphone, tetapi juga tentang memahami konsep dasar teknologi.'),
(9, 'Tips Menjaga Kesehatan Jantung', 'Kesehatan', 'Kesehatan jantung adalah hal yang sangat penting untuk dijaga. Beberapa tips untuk menjaga kesehatan jantung antara lain: menjaga pola makan sehat, berolahraga secara teratur, menghindari rokok dan alkohol, mengelola stres, dan melakukan pemeriksaan kesehatan secara rutin. Dengan menerapkan gaya hidup sehat, kita dapat mengurangi risiko penyakit jantung.'),
(10, 'Sejarah dan Perkembangan Bulutangkis Indonesia', 'Olahraga', 'Bulutangkis adalah salah satu olahraga yang membanggakan Indonesia di kancah internasional. Sejak era Susi Susanti dan Alan Budikusuma, Indonesia telah menghasilkan banyak atlet bulutangkis kelas dunia. Prestasi Indonesia di Olimpiade dan kejuaraan internasional lainnya telah membuktikan bahwa Indonesia adalah salah satu kekuatan besar dalam olahraga bulutangkis.'),
(12, 'Pentingnya Menjaga Kesehatan Mental di Era Digital', 'Kesehatan', 'Di era digital yang serba cepat dan penuh tekanan seperti sekarang ini, kesehatan mental menjadi aspek yang semakin penting untuk diperhatikan. Banyak orang menghabiskan waktu berjam-jam di depan layar, terhubung dengan media sosial, dan terpapar informasi yang tak terbatas. Hal ini dapat memberikan dampak signifikan pada kesehatan mental seseorang. Stres dan kecemasan menjadi masalah umum yang dihadapi banyak orang di era digital. Tekanan untuk selalu terhubung, membandingkan diri dengan orang lain di media sosial, dan tuntutan untuk selalu produktif dapat menyebabkan burnout dan masalah kesehatan mental lainnya.\r\nUntuk menjaga kesehatan mental di era digital, ada beberapa hal yang bisa dilakukan. Pertama, batasi penggunaan media sosial dan tetapkan waktu khusus untuk mengakses perangkat digital. Kedua, praktikkan mindfulness dan meditasi untuk mengurangi stres. Ketiga, jaga rutinitas sehat dengan tidur yang cukup, olahraga rutin, dan makan makanan bergizi. Keempat, tetap terhubung dengan orang lain secara langsung, bukan hanya melalui media sosial. Kelima, lakukan aktivitas offline seperti membaca buku atau melakukan hobi. Jika merasa kesulitan mengelola kesehatan mental, jangan ragu untuk mencari bantuan profesional. Ingat bahwa kesehatan mental sama pentingnya dengan kesehatan fisik, dan menjaga keseimbangan di era digital adalah kunci untuk hidup yang lebih sehat dan bahagia.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE `tbl_gallery` (
  `id_gallery` int NOT NULL,
  `judul` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_gallery`
--

INSERT INTO `tbl_gallery` (`id_gallery`, `judul`, `foto`) VALUES
(1, 'Artificial Intelligence', 'Artificial-Intelligence.jpg'),
(3, 'Mie Ayam Jamur', 'Mi_ayam_jamur.JPG'),
(5, 'Pemain Persib Bandung', 'pemain-persib-bandung.jpeg'),
(6, 'Batik Kawung', 'Batik-Kawung-1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `id_komentar` int NOT NULL,
  `id_artikel` int NOT NULL,
  `username` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `komentar` text COLLATE utf8mb4_general_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`id_komentar`, `id_artikel`, `username`, `komentar`, `parent_id`, `tanggal`) VALUES
(7, 12, 'cahya', 'Cihuyy', NULL, '2025-06-18 02:43:49'),
(9, 12, 'Ohim', 'Artikel yang sangat bermanfaat !!!', NULL, '2025-06-18 02:45:20'),
(10, 12, 'admin', 'Terima kasih sudah mampir', 9, '2025-06-18 02:45:50'),
(11, 12, 'cahya', 'Halo puh sepuhh', 10, '2025-06-18 02:46:22'),
(12, 12, 'admin', 'Xixixi', 10, '2025-06-18 04:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `id_kontak` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(200) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('belum_dibaca','sudah_dibaca') DEFAULT 'belum_dibaca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kontak`
--

INSERT INTO `tbl_kontak` (`id_kontak`, `nama`, `email`, `subjek`, `pesan`, `tanggal`, `status`) VALUES
(2, 'Cahya Apriyana', 'admin@cahya.dev', 'Pengiklanan', 'Saya Tertarik Memasang Iklan diweb anda, harap balas email ini jika berkenan', '2025-06-18 11:35:36', 'belum_dibaca'),
(3, 'Ohim', 'ohim@gmail.com', 'Kerja Sama Afilate', 'Kami memiliki program afiliasi yang menarik dengan [Sebutkan poin-poin menarik dari program afiliasi Anda, misalnya komisi tinggi, produk berkualitas, dukungan pemasaran, dll.]. Kami percaya bahwa program ini akan sangat cocok dengan audiens Anda dan dapat memberikan keuntungan timbal balik yang signifikan.', '2025-06-18 11:45:54', 'belum_dibaca'),
(16, 'Ohim', 'ohim@gmail.com', 'Backlink berbayar', 'Saya tertarik meletakan backlink di website anda, jika berkenan bisa balas pesan ini', '2025-06-18 12:14:50', 'sudah_dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengunjung`
--

CREATE TABLE `tbl_pengunjung` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pengunjung`
--

INSERT INTO `tbl_pengunjung` (`id`, `tanggal`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, '2025-06-18', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '2025-06-18 05:31:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('Admin','Editor','Viewer') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Viewer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `password`, `role`) VALUES
('admin', 'admin', 'Admin'),
('cahya', '123', 'Editor'),
('Ohim', 'Ohim', 'Viewer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_about`
--
ALTER TABLE `tbl_about`
  ADD PRIMARY KEY (`id_about`);

--
-- Indexes for table `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_artikel` (`id_artikel`),
  ADD KEY `username` (`username`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_about`
--
ALTER TABLE `tbl_about`
  MODIFY `id_about` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_artikel`
--
ALTER TABLE `tbl_artikel`
  MODIFY `id_artikel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
  MODIFY `id_gallery` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `id_komentar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `id_kontak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD CONSTRAINT `tbl_komentar_ibfk_1` FOREIGN KEY (`id_artikel`) REFERENCES `tbl_artikel` (`id_artikel`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_komentar_ibfk_2` FOREIGN KEY (`username`) REFERENCES `tbl_user` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_komentar_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `tbl_komentar` (`id_komentar`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

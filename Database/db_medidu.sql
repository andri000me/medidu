-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Agu 2016 pada 02.32
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_medidu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akses`
--

CREATE TABLE IF NOT EXISTS `tbl_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `akses` varchar(15) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tbl_akses`
--

INSERT INTO `tbl_akses` (`id`, `akses`, `keterangan`) VALUES
(1, 'Admin', 'Pengguna yang bertugas mengatur aplikasi'),
(2, 'Pemain', 'Pengguna yang memainkan aplikasi'),
(3, 'Orang Tua ', 'Pengguna yang bertugas untuk memantau perkembangan anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_message`
--

CREATE TABLE IF NOT EXISTS `tbl_detail_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_head` int(11) DEFAULT NULL,
  `pesan` text,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(12) DEFAULT NULL,
  `pengirim` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_head` (`id_head`),
  KEY `pengirim` (`pengirim`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data untuk tabel `tbl_detail_message`
--

INSERT INTO `tbl_detail_message` (`id`, `id_head`, `pesan`, `tanggal`, `jam`, `pengirim`) VALUES
(4, 5, '<p>asd asdasd</p>', '2016-08-13', NULL, 1),
(5, 5, '<p>tesss</p>', '2016-08-13', NULL, 1),
(6, 5, '<p>cek</p>', '2016-08-13', NULL, 1),
(7, 5, '<p>oii</p>', '2016-08-13', NULL, 5),
(8, 5, '<p>oii</p>', '2016-08-13', NULL, 5),
(9, 5, '<p>oii&nbsp;</p>', '2016-08-13', NULL, 5),
(10, 5, '<p>Tester aHHH&nbsp;</p>', '2016-08-13', NULL, 1),
(11, 6, '<p>asd</p>', '2016-08-14', NULL, 1),
(12, 6, '<p>asd</p>', '2016-08-14', NULL, 1),
(13, 6, '<p>asd</p>', '2016-08-14', NULL, 1),
(14, 6, '<p>cekkk</p>', '2016-08-14', NULL, 1),
(15, 6, '<p>cekkk</p>', '2016-08-14', NULL, 1),
(16, 6, '<p>cekkk</p>', '2016-08-14', NULL, 1),
(17, 6, '<p>aaa</p>', '2016-08-14', NULL, 1),
(18, 6, '<p>vvvv</p>', '2016-08-14', NULL, 1),
(27, 6, '<p>Love yu lahhh&nbsp;</p>', '2016-08-14', NULL, 1),
(28, 6, '<p>&lt;3&nbsp;</p>', '2016-08-14', NULL, 1),
(29, 5, '<p>TS coeg</p>', '2016-08-14', NULL, 1),
(30, 6, '<p>Iya ka??&nbsp;</p>', '2016-08-14', NULL, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_file`
--

CREATE TABLE IF NOT EXISTS `tbl_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `kondisi` int(1) DEFAULT '0',
  `coloumn` varchar(15) DEFAULT NULL,
  `id_foreign` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `tbl_file`
--

INSERT INTO `tbl_file` (`id`, `file`, `type`, `kondisi`, `coloumn`, `id_foreign`, `tanggal`) VALUES
(11, '1468839853_file_user.jpg', 'image/jpeg', 0, 'id_user', 1, '2016-07-18'),
(12, '1468840923_file_user.jpg', 'image/jpeg', 0, 'id_user', 1, '2016-07-18'),
(13, '1468841929_file_user.jpg', 'image/jpeg', 0, 'id_user', 1, '2016-07-18'),
(14, '1468856048_file_user.jpg', 'image/jpeg', 0, 'id_user', 1, '2016-07-18'),
(15, '1468897379_file_user.png', 'image/png', 0, 'id_user', 1, '2016-07-19'),
(16, '1468983433_file_user.png', 'image/png', 0, 'id_user', 5, '2016-07-20'),
(17, '1468983470_file_user.png', 'image/png', 0, 'id_user', 5, '2016-07-20'),
(18, '1468983598_file_user.jpg', 'image/jpeg', 0, 'id_user', 5, '2016-07-20'),
(19, '1468983667_file_user.jpg', 'image/jpeg', 0, 'id_user', 5, '2016-07-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_file_game`
--

CREATE TABLE IF NOT EXISTS `tbl_file_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) DEFAULT NULL,
  `file` varchar(50) DEFAULT NULL,
  `versi` varchar(15) NOT NULL,
  `enabled` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_game` (`id_game`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tbl_file_game`
--

INSERT INTO `tbl_file_game` (`id`, `id_game`, `file`, `versi`, `enabled`) VALUES
(1, 6, '1469278978_games.swf', '1.0.0', 0),
(2, 6, '1469297345_games.swf', '1.0.1', 1),
(3, 5, '1469365470_games.swf', '1.0.0', 0),
(4, 3, '80146936_bawang_games.swf', '1.0.0', 0),
(5, 3, '146936_bawang_games.swf', '1.0.1', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_game`
--

CREATE TABLE IF NOT EXISTS `tbl_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `viewers` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `download` int(11) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tbl_game`
--

INSERT INTO `tbl_game` (`id`, `game`, `deskripsi`, `viewers`, `likes`, `download`, `enabled`) VALUES
(1, 'Mengenal Hewan', 'Game mengenal hewan mengajarkan agar pemain dapat mengenal berbagai macam hewani', 15, 2, 11, 1),
(2, 'Mengenal Kata', 'Game Mengenal Kata mengajarkan anak-anak untuk belajar sambil bermain dengan tujuan agar mengenal kata', 2, 5, 3, 1),
(3, 'Bawang putih', 'Game bawang merupakan game edukasi yang memperkenalkan sayur-sayuran khususnya bawang kepada para pemain', 17, 2, 5, 0),
(5, 'Mari Berhitung', 'Permainan untuk anak-anak dibawah 10 tahun', 16, 0, 0, 0),
(6, 'Mengenal Angka 1', 'Permainan untuk anak dibawah umur 10 tahun', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_genre`
--

CREATE TABLE IF NOT EXISTS `tbl_genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data untuk tabel `tbl_genre`
--

INSERT INTO `tbl_genre` (`id`, `genre`, `keterangan`) VALUES
(1, 'Adventure', 'Untuk game bercerita mengenai petualangan'),
(9, 'Action', 'Untuk game yang memiliki cerita maupun permainan yang memacu adrenalin'),
(19, 'Education', ''),
(20, 'Puzzle', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_group_genre`
--

CREATE TABLE IF NOT EXISTS `tbl_group_genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) DEFAULT NULL,
  `id_genre` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_game` (`id_game`),
  KEY `id_genre` (`id_genre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tbl_group_genre`
--

INSERT INTO `tbl_group_genre` (`id`, `id_game`, `id_genre`) VALUES
(1, 1, 9),
(2, 1, 1),
(4, 6, 9),
(5, 3, 19),
(6, 3, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_head_message`
--

CREATE TABLE IF NOT EXISTS `tbl_head_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengirim` int(11) DEFAULT NULL,
  `penerima` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengirim` (`pengirim`),
  KEY `penerima` (`penerima`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tbl_head_message`
--

INSERT INTO `tbl_head_message` (`id`, `pengirim`, `penerima`, `status`) VALUES
(5, 1, 5, 0),
(6, 2, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komentar`
--

CREATE TABLE IF NOT EXISTS `tbl_komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_wacana` int(11) DEFAULT NULL,
  `komentar` text,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_wacana` (`id_wacana`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`id`, `id_user`, `id_wacana`, `komentar`, `tanggal`, `jam`) VALUES
(1, 2, 2, '<3', '2016-07-19', '08:43'),
(2, 1, 3, '[object Object]', '2016-07-19', '2016-07-19'),
(3, 1, 3, '[object Object]', '2016-07-19', '2016-07-19'),
(4, 1, 3, 'tester komentar', '2016-07-19', '2016-07-19'),
(5, 1, 5, '<p>Emangnya besok ada apa? hehe</p>', '2016-07-19', '2016-07-19'),
(6, 1, 5, '<p>di test lagi ya komentarnyajQuery112409277336962982417_1468982985140 hhe</p>', '2016-07-20', '2016-07-20'),
(7, 5, 5, '<p>Ada apa ini?</p>', '2016-07-20', '2016-07-20'),
(8, 5, 6, '<p>kenapa statusmu nak?</p>', '2016-07-20', '2016-07-20'),
(9, 1, 7, '<p>jahh allayyerss !</p>', '2016-07-20', '2016-07-20'),
(10, 1, 6, '<p>Ngga apa apa jon :v</p>', '2016-07-20', '2016-07-20'),
(11, 1, 10, '<p>asseek </p>', '2016-08-08', '2016-08-08'),
(12, 2, 10, '<p>test</p>', '2016-08-13', '2016-08-13'),
(13, 1, 10, '<p>Test lagih </p>', '2016-08-13', '2016-08-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_level`
--

CREATE TABLE IF NOT EXISTS `tbl_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(7) NOT NULL,
  `exp` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tbl_level`
--

INSERT INTO `tbl_level` (`id`, `level`, `exp`) VALUES
(1, '1', 1000),
(2, '2', 2300),
(3, '3', 3500),
(4, '4', 4800);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengaturan`
--

CREATE TABLE IF NOT EXISTS `tbl_pengaturan` (
  `id` int(11) NOT NULL,
  `notifikasi` int(1) DEFAULT '0',
  `display_email` int(1) NOT NULL DEFAULT '0',
  `display_phone` int(1) NOT NULL DEFAULT '0',
  `bahasa` char(2) DEFAULT NULL,
  `poto_profil` varchar(50) NOT NULL,
  `poto_sampul` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengaturan`
--

INSERT INTO `tbl_pengaturan` (`id`, `notifikasi`, `display_email`, `display_phone`, `bahasa`, `poto_profil`, `poto_sampul`) VALUES
(1, 0, 0, 0, 'id', '1468841929_file_user.jpg', '1468839853_file_user.jpg'),
(2, 0, 1, 1, 'id', '', ''),
(3, 0, 0, 0, 'id', '', ''),
(5, 0, 0, 0, 'id', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_skor`
--

CREATE TABLE IF NOT EXISTS `tbl_skor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_game` int(11) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL,
  `exp` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_game` (`id_game`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `tbl_skor`
--

INSERT INTO `tbl_skor` (`id`, `id_user`, `id_game`, `skor`, `exp`, `tanggal`) VALUES
(1, 1, 1, 12, 200, '2016-08-02'),
(2, 1, 1, 20, 200, '2016-07-22'),
(3, 1, 2, 50, 200, '2016-07-07'),
(4, 1, 3, 50, 200, '2016-07-08'),
(6, 1, 3, 64, 100, '2016-07-05'),
(7, 1, 3, 40, 100, '2016-08-02'),
(8, 1, 3, 50, 100, '2016-08-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_soal`
--

CREATE TABLE IF NOT EXISTS `tbl_soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) DEFAULT NULL,
  `soal` text,
  `jawaban_a` varchar(100) DEFAULT NULL,
  `jawaban_b` varchar(100) DEFAULT NULL,
  `jawaban_c` varchar(100) DEFAULT NULL,
  `enabled` int(1) DEFAULT NULL,
  `exp` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_game` (`id_game`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `id_game`, `soal`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `enabled`, `exp`) VALUES
(3, 2, 'Soal', 'A', 'B', 'C', 1, 0),
(4, 1, 'Sebutan lain dari bawang ?', 'A', 'B', 'C', 1, 35),
(5, 1, 'Soal ke 2', 'A ', 'B', 'C', 1, 40),
(10, 1, 'fad', 'fad', 'fad', 'fad', 1, 50),
(11, 1, 'cc', 'c', 'c', 'c', 1, 0),
(17, 1, 'AAA', 'AA', 'BB', 'CC', 1, 0),
(18, 1, 'aa', 'aa', 'aa', 'aa', 1, 0),
(19, 1, 'a', 'a', 'a', 's', 1, 0),
(21, 6, 'Soal ke 2', 'Jawaban 1', 'jawaban 2', 'Jawaban 3', 1, 0),
(22, 6, 'Testa', 'Testa', 'Testa', 'Testa', 1, 0),
(24, 2, 'Soal', 'A', 'B', 'C', 1, 0),
(26, 3, 'Nama lain dari bawang putih', 'jawaban Benar', 'Salah', 'Salah', 0, 50),
(27, 5, 'qwea', 'qwea', 'qwea', 'qwe', 1, 0),
(28, 3, 'Manfaat dari bawang putih adalah ? ', 'Menyembuhkan penyakit ABC', 'Salah', 'Untuk memasak', 0, 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_akses` int(11) NOT NULL,
  `nama_depan` varchar(30) DEFAULT NULL,
  `nama_belakang` varchar(50) NOT NULL,
  `kelamin` char(1) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `logged` int(1) NOT NULL DEFAULT '0',
  `tanggal` date DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  `browser` varchar(25) NOT NULL,
  `version` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_level` (`id_akses`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `id_akses`, `nama_depan`, `nama_belakang`, `kelamin`, `telepon`, `tgl_lahir`, `alamat`, `email`, `username`, `password`, `logged`, `tanggal`, `jam`, `browser`, `version`, `ip`) VALUES
(1, 1, 'Hadad', 'Al Gojali', 'L', '08997939703', '0000-00-00', 'Jln. Raya Banjaran no 173 Rt 01/01 desa Cijengkol, Kecamatan Banjaran, Kabupaten Bandung', 'hadadalgojali@gmail.com', 'algojali', 'ad6844ab75806e8f0be8fc51e7f39b0c', 0, '2016-08-15', '06:05:44 PM', '', '', '0'),
(2, 2, 'Pipit', 'Safitri', 'P', '089698962184', '1995-03-27', 'Permata Biru, Cilleunyi', 'pipitsafitri99@yahoo.co.id', 'pipitsaf', '13e37874b990681284856ce716b3455e', 0, '2016-08-14', '03:58:17 PM', '', '', '0'),
(3, 2, 'Kira', 'Ryuzaki', 'L', '08997939703', '2016-07-02', 'Japanese, Tokyo', 'forgothboyz@gmail.com', 'ryuzakies', '320277700cbdc353b66709f99c1eb585', 0, NULL, NULL, '', '', '0'),
(5, 2, 'Ryuzaki', 'Kira', 'L', '089698962184', '2011-11-09', 'Japanese children, Tokyo', 'kira.ryuzaki@gmail.com', 'kiraru', '66d62ad8cea2ccb21d063a59d01bf59e', 0, '2016-08-14', '08:26:02 AM', '', '', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_wacana`
--

CREATE TABLE IF NOT EXISTS `tbl_wacana` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `wacana` text,
  `type` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `tbl_wacana`
--

INSERT INTO `tbl_wacana` (`id`, `id_user`, `wacana`, `type`, `tanggal`, `jam`) VALUES
(2, 1, '<p>Love dia lahhhh&nbsp;</p>', 'wacana', '2016-07-19', '2016-07-19'),
(3, 1, '<p style="text-align: start;"><span style="font-family: " comic="" sans="" ms";"="">Apa kabar dunia? hahaha</span></p>', 'wacana', '2016-08-08', '2016-08-08'),
(4, 1, '<p style="line-height: 1;">Malam yang indah bukan ?? <span style="font-weight: bold;">hehe&nbsp;</span></p>', 'wacana', '2016-08-06', '2016-08-06'),
(5, 2, '<p>Esok Hari yang indah \\^_^/</p>', 'wacana', '2016-07-19', '2016-07-19'),
(6, 1, '<p>?&nbsp;</p>', 'wacana', '2016-08-10', '2016-08-10'),
(7, 5, '<p>Cingan acan update status yeuhh ...&nbsp;</p>', 'wacana', '2016-07-20', '2016-07-20'),
(8, 5, '<p>Hari ini hari selasa di minggu <span style="font-weight: bold;">UAS</span> ,, <span style="font-weight: bold;">magaattttttsss</span></p>', 'wacana', '2016-07-20', '2016-07-20'),
(10, 2, '<p>Selasa happy \\^_^/</p>', 'wacana', '2016-07-20', '2016-07-20'),
(11, 1, '<p>Test di hari Sabtu tanggal 13 Agustus 2015</p>', 'wacana', '2016-08-13', '2016-08-13');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_detail_message`
--
ALTER TABLE `tbl_detail_message`
  ADD CONSTRAINT `tbl_detail_message_ibfk_1` FOREIGN KEY (`id_head`) REFERENCES `tbl_head_message` (`id`),
  ADD CONSTRAINT `tbl_detail_message_ibfk_2` FOREIGN KEY (`pengirim`) REFERENCES `tbl_user` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_file_game`
--
ALTER TABLE `tbl_file_game`
  ADD CONSTRAINT `tbl_file_game_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `tbl_game` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_group_genre`
--
ALTER TABLE `tbl_group_genre`
  ADD CONSTRAINT `tbl_group_genre_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `tbl_game` (`id`),
  ADD CONSTRAINT `tbl_group_genre_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `tbl_genre` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_head_message`
--
ALTER TABLE `tbl_head_message`
  ADD CONSTRAINT `tbl_head_message_ibfk_1` FOREIGN KEY (`pengirim`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_head_message_ibfk_2` FOREIGN KEY (`penerima`) REFERENCES `tbl_user` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD CONSTRAINT `tbl_komentar_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_komentar_ibfk_2` FOREIGN KEY (`id_wacana`) REFERENCES `tbl_wacana` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_pengaturan`
--
ALTER TABLE `tbl_pengaturan`
  ADD CONSTRAINT `tbl_pengaturan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_skor`
--
ALTER TABLE `tbl_skor`
  ADD CONSTRAINT `tbl_skor_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_skor_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `tbl_game` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD CONSTRAINT `tbl_soal_ibfk_1` FOREIGN KEY (`id_game`) REFERENCES `tbl_game` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_akses`) REFERENCES `tbl_akses` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_wacana`
--
ALTER TABLE `tbl_wacana`
  ADD CONSTRAINT `tbl_wacana_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

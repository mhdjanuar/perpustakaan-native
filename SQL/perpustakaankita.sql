-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2019 pada 19.26
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaankita`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddPinjam` (IN `nis` VARCHAR(11), IN `kd_buku` INT, IN `jumlahPinjam` INT, IN `tglPinjam` DATE, IN `jatuhTempo` DATE, IN `status` INT)  begin
insert into peminjaman(nis,kd_buku,jumlah_pinjam,tgl_pinjam,jatuh_tempo,status) values(nis,kd_buku,jumlahPinjam,tglPinjam,jatuhTempo,status);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `kd_buku` varchar(6) NOT NULL,
  `kd_rak` int(11) DEFAULT NULL,
  `nama_buku` varchar(30) DEFAULT NULL,
  `penerbit` text,
  `pengarang` varchar(100) DEFAULT NULL,
  `jumlah_buku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`kd_buku`, `kd_rak`, `nama_buku`, `penerbit`, `pengarang`, `jumlah_buku`) VALUES
('10', 0, 'Ensiklopedia IPTEK 5', 'Tim Kingfisher', 'Lentera Abadi, Jkt 2007', 26),
('103', 0, 'dummy2', 'Dwijanti', 'Lentera Abadi, Jkt 2009', 0),
('11', 0, 'Ensiklopedia IPTEK 6 muatan lo', 'Dody Hidayat', 'Lentera Abadi, Jkt 2007', 27),
('12', 0, 'Ensiklopedia IPTEK 7  muatan l', 'Dody Hidayat', 'Lentera Abadi, Jkt 2007', 23),
('13', 0, 'Ensiklopedia IPTEK 8 muatan lo', 'Dody Hidayat', 'Lentera Abadi, Jkt 2007', 26),
('14', 0, 'Ensiklopedia mengenal sains 1', 'Carolin Bingham', 'Aku Bisa, Jakarta 2012', 2),
('15', 0, 'Ensiklopedia mengenal sains 2', 'Carolin Bingham', 'Aku Bisa, Jakarta 2012', 2),
('16', 0, 'Ensiklopedia mengenal sains 3', 'Carolin Bingham', 'Aku Bisa, Jakarta 2012', 3),
('17', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 5),
('18', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('19', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('2', 0, 'Ensiklopedia IPA 2', '', 'Lentera Abadi, Jkt 2009', -1),
('20', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('21', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 7),
('22', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('23', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('24', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('25', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('26', 0, 'Ensiklopedia kemukjizatan Al-Q', 'Magdi Shehab', 'Naylal Moona', 8),
('27', 0, 'Rekreasi Matematika 1 - 5', 'Hendry Ernest', 'Indonesian Publishing', 22),
('28', 0, 'Teknik Menggambar Mode Busana', 'Goet Poespo', 'Kanisius Yogya 2000', 115),
('29', 0, 'Pola Dasar dan Pecah Pola Busa', 'Djati Pratiwi', 'Kanisius ( Anggota IKAPI ) Jkt 2002', 88),
('3', 0, 'Ensiklopedia IPA 3', '', 'Lentera Abadi, Jkt 2009', 0),
('30', 0, 'Pola Rok Lurus', 'Syahandini', 'Depdikbud, Jkt 1996', 31),
('31', 0, 'Pembuatan Busana Anak', 'Tini Sukartini', 'Depdiknas, Jkt 1999', 47),
('32', 0, 'Pembuatan Busana Pesa', '', '', 39),
('33', 0, 'Peremajaan Kulit Wajah dengan ', 'Sutriati', 'Depdiknas, Jkt 1999', 28),
('34', 0, 'Pembuatan Celana Wanita', 'Lily Mayshariati', 'Depdiknas, Jkt, 1999', 25),
('35', 0, 'Pembuatan Blus dg Opnaisel', 'Catri Sumaryati', 'Depdiknas, Jkt, 2000', 29),
('36', 0, 'Pembuatan Piyama Wanita', 'Dwijanti', 'Depdiknas, Jkt 1996', 39),
('37', 0, 'Pembuatan Busana Rekreasi', 'Katri Sumariati', 'Depdiknas, Jkt, 1999', 65),
('38', 0, 'Pembuatan Sarung Bantal,Kursi,', 'Aisyah Jafar', 'Depdiknas, Jkt 1999', 36),
('39', 0, 'Sarung Bantal Kursi', 'Nuniek Indriyaswati', 'Depdiknas, Jkt, 2000', 9),
('4', 0, 'Ensiklopedia IPA 4', '', 'Lentera Abadi, Jkt 2009', 0),
('40', 0, 'Perawatan Anti Stres Dengan Ar', 'Ida Ayu Komang', 'Depdiknas, Jkt 1999', 39),
('41', 0, 'Pengelola Jasa Pelayanan Telep', 'Cidartaty Lubis', 'Depdiknas, Jkt 1999', 29),
('42', 0, 'Akomodasi Perhotelan jilid 3', 'Ni Wayan S', 'BSE, Jakarta 2008', 3),
('43', 0, 'Akomodasi Perhotelan jilid 1', 'Ni Wayan S', 'BSE, Jakarta 2008', 3),
('44', 0, 'BINATU', 'Retnowati', 'Depdikbud, Jakarta 1996', 17),
('45', 0, 'Etika Komunikasi', 'I Made Sukanta', 'Depdikbud, Jakarta 1994', 22),
('46', 0, 'Kantor Depan', 'I Gusti Ketut Agung', 'Depdikbud,Jkt, 1996', 21),
('47', 0, 'Pelayanan Tamu Hotel ', 'Maria Mistiani', 'Depdikbud, Jkt, 1996', 22),
('48', 0, 'tata graha', 'Sumi Machmoed', 'Depdikbud, Jkt, 1982', 30),
('49', 0, 'Front Office 3', 'Tim Front office SMK', 'Galaxy puspa mega, Jkt, 2004', 23),
('5', 0, 'Ensiklopedia IPA 5', '', 'Lentera Abadi, Jkt 2009', -3),
('50', 0, 'Front Office 2 SMK Kls. 2', 'Tim Front office SMK', 'Galaxy puspa mega, Jkt, 2005', 5),
('51', 0, 'House Keeping 3', 'Tim Housekeeping SMK', 'Galaxy Puspa Mega, Jkt, 2004', 23),
('52', 0, 'House Keeping 2', 'Tim Housekeeping SMK', 'Galaxy Puspa Mega, Jkt, 1999', 8),
('53', 0, 'Perkasiran HOTEL ', 'I Made Sukanta', 'Depdikbud, Jkt 1996', 28),
('54', 0, 'Hyigiene dan Sanitasi', 'Bagus Putu Sudiara', 'Depdikbud, Jkt 1996', 21),
('55', 0, 'manajement penyelenggraaan Hot', '', '', 28),
('56', 0, 'Manajemen Front Office Hotel', 'Heldin, dkk', 'Kesain Blanc ( Anggota IKAPI ) JKt 2002', 115),
('57', 0, 'Kamus Istilah Pariwisata Dan P', 'Drs. Adi Suharno MBA', 'Angkasa Bandung 1993', 58),
('58', 0, 'Manajemet Hotel Termasuk Front', '', '', 55),
('59', 0, 'Seni Merangkai bunga bentuk bu', '', '', 53),
('6', 0, 'Ensiklopedia IPTEK 1', 'Tim Kingfisher', 'Lentera Abadi, Jkt 2007', 20),
('60', 0, 'Rekayasa Perangkat Lunak 1 ', 'Aunur Rofiq', 'BSE', 5),
('61', 0, 'Rekayasa Perangkat Lunak 1 ', 'Aunur Rofiq', 'BSE', 5),
('62', 0, 'Rekayasa Perangkat Lunak 1 ', 'Aunur Rofiq', 'BSE', 5),
('63', 0, 'Seri ICT:  Daya dan Kecepatan', 'Tim Life Books', 'Ens. Nasional Indonesia', 5),
('64', 0, 'Seri ICT : Keamanan Komputer', 'Tim Life Books', 'Ens. Nasional Indonesia', 5),
('65', 0, 'Seri ICT : Komunikasi', 'Tim Life Books', 'Ens. Nasional Indonesia', 5),
('66', 0, 'Dasar - dasar Komputer', '', '', 5),
('67', 0, 'Bahasa Komputer', '', '', 5),
('68', 0, 'Ensiklopedia Sepak Bola Indone', '', 'Lentera Abadi, Jkt 2011', 1),
('69', 0, 'Ensiklopedia Sepak Bola Indone', '', 'Lentera Abadi, Jkt 2011', 1),
('7', 0, 'Ensiklopedia IPTEK 2', 'Tim Kingfisher', 'Lentera Abadi, Jkt 2007', 6),
('70', 0, 'Ensiklopedia Sepak Bola Indone', '', 'Lentera Abadi, Jkt 2011', 1),
('71', 0, 'Ensiklopedia Sepak Bola Indone', '', 'Lentera Abadi, Jkt 2011', 1),
('72', 0, 'Ensiklopedia Sepak Bola Indone', '', 'Lentera Abadi, Jkt 2011', 1),
('73', 0, 'Membangun Guru Berkualitas', '', '', 5),
('74', 0, 'Ensiklopedia Sains dan Teknolo', '', '', 4),
('75', 0, 'Ensiklopedia Sains dan Teknolo', '', '', 3),
('76', 0, 'Rekreasi Matematika', '', '', 3),
('77', 0, 'Matematika untuk SMK dan MAK K', '', '', 5),
('78', 0, 'Bahasa Inggris untuk SMK dan M', '', '', 5),
('79', 0, 'Bahasa Indonesia SMK dan MAK', '', '', 3),
('8', 0, 'Ensiklopedia IPTEK 3', 'Tim Kingfisher', 'Lentera Abadi, Jkt 2007', 25),
('80', 0, 'Matematika SMK dan MAK Kelompo', '', '', 5),
('81', 0, 'Ensiklopedia Bumi dan Ruang Wa', '', '', 24),
('82', 0, 'Ensiklopedia Makhluk Hidup Man', '', '', 3),
('83', 0, 'Ensiklopedia Kimia dan Unsur B', '', '', 25),
('84', 0, 'Penanganan dan Pengolahan Buah', '', '', 80),
('85', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', 4),
('86', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', 5),
('87', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', 5),
('88', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', 5),
('89', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', 4),
('9', 0, 'Ensiklopedia IPTEK 4', 'Tim Kingfisher', 'Lentera Abadi, Jkt 2007', 26),
('90', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', 1),
('91', 0, 'Pustaka pengetahuan Al Qu?ran ', 'Dr. Muhammad assaid yusuf & dkk', 'Dar as asallam', -1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `nis` varchar(11) DEFAULT NULL,
  `kd_buku` int(11) DEFAULT NULL,
  `jumlah_pinjam` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `nis`, `kd_buku`, `jumlah_pinjam`, `tgl_pinjam`, `jatuh_tempo`, `status`) VALUES
(1, '2185', 6, 1, '2018-12-01', '2018-12-08', 2),
(2, '2185', 6, 1, '2018-12-01', '2018-12-08', 2),
(3, '6508', 6, 1, '2018-12-01', '2018-12-08', 0),
(4, '2185', 10, 1, '2018-12-01', '2018-12-08', 2),
(5, '2185', 10, 1, '2018-12-11', '2018-12-18', 2),
(6, '2185', 10, 1, '2019-05-04', '2019-05-11', 0);

--
-- Trigger `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `transaksi_peminjaman` AFTER INSERT ON `peminjaman` FOR EACH ROW begin
update buku set jumlah_buku = jumlah_buku - new.jumlah_pinjam where kd_buku = new.kd_buku;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `denda` varchar(30) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tgl_kembali`, `denda`, `status`) VALUES
(1, 1, '2018-11-29', '0', NULL),
(2, 2, '2018-11-28', '0', NULL),
(3, 4, '2018-11-29', '0', NULL),
(4, 5, '2019-05-04', '68500', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(30) DEFAULT NULL,
  `password` text,
  `jenis_kelamin` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `password`, `jenis_kelamin`) VALUES
(1, 'admin', 'admin', 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rak`
--

CREATE TABLE `rak` (
  `kd_rak` int(11) NOT NULL,
  `kategori_rak` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rak`
--

INSERT INTO `rak` (`kd_rak`, `kategori_rak`) VALUES
(1, 'Pelajaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(11) NOT NULL,
  `nama_siswa` varchar(30) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `kelas`, `jurusan`) VALUES
('2185', 'Dummy1', '12', 'Rekayasa Perangkat Lunak'),
('6508', 'dummy2', '12', 'Rekayasa Perangkat Lunak');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`kd_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `nis` (`nis`);

--
-- Indeks untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`kd_rak`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rak`
--
ALTER TABLE `rak`
  MODIFY `kd_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Mar 2025 pada 14.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raficahyadi_presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `NIK` varchar(25) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Tglahir` date NOT NULL,
  `Alamat` varchar(150) NOT NULL,
  `Gaji` varchar(15) NOT NULL,
  `Kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`NIK`, `Nama`, `Tglahir`, `Alamat`, `Gaji`, `Kelas`) VALUES
('3321100192220001', 'Riska adriana', '1994-01-28', 'Ngamprah 2', '5500000', 'B.Inggris'),
('3321100307220002', 'Erik Pratama', '1981-12-15', 'Padalarang', '23000000', 'PPLG'),
('3321100307220003', 'Cahyadi', '1982-01-24', 'Cimahi', '50000000', 'Oracle'),
('3321100307220004', 'Inggit', '1998-03-12', 'cihanjuang', '14000000', 'Oracle'),
('3321100307220005', 'Zein putra', '1988-02-23', 'cimahi selatan', '9000000', 'PPLG'),
('3321100307220006', 'Tamam fuadi', '1984-08-12', 'Cimareme', '12000000', 'Oracle'),
('3321100307220007', 'Angga D.jayanto', '1979-12-20', 'Cikalong', '10000000', 'B.indonesia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `ID` int(10) NOT NULL,
  `Nama` varchar(25) NOT NULL,
  `progam_keahlian` varchar(15) NOT NULL,
  `idwalas` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `percobaan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `percobaan` (
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `ID` int(25) NOT NULL,
  `tgl` date NOT NULL,
  `NISN` varchar(15) NOT NULL,
  `status` varchar(30) NOT NULL,
  `guruID` varchar(20) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`ID`, `tgl`, `NISN`, `status`, `guruID`, `TimeStamp`) VALUES
(1, '2024-09-02', '0085280535', 'Hadir', '3321100307220002', '2025-03-23 14:43:12'),
(2, '2024-09-02', '0078737769', 'Hadir', '3321100307220002', '2025-03-23 14:43:32'),
(3, '2024-09-02', '0076011234 ', 'Hadir', '3321100307220002', '2025-03-23 14:57:47'),
(4, '2024-09-02', '0085902389', 'Sakit', '3321100307220002', '2025-03-23 14:57:52'),
(5, '2024-09-02', '0078267293', 'Sakit', '3321100307220002', '2025-03-23 14:44:13'),
(6, '2024-09-08', '0071072691', 'hadir', '3321100307220002', '2024-09-07 23:54:27'),
(7, '2024-09-08', '0077668353', 'hadir', '3321100307220002', '2024-09-08 11:58:02'),
(8, '2024-09-08', '0078737775', 'izin', '3321100307220002', '2024-09-08 11:58:59'),
(9, '2024-09-08', '0085902389', 'sakit', '3321100307220002', '2024-09-08 11:59:23'),
(10, '2024-09-08', '0085280536', 'Hadir', '3321100307220002', '2025-03-24 13:11:02'),
(11, '2024-09-08', '0087595437', 'hadir', '3321100307220002', '2024-09-08 14:43:04'),
(12, '2024-09-08', '0075636275', 'sakit', '3321100307220002', '2024-09-08 14:43:29'),
(13, '2024-09-08', '', 'sakit', '3321100307220002', '2025-03-24 13:10:27'),
(27, '2025-03-24', '0085902389', 'hadir', '3321100307220005', '2025-03-24 13:12:15'),
(28, '2025-03-24', '0086298648', 'hadir', '3321100307220006', '2025-03-24 13:13:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `NISN` varchar(15) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Kelas` varchar(10) NOT NULL,
  `BL_lahir` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`NISN`, `Nama`, `Kelas`, `BL_lahir`) VALUES
('0075636274', 'M.Irgi Araysid123', 'XI', 'Februari'),
('0076011234', 'Rafi Bakhtiar', 'XII', 'October'),
('0077668353', 'M.Anwar Zaidan', 'XI', 'agustus'),
('0078267293', 'Dinar Ajiz Gifari', 'XII', 'September'),
('0078737775', 'Annisa Tasya ', 'XII', 'Desember'),
('0081197290', 'Qomarudin ', 'XI', 'januari'),
('0081619663', 'M.Panji Pratama', 'XI', 'januari'),
('0084693045', 'Geugeu Alpiana', 'XI', 'Juni'),
('0085280536', 'Alfajar Tri ramadani', 'X', 'agustus'),
('0085342765', 'M.Rafi Adi Fairuz', 'X', 'April'),
('0085497435', 'M.Dzikri', 'XI', 'Juni'),
('0085902389', 'Haris Budi ', 'X', 'Desember'),
('0086298648', 'Dika Pratama', 'XI', 'Maret');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `ID` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Role` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `Role`) VALUES
(5, 'Rafi', 'admin12345', 'guru');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `vpresensi`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `vpresensi` (
);

-- --------------------------------------------------------

--
-- Struktur untuk view `percobaan`
--
DROP TABLE IF EXISTS `percobaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `percobaan`  AS SELECT `presensi`.`ID` AS `ID`, `presensi`.`NISN` AS `NISN`, `siswa1`.`Nama` AS `NamaSiswa`, `presensi`.`tgl` AS `Tanggal`, `presensi`.`status` AS `status` FROM ((`siswa1` left join `presensi` on(`siswa1`.`NISN` = `presensi`.`NISN`)) join `guru` on(`presensi`.`guruID` = `guru`.`NIK`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vpresensi`
--
DROP TABLE IF EXISTS `vpresensi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpresensi`  AS SELECT `presensi`.`ID` AS `id`, `presensi`.`tgl` AS `tanggal`, `siswa1`.`NISN` AS `NISN`, `siswa1`.`Kelas` AS `Kelas`, `siswa1`.`Nama` AS `namasiswa`, `presensi`.`status` AS `status`, `guru`.`Nama` AS `namaguru` FROM ((`siswa1` left join `presensi` on(`siswa1`.`NISN` = `presensi`.`NISN`)) join `guru` on(`presensi`.`guruID` = `guru`.`NIK`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`NIK`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NISN`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

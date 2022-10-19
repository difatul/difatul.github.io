-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Okt 2022 pada 17.47
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ulistrik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpel` varchar(15) NOT NULL,
  `nometer` varchar(50) NOT NULL,
  `nm_pel` varchar(30) NOT NULL,
  `almt_pel` varchar(100) NOT NULL,
  `idtarif` varchar(15) NOT NULL,
  `tgldaftar` varchar(20) NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`idpel`, `nometer`, `nm_pel`, `almt_pel`, `idtarif`, `tgldaftar`, `status`) VALUES
('PLG00083834', '75654634543', 'Musdelan', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '001', '03-Jan-2019', 'Aktif'),
('PLG00083911', '762512435636', 'Ariman', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00083942', '97389273628', 'Saropah', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00084029', '362536237233', 'Munasron', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '001', '03-Jan-2019', 'Aktif'),
('PLG00084048', '89273263526', 'Musnan', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '001', '03-Jan-2019', 'Aktif'),
('PLG00084117', '723963726532', 'Widi Purnomo', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00084142', '7685343456', 'Dzikron', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00084233', '8564352654756', 'Umami', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00084344', '876856743546', 'Abdul Kohar', 'Jl Sumber Agung 11/05 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00084427', '78566743424', 'Anis Fatin', 'Jl Sumber Agung 11/05 Petung Panceng Gresik', '002', '03-Jan-2019', 'Aktif'),
('PLG00084501', '76275632542', 'Mat Rozi', 'Jl Sari Utomo 02/01 Petung Panceng Gresik', '001', '03-Jan-2019', 'Aktif'),
('PLG00084532', '785621575245', 'Mohammad Kasrozi', 'Jl Polowijo 06/02 Petung Panceng Gresik', '001', '03-Jan-2019', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `idbayar` varchar(15) NOT NULL,
  `idpel` varchar(15) NOT NULL,
  `idtagihan` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `biayaadmin` int(6) NOT NULL,
  `totalpenggunaan` int(6) NOT NULL,
  `bayar` int(6) NOT NULL,
  `kembali` int(6) NOT NULL,
  `iduser` varchar(15) NOT NULL,
  `totalbayar` int(6) NOT NULL,
  `bulanbayar` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`idbayar`, `idpel`, `idtagihan`, `tanggal`, `biayaadmin`, `totalpenggunaan`, `bayar`, `kembali`, `iduser`, `totalbayar`, `bulanbayar`) VALUES
('TR00030537', 'PLG00084142', 'TGH00105022', '2019-04-04', 3000, 37430, 50000, 9570, 'PG003', 40430, ''),
('TR00032855', 'PLG00083834', 'TGH00104629', '2019-04-04', 3000, 9120, 15000, 2880, 'PG003', 12120, ''),
('TR00033044', 'PLG00083911', 'TGH00104941', '2019-04-04', 3000, 46295, 100000, 50705, 'PG003', 49295, ''),
('TR00034949', 'PLG00083911', 'TGH00113453', '2019-04-04', 3000, 48265, 60000, 8735, 'PG003', 51265, ''),
('TR00040821', 'PLG00084029', 'TGH00042908', '2019-04-05', 3000, 13224, 20000, 3776, 'PG003', 16224, 'Apr'),
('TR00040844', 'PLG00084029', 'TGH00104957', '2019-04-05', 3000, 25992, 30000, 1008, 'PG003', 28992, 'Apr'),
('TR00040856', 'PLG00084029', 'TGH00042320', '2019-04-05', 3000, 19608, 30000, 7392, 'PG003', 22608, 'Apr'),
('TR00040950', 'PLG00083942', 'TGH00042259', '2019-04-05', 3000, 15760, 20000, 1240, 'PG003', 18760, 'Apr'),
('TR00041401', 'PLG00083942', 'TGH00042311', '2019-04-05', 3000, 43340, 50000, 3660, 'PG003', 46340, 'Apr'),
('TR00042537', 'PLG00084117', 'TGH00105016', '2019-04-05', 3000, 65995, 100000, 31005, 'PG003', 68995, 'Apr'),
('TR00043059', 'PLG00084142', 'TGH00042933', '2019-04-04', 3000, 28565, 35000, 3435, 'PG003', 31565, 'Apr'),
('TR00072214', 'PLG00083942', 'TGH00104949', '2019-04-05', 3000, 38415, 50000, 8585, 'PG003', 41415, 'Apr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
--

CREATE TABLE `penggunaan` (
  `idpel` varchar(15) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `meterawal` varchar(8) NOT NULL,
  `meterakhir` varchar(8) NOT NULL,
  `idpenggunaan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`idpel`, `bulan`, `tahun`, `meterawal`, `meterakhir`, `idpenggunaan`) VALUES
('PLG00083834', 'Apr', '2019', '89', '', 'PNG00042245'),
('PLG00083942', 'Mar', '2019', '55', '99', 'PNG00042259'),
('PLG00083942', 'Apr', '2019', '99', '', 'PNG00042311'),
('PLG00084029', 'Mar', '2019', '100', '129', 'PNG00042320'),
('PLG00084029', 'Apr', '2019', '129', '', 'PNG00042908'),
('PLG00084048', 'Mar', '2019', '132', '', 'PNG00042916'),
('PLG00084117', 'Mar', '2019', '99', '', 'PNG00042926'),
('PLG00084142', 'Mar', '2019', '67', '', 'PNG00042933'),
('PLG00084233', 'Mar', '2019', '82', '', 'PNG00042940'),
('PLG00084344', 'Mar', '2019', '92', '', 'PNG00042951'),
('PLG00084427', 'Mar', '2019', '93', '', 'PNG00043000'),
('PLG00084501', 'Mar', '2019', '86', '', 'PNG00043012'),
('PLG00084532', 'Mar', '2019', '69', '', 'PNG00043026'),
('PLG00083834', 'Jan', '2019', '0', '20', 'PNG00083834'),
('PLG00083911', 'Jan', '2019', '0', '47', 'PNG00083911'),
('PLG00083942', 'Jan', '2019', '0', '39', 'PNG00083942'),
('PLG00084029', 'Jan', '2019', '0', '57', 'PNG00084029'),
('PLG00084048', 'Jan', '2019', '0', '99', 'PNG00084048'),
('PLG00084117', 'Jan', '2019', '0', '67', 'PNG00084117'),
('PLG00084142', 'Jan', '2019', '0', '38', 'PNG00084142'),
('PLG00084233', 'Jan', '2019', '0', '37', 'PNG00084233'),
('PLG00084344', 'Jan', '2019', '0', '58', 'PNG00084344'),
('PLG00084427', 'Jan', '2019', '0', '72', 'PNG00084427'),
('PLG00084501', 'Jan', '2019', '0', '53', 'PNG00084501'),
('PLG00084532', 'Jan', '2019', '0', '31', 'PNG00084532'),
('PLG00083834', 'Feb', '2019', '20', '40', 'PNG00104629'),
('PLG00083834', 'Mar', '2019', '40', '89', 'PNG00104755'),
('PLG00083911', 'Feb', '2019', '47', '96', 'PNG00104941'),
('PLG00083942', 'Feb', '2019', '39', '55', 'PNG00104949'),
('PLG00084029', 'Feb', '2019', '57', '100', 'PNG00104957'),
('PLG00084048', 'Feb', '2019', '99', '132', 'PNG00105004'),
('PLG00084117', 'Feb', '2019', '67', '99', 'PNG00105016'),
('PLG00084142', 'Feb', '2019', '38', '67', 'PNG00105022'),
('PLG00084233', 'Feb', '2019', '37', '82', 'PNG00105031'),
('PLG00084344', 'Feb', '2019', '58', '92', 'PNG00105037'),
('PLG00084427', 'Feb', '2019', '72', '93', 'PNG00105042'),
('PLG00084501', 'Feb', '2019', '53', '86', 'PNG00105051'),
('PLG00084532', 'Feb', '2019', '31', '69', 'PNG00105056'),
('PLG00083911', 'Mar', '2019', '96', '', 'PNG00113453');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `idtagihan` varchar(15) NOT NULL,
  `idpel` varchar(15) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tahun` varchar(5) NOT NULL,
  `jumlahmeter` int(8) NOT NULL,
  `status` enum('Belum Terbayar','Terbayar') NOT NULL,
  `idpenggunaan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`idtagihan`, `idpel`, `bulan`, `tahun`, `jumlahmeter`, `status`, `idpenggunaan`) VALUES
('TGH00042245', 'PLG00083834', 'Mar', '2019', 49, 'Belum Terbayar', 'PNG00042245'),
('TGH00042259', 'PLG00083942', 'Feb', '2019', 16, 'Terbayar', 'PNG00042259'),
('TGH00042311', 'PLG00083942', 'Mar', '2019', 44, 'Terbayar', 'PNG00042311'),
('TGH00042320', 'PLG00084029', 'Feb', '2019', 43, 'Terbayar', 'PNG00042320'),
('TGH00042908', 'PLG00084029', 'Mar', '2019', 29, 'Terbayar', 'PNG00042908'),
('TGH00042916', 'PLG00084048', 'Feb', '2019', 33, 'Belum Terbayar', 'PNG00042916'),
('TGH00042926', 'PLG00084117', 'Feb', '2019', 32, 'Belum Terbayar', 'PNG00042926'),
('TGH00042933', 'PLG00084142', 'Feb', '2019', 29, 'Terbayar', 'PNG00042933'),
('TGH00042940', 'PLG00084233', 'Feb', '2019', 45, 'Belum Terbayar', 'PNG00042940'),
('TGH00042951', 'PLG00084344', 'Feb', '2019', 34, 'Belum Terbayar', 'PNG00042951'),
('TGH00043000', 'PLG00084427', 'Feb', '2019', 21, 'Belum Terbayar', 'PNG00043000'),
('TGH00043012', 'PLG00084501', 'Feb', '2019', 33, 'Belum Terbayar', 'PNG00043012'),
('TGH00043026', 'PLG00084532', 'Feb', '2019', 38, 'Belum Terbayar', 'PNG00043026'),
('TGH00104629', 'PLG00083834', 'Jan', '2019', 20, 'Terbayar', 'PNG00104629'),
('TGH00104755', 'PLG00083834', 'Feb', '2019', 20, 'Belum Terbayar', 'PNG00104755'),
('TGH00104941', 'PLG00083911', 'Jan', '2019', 47, 'Terbayar', 'PNG00104941'),
('TGH00104949', 'PLG00083942', 'Jan', '2019', 39, 'Terbayar', 'PNG00104949'),
('TGH00104957', 'PLG00084029', 'Jan', '2019', 57, 'Terbayar', 'PNG00104957'),
('TGH00105004', 'PLG00084048', 'Jan', '2019', 99, 'Belum Terbayar', 'PNG00105004'),
('TGH00105016', 'PLG00084117', 'Jan', '2019', 67, 'Terbayar', 'PNG00105016'),
('TGH00105022', 'PLG00084142', 'Jan', '2019', 38, 'Terbayar', 'PNG00105022'),
('TGH00105031', 'PLG00084233', 'Jan', '2019', 37, 'Belum Terbayar', 'PNG00105031'),
('TGH00105037', 'PLG00084344', 'Jan', '2019', 58, 'Belum Terbayar', 'PNG00105037'),
('TGH00105042', 'PLG00084427', 'Jan', '2019', 72, 'Belum Terbayar', 'PNG00105042'),
('TGH00105051', 'PLG00084501', 'Jan', '2019', 53, 'Belum Terbayar', 'PNG00105051'),
('TGH00105056', 'PLG00084532', 'Jan', '2019', 31, 'Belum Terbayar', 'PNG00105056'),
('TGH00113453', 'PLG00083911', 'Feb', '2019', 49, 'Terbayar', 'PNG00113453');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `idtarif` varchar(10) NOT NULL,
  `daya` varchar(10) NOT NULL,
  `tarifperkwh` int(6) NOT NULL,
  `denda` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`idtarif`, `daya`, `tarifperkwh`, `denda`) VALUES
('001', '450', 456, 5000),
('002', '900', 985, 10000),
('003', '1300', 1250, 15000),
('004', '2200', 1385, 20000),
('005', '3500', 2065, 50000),
('006', '6600', 2490, 75000),
('007', '14000', 3595, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nm_user` varchar(30) NOT NULL,
  `tlp_user` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `level` enum('Administrator','Petugas') NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `akses` datetime DEFAULT NULL,
  `foto` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nm_user`, `tlp_user`, `alamat`, `level`, `status`, `akses`, `foto`) VALUES
('PG001', 'admin', 'admin', 'Elinda Sekar Pandayu', '085648140240', 'Petung Panceng Gresik', 'Administrator', 'Aktif', '2022-07-05 21:37:55', NULL),
('PG003', 'ahya', 'ahya', 'Ahyana Yahya u', '087771233555', 'Jl Amir Mahmud XII Rungkut Surabaya', 'Petugas', 'Aktif', '2019-04-05 15:48:01', 'PG003.png'),
('PG004', 'difa', 'difa', 'Difa', '085704515023', 'petung ', 'Administrator', 'Aktif', NULL, NULL),
('PG005', 'albab', 'albab', 'Albab Albadisa', '09877654', 'petung', 'Administrator', 'Aktif', NULL, 'PG005.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpel`),
  ADD KEY `idtarif` (`idtarif`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`idbayar`),
  ADD KEY `idpel` (`idpel`),
  ADD KEY `idtagihan` (`idtagihan`),
  ADD KEY `iduser` (`iduser`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`idpenggunaan`),
  ADD KEY `idpel` (`idpel`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`idtagihan`),
  ADD KEY `idpel` (`idpel`),
  ADD KEY `idpenggunaan` (`idpenggunaan`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`idtarif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`idtarif`) REFERENCES `tarif` (`idtarif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`idpel`) REFERENCES `pelanggan` (`idpel`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`idtagihan`) REFERENCES `tagihan` (`idtagihan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`idpel`) REFERENCES `pelanggan` (`idpel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`idpel`) REFERENCES `pelanggan` (`idpel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

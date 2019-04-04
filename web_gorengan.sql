-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2019 pada 05.07
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_gorengan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detailtransaksi` int(11) NOT NULL,
  `id_transaksi` varchar(11) NOT NULL,
  `id_gorengan` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `transaksi` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
		UPDATE gorengan SET gorengan.stok=gorengan.stok-NEW.jumlah 
        	WHERE gorengan.id_gorengan = NEW.id_gorengan;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gorengan`
--

CREATE TABLE `gorengan` (
  `id_gorengan` varchar(11) NOT NULL,
  `gorengan` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gorengan`
--

INSERT INTO `gorengan` (`id_gorengan`, `gorengan`, `harga`, `stok`) VALUES
('GRG001', 'Bakwan Ayam', 2000, 1000),
('GRG002', 'Tempe Goreng', 2000, 1020),
('GRG003', 'Tahu Goreng', 2000, 1000),
('GRG004', 'Singkong Goreng', 1000, 510),
('GRG005', 'Pisang Cokelat', 2000, 1000),
('GRG006', 'Cireng Aci di goreng', 1500, 101),
('GRG007', 'Ubi', 2000, 1007),
('GRG008', 'Kentang Goreng', 2000, 1000),
('GRG009', 'Bakwan Jagung', 2000, 200),
('GRG010', 'Tempe Rebus', 2000, 500),
('GRG011', 'Jamur Crispy', 5000, 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','kasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kasir`
--

INSERT INTO `kasir` (`id_kasir`, `username`, `nama`, `password`, `level`) VALUES
('kasir 1', 'admin', 'Prio Arief Gunawan', 'admin', 'admin'),
('kasir 2', 'kasir1', 'Hermawan Wihardja', 'kasir1', 'kasir'),
('kasir 3', 'kasir2', 'Nia Hapsari', 'kasir2', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` varchar(11) NOT NULL,
  `id_gorengan` varchar(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id_stok`, `id_gorengan`, `stok`, `tanggal`) VALUES
('STOK001', 'GRG004', 20, '06-03-2019'),
('STOK002', 'GRG006', 25, '06-03-2019'),
('STOK003', 'GRG001', 1000, '08-03-2019'),
('STOK004', 'GRG003', 1000, '08-03-2019'),
('STOK005', 'GRG005', 1000, '08-03-2019'),
('STOK006', 'GRG007', -3, '08-03-2019'),
('STOK007', 'GRG007', 10, '08-03-2019'),
('STOK008', 'GRG008', 1000, '08-03-2019'),
('STOK009', 'GRG006', 1000, '08-03-2019'),
('STOK010', 'GRG007', 1000, '08-03-2019'),
('STOK011', 'GRG002', 1000, '08-03-2019'),
('STOK012', 'GRG004', 1000, '08-03-2019'),
('STOK013', 'GRG006', 100, '08-03-2019'),
('STOK014', 'GRG001', 1000, '08-03-2019');

--
-- Trigger `stok`
--
DELIMITER $$
CREATE TRIGGER `stok` AFTER INSERT ON `stok` FOR EACH ROW BEGIN
		UPDATE gorengan SET gorengan.stok=gorengan.stok+NEW.stok 
        	WHERE gorengan.id_gorengan = NEW.id_gorengan;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(11) NOT NULL,
  `id_kasir` varchar(11) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detailtransaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_gorengan` (`id_gorengan`);

--
-- Indeks untuk tabel `gorengan`
--
ALTER TABLE `gorengan`
  ADD PRIMARY KEY (`id_gorengan`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_gorengan` (`id_gorengan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_kasir` (`id_kasir`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detailtransaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_gorengan`) REFERENCES `gorengan` (`id_gorengan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_gorengan`) REFERENCES `gorengan` (`id_gorengan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_kasir`) REFERENCES `kasir` (`id_kasir`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

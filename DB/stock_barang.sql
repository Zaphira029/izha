-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jan 2022 pada 16.59
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(4, 4, '2021-12-12 17:26:15', 'Pembeli', 10),
(5, 5, '2021-12-12 17:32:25', 'Bagas Pitono', 1),
(6, 6, '2021-12-13 12:05:14', 'Bagas Pitono', 5),
(7, 6, '2021-12-13 12:59:47', 'Bagas Pitono', 10),
(9, 10, '2021-12-16 19:58:54', 'Budi', 200),
(12, 10, '2021-12-19 13:34:08', 'Supriyanto', 100),
(13, 10, '2021-12-19 13:34:31', 'Budi', 1000),
(14, 10, '2021-12-19 13:35:25', 'Bagas Pitono', 10),
(15, 13, '2021-12-19 17:20:53', 'Budi', 100),
(16, 14, '2021-12-21 02:53:09', 'Budi', 100),
(17, 10, '2021-12-21 04:11:05', 'Budi', 100),
(22, 16, '2021-12-27 04:29:00', 'Budi', 20),
(23, 17, '2022-01-07 17:48:33', 'Supriadi', 100),
(24, 18, '2022-01-07 18:59:00', 'dendy', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'baretjingga@gmail.com', '171047'),
(4, 'Infolahta@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(3, 2, '2021-12-12 14:45:48', 'Supriyanto', 5),
(4, 1, '2021-12-12 14:46:27', 'Bagas Pitono', 1),
(5, 4, '2021-12-12 17:25:43', 'Supriyanto', 3),
(6, 5, '2021-12-12 17:31:48', 'Supriyanto', 3),
(7, 6, '2021-12-13 12:04:47', 'Supriyanto', 5),
(8, 6, '2021-12-13 12:59:25', 'Supriyanto', 5),
(9, 8, '2021-12-14 11:27:32', 'Supriyanto', 5),
(10, 3, '2021-12-14 11:33:38', 'Supriyanto', 1),
(11, 3, '2021-12-14 11:34:36', 'Supriyanto', 3),
(16, 11, '2021-12-16 20:36:07', 'Supriadi', 800),
(18, 10, '2021-12-19 13:33:46', 'Supriadi', 800),
(19, 10, '2021-12-19 13:34:45', 'Supriyanto', 10),
(20, 10, '2021-12-19 13:34:55', 'Supriadi', 200),
(21, 14, '2021-12-21 02:53:45', 'supri', 100),
(22, 10, '2021-12-21 03:35:09', 'Budi', 100),
(23, 11, '2021-12-25 05:39:44', 'Supriyanto', 100),
(24, 15, '2021-12-26 14:54:14', 'Budi', 500),
(25, 11, '2021-12-26 15:03:20', 'Supriadi', 800),
(26, 16, '2021-12-27 16:52:12', 'Supriyanto', 100),
(27, 17, '2022-01-07 17:47:59', 'Supri', 80),
(28, 18, '2022-01-07 18:52:59', 'Budi', 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

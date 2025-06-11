/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `amanah_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `amanah_db`;

CREATE TABLE IF NOT EXISTS `inventori` (
  `kode_item` varchar(15) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `status_produk` enum('Ada isi','Kosong','Tersedia','Terjual','Return') NOT NULL,
  `kode_produk` varchar(15) NOT NULL,
  PRIMARY KEY (`kode_item`),
  KEY `kode_produk` (`kode_produk`),
  CONSTRAINT `inventori_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `inventori` DISABLE KEYS */;
REPLACE INTO `inventori` (`kode_item`, `tgl_masuk`, `tgl_keluar`, `status_produk`, `kode_produk`) VALUES
	('ITM-0000001', '2025-06-02', '2025-06-04', 'Kosong', 'PRD-001'),
	('ITM-0000002', '2025-06-02', '2025-06-04', 'Kosong', 'PRD-001'),
	('ITM-0000003', '2025-06-02', '2025-06-04', 'Kosong', 'PRD-001'),
	('ITM-0000004', '2025-06-02', NULL, 'Ada isi', 'PRD-001'),
	('ITM-0000005', '2025-06-02', NULL, 'Ada isi', 'PRD-001'),
	('ITM-0000006', '2025-06-02', '2025-06-04', 'Terjual', 'PRD-002'),
	('ITM-0000007', '2025-06-02', '2025-06-04', 'Terjual', 'PRD-002'),
	('ITM-0000008', '2025-06-02', NULL, 'Tersedia', 'PRD-002'),
	('ITM-0000009', '2025-06-02', NULL, 'Tersedia', 'PRD-003'),
	('ITM-0000010', '2025-06-02', NULL, 'Tersedia', 'PRD-003'),
	('ITM-0000011', '2025-06-02', '2025-06-04', 'Terjual', 'PRD-004'),
	('ITM-0000012', '2025-06-02', NULL, 'Tersedia', 'PRD-004');
/*!40000 ALTER TABLE `inventori` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_keranjang` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `id_pesanan` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `kode_item` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `kode_produk` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `id_user` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  KEY `FK_keranjang_users` (`id_user`),
  KEY `FK_keranjang_inventori` (`kode_item`),
  KEY `FK_keranjang_pesanan` (`id_pesanan`),
  KEY `FK_keranjang_produk` (`kode_produk`),
  CONSTRAINT `FK_keranjang_inventori` FOREIGN KEY (`kode_item`) REFERENCES `inventori` (`kode_item`),
  CONSTRAINT `FK_keranjang_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  CONSTRAINT `FK_keranjang_produk` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`),
  CONSTRAINT `FK_keranjang_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `keranjang` DISABLE KEYS */;
REPLACE INTO `keranjang` (`id_keranjang`, `id_pesanan`, `kode_item`, `kode_produk`, `id_user`) VALUES
	('KJG-0000001', 'PSN-000001', 'ITM-0000001', 'PRD-001', 'USR-000001'),
	('KJG-0000002', 'PSN-000002', 'ITM-0000002', 'PRD-001', 'USR-000003'),
	('KJG-0000003', 'PSN-000002', 'ITM-0000003', 'PRD-001', 'USR-000003'),
	('KJG-0000004', 'PSN-000002', 'ITM-0000006', 'PRD-002', 'USR-000003'),
	('KJG-0000005', 'PSN-000003', 'ITM-0000007', 'PRD-002', 'USR-000004'),
	('KJG-0000006', 'PSN-000003', 'ITM-0000011', 'PRD-004', 'USR-000004');
/*!40000 ALTER TABLE `keranjang` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pesanan` (
  `id_pesanan` varchar(15) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `status_pesanan` enum('Diproses','Dikirim','Diterima') NOT NULL,
  `metode_pembayaran` enum('Cash','Transfer') NOT NULL,
  `id_user` varchar(15) NOT NULL,
  PRIMARY KEY (`id_pesanan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `FK_pesanan_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
REPLACE INTO `pesanan` (`id_pesanan`, `tgl_pesan`, `tgl_kirim`, `status_pesanan`, `metode_pembayaran`, `id_user`) VALUES
	('PSN-000001', '2025-06-04', NULL, 'Diproses', 'Cash', 'USR-000001'),
	('PSN-000002', '2025-06-04', NULL, 'Diproses', 'Transfer', 'USR-000003'),
	('PSN-000003', '2025-06-04', NULL, 'Diproses', 'Cash', 'USR-000004');
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `produk` (
  `kode_produk` varchar(15) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `harga_produk` varchar(50) NOT NULL,
  `gambar_produk` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
REPLACE INTO `produk` (`kode_produk`, `nama_produk`, `deskripsi`, `harga_produk`, `gambar_produk`) VALUES
	('PRD-001', 'Galon 19 liter', '1 galon', '20.000', '../amanah_assets/img/produk/produk 4.avif'),
	('PRD-002', 'Botol 500 mililiter', '1 dus isi 28 botol', '70.000', '../amanah_assets/img/produk/produk 3.avif'),
	('PRD-003', 'Botol 330  mililiter', '1 dus isi 32 botol', '60.000', '../amanah_assets/img/produk/produk 2.avif'),
	('PRD-004', 'Botol 200 mililiter', '1 dus isi botol', '35.000', '../amanah_assets/img/produk/produk 1.avif');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sandi` varchar(20) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL DEFAULT '',
  `alamat` varchar(100) NOT NULL,
  `level_user` enum('Penjual','Pembeli') NOT NULL,
  `foto_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id_user`, `email`, `sandi`, `nama_user`, `no_telepon`, `alamat`, `level_user`, `foto_user`) VALUES
	('USR-000001', 'akun1@gmail.com', '123', 'akun1', '08123456789', 'Ngaliyan', 'Pembeli', '../amanah_assets/img/avatar/avatar-2.png'),
	('USR-000002', 'admin1@gmail.com', '123', 'admin1', '081122334455', 'Boja', 'Penjual', '../amanah_assets/img/avatar/avatar-2.png'),
	('USR-000003', 'akun2@gmail.com', '123', 'akun2', '083344221166', 'Mijen', 'Pembeli', '../amanah_assets/img/avatar/avatar-2.png'),
	('USR-000004', 'akun3@gmail.com', '123', 'akun3', '082345231156', 'BPI', 'Pembeli', '../amanah_assets/img/avatar/avatar-2.png');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

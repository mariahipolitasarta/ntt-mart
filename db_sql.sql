DROP TABLE IF EXISTS `order_detail`;
DROP TABLE IF EXISTS `cart`;
DROP TABLE IF EXISTS `profile`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `users`;

-- ==========================
-- TABLE USERS
-- ==========================
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `alamat` text,
  `nama` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`,`alamat`,`nama`,`telepon`) VALUES
(7,'tukad pancoran','lisa','02827326637');

-- ==========================
-- TABLE PRODUCTS
-- ==========================
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products`
(`id`,`nama_produk`,`harga`,`gambar`,`deskripsi`) VALUES
(1,'Kain Tenun Manggarai',250000,'img/tenun.jpg','Tenun khas Manggarai'),
(2,'Kopi Flores',75000,'img/kopi.jpg','Kopi asli Flores'),
(3,'Songke Manggarai',350000,'img/selendang.png','Kain Songke premium'),
(4,'Kain Tenun Nagekeo',350000,'img/nagekeo.jpg',NULL),
(5,'Kain Tenun Sabu Raijua',250000,'img/sal.jpg',NULL);

-- ==========================
-- TABLE ORDERS
-- ==========================
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP,
  `total` int DEFAULT 0,
  `status` varchar(50) DEFAULT 'Menunggu',
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `orders_ibfk_1`
    FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders`
(`id`,`id_user`,`tanggal`,`total`,`status`,`metode_pembayaran`)
VALUES
(17,7,'2026-06-28 17:19:06',250000,'Menunggu','QRIS');

-- ==========================
-- TABLE CART
-- ==========================
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `qty` int DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `cart_ibfk_1`
    FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `cart_ibfk_2`
    FOREIGN KEY (`id_produk`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================
-- TABLE PROFILE
-- ==========================
CREATE TABLE `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `profile_ibfk_1`
    FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ==========================
-- TABLE ORDER DETAIL
-- ==========================
CREATE TABLE `order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_order` int NOT NULL,
  `id_produk` int NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_order` (`id_order`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `order_detail_ibfk_1`
    FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_detail_ibfk_2`
    FOREIGN KEY (`id_produk`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
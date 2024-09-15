CREATE TABLE `category_product` (
  `id_category` int PRIMARY KEY,
  `nama_category` varchar (250) NOT NULL
)

INSERT INTO `category_product` (`id_category`, `nama_category`) VALUES('1','Smartphone');
INSERT INTO `category_product` (`id_category`, `nama_category`) VALUES('2','Laptop');
INSERT INTO `category_product` (`id_category`, `nama_category`) VALUES('3','Camera');


CREATE TABLE product (
    `id_product` INT AUTO_INCREMENT PRIMARY KEY,
    `nama` VARCHAR(100) NOT NULL,
    `stok` INT NOT NULL,
    `id_category` INT,
    FOREIGN KEY (`id_category`) REFERENCES category_product(`id_category`)
);

INSERT INTO `product` (`nama`, `stok`, `id_category`) VALUES('Samsung S24 Ultra', '20', '1');
<?php
error_reporting(0);
header("Content-Type: application/json");

require ('../connection/koneksi.php');

$nama_search = $_POST['nama_search'];
$sql = "SELECT * FROM product WHERE nama LIKE ('%$nama_search%')";
$search = koneksi() -> query($sql);

$products = [];

if ($search->num_rows > 0) {
    while ($row = $search -> fetch_assoc()) {
        $products[] = [
            'id_product' => $row['id_product'],
            'nama' => $row['nama'],
            'stok' => $row['stok'],
            'id_category' => $row['id_category']
        ];
    }

    echo json_encode($products);
} else {
    echo json_encode([]);
}

?>

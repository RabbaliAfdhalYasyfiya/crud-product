<?php
error_reporting(0);
header("Content-Type: application/json");

require ('../connection/koneksi.php');

$data = json_decode(file_get_contents("php://input"), true);

$id_product = $data['id_product'];
$nama = $data['nama'];
$stok = $data['stok'];
$id_category = $data['id_category'];

$sql = "UPDATE product SET nama = '$nama', stok = '$stok', id_category = '$id_category' WHERE id_product = '$id_product'";

$update = koneksi() -> query($sql);

$response = [];

if ($update === TRUE) {
  $response['status'] = 'success';
  $response['message'] = "Berhasil Update Data Product: $nama | Stok: $stok | Category ID: $id_category";
} else {
  $response['status'] = 'error';
  $response['message'] = "Gagal mengupdate Data Product.";
}

echo json_encode($response);
?>

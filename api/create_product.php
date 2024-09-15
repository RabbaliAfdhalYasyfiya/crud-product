<?php
header("Content-Type: application/json");

include ('../connection/koneksi.php');

$data = json_decode(file_get_contents("php://input"), true);
$nama = $data['nama'];
$stok = $data['stok'];
$id_category = $data['id_category'];

$sql = "INSERT INTO product (nama, stok, id_category) VALUES ('$nama', '$stok', '$id_category')";
$insert = koneksi() -> query($sql);

if($insert) {
    $msg = "Berhasil, Tambah Data Product";
} else {
    $msg = "Gagal menambahkan Data Product";
}


$response = [];

if ($insert === TRUE) {
    $response['status'] = 'success';
    $response['message'] = "Berhasil, Tambah Data Product: $nama | Stok: $stok";
} else {
    $response['status'] = 'error';
    $response['message'] = "Gagal menambahkan Data Product.";
}

echo json_encode($response);
?>

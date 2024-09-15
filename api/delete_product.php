<?php
error_reporting(0);
header("Content-Type: application/json");

require ('../connection/koneksi.php');

$data = json_decode(file_get_contents("php://input"), true);
$nama_delete = $data['nama_delete'];

$sql = "DELETE FROM product WHERE nama LIKE ('%$nama_delete%')";
$delete = koneksi() -> query($sql);

$response = [];

if ($delete === TRUE) {
    $response['status'] = 'success';
    $response['message'] = "Berhasil, Hapus Data Product";
} else {
    $response['status'] = 'error';
    $response['message'] = "Gagal menghapus Data Product.";
}

echo json_encode($response);
?>

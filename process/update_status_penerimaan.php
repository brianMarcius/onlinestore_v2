<?php 
session_start();
require_once "../config/koneksi.php";
$kode_jual = $_POST['kodejual'];

$update_status = mysqli_query($koneksi,"UPDATE penjualan_header set status_penerimaan='1', tgl_penerimaan=sysdate() where kode_jual='$kode_jual'");

if ($update_status) {
    $data = [
        "code" => 200,
        "title" => "Barang Diterima",
        "message" => "Barang telah diterima oleh customer",
    ];
}else{
    $data = [
        "code" => 500,
        "title" => "Penerimaan Failed",
        "message" => "Internal server error",
        "data" => [],
    ];
}

echo json_encode($data);
?>
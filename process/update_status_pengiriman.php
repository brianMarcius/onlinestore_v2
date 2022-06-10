<?php 
session_start();
require_once "../config/koneksi.php";
$kode_jual = $_POST['kodejual'];

$update_status = mysqli_query($koneksi,"UPDATE penjualan_header set status_pengiriman='1', tgl_pengiriman=sysdate() where kode_jual='$kode_jual'");

if ($update_status) {
    $data = [
        "code" => 200,
        "title" => "Pengiriman Success",
        "message" => "Penjualan berhasil dikirim",
    ];
}else{
    $data = [
        "code" => 500,
        "title" => "Pengiriman Failed",
        "message" => "Internal server error",
        "data" => [],
    ];
}

echo json_encode($data);
?>
<?php 
session_start();
require_once "../config/koneksi.php";
$kode_jual = $_POST['kodejual'];

$update_status = mysqli_query($koneksi,"UPDATE penjualan_header set status_pembayaran='1' where kode_jual='$kode_jual'");

if ($update_status) {
    $data = [
        "code" => 200,
        "title" => "Approved",
        "message" => "Pembayaran telah disetujui",
    ];
}else{
    $data = [
        "code" => 500,
        "title" => "500",
        "message" => "Internal server error",
        "data" => [],
    ];
}

echo json_encode($data);
?>
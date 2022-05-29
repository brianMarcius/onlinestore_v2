<?php
session_start();
include('../config/koneksi.php');
$kode_customer = $_SESSION['kode_customer'];
$provinsi = $_POST['province_name'];
$kota = $_POST['city_name'];
$kecamatan = $_POST['district_name'];
$kelurahan = $_POST['village_name'];
$alamat = $_POST['alamat'];

$update = mysqli_query($koneksi,"UPDATE customer set provinsi = '$provinsi', kota = '$kota', kecamatan = '$kecamatan', kelurahan = '$kelurahan', alamat = '$alamat' where kode_customer='$kode_customer'");

$data = [
        "code" => "500",
        "message" => "Alamat gagal di update"
    ];

if ($update) {
    $data = [
        "code" => "200",
        "message" => "Alamat berhasil di update"
    ];
}

echo json_encode($data);


?>
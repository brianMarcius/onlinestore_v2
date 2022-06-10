<?php
require_once('../config/koneksi.php');
$tahun = $_GET['tahun'];

$data = [];
for ($i=1; $i <= 12; $i++) { 
    $sql = "SELECT ifnull(sum(grand_total),0) total from penjualan_header where month(tanggal_jual) = '$i' and date_format(tanggal_jual,'%Y') = '$tahun'";
    $query = mysqli_fetch_array(mysqli_query($koneksi,$sql));
    $data[] = $query['total'];
}

echo json_encode($data);

?>
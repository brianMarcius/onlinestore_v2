<?php 
session_start();
require_once "../config/koneksi.php";

$customer_count = mysqli_num_rows(mysqli_query($koneksi,"SELECT * from customer"));
$product_count = mysqli_num_rows(mysqli_query($koneksi,"SELECT * from product"));
$total_penjualan = mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(grand_total) total_jual from penjualan_header"));


$data_response = [
    "jml_customer" => $customer_count,
    "jml_product" => $product_count,
    "total_penjualan" => $total_penjualan['total_jual'],
];


echo json_encode($data_response);
?>
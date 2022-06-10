<?php
require_once('../config/koneksi.php');
$id = $_GET['id'];
$sql = "SELECT * from product where id = '$id'";
$product = mysqli_fetch_assoc(mysqli_query($koneksi,$sql));
$data = [
    "code" => '200',
    "message" => 'sucess',
    "data" => $product
];

echo json_encode($data);




?>
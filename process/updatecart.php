<?php 
session_start();
require_once "../config/koneksi.php";
$id_user = $_SESSION['id'];
$id_product = $_GET['id_product'];
$qty = $_GET['qty'];

$update_cart = mysqli_query($koneksi,"UPDATE keranjang set qty=$qty where id_user='$id_user' and id_product='$id_product'");
$get_price = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from product where id='$id_product'"));
$total = $qty * $get_price['price'];


$data_response = [
    'total' => $total
];

if ($update_cart) {
    $data = [
        "code" => 200,
        "title" => "Update Success",
        "message" => "Cart berhasil diperbarui",
        "data" => $data_response
    ];
}else{
    $data = [
        "code" => 500,
        "title" => "Update Failed",
        "message" => "Internal server error",
        "data" => [],
    ];
}

echo json_encode($data);
?>
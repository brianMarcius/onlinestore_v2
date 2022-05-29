<?php 
session_start();
require_once "../config/koneksi.php";
$id_user = $_SESSION['id'];
$id_product = $_GET['id_product'];

$remove_cart = mysqli_query($koneksi,"DELETE from keranjang where id_user='$id_user' and id_product='$id_product'");
$get_grand_total = mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(b.qty*a.price) total from keranjang b, product a where a.id=b.id_product and b.id_user='$id_user'"));

$data_response = [
    'grand_total' => $get_grand_total['total'],
];

if ($remove_cart) {
    $data = [
        "code" => 200,
        "title" => "Delete Success",
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
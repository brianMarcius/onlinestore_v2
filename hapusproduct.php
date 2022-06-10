<?php 
session_start();
require_once "../config/koneksi.php";
$id_user = $_SESSION['id'];
$id_product = $_GET['id'];

$get_img = mysqli_fetch_array(mysqli_query($koneksi,"SELECT img from product where id='$id_product'"));
unlink('../img/'.$get_img['img']);
$remove_cart = mysqli_query($koneksi,"DELETE from product where id='$id_product'");

if ($remove_cart) {
    $data = [
        "code" => 200,
        "title" => "Delete Success",
        "message" => "Product berhasil dihapus",
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
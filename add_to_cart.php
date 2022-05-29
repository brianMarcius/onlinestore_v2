<?php 
session_start();
require_once "../config/koneksi.php";
$id_user = $_SESSION['id'];
$id_product = $_POST['id_product'];

$cek_product = mysqli_num_rows(mysqli_query($koneksi,"SELECT * from keranjang where id_user='$id_user' and id_product='$id_product'"));
if ($cek_product==0) {
    $add_to_cart = mysqli_query($koneksi,"INSERT into keranjang(id_user,id_product,qty) value('$id_user','$id_product',1)");
    if ($add_to_cart) {
        $data = [
            "code" => 200,
            "title" => "Add Success",
            "message" => "Produk berhasil dimasukan ke keranjang",
        ];
    }else{
        $data = [
            "code" => 500,
            "title" => "Add Failed",
            "message" => "Internal server error",
        ];
    }
}else{
    $data = [
            "code" => 200,
            "title" => "Already in your cart",
            "message" => "Data sudah ada didalam keranjang anda",
        ];
}




echo json_encode($data);
?>
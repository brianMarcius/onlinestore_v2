<?php 
session_start();
require_once "../config/koneksi.php";
$id_user = $_SESSION['id'];
$shipment = $_GET['shipment'];

$get_grand_total = mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(b.qty*a.price) total from keranjang b, product a where a.id=b.id_product and b.id_user='$id_user'"));

$tax = $get_grand_total['total'] * 0.11;
$grand_total_plus_tax = $get_grand_total['total'] + $tax;
$ongkir = ($shipment == 0) ? 0 : 500000;
$grand_total_plus_tax_plus_shipment = ($shipment == 0) ? $grand_total_plus_tax : $grand_total_plus_tax+$ongkir;

$data_response = [
    'total_item' => $get_grand_total['total'],
    'tax' => $tax,
    'grand_total_plus_tax' => $grand_total_plus_tax,
    'ongkir' => $ongkir,
    'grand_total_plus_tax_plus_shipment' => $grand_total_plus_tax_plus_shipment
];

if (!empty($get_grand_total)) {
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
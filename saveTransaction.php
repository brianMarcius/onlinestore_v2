<?php
session_start();
include "../config/koneksi.php";
$shipment = $_POST['shipment'];
$payment = $_POST['payment'];
$now = date('Y-m-d');
$id_user = $_SESSION['id'];
$get_customer = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from customer where id_user='$id_user'"));
$kode_customer = $get_customer['kode_customer'];
$sqlpenjualan = "SELECT * from penjualan_header";
$querypenjualan = mysqli_query($koneksi,$sqlpenjualan);
$count = mysqli_num_rows($querypenjualan);

$kodepenjualan = 'INV'.date('ymdhis');

$insert_detail_penjualan = mysqli_query($koneksi, "INSERT into penjualan_detail(kode_jual,id_product,qty,price) (SELECT '$kodepenjualan',a.id_product,a.qty,b.price from keranjang a, product b where a.id_product=b.id and a.id_user='$id_user')");

$data = [
                "code" => 500,
                "title" => "Checkout Failed",
                "message" => "Keranjang anda gagal di checkout",
        ];

if ($insert_detail_penjualan) {
        $get_sum_item = mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(qty*price) total from penjualan_detail where kode_jual='$kodepenjualan'"));
        $total = $get_sum_item['total'];
        $tax = $total * 0.11;
        $ongkir = ($shipment==0) ? 0 : 500000;
        $grand_total = $total + $tax + $ongkir;
        $shipment_date = date('Y-m-d',strtotime(date("Y-m-d") . "+2 days"));
        $insert_penjualan = mysqli_query($koneksi,"INSERT into penjualan_header(kode_jual,kode_customer,total,ppn,ongkir,grand_total,metode_bayar,tanggal_jual,pengiriman,tgl_pengiriman,created_at) values('$kodepenjualan','$kode_customer',$total,$tax,$ongkir,$grand_total,'$payment','$now','$shipment','$shipment_date','$now')");
        if ($insert_penjualan) {
                $delete_cart = mysqli_query($koneksi,"DELETE from keranjang where id_user='$id_user'");
                $data = [
                        "code" => 200,
                        "title" => "Checkout Success",
                        "message" => "Keranjang belanja anda berhasil di checkout",
                        "data" => [
                                "kode_jual" => $kodepenjualan
                        ]
                ];
        }
}


echo json_encode($data);



?>
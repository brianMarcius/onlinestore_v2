<?php
require_once('../config/koneksi.php');
$kodejual = $_GET['kodejual'];
$data = [];

$getheader = mysqli_query($koneksi, "SELECT * FROM bukti_pembayaran a, penjualan_header b, customer d where a.kode_jual=b.kode_jual and b.kode_customer=d.kode_customer and a.kode_jual='$kodejual'");

while ($r = mysqli_fetch_array($getheader)) {
    $data['kode_jual'] = $r['kode_jual'];
    $data['nominal'] = $r['nominal'];
    $data['bank'] = $r['bank'];
    $data['nama'] = $r['nama'];
    $data['norek'] = $r['norek'];
    $data['total'] = $r['total'];
    $data['ppn'] = $r['ppn'];
    $data['ongkir'] = $r['ongkir'];
    $data['grand_total'] = $r['grand_total'];
    $data['customer_name'] = $r['customer_name'];
    $data['email'] = $r['email'];
    $data['no_telp'] = $r['no_telp'];
    $data['bukti_transfer'] = $r['bukti_transfer'];
    $data['tanggal_jual'] = $r['tanggal_jual'];
    $data['alamat'] = $r['alamat'].' '.$r['kelurahan'].' '.$r['kecamatan'].' '.$r['kota'].' '.$r['provinsi'];
    $detail=[];
    $getdetail = mysqli_query($koneksi,"SELECT * FROM penjualan_detail a, product b where a.id_product=b.id and a.kode_jual='$kodejual'");
    while ($d = mysqli_fetch_assoc($getdetail)) {
        $detail[] = $d;
    }
    $data['detail'] = $detail;
}


echo json_encode($data);

?>
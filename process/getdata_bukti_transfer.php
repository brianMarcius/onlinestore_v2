<?php
require_once('../config/koneksi.php');
$kodejual = $_GET['kodejual'];
$data = [];

$getheader = mysqli_query($koneksi, "SELECT * from penjualan_header b, customer d where b.kode_customer=d.kode_customer and b.kode_jual='$kodejual'");

while ($r = mysqli_fetch_array($getheader)) {
    $data['kode_jual'] = $r['kode_jual'];
    $data['total'] = $r['total'];
    $data['ppn'] = $r['ppn'];
    $data['ongkir'] = $r['ongkir'];
    $data['grand_total'] = $r['grand_total'];
    $data['customer_name'] = $r['customer_name'];
    $data['metode_bayar'] = $r['metode_bayar'];
    $data['email'] = $r['email'];
    $data['no_telp'] = $r['no_telp'];
    $data['tanggal_jual'] = $r['tanggal_jual'];
    $data['alamat'] = $r['alamat'].' '.$r['kelurahan'].' '.$r['kecamatan'].' '.$r['kota'].' '.$r['provinsi'];
    $detail=[];
    $getdetail = mysqli_query($koneksi,"SELECT * FROM penjualan_detail a, product b where a.id_product=b.id and a.kode_jual='$kodejual'");
    while ($d = mysqli_fetch_assoc($getdetail)) {
        $detail[] = $d;
    }
    $data['detail'] = $detail;
}

$getbukti = mysqli_query($koneksi,"SELECT * from bukti_pembayaran where kode_jual='$kodejual'");
while($b = mysqli_fetch_array($getbukti)){
    $data['nominal'] = $b['nominal'];
    $data['nama'] = $b['nama'];
    $data['norek'] = $b['norek'];
    $data['bank'] = $b['bank'];
    $data['bukti_transfer'] = $b['bukti_transfer'];
}


echo json_encode($data);

?>
<?php
session_start();
include('../config/koneksi.php');
$level = $_SESSION['level'];
$kode_customer = $_SESSION['kode_customer'];
$search = $_POST['search'];
$filter_customer ='';
$filter_search ='';
$filter_selesai ='';

if ($level == 2) {
    $filter_customer = " and a.kode_customer='$kode_customer'";
}

if($level == 1){
    $filter_selesai = " and a.status_penerimaan = 1 ";
}

if ($search != '') {
    $filter_search = " and (a.kode_jual like '%$search%' or b.customer_name like '$search' or a.tanggal_jual = '$search')";
}
$sql = "SELECT a.kode_jual, a.kode_customer, b.customer_name, b.email, b.no_telp, concat(b.alamat,', Kel. ',b.kelurahan,', Kec. ',b.kecamatan,', ',b.kota,', ',b.provinsi) alamat, a.total, a.ppn, a.ongkir, a.grand_total, a.tanggal_jual, a.status_pembayaran, a.status_penerimaan, a.status_pengiriman from penjualan_header a, customer b where a.kode_customer=b.kode_customer $filter_selesai $filter_customer $filter_search order by a.tanggal_jual desc";
$query =mysqli_query($koneksi,$sql);
$html = '';
$no=1;
while ($d = mysqli_fetch_array($query)) {
    $status = "";
    if ($d['status_pembayaran'] == 0) {
        $status = '<span class="badge badge-secondary">Verifikasi Pembayaran</span>';
    }elseif($d['status_pembayaran']==1 && $d['status_pengiriman'] == 0){
        $status = '<span class="badge badge-primary">Pesanan dalam proses</span>';
    }elseif($d['status_pengiriman']==1 && $d['status_penerimaan'] == 0){
        $status = '<span class="badge badge-warning">Dalam proses Pengiriman</span>';
    }else{
        $status = '<span class="badge badge-success">Pesanan telah diterima</span>';
    }


    $button = '<div class="btn-group" role="group" aria-label="Basic example">';
    $button .= "<a class='btn btn-light' target='_blank' href='resultPembelian.php?kode=".$d['kode_jual']."'><i class='fa fa-file-text-o'></i></a>";
    if ($d['status_pengiriman']==1 && $d['status_penerimaan']==0) {
        $button .= "<a class='btn btn-primary text-white' onclick='modalPenerimaan(\"".$d['kode_jual']."\",".$d['status_penerimaan'].")'><i class='fa fa-handshake-o'></i></a>";
    }
    $button .= "</div>";
    $html .= "<tr>
                    <td>".$no++."</td>
                    <td>".$d['kode_jual']."</td>
                    <td>".$d['customer_name']."</td>
                    <td>".$d['tanggal_jual']."</td>
                    <td>".$status."</td>
                    <td class='text-right'>".number_format($d['grand_total'])."</td>
                    <td class='text-right'>$button</td>
                </tr>";
}

echo $html;


?>
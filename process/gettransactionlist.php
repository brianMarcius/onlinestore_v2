<?php
session_start();
include('../config/koneksi.php');
$level = $_SESSION['level'];
$kode_customer = $_SESSION['kode_customer'];
$search = $_POST['search'];
$filter_customer ='';
$filter_search ='';
if ($level == 2) {
    $filter_customer = " and a.kode_customer='$kode_customer'";
}

if ($search != '') {
    $filter_search = " and (a.kode_jual like '%$search%' or b.customer_name like '$search' or a.tanggal_jual = '$search')";
}
$sql = "SELECT a.kode_jual, a.kode_customer, b.customer_name, b.email, b.no_telp, concat(b.alamat,', Kel. ',b.kelurahan,', Kec. ',b.kecamatan,', ',b.kota,', ',b.provinsi) alamat, a.total, a.ppn, a.ongkir, a.grand_total, a.tanggal_jual from penjualan_header a, customer b where a.kode_customer=b.kode_customer and a.status_pengiriman=1 $filter_customer $filter_search";
$query =mysqli_query($koneksi,$sql);
$html = '';
while ($d = mysqli_fetch_array($query)) {
    $html .= "<tr>
                    <td>".$d['kode_jual']."</td>
                    <td>".$d['customer_name']."</td>
                    <td>".$d['tanggal_jual']."</td>
                    <td class='text-right'>".number_format($d['grand_total'])."</td>
                    <td class='text-right'><a class='btn btn-light' target='_blank' href='resultPembelian.php?kode=".$d['kode_jual']."'><i class='fa fa-file-text-o'></i></a></td>
                </tr>";
}

echo $html;


?>
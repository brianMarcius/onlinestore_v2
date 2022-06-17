<?php
session_start();
include('../config/koneksi.php');
$sql = "SELECT a.kode_jual, a.kode_customer, b.customer_name, b.email, b.no_telp, concat(b.alamat,', Kel. ',b.kelurahan,', Kec. ',b.kecamatan,', ',b.kota,', ',b.provinsi) alamat, a.total, a.ppn, a.ongkir, a.grand_total, a.tanggal_jual from penjualan_header a, customer b where a.kode_customer=b.kode_customer and a.status_pembayaran=0 order by a.tanggal_jual desc";
$query =mysqli_query($koneksi,$sql);
$html = '';
$no=1;
while ($d = mysqli_fetch_array($query)) {
    $html .= "<tr>
                    <td>".$no++."</td>
                    <td>".$d['kode_jual']."</td>
                    <td>".$d['customer_name']."</td>
                    <td>".$d['tanggal_jual']."</td>
                    <td class='text-right'>".number_format($d['grand_total'])."</td>
                    <td class='text-right'><a class='btn btn-light' onclick='konfirmPembayaran(\"".$d['kode_jual']."\")'><i class='fa fa-credit-card'></i></a></td>
                </tr>";
}

echo $html;


?>
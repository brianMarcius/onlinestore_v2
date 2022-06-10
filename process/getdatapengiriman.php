<?php
session_start();
include('../config/koneksi.php');


$sql = "SELECT a.kode_jual, a.kode_customer, b.customer_name, b.email, b.no_telp, concat(b.alamat,', Kel. ',b.kelurahan,', Kec. ',b.kecamatan,', ',b.kota,', ',b.provinsi) alamat, a.total, a.ppn, a.ongkir, a.grand_total, a.tanggal_jual, a.status_pengiriman, a.tgl_pengiriman from penjualan_header a, customer b where a.kode_customer=b.kode_customer";
$query =mysqli_query($koneksi,$sql);
$html = '';
while ($d = mysqli_fetch_array($query)) {
    if ($d['status_pengiriman']==0) {
        $d['tgl_pengiriman'] = '<i class="text-muted">Waiting For Shipment</i>';
        $status =  '<button class="btn btn-outline-info" onclick="updatePengiriman(\''.$d['kode_jual'].'\')"><i class="fa fa-truck" aria-hidden="true"></i></button>';

    }else{
        $status =  '<button  class="btn btn-danger"><i class="fa fa-check"></i></button>';
    }
    $html .= "<tr>
                    <td>".$d['kode_jual']."</td>
                    <td>".$d['customer_name']."</td>
                    <td>".$d['no_telp']."</td>
                    <td>".$d['alamat']."</td>
                    <td>".$d['tgl_pengiriman']."</td>
                    <td class='text-right'>$status</td>
                </tr>";
}

echo $html;


?>
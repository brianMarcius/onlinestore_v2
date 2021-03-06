<?php
session_start();
include('../config/koneksi.php');


$sql = "SELECT a.kode_jual, a.kode_customer, b.customer_name, b.email, b.no_telp, concat(b.alamat,', Kel. ',b.kelurahan,', Kec. ',b.kecamatan,', ',b.kota,', ',b.provinsi) alamat, a.total, a.ppn, a.ongkir, a.grand_total, a.tanggal_jual, a.status_pengiriman, a.tgl_pengiriman from penjualan_header a, customer b where a.kode_customer=b.kode_customer and a.status_pembayaran=1 order by a.kode_jual desc";
$query =mysqli_query($koneksi,$sql);
$html = '';
$no = 1;
while ($d = mysqli_fetch_array($query)) {
    if ($d['status_pengiriman']==0) {
        $d['tgl_pengiriman'] = '<i class="text-muted">Waiting For Shipment</i>';
        $status =  '<button class="btn btn-outline-info" onclick="modalPengiriman(\''.$d['kode_jual'].'\',0)"><i class="fa fa-truck" aria-hidden="true"></i></button>';

    }else{
        $status =  '<button  class="btn btn-danger" onclick="modalPengiriman(\''.$d['kode_jual'].'\',1)"><i class="fa fa-check"></i></button>';
    }
    $html .= "<tr>
                    <td>".$no++."</td>
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
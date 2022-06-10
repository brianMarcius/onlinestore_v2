<?php 
session_start();
require_once "../config/koneksi.php";

$customer = mysqli_query($koneksi,"SELECT * from customer");
$html = '';
$no = 1;
while ($d = mysqli_fetch_array($customer)) {
    $html .= "<tr>
                    <td>$no</td>
                    <td>".$d['customer_name']."</td>
                    <td>".$d['email']."</td>
                    <td>".$d['no_telp']."</td>
                    <td>".$d['alamat'].', '.$d['kelurahan'].', '.$d['kecamatan'].', '.$d['kota'].', '.$d['provinsi']."</td>
                </tr>";
                $no++;
}

echo $html;
?>
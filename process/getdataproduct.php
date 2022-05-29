<?php
require_once('../config/koneksi.php');
$sql = "SELECT * from product";
$query = mysqli_query($koneksi,$sql);
$i=1;
$html = "";
while ($r = mysqli_fetch_array($query)) {
    $html .= "<tr>
                    <td>".$i++."</td>
                    <td>".$r['title']."</td>
                    <td>".$r['description']."</td>
                    <td>".$r['color']."</td>
                    <td>".$r['size']."</td>
                    <td>".$r['satuan']."</td>
                    <td>".$r['img']."</td>
                    <td class='text-right'>".number_format($r['price'])."</td>
                    <td>
                    <div class='btn-group' role='group' aria-label='Basic example'>
                        <button class='btn btn-sm btn-light' onclick='launchModal(\"edit\",".$r['id'].")'><i class='fa fa-pencil'></i></button>
                        <button class='btn btn-sm btn-danger' onclick='deleteProduct(".$r['id'].")'><i class='fa fa-trash'></i></button>
                        </div>
                    </td>
                </tr>";
}
echo $html;



?>
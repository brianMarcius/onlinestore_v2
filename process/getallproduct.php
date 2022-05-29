<?php
require_once('../config/koneksi.php');
$sql = "SELECT * from product";
$query = mysqli_query($koneksi,$sql);
$i=1;
$html = "<div class='row'>";
while ($r = mysqli_fetch_array($query)) {
        $html .= '<div class="col-md-4 product mt-4" style="display:none">
        <div class="card slideanim">
            <div style="height:250px;overflow:hidden">
            <img class="card-img-top" src="../img/'.$r['img'].'"  alt="Card image cap">
            </div>
            <div class="card-body">
                <h4 class="card-title"><a>'.$r['title'].'</a></h4>
                <p class="card-text">IDR '.number_format($r['price'],2).'</p>
                <a href="detail.php?id='.$r['id'].'" class="btn btn-outline-primary"><i class="fa fa-eye"></i> Detail</a>
            </div>
        </div>
    </div>';
    if ($i % 3 ==0 && $i>=3) {
        $html .= '</div><div class="row">';
    }
    $i++;
}
echo $html;



?>
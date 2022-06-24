<?php 
require_once "../config/koneksi.php";
require_once "../layout/header.php";
require_once "../layout/navbar.php";
$kode_jual = $_GET['kode'];
$get_header = mysqli_fetch_array(mysqli_query($koneksi,"SELECT a.kode_jual, a.kode_customer, b.customer_name, b.email, concat(b.alamat,', Kel. ',b.kelurahan,', Kec. ',b.kecamatan,', ',b.kota,', ',b.provinsi) alamat, b.email, b.no_telp, a.total, a.ppn, a.ongkir, a.grand_total, a.tanggal_jual FROM penjualan_header a, customer b where a.kode_customer=b.kode_customer and a.kode_jual='$kode_jual'"));
$get_detail = mysqli_query($koneksi,"SELECT a.id_product, a.qty, a.price, b.title, b.satuan from penjualan_detail a, product b where a.id_product = b.id and a.kode_jual='$kode_jual'");
?>
<style>
        .body-main {
        background: #ffffff;
        border-bottom: 15px solid #1E1F23;
        border-top: 15px solid #1E1F23;
        margin-top: 30px;
        margin-bottom: 30px;
        padding: 40px 30px !important;
        position: relative ;
        box-shadow: 0 1px 21px #808080;
        font-size:10px;
        
        
        
    }

    .main thead {
		background: #1E1F23;
        color: #fff;
		}
    .img{
        height: 100px;}
    h1{
       text-align: center;
    }

    
</style>

<div class="container">

<div class="page-header pt-3">
    <h1>Invoice Penjualan  </h1>
</div>


<div class="container" id="section-to-print">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6 body-main">
            <div class="col-md-12">
               <div class="row">
                    <div class="col-md-4">
                        <img class="img" alt="Invoce Template" src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png" />
                    </div>
                    <div class="col-md-8 text-right">
                        <h4 style="color: #F81D2D;"><strong><?= $get_header['customer_name']?></strong></h4>
                        <p><?= $get_header['alamat']?></p>
                        <p><?= $get_header['no_telp']?></p>
                        <p><?= $get_header['email']?></p>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>INVOICE</h2>
                        <h5><?= $kode_jual?></h5>
                    </div>
                </div>
                <br />
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><h5>Description</h5></th>
                                <th><h5>Qty</h5></th>
                                <th><h5>Amount</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($r = mysqli_fetch_array($get_detail)){ ?>
                            <tr>
                                <td class="col-md-6"><?= $r['title']?></td>
                                <td class="col-md-3"><?= $r['qty'].' '.$r['satuan']?></td>
                                <td class="col-md-3 text-right"><?= number_format($r['price'])?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td class="text-right" colspan=2>
                                <p>
                                    <strong>Total Amount: </strong>
                                </p>
                                <p>
                                    <strong>Tax (11%): </strong>
                                </p>
							    <p>
                                    <strong>Shipment: </strong>
                                </p>
							    </td>
                                <td>
                                <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <?=number_format($get_header['total']) ?> </strong>
                                </p>
                                <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <?=number_format($get_header['ppn']) ?> </strong>
                                </p>
							    <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <?=number_format($get_header['ongkir']) ?>  </strong>
                                </p>
							    </td>
                            </tr>
                            <tr style="color: #F81D2D;">
                                <td class="text-right" colspan=2><h4><strong>Total:</strong></h4></td>
                                <td class="text-right"><h4><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <?= number_format($get_header['grand_total'])?> </strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="col-md-12">
                        <p><b>Date :</b> <?= $get_header['tanggal_jual']?></p>
                        <br />
                        <p><b>Signature</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

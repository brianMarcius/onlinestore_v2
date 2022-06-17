<?php 
require_once('../layout/header.php'); 
require_once('../layout/navbar.php');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<style>
        .body-main {
        background: #ffffff;
        margin-bottom: 30px;
        padding: 20px 30px !important;
        position: relative ;
        font-size:10px;
        border : solid #eee 2px;
        border-radius : 10px
    }

    .img{
        height: 100px;}
    h1{
       text-align: center;
    }

    
</style>
<div class="container">
        <div class="col main pt-3">
            <!-- <h1 class="display-4 d-none d-sm-block">
            Dashboard Admin
            </h1>
            <p class="lead d-none d-sm-block">Hi Admin <?= $_SESSION['fullname']?>, Selamat datang di halaman dashboard admin.</p> -->
            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6 py-2" id="go_to_customer">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body bg-success">
                            <div class="rotate">
                                <i class="fa fa-user fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Customers</h6>
                            <h1 class="display-4" id="jml_customer"></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 py-2" id="go_to_product">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body bg-danger">
                            <div class="rotate">
                                <i class="fa fa-list fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Product</h6>
                            <h1 class="display-4" id="jml_product"></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 py-2" id="go_to_sale">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body bg-info">
                            <div class="rotate">
                                <i class="fa fa-dollar fa-4x"></i>
                            </div>
                            <h6 class="text-uppercase">Sale</h6>
                            <h1 class="display-4" id="total_jual"></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white">
                <div class="row">
                    <div class="col-md-3 col-xs-12 mx-3">
                        <h6 class="text-uppercase">Grafik Penjualan</h6>
                        <div class="form-group">
                            <!-- <label for="tahun">Tahun</label> -->
                            <select class="form-control" name="tahun" id="tahun">
                                <?php 
                                    $this_year = date('Y');
                                    for ($i=2021; $i <= $this_year; $i++) { 
                                ?>
                                <option value="<?=$i?>" <?php if($i==$this_year){ echo "selected"; }?>><?=$i?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 p-3">
                    <div class="col-12">
                        <canvas id="myChart" class="mb-3" style="height:350px !important"></canvas>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-xl-12 col-sm-12 py-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="pembayaran-tab" data-toggle="tab" role="tab" aria-controls="pembayaran" aria-selected="true" href="#data-pembayaran">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pengiriman-tab" data-toggle="tab" role="tab" aria-controls="pengiriman" aria-selected="true" href="#data-pengiriman">Pengiriman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="penjualan-tab" data-toggle="tab" role="tab" aria-controls="penjualan" aria-selected="true" href="#data-penjualan" onclick="getDataPenjualan()">Selesai</a>
                        </li>
                        
                    </ul>
                    <div class="card bg-white h-100">
                        <div class="card-body bg-white">
                            <div class="tab-content" id="myTabContent">
                                <div id="data-pembayaran" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pembayaran-tab">
                                    <h6 class="text-uppercase">Konfirmasi Pembayaran</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="table_pembayaran">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice</th>
                                                    <th>Customer</th>
                                                    <th>Tanggal</th>
                                                    <th class="text-right">Grand Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_data_pembayaran">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="data-penjualan" class="tab-pane fade" role="tabpanel" aria-labelledby="penjualan-tab">
                                    <h6 class="text-uppercase">Data Penjualan</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="table_penjualan">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice</th>
                                                    <th>Customer</th>
                                                    <th>Tanggal</th>
                                                    <th class="text-right">Grand Total</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_data_penjualan">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="data-pengiriman" class="tab-pane fade" role="tabpanel" aria-labelledby="pengiriman-tab">
                                    <h6 class="text-uppercase">Data Pengiriman</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="table_pengiriman">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice</th>
                                                    <th>Customer</th>
                                                    <th>No Telp</th>
                                                    <th>Alamat</th>
                                                    <th>Tanggal Kirim</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_data_pengiriman">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="modal fade" id="modal_konfirmasi_pembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Konfirmasi Pembayaran</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="row">
        <div class="col-md-6 body-main">
            <div class="col-md-12">
               <div class="row">
                    <div class="col-md-4">
                        <img class="img" alt="Invoce Template" src="http://pngimg.com/uploads/shopping_cart/shopping_cart_PNG59.png" />
                    </div>
                    <div class="col-md-8 text-right">
                        <h4 style="color: #F81D2D;"><strong><span id="customer_name"></span></strong></h4>
                        <p><span id="alamat"></span></p>
                        <p><span id="no_telp"></span></p>
                        <p><span id="email"></span></p>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>INVOICE</h2>
                        <h5><span id="kode_jual"></span></h5>
                        <input type="hidden" id="kode_jual_val"/>
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
                        <tbody id="tbody_detail">
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
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="total"></span> </strong>
                                </p>
                                <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="ppn"></span> </strong>
                                </p>
							    <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="ongkir"></span>  </strong>
                                </p>
							    </td>
                            </tr>
                            <tr style="color: #F81D2D;">
                                <td class="text-right" colspan=2><h4><strong>Total:</strong></h4></td>
                                <td class="text-right"><h4><strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="grand_total"></span> </strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="col-md-12">
                        <p><b>Date :</b> <span id="tanggal_jual"></span></p>
                        <br />
                        <p><b>Signature</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 body-main border-0">
            <div class="md-form mb-2">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" disabled>
            </div>
            <div class="md-form mb-2">
                <label for="bank">Bank</label>
                <input type="text" id="bank" name="bank" class="form-control" disabled>
            </div>
            <div class="md-form mb-2">
                <label for="rekening">Rekening</label>
                <input type="text" id="rekening" name="rekening" class="form-control" disabled>
            </div>
            <div class="md-form mb-2">
                <label for="bukti_transfer">Bukti Transfer</label>
                <img class="img-fluid" id="bukti_transfer">
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" onclick="approvePembayaran()">Approve</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_pengiriman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Pengiriman</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="row">
        <div class="col-md-12 body-main border-0">
            <div class="col-md-12">
               <div class="row">
                    <div class="col-md-4">
                        <img class="img" alt="Invoce Template" src="../img/delivery.png" />
                    </div>
                    <div class="col-md-8 text-right">
                        <h4 style="color: #F81D2D;"><strong><span id="kirim_customer_name"></span></strong></h4>
                        <p><span id="kirim_alamat"></span></p>
                        <p><span id="kirim_no_telp"></span></p>
                        <p><span id="kirim_email"></span></p>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2>Shipment</h2>
                        <h5><span id="kirim_kode_jual"></span></h5>
                        <input type="hidden" id="kirim_kode_jual_val"/>
                    </div>
                </div>
                <br />
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th><h5>Description</h5></th>
                                <th><h5>Qty</h5></th>
                                <th><h5>Satuan</h5></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_detail_kirim">
                            <tr>
                                <td class="text-right" colspan=2>
                                    <p>
                                        <strong>Shipment: </strong>
                                    </p>
							    </td>
                                <td>
                                    <p class="text-right">
                                        <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="kirim_ongkir"></span>  </strong>
                                    </p>
							    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="col-md-12">
                        <p><b>Date :</b><?= date('Y-m-d')?></p>
                        <br />
                        <p><b>Signature</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-primary" onclick="updatePengiriman()">Kirim</button>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    var config = {
                    type: 'bar',
                    data: [],
                    options: {}
                };

    var myChart = new Chart($('#myChart'),config);
    $(function(){
        var tahun = $("#tahun").val();
        getDataChart(tahun)
        getResumeData();
        getDataPenjualan();
        getDataPengiriman();
        getDataPembayaran();
    })

    $("#tahun").change(function(){
        getDataChart($(this).val());
    })

    $("#go_to_customer").click(function(){
        window.location.href = 'customer.php';
    })

    $("#go_to_product").click(function(){
        window.location.href = 'form_product.php';
    })

    $("#go_to_sale").click(function(){
        // Javascript to enable link to tab

        $('.nav-tabs a[href="#data-penjualan"]').tab('show');
        

    })

    function modalPengiriman(kodejual){
        $("#modal_pengiriman").modal('show');
        $.ajax({
            url : "../process/getdata_bukti_transfer.php",
            type : "GET",
            data : {
                kodejual : kodejual
            },
            dataType : "JSON",
            success : function(response){
                $("#kirim_customer_name").html(response.customer_name)
                $("#kirim_alamat").html(response.alamat)
                $("#kirim_no_telp").html(response.no_telp)
                $("#kirim_email").html(response.email)
                $("#kirim_ongkir").html(addCommas(response.ongkir))
                $("#kirim_kode_jual").html(response.kode_jual)
                $("#kirim_kode_jual_val").val(response.kode_jual)
                var html = "";
                console.log(response.detail);
                for (let i = 0; i < response.detail.length; i++) {
                    html += "<tr>";
                    html += "<td class='col-md-6'>"+response.detail[i].title+"</td>";
                    html += "<td class='col-md-3'>"+response.detail[0].qty+"</td>";
                    html += "<td class='col-md-3'>"+response.detail[0].satuan+"</td>";
                    html += "</tr>";
                }
                $("#tbody_detail_kirim").prepend(html);
            }
        })
    }

    function konfirmPembayaran(kodejual){
        $("#modal_konfirmasi_pembayaran").modal('show');
        $.ajax({
            url : "../process/getdata_bukti_transfer.php",
            type : "GET",
            data : {
                kodejual : kodejual
            },
            dataType : "JSON",
            success : function(response){
                $("#customer_name").html(response.customer_name)
                $("#alamat").html(response.alamat)
                $("#no_telp").html(response.no_telp)
                $("#email").html(response.email)
                $("#total").html(addCommas(response.total))
                $("#ppn").html(addCommas(response.ppn))
                $("#ongkir").html(addCommas(response.ongkir))
                $("#grand_total").html(addCommas(response.grand_total))
                $("#tanggal_jual").html(response.tanggal_jual)
                $("#kode_jual").html(response.kode_jual)
                $("#kode_jual_val").val(response.kode_jual)
                $("#nama").val(response.nama)
                $("#bank").val(response.bank)
                $("#rekening").val(response.norek)
                $("#bukti_transfer").attr('src',"../img/bukti_transfer/"+response.bukti_transfer)
                var html = "";
                console.log(response.detail);
                for (let i = 0; i < response.detail.length; i++) {
                    html += "<tr>";
                    html += "<td class='col-md-6'>"+response.detail[i].title+"</td>";
                    html += "<td class='col-md-3 text-right'>"+response.detail[0].qty+"</td>";
                    html += "<td class='col-md-3 text-right'>"+addCommas(response.detail[0].price)+"</td>";
                    html += "</tr>";
                }
                $("#tbody_detail").prepend(html);
            }
        })
    }

    function approvePembayaran(){
        var kodejual = $("#kode_jual_val").val();
        $.ajax({
            url : "../process/approve_pembayaran.php",
            type : "POST",
            data : {
                kodejual : kodejual
            },
            dataType : "JSON",
            success : function(response){
                $("#modal_konfirmasi_pembayaran").modal('hide');

                if (response.code==200) {
                    Swal.fire({
                        icon: 'success',
                        title: response.title,
                        text: response.message,
                        timer: 2000,
                        showConfirmButton : false
                    }).then((result) => {
                        getDataPembayaran();
                        getDataPengiriman();

                    })
                }
            }
        })
    }

    function getDataChart(tahun){
        $.ajax({
            url : "../process/getdata_penjualan_perbulan.php",
            type : "GET",
            data : {
                tahun : tahun
            },
            dataType : "JSON",
            success : function(response){
                myChart.destroy()
                datanya =  response;
                var labels = [
                            'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'Augustus',
                            'September',
                            'October',
                            'November',
                            'December',
                        ];

                var data = {
                    labels: labels,
                    datasets: [{
                    label: 'Penjualan Perbulan',
                    backgroundColor: 
                                    [
                                        'rgb(1, 86, 104)',
                                        'rgb(1, 86, 104)',
                                        'rgb(1, 86, 104)',
                                        'rgb(1, 86, 104)',
                                        'rgb(6, 100, 140)',
                                        'rgb(6, 100, 140)',
                                        'rgb(6, 100, 140)',
                                        'rgb(6, 100, 140)',
                                        'rgb(15, 129, 199)',
                                        'rgb(15, 129, 199)',
                                        'rgb(15, 129, 199)',
                                        'rgb(15, 129, 199)',
                                        
                                    ],
                    borderColor: [
                                        'rgb(1, 86, 104)',
                                        'rgb(1, 86, 104)',
                                        'rgb(1, 86, 104)',
                                        'rgb(1, 86, 104)',
                                        'rgb(6, 100, 140)',
                                        'rgb(6, 100, 140)',
                                        'rgb(6, 100, 140)',
                                        'rgb(6, 100, 140)',
                                        'rgb(15, 129, 199)',
                                        'rgb(15, 129, 199)',
                                        'rgb(15, 129, 199)',
                                        'rgb(15, 129, 199)',
                                        
                                    ],
                    data: datanya,
                    }]
                };

                var config = {
                    type: 'bar',
                    data: data,
                    options: {
                            responsive: true,
                            maintainAspectRatio: false,
                    }
                };
                
                myChart = new Chart(document.getElementById('myChart'),config);
                
            }
        })

    }
    
    function getResumeData(){
        $.ajax({
            url : "../process/getresumedata.php",
            type : "GET",
            dataType : "JSON",
            success : function(response){
                $("#jml_customer").html(response.jml_customer)
                $("#jml_product").html(response.jml_product)
                $("#total_jual").html(addCommas(response.total_penjualan))
            }
        })
    }

    function getDataPenjualan(search=''){
        $("#tbody_data_penjualan").html('');
        $("#table_penjualan").DataTable().destroy();
        $.ajax({
            url:"../process/gettransactionlist.php",
            type:"POST",
            data : {
                search:search,
            },
            success:function(result){
                $("#tbody_data_penjualan").html(result);
                $("#table_penjualan").DataTable();

            },
        })
    }


    function getDataPembayaran(){
        $("#tbody_data_pembayaran").html('');
        $("#table_pembayaran").DataTable().destroy();
        $.ajax({
            url:"../process/gettransaksipembayaran.php",
            type:"POST",
            success:function(result){
                $("#tbody_data_pembayaran").html(result);
                $("#table_pembayaran").DataTable();

            },
        })
    }

    function getDataPengiriman(){
        $("#tbody_data_pengiriman").html('');
        $("#table_pengiriman").DataTable().destroy();
        $.ajax({
            url:"../process/getdatapengiriman.php",
            type:"POST",
            success:function(result){
                $("#tbody_data_pengiriman").html(result);
                $("#table_pengiriman").DataTable();

            },
        })
    }

    function updatePengiriman(){
       var kodejual = $("#kirim_kode_jual_val").val();
       $.ajax({
            url:"../process/update_status_pengiriman.php",
            type:"POST",
            data:{
                kodejual:kodejual
            },
            dataType: "JSON",
            success:function(response){
                $("#modal_pengiriman").modal('hide');

                if (response.code==200) {
                    Swal.fire({
                        icon: 'success',
                        title: response.title,
                        text: response.message,
                        timer: 2000,
                        showConfirmButton : false
                    }).then((result) => {
                        getDataPengiriman();
                    })
                }
            },
        })
    }


    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>
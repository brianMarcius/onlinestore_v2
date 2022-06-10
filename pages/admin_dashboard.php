<?php 
require_once('../layout/header.php'); 
require_once('../layout/navbar.php');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
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
                            <a class="nav-link active" id="pengiriman-tab" data-toggle="tab" role="tab" aria-controls="pengiriman" aria-selected="true" href="#data-pengiriman">Pengiriman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="penjualan-tab" data-toggle="tab" role="tab" aria-controls="penjualan" aria-selected="true" href="#data-penjualan">Selesai</a>
                        </li>
                        
                    </ul>
                    <div class="card bg-white h-100">
                        <div class="card-body bg-white">
                            <div class="tab-content" id="myTabContent">
                                <div id="data-penjualan" class="tab-pane fade" role="tabpanel" aria-labelledby="penjualan-tab">
                                    <h6 class="text-uppercase">Data Penjualan</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="table_penjualan">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
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
                                <div id="data-pengiriman" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pengiriman-tab">
                                    <h6 class="text-uppercase">Data Pengiriman</h6>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="table_pengiriman">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
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
                $("#tbody_data_penjualan").append(result);
                $("#table_penjualan").DataTable();

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

    function updatePengiriman(kodejual){
       $.ajax({
            url:"../process/update_status_pengiriman.php",
            type:"POST",
            data:{
                kodejual:kodejual
            },
            dataType: "JSON",
            success:function(response){
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
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
                <div class="col-xl-4 col-sm-6 py-2">
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
                <div class="col-xl-4 col-sm-6 py-2">
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
                <div class="col-xl-4 col-sm-6 py-2">
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
            <div class="row mb-3">
                <div class="col-xl-12 col-sm-12 py-2">
                    <div class="card bg-white h-100">
                        <div class="card-body bg-white">
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
                    </div>
                </div>
            </div>
</div>
<script type="text/javascript">

    $(function(){
        getResumeData();
        getDataPenjualan();
    })
    
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
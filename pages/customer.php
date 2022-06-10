<?php 
require_once('../layout/header.php'); 
require_once('../layout/navbar.php');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<div class="container">
        <div class="col main pt-3">
            <div class="row mb-3">
                <div class="col-xl-12 col-sm-12 py-2">
                    <div class="card bg-white h-100">
                        <div class="card-body bg-white">
                            <h6 class="text-uppercase">Data Customer</h6>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_customer">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>No Telp</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_data_customer">

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
        getDataCustomer();
    })
    

    function getDataCustomer(){
        $("#tbody_data_customer").html('');
        $("#table_customer").DataTable().destroy();
        $.ajax({
            url:"../process/getcustomer.php",
            type:"POST",
            success:function(result){
                $("#tbody_data_customer").append(result);
                $("#table_customer").DataTable();

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
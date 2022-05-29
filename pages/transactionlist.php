<?php 
  include('../layout/header.php');  
  include('../layout/navbar.php');  


?>
<div class="container bg-white mt-4 mb-4 pt-4 pb-4">
    <div class="row">
        <div class="col-md-12">
            <h3>History Transaction</h3>
            <div class="row">
                <div class="col-md-4 col-xs-12"></div>
                <div class="col-md-4 col-xs-12"></div>
                <div class="col-md-4 col-xs-12">
                    <input type="text" class="form-control" placeholder='Search' id="search">
                </div>
            </div>
            <div class="table-responsive" id="section-to-print">
                <table class="table">
                    <thead>
                        <tr>
                            <th><h5>#</h5></th>
                            <th><h5>Customer</h5></th>
                            <th><h5>Date</h5></th>
                            <th><h5>Ammount</h5></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="list-container"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <a class="btn btn-block btn-primary" href="allproduct.php">Go to Shop</a>
        </div>
        <div class="col-md-3"></div>

    </div>
</div>
<?php require_once "../layout/footer.php" ?>

<script type="text/javascript">
    $(function(){
        getData();
    })

    function getData(search = ''){
        $("#list-container").html('');
        $.ajax({
            url:"../process/gettransactionlist.php",
            type:"POST",
            data : {
                search:search,
            },
            success:function(result){
                $("#list-container").append(result);
            },
        })
    }

    $("#search").change(function(){
        getData($(this).val());
    })
        
    

</script>
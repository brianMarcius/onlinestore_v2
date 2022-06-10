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
                            <h6 class="text-uppercase">Data Product</h6>
                            <button class='btn btn-sm btn-primary mb-3' onclick="launchModal('add')">+ Add Product</button>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_product">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Size</th>
                                            <th>Satuan</th>
                                            <th>Img</th>
                                            <th class="text-right">Price</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_data_product">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div id="modal_product" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="form_product" method="POST" action="../process/store_product.php" enctype="multipart/form-data">
                    <div class="form-outline mb-4">
                        <input class="form-control" type="text" id="title" name="title" placeholder='title'/>
                        <input type="hidden" id="id" name="id" />
                    </div>

                    <div class="form-outline mb-4">
                        <textarea class="form-control" rows="5" placeholder="description" name="description" id="description"></textarea>
                    </div>

                    <div class="form-outline mb-4">
<<<<<<< HEAD
=======
                        <input class="form-control" type="text" id="color" name="color" placeholder="color"/>
                    </div>

                    <div class="form-outline mb-4">
>>>>>>> cff93e8d194ac85e7864dbce1bb32f755c738b97
                        <input class="form-control" type="text" id="size" name="size" placeholder="size"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control" type="text" id="satuan" name="satuan" placeholder="satuan"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control" type="number" id="price" name="price" placeholder="price"/>
                    </div>

                    <div class="form-outline mb-4">
                        <input class="form-control" type="file" id="img" name="img" placeholder="img"/>
                    </div>
                </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

    $(function(){
        getDataProduct();
    })

    function launchModal(type, id = null){
        if (type == 'add') {
            $("#modal_product").modal('show');            
        }else{
            $.ajax({
                url : '../process/detailproduct.php',
                type : 'GET',
                data : {
                    id : id
                },
                dataType : "JSON",
                success : function(response){
                    if (response.code==200) {
                        $("#id").val(response.data.id)
                        $("#title").val(response.data.title)
                        $("#description").val(response.data.description)
                        $("#color").val(response.data.color)
                        $("#size").val(response.data.size)
                        $("#satuan").val(response.data.satuan)
                        $("#price").val(response.data.price)
                        $("#modal_product").modal('show');            

                    }
                }
            })
        }
    }

    function deleteProduct(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : "../process/hapusproduct.php",
                type : "GET",
                data : {
                    id : id
                },
                dataType : "JSON",
                success : function(response){
                    if (response.code==200) {
                        Swal.fire({
                            icon: 'success',
                            title: response.title,
                            text: response.message,
                            timer: 2000,
                            showConfirmButton : false
                        }).then((result) => {
                            window.location.reload();
                        })
                    }
                    
                }
            });
            
        }
        })

    }
    

    function getDataProduct(){
        $("#tbody_data_product").html('');
        $("#table_product").DataTable().destroy();
        $.ajax({
            url:"../process/getdataproduct.php",
            type:"POST",
            success:function(result){
                $("#tbody_data_product").append(result);
                $("#table_product").DataTable();

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
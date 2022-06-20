<?php 
  include('../layout/header.php');  
  include('../layout/navbar.php');  


?>
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
                            <th><h5>Invoice</h5></th>
                            <th><h5>Customer</h5></th>
                            <th><h5>Date</h5></th>
                            <th><h5>Status</h5></th>
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
<div class="modal fade" id="modal_pengiriman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Konfirmas Barang Diterima</h4>
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
                                <th><h5>Amount</h5></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_detail_kirim">
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
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="kirim_total"></span> </strong>
                                </p>
                                <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="kirim_ppn"></span> </strong>
                                </p>
							    <p class="text-right">
                                    <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="kirim_ongkir"></span>  </strong>
                                </p>
							    </td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan=2>
                                    <p>
                                        <strong>Total: </strong>
                                    </p>
							    </td>
                                <td>
                                    <p class="text-right">
                                        <strong><i class="fas fa-rupee-sign" area-hidden="true"></i> <span id="kirim_grand_total"></span>  </strong>
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
        <button class="btn btn-primary" id="terima" onclick="updatePenerimaan()">Terima</button>
        <button class="btn btn-primary disabled" id="diterima">Sudah Diterima &nbsp; <i class="fa fa-check"></i></button>
      </div>
    </div>
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

    function modalPenerimaan(kodejual, status){
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
                $("#kirim_total").html(addCommas(response.total))
                $("#kirim_ppn").html(addCommas(response.ppn))
                $("#kirim_ongkir").html(addCommas(response.ongkir))
                $("#kirim_grand_total").html(addCommas(response.grand_total))
                $("#kirim_kode_jual").html(response.kode_jual)
                $("#kirim_kode_jual_val").val(response.kode_jual)
                var html = "";
                console.log(response.detail);
                for (let i = 0; i < response.detail.length; i++) {
                    html += "<tr>";
                    html += "<td class='col-md-6'>"+response.detail[i].title+"</td>";
                    html += "<td class='col-md-3'>"+response.detail[0].qty+" "+response.detail[0].satuan+"</td>";
                    html += "<td class='col-md-3 text-right'>"+addCommas(response.detail[0].price)+"</td>";
                    html += "</tr>";
                }
                $("#tbody_detail_kirim").prepend(html);
                if (status == 0) {
                    $("#diterima").hide()
                    $("#terima").show()
                }else{
                    $("#diterima").show()
                    $("#terima").hide()
                }
            }
        })
    }
        
    function updatePenerimaan(){
        var kodejual = $("#kirim_kode_jual_val").val();
       $.ajax({
            url:"../process/update_status_penerimaan.php",
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
                        getData();
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
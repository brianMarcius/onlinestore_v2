<?php 
require_once('../layout/header.php'); 
require_once('../layout/navbar.php'); 
$id_user = $_SESSION['id'];
$get_customer = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from customer where id_user='$id_user'"));
$kode_customer = $get_customer['kode_customer'];
$get_cart = mysqli_query($koneksi,"SELECT a.id, a.title, a.description, a.img, b.qty, a.color, a.size, a.price, a.price*b.qty as total_per_item from keranjang b, product a where a.id = b.id_product and id_user='$id_user'");
$get_grand_total = mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(b.qty*a.price) total from keranjang b, product a where a.id=b.id_product and b.id_user='$id_user'"));
$count_item = mysqli_num_rows($get_cart);
$get_alamat_customer = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT provinsi,kota,kecamatan,kelurahan,alamat,no_telp from customer where kode_customer='$kode_customer'"));


?>
<style>
    .container-fluid{
        padding:30px 50px
    }
</style>
<section class="h-100 gradient-custom">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <?php if($count_item > 0){ ?>
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Cart - <?= $count_item ?>  items</h5>
                        </div>
                        <div class="card-body">
                            <?php while($prd = mysqli_fetch_array($get_cart)){ ?>
                            <!-- Single item -->
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                        <img src="../img/<?= $prd['img']?>" class="w-100" alt="Blue Jeans Jacket" />
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                    <!-- Data -->
                                    <p><strong><?= $prd['title'] ?></strong></p>
                                    <p>Color: <?= $prd['color']?></p>
                                    <p>Size: <?= $prd['size']?></p>
                                    <p>Price: <?= "IDR ".number_format($prd['price'])?></p>
                                    <button type="button" class="btn btn-light btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item" onclick="removeCart(<?=$prd['id']?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm mb-2" data-mdb-toggle="tooltip"title="Move to the wish list">
                                        <i class="fa fa-heart"></i>
                                    </button>
                                    <!-- Data -->
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <!-- Quantity -->
                                    <strong>Quantity</strong>
                                    <div class="d-flex mb-4" style="max-width: 300px">
                                    <button class="btn btn-secondary px-3 me-2"
                                        onclick="updateCart(<?=$prd['id']?>,this,'decrease')">
                                        <i class="fa fa-minus"></i>
                                    </button>

                                    <div class="form-outline">
                                        <input id="form1" min="1" name="quantity" value="<?= $prd['qty'] ?>" type="number" class="form-control" />
                                    </div>

                                    <button class="btn btn-secondary px-3 ms-2"
                                        onclick="updateCart(<?=$prd['id']?>,this,'increase')">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    </div>
                                    <!-- Quantity -->

                                    <!-- Price -->
                                    <p class="text-start text-md-center" id="total_<?=$prd['id']?>">
                                    <strong>IDR <?= number_format($prd['total_per_item'])?></strong>
                                    </p>
                                    <!-- Price -->
                                </div>
                            </div>
                            <!-- Single item -->
                            <hr class="my-4" />
                            <?php } ?>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Empty Cart</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
								<img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
								<h3><strong>Your Cart is Empty</strong></h3>
								<h4>Add something to make me happy :)</h4>
								<a href="home.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
							</div>
                        </div>
                    </div>
                <?php } ?>
        <div class="card mb-4">
            <div class="card-body">
                <strong>Shipment : </strong>
                <select class="form-control" id="shipment">
                    <option value="1">Pengiriman</option>
                    <option value="0">Ambil ditempat</option>
                </select>
                <hr>
                <div id="detail-pengiriman" class="slideanim">
                    <p><strong>Expected shipping delivery</strong></p>
                    <p class="mb-0"><?= date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s") . "+2 days")); ?></p>
                    <br>
                    <table class="table">
                        <?php foreach($get_alamat_customer as $key => $value){ ?>
                        <tr>
                        <td>
                            <strong><?= ucwords($key) ?></strong>
                            <p> <?=$value?> </p>
                        </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
              <strong>Payment : </strong>
                <select class="form-control" id="payment">
                    <option value="Transfer">Transfer</option>
                    <option value="Cash">Cash</option>
                </select>
                <hr>
                <div id="detail-transfer" class="slideanim">
                    <p><strong>We accept</strong></p>
                    <i class="fa fa-cc-visa" style="font-size:30px"></i>
                    &nbsp;
                    <i class="fa fa-cc-paypal" style="font-size:30px"></i>
                    &nbsp;
                    <i class="fa fa-cc-amex" style="font-size:30px"></i>
                    &nbsp;
                    <i class="fa fa-credit-card" style="font-size:30px"></i>
                </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Summary</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span id="total_item"><?=number_format($get_grand_total['total'])?></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Tax (11%)
                <span id="tax_item"><?=number_format($get_grand_total['total']*0.11)?></span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span id="ongkir"><?=number_format(500000)?></span>
              </li>
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                </div>
                <span id="grand_total"><strong><?= number_format(($get_grand_total['total']*1.11)+500000)?></strong></span>
              </li>
            </ul>

            <?php if($count_item > 0){ ?>
            <a onclick='checkout()' class="btn btn-primary btn-lg btn-block text-white">
              Go to checkout
            </a>
            <?php }else{?>
                <a href='allproduct.php' class="btn btn-primary btn-lg btn-block text-white">
              Back to shop
            </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once "../layout/footer.php" ?>
<script type="text/javascript">

    $("#shipment").change(function(){
        var shipment = $(this).val();
        if (shipment == 0) {
            $("#detail-pengiriman").hide()   
            getResume()
        }else{
            $("#detail-pengiriman").show()
            getResume()
        }
    })

    $("#payment").change(function(){
        var payment = $(this).val();
        if (payment == 'Cash') {
            $("#detail-transfer").hide()   
        }else{
            $("#detail-transfer").show()
        }
    })

    function updateCart(id,th,type){
        var inputQty = $(th).parent().find('input[type=number]');
        var qty = inputQty.val();

        if (type == "increase") {
         ++qty
        }else {
         --qty
        }

        if (qty < 1) {
          qty=1;
        }

        inputQty.val(qty);

        $.ajax({
            url : "../process/updatecart.php",
            type : "GET",
            data : {
                id_product : id,
                qty : qty,
            },
            dataType : "JSON",
            success : function(response){
                if (response.code == 200) {
                    
                    total = addCommas(response.data.total)


                    $("#total_"+id).html('<strong>IDR '+total+'</strong>');
                    getResume();
                }
            }

        })
    }

    function getResume(){
        var shipment = $("#shipment").val();
        $.ajax({
            url : "../process/getresume.php",
            type : "GET",
            data : {
                shipment : shipment
            },
            dataType : "JSON",
            success : function(response){
                if (response.code == 200) {
                    
                    total_item = (response.data.total_item == null) ? 0 : addCommas(response.data.total_item)
                    tax = addCommas(response.data.tax)
                    ongkir = addCommas(response.data.ongkir)
                    grandtotal = addCommas(response.data.grand_total_plus_tax_plus_shipment);

                    $("#grand_total").html('<strong>'+grandtotal+'</strong>');
                    $("#total_item").html(total_item)
                    $("#tax_item").html(tax)
                    $("#ongkir").html(ongkir)
                }
            }

        })
    }

    function removeCart(id){
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
                url : "../process/removecart.php",
                type : "GET",
                data : {
                    id_product : id
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

    function checkout(){
        var shipment = $("#shipment").val();
        var payment = $("#payment").val();
        $.ajax({
            url : '../process/saveTransaction.php',
            type : 'POST',
            data : {
                shipment : shipment,
                payment : payment,
            },
            dataType : 'JSON',
            success : function(response){
                console.log(response);
                if (response.code==200) {
                    Swal.fire({
                            icon: 'success',
                            title: response.title,
                            text: response.message,
                            timer: 2000,
                            showConfirmButton : false
                        }).then((result) => {
                            window.location.href= 'resultPembelian.php?kode='+response.data.kode_jual;
                        })
                }
            }
        })

    }

</script>
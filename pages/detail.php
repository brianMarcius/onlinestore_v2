<?php 
require_once('../layout/header.php'); 
require_once('../layout/navbar.php'); 
$id_product = $_GET['id'];
$get_product = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * from product where id='$id_product'"));
$get_other_product = mysqli_query($koneksi,"SELECT * from product where id != '$id_product' limit 3");
?>
<style>
    .container-fluid{
        padding:30px 50px
    }
</style>
<div class="container mb-3">
    <div class="row">
        <div class="col-9 col-md-9 col-xs-12">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Product Detail</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-5 col-xs-12" style="overflow:hidden">
                            <div class="card">
                                <div style="height:300px;overflow:hidden">
                                    <img class="card-img-top" src="../img/<?=$get_product['img']?>"  alt="Card image cap">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><a><?=$get_product['title']?></a></h4>
                                    <p class="card-text">IDR <?=number_format($get_product['price']); ?></p>
                                    <a class="btn btn-primary btn-block text-white" onclick="addToCart(<?=$id_product?>)"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                </div>
                            </div>                        
                        </div>
                        <div class="col-7 col-md-7 col-xs-12">
                            <?php foreach($get_product as $key => $value){ 
                                if ($key !== 'id' && $key !=='img') { ?>
                                <h4 class="card-title"><?= ucwords($key) ?></h4>
                                <p><?= $value ?></p>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 col-md-3 col-xs-12">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Product Lainnya</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <?php while ($other = mysqli_fetch_array($get_other_product)) { ?>
                           <tr onclick="detailproduct(<?= $other['id']?>)">
                               <td><?= $other['title']?></td>
                           </tr> 
                        <?php } ?>
                    </table>
                    <a class="btn btn-block btn-primary" href="allproduct.php">Back to Shop</a>
                </div>
            </div>
        </div>
    </div>
        
    <!-- <div class="load-more">
      <a href="#" class="btn btn-primary" id="loadMore"> Load more..</a>
        <p class="totop"> 
            <a class="btn btn-dark" href="#top" >Back to top</a> 
        </p>
    </div> -->
</div>
<?php require_once "../layout/footer.php" ?>

<script type="text/javascript">
    $(function(){
        loadData();
        $(window).scroll(function() {
            $(".slideanim").each(function(){
            var pos = $(this).offset().top;

            var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                $(this).addClass("slide");
                }
            });
        });     
    });

    function detailproduct(id){
        document.location.href = "detail.php?id="+id;
    }

    function addToCart(id){
        $.ajax({
            url : "../process/add_to_cart.php",
            type : "POST",
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
        })
    }

    function loadData(){
        $.ajax({
            url:"../process/getallproduct.php",
            type:"POST",
            success:function(data){
                $("#product-container").append(data);
                    if (data.length%3==0) {
                        $("#product-container .row:last-child").remove();
                    }
                    // console.log(data);
                    $(".product").slice(0, 3).show();
                    $("#loadMore").on('click', function (e) {
                        e.preventDefault();
                        $(".product:hidden").slice(0, 3).slideDown();
                        if ($(".product:hidden").length == 0) {
                            $("#load").fadeOut('slow');
                            $("#loadMore").hide();
                        }
                        $('html,body').animate({
                            scrollTop: $(this).parent().parent().find("div .product:visible:last").offset().top
                        }, 1000);
                    });
            }
        })
    }
</script>
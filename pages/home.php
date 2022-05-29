<?php 
require_once('../layout/header.php'); 
require_once('../layout/navbar.php');
require_once('../layout/jumbotron.php'); 
require_once('articles.php'); 
?>
<div class="container-fluid slideanim" style="background-color:#fff">
<div class="container">
<h2 class="text-center">Our Products</h2>
  <div class="content-wrapper">
    <div id="product-container">

    </div>
    <div class="text-center pt-4 slideanim">
        <a class="btn btn-lg btn-primary text-white" href="allproduct.php">See All Product &nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></a>
    </div>
    <!-- <div class="load-more">
      <a href="#" class="btn btn-primary" id="loadMore"> Load more..</a>
        <p class="totop"> 
            <a class="btn btn-dark" href="#top" >Back to top</a> 
        </p>
    </div> -->
  </div>
</div>
</div>
    
<?php require_once "../layout/footer.php" ?>
<script type="text/javascript">
    $(function(){
        loadData();     
    });

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
<?php 
require_once "../config/koneksi.php";
$id_user = $_SESSION['id'];
$get_cart = mysqli_query($koneksi,"SELECT * from keranjang where id_user=$id_user");
$count_item = mysqli_num_rows($get_cart);

if ($_SESSION['level']==2) {
?>
<nav class="navbar navbar-expand-sm bg-white navbar-light sticky-top">
  <a class="navbar-brand" href="home.php"><i class="fa fa-home"></i> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <div class="d-flex justify-content-between" style="width:100%">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="allproduct.php">Product<sup><span class="badge badge-danger">New</span></sup></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="transactionlist.php">Transaction</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="keranjang.php"><i class="fa fa-shopping-cart"></i><?php if ($count_item>0) { ?><sup><span class="badge badge-danger"><?= $count_item ?></span></sup><?php } ?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i>  <?= $_SESSION['username']?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a href="profile.php" class="dropdown-item">
            Profile
          </a>
            <div class="dropdown-divider"></div>

          <a id="logout" class="dropdown-item">
            Logout
          </a>
        </div>
      </li>
    </ul>
</div>
  </div> 

</nav>
<?php
}else{ ?>
  <nav class="navbar navbar-expand-sm bg-white navbar-light sticky-top">
  <a class="navbar-brand" href="admin_dashboard.php"><i class="fa fa-home"></i> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="form_product.php">Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customer.php">Customer</a>
      </li>
    </ul>
  </div> 
    <ul class="navbar-nav">
      <!-- <li class="nav-item">
        <a class="nav-link" href="keranjang.php"><i class="fa fa-shopping-cart"></i><?php if ($count_item>0) { ?><sup><span class="badge badge-danger"><?= $count_item ?></span></sup><?php } ?></a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i>  <?= $_SESSION['username']?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a href="profile.php" class="dropdown-item">
            Profile
          </a>
            <div class="dropdown-divider"></div>

          <a id="logout" class="dropdown-item">
            Logout
          </a>
        </div>
      </li>
    </ul>
</nav>
<?php }
?>
<div class="modal" tabindex="-1" id="modal_greeting">
  <div class="modal-dialog modal-lg">
    <div class="card">
      <div class="text-right cross"> <i class="fa fa-times"></i> </div>
          <div class="card-body text-center"> <img src="https://img.icons8.com/bubbles/200/000000/trophy.png">
                 <h4>Hi, <?= ucwords($_SESSION['fullname'])?>!</h4>
                 <?php if ($count_item == 0) { ?>
                  <p>Selamat datang di website Perwira Steel   </p> <button class="btn btn-out btn-square continue">CONTINUE</button>
                 <?php }else{ ?>
                  <p>Anda memiliki <?= $count_item ?> product di keranjang belanja anda, Ayo segera checkout sebelum kehabisan stock</p> 
                  <a class="btn btn-out btn-square continue" href="keranjang.php">CONTINUE</a>


                  <?php } ?>
          </div>
      </div>
  </div>
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
var greeting = "<?= $_SESSION['greeting'] ?>";
  
$(function(){
  if (greeting==1) {
    setTimeout(myGreeting, 1000)
    setOffGreeting();
  }
})

function myGreeting() {
    $("#modal_greeting").modal('show');
}

$("#logout").click(function(){
  logout();
})

function setOffGreeting(){
  $.ajax({
    url : "../process/set_off_greeting.php",
    type : "GET",
    dataType : "JSON",
    success : function(response){
      console.log(response);
    }
  })
}

function logout(){
  $.ajax({
    url : "../process/logout.php",
    type : "GET",
    success : function(){
        Swal.fire({
            icon: 'success',
            title: "Logout Berhasil",
            text: "Terimakasih sudah berkunjung diwebsite ini",
            timer: 2000,
            showConfirmButton : false
        }).then((result) => {
               document.location.href = "../index.php";
            
          })
    }
  })
}

</script>
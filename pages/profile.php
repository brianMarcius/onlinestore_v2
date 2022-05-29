<?php 
include "../layout/header.php";
include "../layout/navbar.php";
$get_customer = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from customer where kode_customer='".$_SESSION['kode_customer']."'"));
$get_user = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from users where id = '".$_SESSION['id']."'"));
$level = $_SESSION['level'];
$password = base64_decode($get_user['password']);
?>
<style>
  .select2-container{
    width:100% !important
  }

  .select2-dropdown{
    z-index: 3051;
}

</style>
<section style="background-color: #eee;">
  <div class="container py-4">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['username']?>&background=random" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?=$_SESSION['fullname']?></h5>
            <p class="text-muted mb-1"><?= $_SESSION['email']?></p>
            <p class="text-muted mb-4">
              <?php if ($level == 2) {
                echo $get_customer['alamat'];
              }
              ?>
            </p>
            
            <div class="d-flex justify-content-center mb-2">
              <a onclick="logout()" href="#" class="btn btn-primary">Logout</a>
              <a href="mailto:<?=$_SESSION['email']?>" class="btn btn-outline-primary ms-1">Message</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-header bg-white">
              <h3>Profile</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <input class="form-control border-0 bg-white" id="fullname" disabled type="text" value="<?= $_SESSION['fullname']?>">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <input class="form-control border-0 bg-white" id="username" disabled type="text" value="<?= $_SESSION['username']?>">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <input class="form-control border-0 bg-white" id="email" disabled type="email" value="<?= $_SESSION['email']?>">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Password</p>
              </div>
              <div class="col-sm-9">
                <input class="form-control border-0 bg-white" id="password" disabled type="password" value="<?= $password?>">
              </div>
            </div>
            <?php
              if ($level==2) {
            ?>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0" id="alamat"><?= $get_customer['alamat'].', '.$get_customer['kelurahan'].', '.$get_customer['kecamatan'].', '.$get_customer['kota'].', '.$get_customer['provinsi']?></p>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="card-footer bg-white">
            <button class="btn btn-light" id="edit"><i class="fa fa-edit"></i>  Edit</button>
            <button class="btn btn-primary" id="update" onclick="updateProfile()" style="display:none"><i class="fa fa-save"></i>  Update</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div id="modal_update_alamat" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="form_alamat">
                    <div class="form-outline mb-4">
                        <select class="form-control" id="province">
                          <option value="">Pilih Provinsi</option>
                        </select>
                        <input type="hidden" id="province_name" name="province_name"/>
                    </div>
                    <div class="form-outline mb-4">
                        <select class="form-control" id="city">
                          <option value="">Pilih Kota</option>
                        </select>
                        <input type="hidden" id="city_name" name="city_name"/>

                    </div>
                    <div class="form-outline mb-4">
                        <select class="form-control" id="district">
                          <option value="">Pilih Kecamatan</option>
                        </select>
                        <input type="hidden" id="district_name" name="district_name"/>

                    </div>

                    <div class="form-outline mb-4">
                        <select class="form-control" id="village">
                          <option value="">Pilih Kelurahan</option>
                        </select>
                        <input type="hidden" id="village_name" name="village_name"/>

                    </div>
                    
                    <div class="form-outline mb-4">
                        <textarea class="form-control" rows="5" placeholder="Alamat" name="alamat" id="alamat_customer"></textarea>
                    </div>
                </div>
              </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateAlamat()" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>

<?php include '../layout/footer.php' ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 var provinsi = "<?= $get_customer['provinsi']?>";
 var kota = "<?= $get_customer['kota']?>";
 var kecamatan = "<?= $get_customer['kecamatan']?>";
 var kelurahan = "<?= $get_customer['kelurahan']?>";
 var alamat = "<?= $get_customer['alamat']?>";

  $(function(){
    getProvince();
    $("#province").select2();
    $("#city").select2();
    $("#district").select2();
    $("#village").select2();
    $("#alamat_customer").val(alamat);
  })

  $("#edit").click(function(){
    $("#fullname").attr('disabled', false).focus();
    $("#email").attr('disabled', false);
    $("#password").attr('disabled', false);
    $("#username").attr('disabled', false);
    $("#edit").hide();
    $("#update").show();
  })

  function updateProfile(){
    var fullname  = $("#fullname").val();
    var email  = $("#email").val();
    var password  = $("#password").val();
    var username  = $("#username").val();
    $.ajax({
      url : "../process/updateprofile.php",
      type : "POST",
      data : {
        fullname : fullname,
        email : email,
        password : password,
        username : username
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

  function updateAlamat(){
    $.ajax({
      url : "../process/updatealamat.php",
      type : "POST",
      data : $("#form_alamat").serialize(),
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

  $("#alamat").click(function(){
    $("#modal_update_alamat").modal('show');
  })

  $("#province").change(function(){
    var provinceId = $(this).val();
    var provinceName = $("#province option:selected").text();
    $("#province_name").val(provinceName);
    getCities(provinceId);
  })

  $("#city").change(function(){
    var cityId = $(this).val();
    var cityName = $("#city option:selected").text();
    $("#city_name").val(cityName);
    getDistricts(cityId);
  })

  $("#district").change(function(){
    var districtId = $(this).val();
    var districtName = $("#district option:selected").text();
    $("#district_name").val(districtName);
    getVillages(districtId);
  })

  $("#village").change(function(){
    var villageName = $("#village option:selected").text();
    $("#village_name").val(villageName);
  })


  function getProvince(){
        $.ajax({
            url : "http://dev.farizdotid.com/api/daerahindonesia/provinsi",
            type : "GET",
            success : function(data){
                if (data.provinsi.length > 0) {
                    var option = "";
                    for (let i = 0; i < data.provinsi.length; i++) {
                      selected = data.provinsi[i].nama == provinsi ? "selected" : "";
                      if (selected == "selected") {
                        getCities(data.provinsi[i].id)
                        $("#province_name").val(data.provinsi[i].nama);

                      }
                        option += "<option value='"+data.provinsi[i].id+"' "+selected+">"+data.provinsi[i].nama+"</option>";
                    }
                    $("#province").html(option);
                }
            }
          });
    }


  function getCities(provinceId){
        $.ajax({
            url : "http://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi="+provinceId,
            type : "GET",
            success : function(data){
                if (data.kota_kabupaten.length > 0) {
                    var option = "";
                    for (let i = 0; i < data.kota_kabupaten.length; i++) {
                        selected = data.kota_kabupaten[i].nama == kota ? "selected" : "";
                        if (selected == "selected") {
                        getDistricts(data.kota_kabupaten[i].id)
                        $("#city_name").val(data.kota_kabupaten[i].nama);
                        }
                        option += "<option value='"+data.kota_kabupaten[i].id+"' "+selected+">"+data.kota_kabupaten[i].nama+"</option>";
                    }
                    $("#city").html(option);

                }
            }
        })
    }

    function getDistricts(cityId){
        $.ajax({
            url : "http://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota="+cityId,
            type : "GET",
            success : function(data){
                if (data.kecamatan.length > 0) {
                    var option = "";
                    for (let i = 0; i < data.kecamatan.length; i++) {
                        selected = data.kecamatan[i].nama == kecamatan ? "selected" : "";
                        if (selected == "selected") {
                        getVillages(data.kecamatan[i].id)
                        $("#district_name").val(data.kecamatan[i].nama);
                        }
                        option += "<option value='"+data.kecamatan[i].id+"' "+selected+">"+data.kecamatan[i].nama+"</option>";
                    }
                    $("#district").html(option);
                }
            }
        })
    }

    function getVillages(districtId){
        $.ajax({
            url : "http://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan="+districtId,
            type : "GET",
            success : function(data){
                if (data.kelurahan.length > 0) {
                    var option = "";
                    for (let i = 0; i < data.kelurahan.length; i++) {
                        selected = data.kelurahan[i].nama == kelurahan ? "selected" : "";
                        if (selected == 'selected') {
                          $("#village_name").val(data.kelurahan[i].nama);
                        }

                        option += "<option value='"+data.kelurahan[i].id+"' "+selected+">"+data.kelurahan[i].nama+"</option>";
                    }
                    $("#village").html(option);
                }
            }
        })
    }
     
</script>
</html>
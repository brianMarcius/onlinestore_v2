<!DOCTYPE html>
<html lang="en">
<head>
  <title>Perwira Steel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/custom_bootstrap.css">
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="img/logo/logo1.png">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <style>
  
  .select2-selection{
    height:48px !important;
    border: 1px solid #ced4da !important;
  }

  .select2-selection__rendered{
    height:48px !important;
    padding: 8px 16px;
    color: #495057 !important;
  }
  
  </style>
</head>
<body>
   <section class="vh-200 bg-light">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5">
            <form id="form_register" name="form_register" action="">
            <h3 class="mb-5 text-center">Register</h3>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center">Data Diri</h4>
                    <div class="form-outline mb-4">
                      <input type="text"  class="form-control form-control-lg" id="username" name="username" placeholder="Username"/>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="text"  class="form-control form-control-lg" id="fullname" name="fullname" placeholder="Full name"/>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="email"  class="form-control form-control-lg" id="email" name="email" placeholder="Email"/>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="text"  class="form-control form-control-lg" id="telp" name="telp" placeholder="No Telp"/>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password"  class="form-control form-control-lg" id="password" name="pass" placeholder="Password"/>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password"  class="form-control form-control-lg" id="password1" name="confirm_pass" placeholder="Password Confirmation"/>
                    </div>
                </div>
                <div class="col-md-6">
                  <h4 class="text-center">Shipment</h4>
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
                        <textarea class="form-control" rows="5" placeholder="Alamat" name="alamat"></textarea>
                    </div>
                </div>
            </div>
            </form>

            <a class="btn btn-primary btn-lg btn-block text-white" id="signup">Sign Up</a>
            <a class="btn btn-light btn-lg btn-block" id="cancel" href="../index.php">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function(){
    getProvince();
    $("#province").select2();
    $("#city").select2();
    $("#district").select2();
    $("#village").select2();
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

  $("#login").click(function(){
    var email = $("#email").val();
    var pass = $("#password").val();
    login(email,pass);
  });

  $("#signup").click(function(){
    signUp();
  })

  var typingTimer;                //timer identifier
var doneTypingInterval = 1000;  //time in ms, 5 seconds for example
var $input = $('#password1');

//on keyup, start the countdown
$input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping () {
  confirmPass();
}

  function confirmPass(){
      var pass = $("#password").val();
      var pass1 = $("#password1").val();
      if (pass !== pass1) {
        Swal.fire({
              icon: 'error',
              title: 'Password tidak sama',
              text: 'Pastikan kembali password yang anda input',
              timer: 2000,
              showConfirmButton: false,
          }).then((result) => {
              $("#password1").focus();            
          })
      }
  }

  function login(email, pass){
    $.ajax({
      url : "process/login.php",
      type : "POST",
      data : {
        email : email,
        pass : pass
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
               document.location.href = "pages/home.php";
            
          })
        }else{
          Swal.fire({
              icon: 'error',
              title: response.title,
              text: response.message,
              timer: 2000,
              showConfirmButton: false,
          }).then((result) => {
              $("#email").focus();            
          })
        }
      }
    })
  }

  function getProvince(){
        $.ajax({
            url : "http://dev.farizdotid.com/api/daerahindonesia/provinsi",
            type : "GET",
            success : function(data){
                if (data.provinsi.length > 0) {
                    var option = "";
                    for (let i = 0; i < data.provinsi.length; i++) {
                        option += "<option value='"+data.provinsi[i].id+"'>"+data.provinsi[i].nama+"</option>";
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
                        option += "<option value='"+data.kota_kabupaten[i].id+"'>"+data.kota_kabupaten[i].nama+"</option>";
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
                        option += "<option value='"+data.kecamatan[i].id+"'>"+data.kecamatan[i].nama+"</option>";
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
                        option += "<option value='"+data.kelurahan[i].id+"'>"+data.kelurahan[i].nama+"</option>";
                    }
                    $("#village").html(option);
                }
            }
        })
    }
     
    function signUp(){
      var pass = $("#password").val();
      var pass1 = $("#password1").val();
      if (pass !== pass1) {
        Swal.fire({
              icon: 'error',
              title: 'Password tidak sama',
              text: 'Pastikan kembali password yang anda input',
              timer: 2000,
              showConfirmButton: false,
          }).then((result) => {
              $("#password1").focus();            
          })
      }else{
        $.ajax({
          url : "../process/signup.php",
          type : "POST",
          data : $("#form_register").serialize(),
          dataType : "JSON",
          success : function (response){
            if (response.code==200) {
              Swal.fire({
                  icon: 'success',
                  title: response.title,
                  text: response.message,
                  timer: 2000,
                  showConfirmButton : false
              }).then((result) => {
                  document.location.href = "../index.php";
                
              })
            }else{
              Swal.fire({
                  icon: 'error',
                  title: response.title,
                  text: response.message,
                  timer: 2000,
                  showConfirmButton: false,
              }).then((result) => {
                  $("#email").focus();            
              })
            }
          }
        })
      }
    }
</script>
</html>
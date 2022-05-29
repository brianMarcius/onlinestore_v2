<!DOCTYPE html>
<html lang="en">
<head>
  <title>Perwira Steel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom_bootstrap.css">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="img/logo/logo1.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>


  </style>
</head>
<body>
   <section class="vh-100 bg-light">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <div class="form-outline mb-4">
              <input type="email"  class="form-control form-control-lg" id="email" placeholder="Email"/>
            </div>

            <div class="form-outline mb-4">
              <input type="password"  class="form-control form-control-lg" id="password" placeholder="Password"/>
            </div>

            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-start mb-4">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
              <label class="form-check-label" for="form1Example3"> Remember password </label>
            </div>

            <a class="btn btn-primary btn-lg btn-block text-white" id="login">Login</a>
            <a class="btn btn-light btn-lg btn-block" href="pages/register.php">Register</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $("#login").click(function(){
    var email = $("#email").val();
    var pass = $("#password").val();
    login(email,pass);
  });

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
                if (response.data.level==1) {
                  document.location.href = "pages/admin_dashboard.php";                  
                }else{
                  document.location.href = "pages/home.php";
                }
            
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
</script>
</html>
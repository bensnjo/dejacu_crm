<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");

//access();

session_start();

if (isset($_POST['change'])){
    cp($_POST['password2'], $_POST['password'], $_POST['password1'], $_SESSION['username']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/devajuLogo.jpeg" rel="icon">
  <title>Dejavu Passwords</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                  <img style="width: 200px; height: 120px" src="img/devajuLogo.jpeg">
                    <!-- <img src="img/logo.png" > -->
                   <hr>

                   <?php
                   
                   if(count($errors)> 0){
                    echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    '.$errors[0].'
                  </div>
                    ';
                }
                   ?>
                    <h1 class="h4 text-gray-900 mb-4" style="color: red;">CHANGE PASSWORD</h1>
                    
                  </div>
                  <form class="user" action="" method="POST" onsubmit="return checkPasswords()">
                  <div class="form-group">
                      <input type="password" class="form-control" id="id_password"
                      placeholder="Old Password" name="password2" required>
                      <i class="far fa-eye" id="togglePassword" style="cursor: pointer"></i> 
                      <label class="">See password</label>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="pInput1" placeholder="New Password"
                       name="password" required>
                       <i class="far fa-eye" id="togglePassword1" style="cursor: pointer"></i> 
                      <label style="font-style: italic; font-size: 12px; color: red;">See password</label>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="pInput2" 
                      placeholder="Repeat Password" name="password1" required>
                      <i class="far fa-eye" id="togglePassword2" style="cursor: pointer"></i> 
                      <label style="font-style: italic; font-size: 12px; color: red;">See password</label>
                    </div>
                    
                    <div class="form-group">
                      <input type="submit" value="SUBMIT" class="btn btn-danger btn-block" name="change">
                    </div>
                    <hr>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });

    const togglePassword1 = document.querySelector('#togglePassword1');
    const password1 = document.querySelector('#pInput1');

    togglePassword1.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
      password1.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });

    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#pInput2');

    togglePassword2.addEventListener('click', function(e) {
      // toggle the type attribute
      const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
      password2.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
  </script>
<script>

 function checkPasswords(){

    if(document.getElementById("pInput1").value != document.getElementById("pInput2").value){
      alert("Passwords do not match");
      return false;
    }
    return true;
  }

</script>  


</html>
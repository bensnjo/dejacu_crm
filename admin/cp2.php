<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");

session_start();

$succcess = null;

if (isset($_POST['change'])){
    cp2($_POST['otp'], $_POST['password'], $_POST['password1'], $_SESSION['userhold']);
}


if(isset($GLOBALS['rPassword'])){
  $succcess = $GLOBALS['rPassword'];
  unset($GLOBALS['rPassword']);
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
  <title>Dejavu Change Password</title>
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
                  <img style="width: 100px; height: 100px" src="img/logo.png" >
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


                if(isset($succcess)){
                  echo  '<div class="alert alert-success alert-dismissible fade show ml-4 mr-4" des$designation="alert">
                  '.$succcess.'
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
      
      
                echo'<script>
                setTimeout(()=>{
                  window.open("../main/login.php", "_self");
                }, 2000)
               
               </script>';
      
                 }

                   ?>
                    <h1 class="h4 text-gray-900 mb-4">CHANGE PASSWORD</h1>
                    <p>Enter the OTP Sent to your Phone Number</p>
                    
                  </div>
                  <form class="user" action="" method="POST" onsubmit="return checkPasswords()">
                  <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputPassword" placeholder="Enter OTP" name="otp" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="pInput1" placeholder="New Password" name="password" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="pInput2" placeholder="Repeat Password" name="password1" required>
                    </div>
                    
                    <div class="form-group">
                      <input type="submit" value ="SUMIT PASSWORD" class="btn btn-primary btn-block" name="change">
                    </div>
                    <hr>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="/crm/main/login.php">Login </a>
                  </div>
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

function checkPasswords(){
    if(document.getElementById("pInput1").value != document.getElementById("pInput2").value){
      alert("Passwords do not match");
      return false;
    }
    return true;
  }

</script>  

</html>
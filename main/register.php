
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");

header("location:logout.php");

$succcess = null;

if (isset($_POST['register'])){
    register();

    if(isset($_SESSION['registerSucc'])){
      $succcess = $_SESSION['registerSucc'];

      unset($_SESSION['registerSucc']);
    }
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
  <title>Dejavu Register</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                  <img style= "width: 100px; height: 100px;" src="img/logo.png" >
                   <hr>
        
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
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
                      window.open("/crm/main/teams.php", "_self");
                    }, 2000)
                   
                   </script>';
          
                     }
                   ?>

                  </div>
                  <form action="" method="POST">
                    <div class="form-group">
                      <label>STAFF No</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" 
                      placeholder="Enter Staff No" name="username" required>
                    </div>
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="exampleInputLastName" 
                      placeholder="Enter Full Name" name="fullname" required>
                    </div>
                    <div class="form-group">
                      <label>Mobile No</label>
                      <input type="text" class="form-control" id="exampleInputEmail" pattern = "[0-9]{10,12}"
                        placeholder="Enter Mobile No" name = "telephone" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" name = "email" required>
                    </div>
                    <div class="form-group">
                      <label>Department</label>
                      <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter your Department" name = "department">
                    </div>
                    <div class="form-group">
                    <label class="label label-danger">SELECT YOUR POSITION</label>
                        <select name="position" id="color" required>
                          <option value="3">OFFICER</option>
                          <option value="4">SUPERVISOR</option>
                          <option value="5" >ASSISTANT MANAGER</option>
                          <option value="6" >MANAGER</option>
                          <option value="7" >CHEIF MANAGER</option> 
                        </select>
                    </div>

                    <!-- <div class="form-group">
                    <label class="label label-danger">SELECT YOUR TEAM</label>
                        <select name="teams" id="color" required>
                          <option value="dtd">DTD</option>
                          <option value="customs">CUSTOMS</option>
                          <option value="css" >CSS</option>
                          <option value="ntsa" >NTSA</option>
                          <option value="reporting" >REPORTING</option> 
                        </select>
                    </div> -->
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password_1">
                    </div>
                    <div class="form-group">
                      <label>Repeat Password</label>
                      <input type="password" class="form-control" id="exampleInputPasswordRepeat"
                        placeholder="Repeat Password" name="password_2">
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="register" >Register</button>
                    </div>
                    <hr>
                    
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="login.php">Already have an account?</a>
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
  <!-- Register Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
</html>
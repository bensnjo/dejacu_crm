
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
require_once($_SERVER['DOCUMENT_ROOT'].'/crm/smail.php');

session_start();
access();
//admin();
$succcess = null;
if (isset($_POST['register'])){
    register();
    if(isset($_SESSION['registerSucc'])){
      $succcess = $_SESSION['registerSucc'];
      unset($_SESSION['registerSucc']);
      $newData = $_SESSION['registeredUser'];

    #Newton -- Send email To added Use with details ##endregion
    $mail = "Dear ".$newData['name'].", Account Created. Use the following credentials to log in:
          \n Username: ".$newData['username']." \nPassword: ".$newData['password']."www.dejavu.co.ke/crm";
    send_mail_by_PHPMailer($newData['email'], 'Account creation',$mail);

    unset($_SESSION['registeredUser']);


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
  <title>Dejavu Users</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
      include('sidebar.php');
    ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php
         include('topbar.php');
        ?>

  <!-- Register Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-11 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
        
                    <h1 class="h4 text-gray-900 mb-4">Create New User</h1>
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
                    window.open("/crm/admin/editusers.php", "_self");
                  }, 1000)
                 
                 </script>';
                     }
                   ?>
                  </div>
                 <!-- content -->
                 <div class="card col-xl-12 col-md-12 mb-4 p-5">
              <form method="POST">
           + New user
          </form> 
                <hr> <form action="" method="POST" class="p-4">
                  <div class="row">
                  <div class="col">
                  <div class="form-group">
                      <label>USERNAME</label>
                      <input type="text" class="form-control" id="exampleInputFirstName"
                       placeholder="username" name="username" required>
                    </div>
                    </div>
                  <div class="col">
                  <div class="form-group">
                      <label>FULL NAME</label>
                      <input type="text" class="form-control" id="exampleInputLastName"
                       placeholder="Enter Full Name" name="fullname" required>
                    </div>
                    </div>
                    </div>

                <div class="row">
                      <div class="col">
                      <div class="form-group">
                      <label>MOBILE NO.</label>
                      <input type="text" class="form-control" id="exampleInputEmail" pattern = "[0-9]{10,12}"
                        placeholder="Enter Mobile No" name = "telephone">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <label>EMAIL</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" name = "email" required>
                    </div>
                    </div>
                    </div>

                    <div class="row">
                      <div class="col">
                      <div class="form-group">
                    <?php 
                    $db = getConnection();
                    $query = "SELECT * FROM `departments`";
                    $dpts = mysqli_query($db, $query);?>                                  
                    
                      <label>SELECT DEPARTMENT</label>
                      <select name="department" id="color2" class="form-control" id="exampleInputEmail" required >
                        <?php 
                           foreach($dpts as $dpt){
                             echo '<option>'.$dpt['name'].'</option>';
                           }
                        ?>
                      </select>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                    <label class="label label-danger">SELECT POSITION</label>
                        <select name="position" id="color" class="form-control" id="exampleInputEmail" required>
                          <option value="3">Officer</option>
                          <option value="4">Head of Department</option>
                          <option value="5" >Assistant Manager</option>
                          <option value="6" >Manager</option>
                          <option value="7" >Director</option> 
                        </select>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                      <div class="col">
                      <div class="form-group">
                    <?php 
                    $db = getConnection();
                    $query = "SELECT * FROM `teams`";
                    $teams = mysqli_query($db, $query);
                    $db->close();
                    ?>
                      <label>SELECT TEAM</label>
                      <select name="teams" id="color2"class="form-control" id="exampleInputEmail"  required>
                        <?php 
                           foreach($teams as $team){
                             echo '<option>'.$team['teamName'].'</option>';
                           }
                        ?>
                      </select>
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block" name="register" >Create user</button>
                    </div>

                    <hr> 
        </form>
        </div>
   
                <!-- content ends -->
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

  </div>
  </div>
  </div>
  
</body>
</html>

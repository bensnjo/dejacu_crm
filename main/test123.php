
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();


if(isset($_REQUEST['user'])){

if (isset($_POST['editPP'])){
    update();
}

$succcess = null;

if(isset($_SESSION['successUp']) && $_SESSION['successUp'] == "Profile updated success"){
    $succcess = "Profile updated success";
  
    unset($_SESSION['successUp']);
  }

  $uid = $_REQUEST['user'];
  $user = getUser($uid);
 $GLOBALS['usere'] = $user['username'];

}

$user = getUser($_SESSION['username']);

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
  <title>Dejavu Profile</title>>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">

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
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
 
                   <hr>
        
                    <h1 class="h4 text-gray-900 mb-4">Profile</h1>
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
                      window.open("/crm/admin/index.php", "_self");
                    }, 2000)
                   
                   </script>';
                }

                   ?>

                  </div>
                  <form action="" method="POST">
                    <div class="form-group">
                      <label>STAFF No</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" 
                       placeholder="Enter Staff No" name="username" value="<?php echo($user['username']); ?>" required readonly>
                    </div>
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="exampleInputLastName" 
                      placeholder="Enter Full Name" name="fullname" value="<?php echo($user['full_names']); ?>" required readonly>
                    </div>
                    <div class="form-group">
                      <label>Mobile No</label>
                      <input type="text" class="form-control" id="exampleInputEmail" pattern = "[0-9]{10,12}"
                        placeholder="Enter Mobile No" name = "telephone" value="<?php echo($user['mobile_phone']); ?>" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address" name = "email" value="<?php echo($user['email_addr']); ?>" required readonly>
                    </div>
                    <div class="form-group">
                      <label>Department</label>
                      <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter your Department" name = "department" value="<?php echo($user['department']); ?>" required readonly>
                    </div>
                    <div class="form-group">
                    <label class="label label-danger">Position</label>
                           <?php $posit = "" ;
                             if($user['grade']=='3'){ $posit = 'OFFICER'; }
                             if($user['grade']=='4'){ $posit = 'SUPERVISOR';} 
                             if($user['grade']=='5'){ $posit = 'ASSISTANT MANAGER'; } 
                             if($user['grade']=='6'){ $posit = 'MANAGER';} 
                             if($user['grade']=='7'){ $posit= 'CHEIF MANAGER';} ?> 


                        <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter your Position" name = "position" value="<?php echo $posit ; ?>" required readonly>
                    </div>

                    <div class="form-group">
                    <label class="label label-danger"> YOUR TEAM</label>
                    <div style="display: flex">
                    <input type="text" class="form-control" style="width: 200px;margin-right:20px" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter your Department" name = "teams" value="<?php echo($user['team']); ?>" required readonly>
                        <a href="teams2.php?user=<?php echo $user['username']?>"  class="btn btn-primary">Change Team</a>
                        <!-- fff -->
                    </div> 
                    </div>
                    <div class="form-group">
                    <label class="label label-danger">STATUS</label>
                        <select name="status" id="color" required readonly>
                          <option <?php if($user['status']=='Active'){echo 'selected';} ?> value="Active">Active</option>
                          <option <?php if($user['status']=='Closed'){echo 'selected';}?> value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="editPP" >Update</button>
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
  <!-- Register Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>
</html>

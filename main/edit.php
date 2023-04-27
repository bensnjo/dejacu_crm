<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

if(isset($_REQUEST['id'])){
$db =  getConnection();   

 $id = $_REQUEST['id'];   
$query1 = "SELECT * FROM `customers` WHERE `id` = $id";
$subject = mysqli_query($db,$query1);
$subject = mysqli_fetch_assoc($subject);


$email = $subject['email'];
$pin = $subject['pin'];
$idNo = $subject['idNo'];
$tell = $subject['tell'];
$firstname = $subject['firstName'];
$middlename = $subject['middleName'];
$lastname = $subject['lastName'];

//echo $name;

if(isset($_POST['edit'])){

  $email = $_POST['email'];
  $pin = $_POST['pin'];
  $idNo = $_POST['idNo'];
  $tell = $_POST['tel'];
  $firstname = $_POST['firstname'];
  $middlename = $_POST['middlename'];
  $lastname = $_POST['lastname'];
    //echo $name;
  $user = $_SESSION['username'];
    

//Check if user exist with same email
$userExist = [];
if($subject['email'] != $email){

  $qury1 = "SELECT * FROM `customers` WHERE `email`= '$email'";
  $res = mysqli_query($db,$qury1);
  
  $userExist = mysqli_fetch_assoc($res);
  }
  
  if(count($userExist) > 0){
    $error = "The Email address Is already in use";
  }else{
  
  $query2 = "UPDATE `customers` SET `idNo`='$idNo',`pin`='$pin',
  `tell`='$tell',`firstName`='$firstname',`middleName`='$middlename',`lastName`='$lastname',`email`='$email' WHERE id = '$id'";
  mysqli_query($db,$query2);
  
   // audit trail
  
   $ip = getip();
   $t = time();
   
    $d = date("Y-m-d G:i:s",$t);
  
   $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
   VALUES('$user','$d', 'edit_customer', 'success', '$firstname', '$ip')";
   mysqli_query($db, $audit);
   $succcess = "Customer updated succcess";
  }
  
  
  
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
  <title>Dejavu Customers</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    .dev {justify-content: center;
      align-items: center;
      width: 100%;
      min-height: 100%;
      background: url("/uploads/media/default/0001/01/49bff73f282c2c21f3341f1fe457fe35337b1792.jpeg") no-repeat center;
      background-size: cover;}
  </style>
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
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit customer</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">DataTables</li>
            </ol>
          </div>


          <?php
                   
                   if(isset($error)){
                    echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    '.$error.'
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
            window.open("/crm/admin/vcustomers.php", "_self");
          }, 2000)
         
         </script>';

           }


                   ?>

          <!-- PUT YOUR CODE HERE -->
          <div class= "dev" style = "background-color: #4dd0e1CC; padding: 10px; border-radius: 10px; min-height: 200px; margin: 20px; display: flex; justify-content: center;">
          <div class= "card col-lg-8" >
          <form action="" method="POST">
          <div class="form-group">
                      <label>CUSTOMER PIN</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" pattern = "[A-Z]{1}[0-9]{9,}[A-Z]{1}"
                       placeholder="Enter customer's pin" name="pin"  value= "<?php print $pin;?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>ID NO</label>
                      <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="id number" name = "idNo" value= "<?php print $idNo;?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>MOBILE NO</label>
                      <input type="text" class="form-control" id="exampleInputEmail" pattern = "[0-9]{10,12}"
                        placeholder="Enter Mobile No" name = "tel" value= "<?php print $tell;?>" required>
                    </div>
                    <div class="form-group">
                      <label>FIRST NAME</label>
                      <input type="text" class="form-control" id="exampleInputLastName" placeholder="Enter First Name" name="firstname"
                      value= "<?php print $firstname;?>">
                    </div>
                    
                   
                    <div class="form-group">
                      <label>MIDDLE NAME</label>
                      <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Middle" name = "middlename" value= "<?php print $middlename;?>">
                    </div>
                    
                    <div class="form-group">
                      <label>LAST NAME</label>
                      <input type="text" class="form-control" id="exampleInputPassword" placeholder="Enter Last Name" name="lastname" value= "<?php print $lastname;?>">
                    </div>

                    <div class="form-group">
                      <label>EMAIL</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter email" name = "email" value= "<?php print $email;?>">
                   
                        <hr>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="edit" >SAVE CHANGES</button>
                    </div>

                    <hr>
                  </form>

            
</div>
</div>









          <!-- YOUR CODE ENDS HERE -->
         
          </div>
          <!--Row-->

          <!-- Documentation Link -->
          <div class="row">
            <div class="col-lg-12">
              
            </div>
          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <?php
        //include('footer.php');
      ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>
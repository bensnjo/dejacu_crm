<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();
access();
$db = getConnection();
$succcess = null;

$existingCust = [];

if(isset($_POST['searchQ'])){
 $sq = $_POST['searchQ'];

 $db = getConnection();
 $query = "SELECT * FROM `customers` WHERE `idNo` = '$sq' OR `pin` = '$sq' OR `email`= '$sq'";
 $res = mysqli_query($db, $query);
 $existingCust = mysqli_fetch_assoc($res);

 if(count($existingCust)> 0){
   $_SESSION['isExisting'] = true;
 }else{
   $existingCust = null;
 }
}
if (isset($_POST['addjobcard'])){
  regjobcard();
  //
    //admit($_SESSION['memberNo'],$_POST['temp']);

  unset($_SESSION['isExisting']);  unset($_POST['searchQ']);
}
if(isset($_SESSION['iaddition'])){
  $succcess = $_SESSION['iaddition'];

  unset($_SESSION['iaddition']);
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
  <title>Dejavu Job cards</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">Add Job Card</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Job cards</li>
              <li class="breadcrumb-item active" aria-current="page">Add Job Card</li>
            </ol>
          </div>

          <!-- PUT YOUR CODE HERE -->
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
                    window.open("/crm/main/mainjobcards.php", "_self");
                  }, 4000)
                 
                 </script>';
      
                 }
                   ?>

<div class="card col-xl-12 col-md-12 mb-4 p-5">
          <form method="POST">
            <h4>New Job Card</h4>
          </form> 
                <hr> <form action="" method="POST" class="p-4" name="equipment">
                  <div class="row">

                    <div class="col">
                    <div class="form-group">
                      <label>CUSTOMER NAME</label>
                      <input type="text" class="form-control" id="exampleInputFirstName"
                      placeholder="Customer Name" name="cusName">
                    </div>
                    </div>

                    <div class="col">
                    <div class="form-group">
                      <label>MOBILE NUMBER</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        placeholder="Mobile Number" name = "mobileNumber" required value= "">
                    </div>
                    </div>

                    <div class="col">
                    <div class="form-group">
                      <label>EMAIL</label>
                      <input type="text" class="form-control" id="exampleInputLastName" 
                      placeholder="Email" name="email" value= "">
                    </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                      <label>EQUIPMENT</label>
                      <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Name" name="equipment" required value= "">
                    </div>
                    </div>

                    
                    <div class="col">
                    <div class="form-group">
                    <label>CHARGER</label>
                    <input class="form-control" type="checkbox" name="charger" value="" id="flexCheckChecked" checked>
                    </div>
                    </div>
                    
                    <div class="col">
                    <div class="form-group">
                      <label>QTY</label>
                      <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Qty" name="qty" required value= "">
                    </div>
                    </div>
                    
                    <div class="col">
                    <div class="form-group">
                      <label>MODEL</label>
                      <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Model" name="modelseq" required value= "">
                    </div>
                    </div>
                    
                    <div class="col">
                    <div class="form-group">
                      <label>SERIAL NUMBER</label>
                      <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Serial Number" name="serialNumber" required value= "">
                    </div>
                    </div>
                    <span><button class=" btn-primary">+</button></span>
                    <table id="tbl" class="table" >
                      <tbody>
                      </tbody>
                     </table>
                  </div>
                  <div class="row">
                    <div class="col">
                    <div class="form-group">
                      <label>FAULT DESCRIPTION</label>
                      <textarea type="text" class="form-control" id="exampleInputPasswordRepeat"
                         name="fault" required></textarea>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <label>WORK DONE</label>
                      <textarea type="text" class="form-control" id="exampleInputPasswordRepeat"
                         name="workdone" ></textarea>
                    </div>
                    </div>

                  </div>
                  <div class="form-group">
                    <label class="label label-danger">TECHNICIAN ASSIGNED</label>
                    <select name="technician" class="form-control" id="exampleInputPassword">
                      <option>Select</option>
                              <?php
                                $query = "SELECT * FROM `users` WHERE `team`='Technical Support'";
                                $result = mysqli_query($db,$query);
                                  foreach($result as $row)  {                                          
                                  echo "<option value='".$row['full_names']."'>".$row['full_names']."</option>";
                                  }
                              ?>
                  
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block" name="addjobcard" >ADD JOB CARD</button>
                    </div>
          <hr> 
        </form>
        </div>
   
          <!-- YOUR CODE ENDS HERE -->
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
  <script type="text/javascript">
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    }); 

       </script>

</body>

</html>

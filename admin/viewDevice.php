<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();
$username= $_SESSION['username'] ;
access();

if(isset($_REQUEST['id'])){
$db =  getConnection();   
$status='';
 $id = $_REQUEST['id'];   
$query1 = "SELECT * FROM `devices` WHERE `id` = $id";
$subject = mysqli_query($db,$query1);
$subject = mysqli_fetch_assoc($subject);

$status_old = $subject['status'];
$serialNumber=$subject['serialNumber'];
//echo $name;

if(isset($_POST['edit'])){

  $status = $_POST['status'];

$query2 = "UPDATE `devices` SET `status`='$status'  WHERE id = '$id'";
mysqli_query($db,$query2);

 // audit trail

 $ip = getip();
 $t = time();
$d = date("Y-m-d G:i:s",$t);

 $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
 VALUES('$username','$d', 'edit_Device', 'success', '$serialNumber', '$ip')";
 mysqli_query($db, $audit);
 $succcess = "device updated succcessfully";

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
  <title>Dejavu Devices</title>
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
            <h1 class="h3 mb-0 text-gray-800">Edit Device Status</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Device</li>
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
            window.open("/crm/admin/allDevices.php", "_self");
          }, 2000)
         
         </script>';

           }


                   ?>

          <!-- PUT YOUR CODE HERE -->
          <div class= "dev">
          <div class= "card col-lg-8" >
          <form action="" method="POST">
          <div class="form-group">
                      
                    
                    <div class="form-group">
                      <label>Device Status</label>
                      <select name="status" class="form-control" id="exampleInputPassword">
                          <option value="<?php print $status_old;?>"><?php print $status_old;?></option>
                          <option value="Active">Active</option>
                          <option value="Disabled">Disabled</option>
                      </select>
                    </div>
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
       include('footer.php');
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
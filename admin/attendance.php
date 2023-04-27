<?php
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/service.php");
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/access.php");

access();

$attendance = attendance();
$service = getService();
$absentee = absentee();
$visitors = getvisitors();

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
  <title>Dejavu Attendance</title>
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
            <h1 class="h3 mb-0 text-gray-800">List of Attendees .<?PHP echo $service; ?></h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Services</li>
              <li class="breadcrumb-item active" aria-current="page">View Attendance</li>
            </ol>
          </div>

          <!-- PUT YOUR CODE HERE -->

          <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>MEMBER NO</th>
                        <th>CONTACT</th>
                        <th>RESIDENCE</th>
                        <th>TEMPRATURE</th>
                        <th>TIME</th>
                        
                      </tr>
                    </thead>
                    
                    <?php
                    foreach($attendance as $members) { ?>
                        <tr>
                        <th><?php echo($members['id']);?></th>
                        <th><?php echo($members['name']);?></th>
                        <th><?php echo($members['memberNo']);?></th> 
                        <th><?php echo($members['contact']);?></th>
                        <th><?php echo($members['residence']);?></th>
                        <th><?php echo($members['temperature']);?></th> 
                        <th><?php echo($members['time']);?></th> 
                        </tr>
                   <?php } ?>
                  
                </table>
                </div>

        <!--- absentee table -->

        




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
       // include('footer.php');
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
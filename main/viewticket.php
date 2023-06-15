<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/access.php");
session_start();
access();
$db = getConnection();
$succcess = null;
if(isset($_REQUEST['id'])){
  $db =  getConnection();   
   $id = $_REQUEST['id'];   
  $query1 = "SELECT * FROM `insidence` WHERE `id`= $id";
  $subject1 = mysqli_query($db,$query1);
  $subject = mysqli_fetch_assoc($subject1);
  $ticktno=$subject['ticketNumber'];
  $customer=$subject['cusName'];
  $mobilenum=$subject['mobileNumber'];
  $businame=$subject['businessName'];
  $serialnum=$subject['serialNumber'];
  $sourcetype=$subject['source'];
  $devicestatus=$subject['dStatus'];
  $priority=$subject['priority'];
  $assigned=$subject['AssignedTo'];
  $ticktdesc=$subject['complain'];
  $ticktresolve=$subject['status'];
 
if (isset($_POST['close'])) {
  header("location: /crm/main/resoltickets.php");
}
if (isset($_SESSION['iaddition'])) {
  $succcess = $_SESSION['iaddition'];

  unset($_SESSION['iaddition']);
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
  <title>Dejavu Tickets</title>
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
            <h1 class="h3 mb-0 text-gray-800" style="color: #cc0000;">Resolved Ticket</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tickets</li>
              <li class="breadcrumb-item active" aria-current="page">Resolved Ticket</li>
            </ol>
          </div>

          <!-- PUT YOUR CODE HERE -->
          <?php
          if (count($errors) > 0) {
            echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ' . $errors[0] . '
                  </div>
                    ';
          }

          if (isset($succcess)) {
            echo  '<div class="alert alert-success alert-dismissible fade show ml-4 mr-4" des$designation="alert">
                  ' . $succcess . '
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';


            echo '<script>
                  setTimeout(()=>{
                    window.open("/crm/main/mytickets.php", "_self");
                  }, 500)
                 
                 </script>';
          }
          ?>

          <div class="card col-xl-12 col-md-12 mb-4 p-5">
            <form method="POST">
              <div>
                <h2 class="h3 mb-0 text-gray-800" style="color: #cc0000;">Resolved Ticket <?php echo $ticktno;?></h2>
              </div>
            </form>
            <hr>
            <form action="" method="POST" class="p-4">
              <div class="form-group row">
                <div class="col">
                  <div class="form-group">
                    <label>CUSTOMER NAME</label>
                    <input type="text" class="form-control" id="exampleInputFirstName" name="cusName" style="color: #cc0000;" value="<?php  echo $customer; ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>MOBILE NUMBER</label>
                    <input type="text" class="form-control" id="exampleInputEmail" pattern="[0-9]{10,12}" style="color: #cc0000;" placeholder="Mobile Number" name="mobileNumber" required value="<?php echo $mobilenum; ?>">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <div class="form-group">
                    <label>BUSINESS NAME</label>
                    <input type="text" class="form-control" id="exampleInputLastName" style="color: #cc0000;" placeholder="Business Name" name="businessName" value="<?php echo $businame; ?>">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label>SERIAL NUMBER</label>
                    <input type="text" class="form-control" id="exampleInputPassword" style="color: #cc0000;" placeholder="Device Serial Number" name="serialNumber" required value="<?php  echo $serialnum; ?>">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <div class="form-group">
                    <label class="label label-danger">SOURCE TYPE</label>
                    <select name="source" class="form-control" id="exampleInputPassword" style="color: #cc0000;">
                      <option selected value="<?php echo $sourcetype; ?>"><?php echo $sourcetype; ?></option>
                      <option value="TELEPHONE">TELEPHONE</option>
                      <option value="WALK IN">WALK IN</option>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label class="label label-danger">DEVICE STATUS</label>
                    <select name="dStatus" class="form-control" id="exampleInputPassword" style="color: #cc0000;">
                    <option selected value="<?php echo $devicestatus; ?>"><?php echo $devicestatus; ?></option>
                      <option value="BOOKED IN">BOOKED IN</option>
                      <option value="NOT BOOKED IN">NOT BOOKED IN</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class=" form-group row">
                <div class="col">
                  <div class="form-group">
                    <label class="label label-danger">PRIORITY</label>
                    <select name="priority" class="form-control" id="exampleInputPassword" style="color: #cc0000;">
                    <option selected value="<?php echo $priority; ?>"><?php echo $priority; ?></option>
                      <option value="HIGH">HIGH</option>
                      <option value="MEDIUM">MEDIUM</option>
                      <option value="LOW">LOW</option>
                    </select>
                  </div>

                </div>
                <div class="col">
                  <div class="form-group">
                    <label class="label label-danger">ASSIGNED</label>
                    <select name="assigned" class="form-control" id="exampleInputPassword" style="color: #cc0000;">
                    <option selected value="<?php echo $assigned; ?>"><?php echo $assigned; ?></option>
                      <?php
                      $query = "SELECT * FROM `users`";
                      $result = mysqli_query($db, $query);
                      foreach ($result as $row) {
                        echo "<option value='" . $row['full_names'] . "'>" . $row['full_names'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-10">
                  <div class="form-group">
                    <label>TICKET DESCRIPTION</label>
                    <textarea type="text" class="form-control" id="exampleInputPasswordRepeat" style="color: #cc0000;" name="complain" rows="3" required><?php echo  $ticktdesc; ?></textarea>
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label>TICKET RESEOLVED</label>
                    <select name="resolved" class="form-control" id="exampleInputPassword" style="color: #cc0000;" required>
                    <option selected value="<?php echo $ticktresolve;?>"><?php echo $ticktresolve; ?></option>
                      <option value="OPEN" >OPEN</option>
                      <option value="CLOSED">CLOSED</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-danger btn-block" name="close">CLOSE VIEW</button>
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
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
    $(document).ready(function() {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>
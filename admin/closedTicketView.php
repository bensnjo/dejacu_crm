<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

$db = getConnection();
//$members = allTickets();

if (isset($_REQUEST['id'])){
    
    $id = $_REQUEST['id'];
    $query2 = "SELECT * FROM insidence WHERE id = '$id'";
    $result1 = mysqli_query($db, $query2);
    $result1 = mysqli_fetch_assoc($result1);

    $Datecreated = $result1['dateCreated'];
    $ticketNumber = $result1['ticketNumber'];
    $cusname = $result1['cusName'];
    $mobileNumber =  $result1['mobileNumber'];
    $businessName =  $result1['businessName'];
    $serialNumber =  $result1['serialNumber'];
    $deviceStatus =  $result1['dStatus'];
    $Complain =  $result1['complain'];
    $status =  $result1['status'];
    $AssignedTo =  $result1['AssignedTo'];
    $comment= $result1['ticketComment'];
    $child = childTickets($ticketNumber);
// 
}
if (isset($_POST['close'])){
  header("Location: resoltickets.php");
  exit();
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
            <h1 class="h3 mb-0 text-gray-800">View Resolved Ticket</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tickets</li>
              <li class="breadcrumb-item active" aria-current="page">Resolved Ticket</li>
            </ol>
          </div>

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
                    window.open("/crm/admin/cticket.php", "_self");
                  }, 1000)
                 
                 </script>';
      
                 }
                   ?>

<div class="card col-xl-12 col-md-12 mb-4 p-5">

          <form action="" method="POST" class="p-4">
                    <div class="row">
                      <div class="col">
                    <div class="form-group">
                      <label>CUSTOMER NAME</label>
                      <input type="text" class="form-control" id="exampleInputFirstName"
                      placeholder="Customer Name" name="cusName" value= "<?php echo $cusname; ?>" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                      <label>TICKET NUMBER</label>
                      <input type="text" class="form-control" id="exampleInputEmail"  
                        placeholder="Ticket Number" name = "ticketNumber" required value= "<?php echo $ticketNumber; ?>" readonly>
                </div>
                </div>
                <div class="col">
                    <div class="form-group">
                      <label>DATE CREATED</label>
                      <input type="text" class="form-control" id="exampleInputEmail" pattern = "[0-9]{10,12}" 
                        placeholder="Mobile Number" name = "mobileNumber" required value= "<?php  echo  substr($Datecreated,0,-10); ?>" readonly>
                </div>
                </div>
                </div>
                <div class="row">
                      <div class="col">
                    <div class="form-group">
                      <label>BUSINESS NAME</label>
                      <input type="text" class="form-control" id="exampleInputLastName" 
                      placeholder="Business Name" name="businessName" value= "<?php echo $businessName; ?>" readonly>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <label>MOBILE NUMBER</label>
                      <input type="text" class="form-control" id="exampleInputLastName" 
                      placeholder="Mobile Number" name="mobileNumber" value= "<?php echo $mobileNumber; ?>" readonly>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <label>SERIAL NUMBER</label>
                      <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Device Serial Number" name="serialNumber" value= "<?php echo $serialNumber;?>" readonly >
                    </div>
                    </div>
                    </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label class="label label-danger">DEVICE STATUS</label>
                        <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Device Serial Number" name="serialNumber" value= "<?php echo $deviceStatus;?>" readonly>
                    </div>
                  </div>

                    <div class="col">
                      <div class="form-group">
                          <label class="label label-danger">TICKET STATUS</label>
                          <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Device Serial Number" name="serialNumber" value= "<?php echo $status;?>" readonly>
                          
                      </div>
                    </div>
                      <div class="col">
                          <div class="form-group">
                              <label class="label label-danger">ASSIGNED</label>
                              <input type="text" class="form-control" id="exampleInputPassword" 
                      placeholder="Device Serial Number" name="serialNumber" value= "<?php echo $AssignedTo;?>" readonly>
                              
                          </div>
                        </div>


                  </div>
                  <div>
                    <div> 
                      <div class="form-group">
                      <label>Description</label>
                      <textarea type="text" class="form-control" id="exampleInputPassword" 
                       name="description" readonly><?php echo $Complain;?></textarea>
                    </div>
                    </div>
                    <div> 
                      <div class="form-group">
                      <label>ADD COMMENT</label>
                      <textarea type="text" class="form-control" id="exampleInputPassword" 
                       name="description1" readonly><?php echo  $comment; ?></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block" name="close" >CLOSE</button>
                    
                    </div>

                  </div>
                    </div>
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

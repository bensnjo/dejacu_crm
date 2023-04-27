<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/access.php");
session_start();

access();

if (isset($_REQUEST['id'])) {
  $db =  getConnection();

  $id = $_REQUEST['id'];
  $query1 = "SELECT * FROM `customers` WHERE `id` = $id";
  $subject = mysqli_query($db, $query1);
  $subject = mysqli_fetch_assoc($subject);
  //`id`, `dateCreated`, ``, ``, 
  //`phoneNumber`, `cusName`, ``, ``, `county`, `email`, `createdBy`

  $idNumber = $subject['idNumber'];
  $pin = $subject['pin'];
  $phoneNumber = $subject['phoneNumber'];
  $cusName = $subject['cusName'];
  $businessName = $subject['businessName'];
  $businessAddress = $subject['businessAddress'];
  $county = $subject['county'];
  $email = $subject['email'];

  //echo $name;

  if (isset($_POST['edit'])) {

    $idNumber = $_POST['idNumber'];
    $pin = $_POST['pin'];
    $phoneNumber = $_POST['phoneNumber'];
    $cusName1 = $_POST['cusNametxt'];
    $businessName = $_POST['businessName'];
    $county = $_POST['county'];
    $businessAddress = $_POST['businessAddress'];
    $email = $_POST['email'];
    //echo $name;
    $user = $_SESSION['username'];

    //Check if user exist with same email
    $userExist = [];
    if ($subject['email'] != $email) {

      $qury1 = "SELECT * FROM `customers` WHERE `email`= '$email'";
      $res = mysqli_query($db, $qury1);

      $userExist = mysqli_fetch_assoc($res);
    }

    if (count($userExist) > 0) {
      $error = "The Email address Is already in use";
    } else {

      $query2 = "UPDATE `customers` SET `idNumber`='$idNumber',`pin`='$pin',
`phoneNumber`='$phoneNumber',`cusName`='$cusName1',`businessName`='$businessName',
`businessAddress`='$businessAddress',`county`='$county',`email`='$email' WHERE `id`=$id";
      mysqli_query($db, $query2);

      // audit trail

      $ip = getip();
      $t = time();

      $d = date("Y-m-d G:i:s", $t);

      $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
 VALUES('$user','$d', 'edit_customer', 'success', '$pin', '$ip')";
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
  <title>Dejavu Customer</title>
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
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit customer</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Customers</li>
              <li class="breadcrumb-item active" aria-current="page">EditCustomer</li>
            </ol>
          </div>


          <?php

          if (isset($error)) {
            echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    ' . $error . '
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
            window.open("/crm/admin/vcustomers.php", "_self");
          }, 2000)
         
         </script>';
          }


          ?>

          <!-- PUT YOUR CODE HERE -->

          <div class="card col-xl-12 col-md-12 mb-4 p-5">
          <div class="card col-xl-12 col-md-12 mb-4 p-5">
          <div class="col-lg-12">
              <div class="mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary"> Edit Customer</h4>
                  <hr>
                  </div>
                </div>
                </div>

            <form action="" method="POST">
            <div class="row">
            <div class="col">
              <div class="form-group">
                <label>NAME</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Customer Name" name="cusNametxt" value="<?php echo $cusName ?>" required>
              </div>
              </div>
              
            <div class="col">
              <div class="form-group">
                <label>KRA PIN</label>
                <input type="text" class="form-control" id="pinInput" placeholder="KRA pin" name="pin" value="<?php echo $pin ?>">
              </div>
              </div>
              
            <div class="col">
              <div class="form-group">
                <label>ID/CERT NO</label>
                <input type="text" class="form-control" id="idInput" aria-describedby="emailHelp" placeholder="ID Number" name="idNumber" value="<?php echo $idNumber ?>">
              </div>
              </div>
              </div>
              <div class="row">
              <div class="col">
              <div class="form-group">
                <label>MOBILE NUMBER</label>
                <input type="text" class="form-control" id="mobileInput" pattern="[0-9]{10,12}" placeholder=" Mobile Number" name="phoneNumber" value="<?php echo $phoneNumber ?>" required>
              </div>
              </div>

              <div class="col">
              <div class="form-group">
                <label>BUSINESS NAME</label>
                <input type="text" class="form-control" id="mnameInput" aria-describedby="emailHelp" placeholder="Business Name" name="businessName" value="<?php echo $businessName ?>">
              </div>
              </div>
              </div>

              <div class="row">
              <div class="col">
              <div class="form-group">
                <label>BUSINESS ADDRESS</label>
                <input type="text" class="form-control" id="exampleInputPassword" placeholder="Business Address" name="businessAddress" value="<?php echo $businessAddress ?>" required>
              </div>
              </div>
              <div class="col">
              <div class="form-group">
                <label>BUSINESS COUNTY</label>
                <select name="county" class="form-control" id="exampleInputPassword">
                  <option value="<?php echo $county ?>" selected="selected"><?php echo $county ?></option>
                  <?php
                  $query = "SELECT * FROM `county`";
                  $result = mysqli_query($db, $query);
                  foreach ($result as $row) {
                    echo "<option value='" . $row['countyName'] . "'>" . $row['countyName'] . "</option>";
                  }
                  ?>
                </select>
              </div>
              </div>

              <div class="col">
              <div class="form-group">
                <label>EMAIL</label>
                <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Business or Customer email" name="email" value="<?php echo $email; ?>" required>
              </div>
              </div>
              </div>
              <hr>
              
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" name="edit">SAVE CHANGES</button>
              </div>

              <hr>
            </form>


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
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/access.php");
session_start();

access();
$groups = getgroups();
$success = null;
$db = getConnection();

if (isset($_REQUEST['id'])) {
  $db =  getConnection();
  $status = '';
  $id = $_REQUEST['id'];
  $query1 = "SELECT * FROM `groups` WHERE `id`=$id";
  $groupquery = mysqli_query($db, $query1);
  $row = mysqli_fetch_assoc($groupquery);

  $groupname = $row['name'];
  $groupreference = $row['reference'];
}
if (isset($_POST['sendsms'])) {

  if (isset($_SESSION['addition']) && $_SESSION['addition'] == "sms sent succcessfully") {
    $succcess = "SMS set Successfully";
    unset($_SESSION['addition']);
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
  <title>Dejavu SMS Group</title>
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
            <h1 class="h3 mb-0 text-gray-800">SMS Group</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Messaging</li>
              <li class="breadcrumb-item"><a href="smsrh.php">groups</a></li>
              <li class="breadcrumb-item active" aria-current="page">send sms</li>
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
            window.open("/crm/main/smsrh.php", "_self");
          }, 2000)
         </script>';
          }
          ?>
          <div class="card col-xl-12 col-md-12 mb-4 p-5">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary"><?php echo $groupname; ?></h6>
                    <div>
                      <a class="btn btn-primary" href="/crm/admin/newcontact.php?id=<?php echo $id; ?>" role="button">Add Contact</a>
                      <a class="btn btn-primary" href="/crm/admin/uploadContact.php?id=<?php echo $id; ?>" role="button">Upload</a>
                    </div>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="">
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>email</th>
                        <th>Created</th>
                        <th>Edit</th>
                        <th>Del</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 0;
                      $contacts = groupcontact($id);
                      foreach ($contacts as $row) {
                        ++$no;
                      ?>
                      <tr>
                        <td><?php echo $no ;?></td>
                        <td><?php echo $row['name'] ;?></td>
                        <td><?php echo  $row['phonenumber'];?></td>
                        <td><?php echo $row['email'] ;?></td>
                        <td><?php echo substr($row['dateCreated'], 0, -10);?></td>
                        <td><a href="/crm/main/editcontact.php?id=<?php echo $row['id']; ?>" class="success "><i class="fa fa-edit"></i></a></td>
                        <td><a href="/crm/main/delgroupc.php?id=<?php echo $row['id']; ?>&is=<?php echo $id; ?>" class=" btn-danger"><i class="fa fa-trash"></i></a></td>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
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
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>copyright &copy; <script>
                  document.write(new Date().getFullYear());
                </script> - developed by
                <b><a href="" target="_blank">Dejavu Technologies</a></b>
              </span>
            </div>
          </div>
        </footer>
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

      function submitForm() {
        var id = document.getElementById("idInput").value;
        var pin = document.getElementById("pinInput").value;
        if (pin.length == 0 && id.length == 0) {
          //showError("ID or Pin is required");
          alert('ID or Pin is required');
          return false;
        } else {
          document.getElementById("addCustomerForm").submit();
        }
      }
    </script>
</body>

</html>
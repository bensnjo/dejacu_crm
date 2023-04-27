<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/access.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/crm/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;



session_start();
access();


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
  $groupid = $row['id'];
  $groupreference = $row['reference'];
}

if (isset($_POST['upload_contact'])) {
  $db =  getConnection();
  //start
  $allowedFileType = [
    'application/vnd.ms-excel',
    'text/xls',
    'text/xlsx',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  ];

  if (in_array($_FILES["file"]["type"], $allowedFileType)) {

    $targetPath = 'uploads/' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

    $spreadSheet = $reader->load($targetPath);
    $excelSheet = $spreadSheet->getActiveSheet();
    $spreadSheetAry = $excelSheet->toArray();
    $sheetCount = count($spreadSheetAry);

    for ($i = 1; $i <= $sheetCount; $i++) {
      $name = "";
      if (isset($spreadSheetAry[$i][0])) {
        $name = mysqli_real_escape_string($db, $spreadSheetAry[$i][0]);
      }
      $number = "";
      if (isset($spreadSheetAry[$i][1])) {
        $number = mysqli_real_escape_string($db, $spreadSheetAry[$i][1]);
      }
      $email = "";
      if (isset($spreadSheetAry[$i][2])) {
        $email = mysqli_real_escape_string($db, $spreadSheetAry[$i][2]);
      }

      if (!empty($name) || !empty($number) || !empty($email)) {
        $user = $_SESSION['username'];
        $d = date("Y-m-d G:i");
        $query = "INSERT INTO `group_join`( `group_id`, `name`, `phonenumber`, `email`, `dateCreated`, `createdby`) 
        VALUES ('$groupid','$name','$number','$email','$d','$user')";
        $result = mysqli_query($db, $query);
        $succcess = "Contacts Added succcessfully";
      }
    }
  } else {
    array_push($GLOBALS['errors'], "Invalid File uploaded!");
  }
  //end
 

  if (isset($_SESSION['addition']) && $_SESSION['addition'] == "Contacts added Successful ") {
    $succcess = "Contact Added success";
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
  <title>Dejavu Add Contact</title>
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
            <h1 class="h3 mb-0 text-gray-800">Group</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Messaging</li>
              <li class="breadcrumb-item active" aria-current="page">Upload Contact</li>
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
            window.open("/crm/main/viewgroup.php?id=' . $groupid . '", "_self");
          }, 2000)
         
         </script>';
          } ?>
          <div class="card col-xl-12 col-md-12 mb-4 p-5">
            <div class="card col-xl-12 col-md-12 mb-4 p-5">
              <div class="col-lg-12">
                <div class="mb-4">
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="m-0 font-weight-bold text-primary"> Upload Contact List</h4>
                    <hr>
                    <h4 class="m-0 font-weight-bold text-primary"><?php echo $groupname; ?></h4>
                  </div>
                </div>
              </div>

              <form action="" method="POST" id="addCustomerForm" enctype="multipart/form-data" onsubmit="return submitForm()">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Attach File</label>
                      <input class="form-control" type="file" name="file" id="file" accept=".xls,.xlsx">
                    </div>
                  </div>
                  <div class="col">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group" style="margin-top: 10px">
                      <button type="submit" class="btn btn-primary btn-block" name="upload_contact">UPLOAD FILE</button>
                    </div>
                  </div>
                  <div class="col">
                  </div>
                  <div class="col">
                  </div>
                </div>
            </div>
            </form>
          </div>
        </div>


        <!-- Documentation Link -->

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
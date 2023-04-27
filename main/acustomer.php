<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/crm/service.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

$success = null;

if (isset($_POST['tel'])){
    registercustomer();
    //regcomplain();
    //admit($_SESSION['memberNo'],$_POST['temp']);


if(isset($_SESSION['addition']) && $_SESSION['addition'] == "member added Successful "){
  $succcess = "Customer Added success";
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
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ADD A CUSTOMER</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Members</li>
              <li class="breadcrumb-item active" aria-current="page">Add Member</li>
            </ol>
          </div>

          <div id="errorDiv">

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
            window.open("/crm/main/vcustomers.php", "_self");
          }, 2000)
         
         </script>';

           }


                   ?>


<div class="card col-xl-12 col-md-12 mb-4 p-5">
         
          <form action="" method="POST" id="addCustomerForm" onsubmit="return submitForm()">

                    <!-- <div class="form-group">
                      <label>CUSTOMER PIN</label>
                      <input type="text" class="form-control" id="pinInput"
                      placeholder="Enter customer's pin" name="pin" pattern="[A-Z]{1}[0-9]{9,}[A-Z]{1}">
                    </div> -->

                    <div class="form-group">
                      <label>ID/CERT NO</label>
                      <input type="text" class="form-control" id="idInput" aria-describedby="emailHelp"
                        placeholder="id number" name = "idNo" >
                    </div>

                    <div class="form-group">
                      <label>Mobile No</label>
                      <input type="text" class="form-control" id="phoneInput" pattern = "[0-9]{10,12}"
                        placeholder="Enter Mobile No" name = "tel" required>
                    </div>
                    <div class="form-group">
                      <label>FIRST NAME</label>
                      <input type="text" class="form-control" id="exampleInputLastName"
                       placeholder="Enter First Name" name="firstname" required> 
                    </div>
                   
                    <div class="form-group">
                      <label>MIDDLE NAME</label>
                      <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Middle Name" name = "middlename" >
                    </div>
                    
                    <div class="form-group">
                      <label>LAST NAME</label>
                      <input type="text" class="form-control" id="exampleInputPassword"
                       placeholder="Enter Last Name" name="lastname" required>
                    </div>
                    <div class="form-group">
                      <label>EMAIL</label>
                      <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp"
                        placeholder="Enter email" name = "email" required>
                   
                    
                    <div class="form-group" style="margin-top: 10px">
                      <button type="submit" class="btn btn-primary btn-block" name="add" >ADD CUSTOMER</button>
                    </div>

                    <hr>
                    
        </form>
        </div>
          
          <!-- YOUR CODE ENDS HERE -->
         
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

<script>

    function submitForm(){
        var id = document.getElementById("idInput").value;
        var pin = document.getElementById("pinInput").value;

        if(pin.length == 0 && id.length == 0){
             //showError("ID or Pin is required");
             alert('ID or Pin is required');
             return false;
        }else{
          document.getElementById("addCustomerForm").submit();
        }

    }

</script>

</body>

</html>

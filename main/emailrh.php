<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/main/sendsms.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/main/sendmail.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

$success = null;
$db = getConnection();

if (isset($_POST['sendemail'])){
  
  $to=mysqli_real_escape_string($db, $_POST['email']);
  $subject=mysqli_real_escape_string($db, $_POST['subject']);
  $message=mysqli_real_escape_string($db, $_POST['emailMessage']);
  send_mail_by_PHPMailer($to, $subject, $message);
    $succcess = "email sent succcessfully";

if(isset($_SESSION['addition']) && $_SESSION['addition'] == "email sent succcessfully "){
  $succcess = "email sent succcessfully";
  unset($_SESSION['addition']);
}
}

if (isset($_POST['sendsms'])){
  sendSMS();
  $succcess = "sms sent succcessfully";
 

if(isset($_SESSION['addition']) && $_SESSION['addition'] == "sms sent succcessfully"){
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
  <title>Dejavu Send email</title>
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
            <h1 class="h3 mb-0 text-gray-800">Messaging</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Messaging</li>
              <li class="breadcrumb-item active" aria-current="page">send emails</li>
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
            window.open("/crm/admin/emailrh.php", "_self");
          }, 2000)
         
         </script>';

           }


                   ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Send Emails</h2>
          </div>
<div class="card col-xl-12 col-md-12 mb-4 p-5">
          <form action="" method="POST" id="sendemailForm" onsubmit="return submitForm()">
          <div class="form-group">
                      <label>Email Subject</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        placeholder=" subject" name = "subject" required ></div>          
          <div class="form-group">
                      <label>Massage</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "emailMessage" required></textarea>
                    </div>
          <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="email address" name = "email" required>
                    </div>
          <div class="form-group" style="margin-top: 10px">
                      <button type="submit" class="btn btn-primary btn-block" name="sendemail">Send email</button>
                    </div>

                    <hr>
           
        </form>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 mb-0 text-gray-800">Send SMS</h2>

          </div>
        <div class="card col-xl-12 col-md-12 mb-4 p-5">
         
          <form action="" method="POST" id="sendemailForm" onsubmit="return submitForm()">
                   
                    <div class="form-group">
                      <label>Massage</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "smsMessage"required></textarea>
                    </div>
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="Number" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="phoneNumber" name = "phoneNumber" required>
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                      <button type="submit" class="btn btn-primary btn-block" name="sendsms">Send sms</button>
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
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
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
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });

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

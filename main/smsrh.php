<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/main/sendSms.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();
$groups=getgroups();
$success = null;
$db = getConnection();

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
  <title>Dejavu Send SMS</title>
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
            <h1 class="h3 mb-0 text-gray-800">SMS</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Messaging</li>
              <li class="breadcrumb-item active" aria-current="page">send sms</li>
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
            window.open("/dejavucoms/panel/home.php", "_self");
          }, 2000)
         
         </script>';

           }


                   ?>


        
        <div class="card col-xl-12 col-md-12 mb-4 p-5">
         
          <form action="" method="POST" id="sendemailForm" onsubmit="return submitForm()">
                   
                    <div class="form-group">
                      <label>Massage</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "smsMessage"required></textarea>
                    </div>
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input type="Number" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Phone number" name = "phoneNumber" required>
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                      <button type="submit" class="btn btn-primary btn-block" name="sendsms">Send sms</button>
                    </div>

                    <hr>
           
        </form>
        </div>
        <span class="h3 mb-0 text-gray-800">SMS Groups</span>
        <div class="card col-xl-12 col-md-12 mb-4 p-5">
            
             <!-- Datatables -->
             <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">SMS Groups</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="">
                      <tr>
                        <th>No</th>
                        <th>Group Name</th>
                        <th>Members</th>
                        <th>OPR</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                              $no=0;
                              $count=15;
                            foreach($groups as $row){
                              ++$no;
                                print "<tr>";
                                print "<td>" .$no. "</td>";
                                print "<td>" . $row['name']. "</td>";
                                print "<td>" . $count. "</td>";
                                print("<td>");
                                print('<a " href="/crm/admin/viewgroup.php?id='.$row['id'].'"><i class="fa fa-eye"></i></a>');
                                print("</td>");
                                
                            }
                        ?>

                     
                    </tbody>
                  </table>
                </div>
              </div>
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

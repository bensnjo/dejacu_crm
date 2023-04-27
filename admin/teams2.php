<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

$teams = allteams();
$users = $_REQUEST['user'];
//echo $user;

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
  <title>Dejavu Teams</title>
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
            <h1 class="h3 mb-0 text-gray-800">Select a Team</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Stall</a></li>
              <li class="breadcrumb-item">Teams</li>
              <li class="breadcrumb-item active" aria-current="page">Teams</li>
            </ol>
          </div>

          <!-- PUT YOUR CODE HERE -->
          <?php

                        if (isset($_REQUEST['tname'])){

                $db = getConnection();
                $users = $_REQUEST['user'];
                $team = $_REQUEST['tname'];
                $updateT = "UPDATE `users` SET `team`='$team' WHERE `username`= '$users' ";
                mysqli_query($db, $updateT);

                $massage = "Team selected Successfully ";

                echo '
                <div class="alert alert-success  alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                '.$massage.'
                </div>
                ';


                // echo'<script>
                //                     setTimeout(()=>{
                //                     window.open("/crm/admin/index.php", "_self");
                //                     }, 2500)
                                
                //                 </script>';
                    
                } ?>

             <!-- Datatables -->
             <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">SELECT A TEAM</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-dark tfoot-dark">
                      <tr>
                      <th>No.</th>
                        <th>TEAM NAME</th>
                        <th>DISCRIPTION</th>
                        <th>DATE</th>
                        <th>SELECT</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                         <?php
                            $no=0;
                            foreach($teams as $row){
                            

                                
                                print " <tr> ";
                                print "<td>" . ++$No. "</td>";
                                print "<td>" . $row['teamName'] . "</td>";
                                print "<td>" . $row['discription']. "</td>";
                                print "<td>" . $row['date_c']. "</td>";
                                print("<td>");
                                print('<a class="btn btn-success" href="/crm/admin/teams2.php?tname='.$row['teamName'].'&user='.$users.'"><i class="fa fa-edit"></i></a>');
                                print("</td>");
                                
                            }
                        ?>

                     
                    </tbody>
                  </table>
                </div>
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

</body>

</html>

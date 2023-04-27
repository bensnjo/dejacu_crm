<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/stat.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();


//access();
$agentU = $_REQUEST['user'];
$agent = getUser($agentU);

$agentname = $agent['full_names'];
$agentdpt = $agent['department'];
$agentteam = $agent['team'];


$data = getAgentTiket($agentU);
$noOfTickets = noOfTickets($agentU);
$openT = openT($agentU);
$closedT = closedT($agentU);
$closedT2 = closedT2();

$dates = summary($agentU);


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
  <title>Dejavu Reports</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <!-- CONTENT HOLDER -->
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
            <h1 class="h3 mb-0 text-gray-800">Single Report</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
          </div>
          <div class="row mb-3">
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Agent: <?php echo $agentname ;?> </h6>
                </div>

                <div class="col-lg-12 d-flex justify-content-between ">
              
              <div class="form-group col-lg-4">
                    <label>NAME</label>
                    <input type="text" class="form-control" id="exampleInputEmail" 
                      value="<?php echo $agentname ;?>" name = "tel" readonly>
                  </div>
                  <div class="form-group col-lg-4">
                    <label>DEPARTMENT</label>
                    <input type="text" class="form-control" id="exampleInputEmail" 
                      value ="<?php echo $agentdpt ;?>" name = "tel" readonly>
                  </div>
                  <div class="form-group col-lg-4">
                    <label>TEAM</label>
                    <input type="text" class="form-control" id="exampleInputEmail" 
                      value ="<?php echo $agentteam; ?>" name = "tel" readonly>
                  </div>
              
             
              </div>
              </div>
            </div>
            
          

                        <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">TOTAL TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $noOfTickets; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>As of Now</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">OPEN TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $openT; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>AS OF TODAY</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">RESOLVED TICKETS</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $closedT2; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Till Now</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">MY TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myT; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-address-card fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->



            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">REPORT SUMMARY</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="t">
                      <tr>
                      
                        <th>DATE</th>
                        <th>TOTAL TICKETS</th>
                        <th>TICKETS RESOLVED</th>
                        <th>TICKETS NOT RESOLVED</th> 
                      </tr>
                    </thead>
                    <tbody>
                         <?php
                              $db = getConnection();
                              //echo json_encode($dates) ;
                            foreach($dates as $row){
                             $td = $row['ticketDate'];
                            // echo $td;
                             $total = totalDay($agentU, $td);
                            // echo "gdskjjbubvbjb";
                             $resolved = mysqli_query($db, "SELECT COUNT(id) FROM insidence WHERE createdBy = '$agentU' AND createdDate = '$td' AND staus = 'closed'");
                                
                                print " <tr> ";
                                print "<td>" . $row['ticketDate'] . "</td>";
                                print "<td>" . $total. "</td>";
                                print "<td>" . $resolved. "</td>";
                           
                                print("</td>");
                                
                            }
                        ?>

                     
                    </tbody>
                  </table>
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
                  <a href="/yaya/logout.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
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
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  

  <script src="js/demo/chart-pie-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>

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
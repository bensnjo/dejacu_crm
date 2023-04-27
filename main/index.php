<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/stat.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

//access();
$agent = $_SESSION['username'];
$data = getAgentTiket($agent);
$noOfTickets = noOfTickets();
$openT = openT();
$closedT = closedT($agent);
$myT = myT($agent);

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
  <title>Dejavu Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">OPEN TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $openT; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> .</span>
                        <span>.</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">MY TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myT; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> .</span>
                        <span>.</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-address-card fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>



           
            

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">NEW TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $myT; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-down"></i> .</span>
                        <span>.</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-2 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">OVERDUE TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 0; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-down"></i>.</span>
                        <span>.</span>
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
             <div class="col-xl-2 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">RESOLVED TICKETS</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $closedT; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>.</span>
                        <span>.</span>
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
             <div class="col-xl-2 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">TRANSFERED TICKETS</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo 0; ?></div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-down"></i>.</span>
                        <span>.</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- CARDS -->
            <div class="col-lg-12">
              <div class="card sm mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">ACTIVITY BOARD  </h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 mb-4">
                    <A href = "cticket.php">
                      <div class="card bg-gradient-primary text-white">
                        <div class="card-body">
                          CREATE A TICKET
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "acustomer.php">
                      <div class="card bg-gradient-info text-white">
                        <div class="card-body">
                          ADD A CUSTOMER
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "trt.php">
                      <div class="card bg-gradient-danger text-white">
                        <div class="card-body">
                          TRANSFER A TICKET
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "mTiket.php">
                      <div class="card bg-gradient-success text-white">
                        <div class="card-body">
                          MY TICKETS
                          <div class="text-white-100 medium"></div>
                        </div>
                      </div>
                      </a>
                    </div>
                    
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

            <!--END OF CARDS -->

            <!-- Area Chart --
            <div class="col-xl-8 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- Pie Chart --
            <div class="col-xl-4 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Month <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                      aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Select Periode</div>
                      <a class="dropdown-item" href="#">Today</a>
                      <a class="dropdown-item" href="#">Week</a>
                      <a class="dropdown-item active" href="#">Month</a>
                      <a class="dropdown-item" href="#">This Year</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="mb-3">
                    <div class="small text-gray-500">Oblong T-Shirt
                      <div class="small float-right"><b>600 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Gundam 90'Editions
                      <div class="small float-right"><b>500 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Rounded Hat
                      <div class="small float-right"><b>455 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Indomie Goreng
                      <div class="small float-right"><b>400 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <div class="small text-gray-500">Remote Control Car Racing
                      <div class="small float-right"><b>200 of 800 Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center">
                  <a class="m-0 small text-primary card-link" href="#">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </div> -->
            <!-- Invoice Example -->
          <div class="col-lg-12 d-flex flex-row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">MY LATEST TICKETS</h6>
                  <a class="m-0 float-right btn btn-danger btn-sm" href="mTiket.php">View More <i
                      class="fas fa-chevron-right"></i></a>
                </div>
                <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>TICKETS ID</th>
                        <th>CUSTOMER NAME</th>
                        <th>DATE OF ISSUE</th>
                        <th>TICKET STATUS</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php 
                     foreach($data as $row){
                            

                              
                      print " <tr> ";
                      print "<td>" . $row['ticketNumber'] . "</td>";
                      print "<td>" . $row['cusName']. "</td>";
                      print "<td>" . $row['dateCreated']. "</td>";
                      print "<td>" . $row['status']. "</td>";
                      
                      
                  }
                     
                     ?>  
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            <!-- Message From Customer-->
            <!-- <div class="col-xl-4 col-lg-4 ">
              <div class="card">
                <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-light">NOTIFICATIONS</h6>
                </div>
                <div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">this massage element is not set but it will be updated in the next release.</div>
                      <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a href="#">
                      <div class="text-truncate message-title">this massage element is not set but it will be updated in the next release.
                      </div>
                      <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">this massage element is not set but it will be updated in the next release.
                      </div>
                      <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
                    </a>
                  </div>
                  <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                      <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                        ducimus qui blanditiis
                      </div>
                      <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
                    </a>
                  </div>
                  <div class="card-footer text-center">
                    <a class="m-0 small text-primary card-link" href="#">View More <i
                        class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div> -->
          <!--Row-->

          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p> THE USHURU CRM <a href=""
                  class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-church"></i>&nbsp;USHURU</a></p>
            </div>
          </div> -->

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
</body>

</html>
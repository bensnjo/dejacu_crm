<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/service.php");
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/stat2.php");
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/access.php");
session_start();

//
if(isset($_REQUEST['id'])){
  $service = $_REQUEST['id'];
} else {
  $service = getService();
}
//$data = allservices($service);
$regMember = noOfregisterd();
$currAttend = noOfpresent($service);
$absents = noOfabsent($service);
$visitors = noOfvisitors($service);


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
  <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


  <style type="text/css">

#chart-container {
    width: 50%;
    height: 50%;
}
</style>
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
            <h1 class="h3 mb-0 text-gray-800">DataTables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Reports</li>
              <li class="breadcrumb-item active" aria-current="page">View all reports</li>
            </ol>
          </div>

          <!-- PUT YOUR CODE HERE -->
          <!-- Background Gradient Utilities -->
          <div class="col-lg-12">
              <div class="card sm mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">SUMMARY REPORT FOR (<?php echo $service ; ?> )</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 mb-4">
                      <div class="card bg-gradient-primary text-white">
                        <div class="card-body">
                          REGISTERED REPORTS
                          <div class="text-white-100 medium"> <?php echo$regMember ; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                      <div class="card bg-gradient-info text-white">
                        <div class="card-body">
                          CURRENT ATTENDANCE
                          <div class="text-white-100 medium"><?php echo$currAttend ; ?> </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                      <div class="card bg-gradient-danger text-white">
                        <div class="card-body">
                          NO OF ABSENTS
                          <div class="text-white-100 medium"><?php echo$absents ; ?> </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                      <div class="card bg-gradient-success text-white">
                        <div class="card-body">
                          NO OF VISITORS
                          <div class="text-white-100 medium"><?php echo$visitors ; ?></div>
                        </div>
                      </div>
                    </div>
                    
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

             <!-- Area Charts -->
             <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                </div>
                <div class="card-body row" >
                    <div class="col-lg-6">
                  <div class="chart-container">
                    <canvas id="graphCanvas"></canvas>
                  </div>
                 </div>
                 <div class="col-lg-6">
                  <div class="chart-container">
                    <canvas id="graphCanvas2"></canvas>
                  </div>
                </div>
                  <hr>
                  This is an age distribution and service tine attendance table
                </div>
              </div>
            </div>
            <!-- Area Charts -->








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

  <!-- GRAPH SCRIPTS -->


  <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].Category);
                        marks.push(data[i].cnt);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Age distribution',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>

<script>
        $(document).ready(function () {
            showGraph2();
        });


        function showGraph2()
        {
            {
                $.post("timed.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].Category);
                        marks.push(data[i].cnt);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Service Attendance Time',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas2");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
            }
        }
        </script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>
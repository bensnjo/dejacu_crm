<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/sendSms.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/Smail.php");
session_start();

access();

//$members = allTickets();

$user = $_SESSION['username'];

if (isset($_REQUEST['tiketNo'])){
    $db = getConnection();
    $tiketNo = $_REQUEST['tiketNo'];
    $query2 = "SELECT * FROM insidence WHERE tiketNo = '$tiketNo'";
    $result1 = mysqli_query($db, $query2);
    $result1 = mysqli_fetch_assoc($result1);
    $pin = $result1['pin'];
    $massage = $result1['massage'];
    $email = $result1['email'];
    $tell =  $result1['tell'];
    $category = $result1['category'];

    

    //$child = childTickets($tiketNo);
    if (isset($_POST['reply'])){
        if($_POST['chanel'] == "sms"){
            if(!isset($tell) OR $tell== "na" ){
                echo"no tellephone no is set";

            }else {
                sendSms($tell, $_POST['replyM']);
                $user = $_SESSION['username'];
                $comment = mysqli_real_escape_string($db, $_POST['comments']);
                $reply = mysqli_real_escape_string($db, $_POST['replyM']);
                $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
                VALUES ('$tiketNo','$pin','$reply','$comment','$category','$user','kra')";
                mysqli_query($db, $query3);
            }

        }else {
            $subject = "Dejavu CUSTOMER SUPPORT FOR TICKET NO -- $tiketNo";

            //send_mail_by_PHPMailer($email, $subject, $reply);
            //sendSms($tell, $_POST['replyM']);
                $user = $_SESSION['username'];
                $comment = mysqli_real_escape_string($db, $_POST['comments']);
                $reply = mysqli_real_escape_string($db, $_POST['replyM']);
                $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
                VALUES ('$tiketNo','$pin','$reply','$comment','$category','$user','kra')";
                mysqli_query($db, $query3);
                send_mail_by_PHPMailer($email, $subject, $reply);
        }

    }

    if (isset($_POST['add'])){
        $smassage= mysqli_real_escape_string($db, $_POST['complain']);
        $category = $_POST['type'];
        $source1 = $_POST['source'];
        $user = $_SESSION['username'];
        $comment = mysqli_real_escape_string($db, $_POST['comments']);

        $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
        VALUES ('$tiketNo','$pin','$smassage','$comment','$category','$user','customer')";
        mysqli_query($db, $query3);
    }
    $child = childTickets($tiketNo);
}

$succcess = null;

if (isset($_REQUEST['action'])){
    $db = getConnection();
    if($_REQUEST['action'] == "assign"){
        $nuser = $_REQUEST['uid'];

        $query4 = "UPDATE `insidence` SET `createdBy`='$nuser' WHERE `tiketNo` = '$tiketNo'";
        mysqli_query($db, $query4);

         // audit trail

         $ip = getip();
         $t = time();
         
           $d = date("Y-m-d G:i:s",$t);

         $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address,)
         VALUES('$user','$d', 'transfer_ticket', 'success', '$nuser', '$ip')";
         mysqli_query($db, $audit);

       //
      //  header('location: ');

      $succcess = "Ticket Transfer Success";

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
  <title>Dejavu Tickets</title>
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
            <h1 class="h3 mb-0 text-gray-800">TRANSFER TICKET</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Members</li>
              <li class="breadcrumb-item active" aria-current="page">View a Member</li>
            </ol>
          </div>

          <?php 

              if(isset($succcess)){
                echo  '<div class="alert alert-success alert-dismissible fade show ml-4 mr-4" des$designation="alert">
                '.$succcess.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';

                
              echo'<script>
                setTimeout(()=>{
                  window.open("/crm/admin/trt.php", "_self");
                }, 3000)
              
              </script>';

              }


           ?>

          <!-- PUT YOUR CODE HERE -->
          <div class="col-lg-12 d-flex justify-content-between ">
              
                <div class="form-group col-lg-4">
                      <label>PIN</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        value="<?php echo $pin ;?>" name = "tel" readonly>
                    </div>
                    <div class="form-group col-lg-4">
                      <label>MOBILE NO</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        value ="<?php echo $tell ;?>" name = "tel" readonly>
                    </div>
                    <div class="form-group col-lg-4">
                      <label>EMAIL</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        value ="<?php echo $email ;?>" name = "tel" readonly>
                    </div>
                
                </a>
                </div>
              </div>
            </div>


             <!-- Datatables -->
             <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">INCIDENT <?php echo "&nbsp -- NO -".$tiketNo ;?></h6>
                </div>
                <div class= "col-lg-8" style= "allign: left">
                <p style = "background-color: #ffcccc;
                                            padding: 10px;
                                            border-radius: 10px;
                                            min-height: 40px;
                                            color: black;" readonly><?php echo $massage ;?></p>
                
                </div>
                <hr>
                <!-- users table -->

                <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">FIND AN AGENT</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-dark tfoot-dark">
                      <tr>
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>FULL NAMES</th>
                        <th>TELLEPHONE</th>
                        <th>EMAIL</th>
                        <th>POSITION</th>
                        <th>DEPARTMENT</th>
                        <th>STATUS</th>
                        <th>TRANSFER</th>
                        <th>TEAM</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>ID</th>
                        <th>USERNAME</th>
                        <th>FULL NAMES</th>
                        <th>TELLEPHONE</th>
                        <th>EMAIL</th>
                        <th>POSITION</th>
                        <th>DEPARTMENT</th>
                        <th>STATUS</th>
                        <th>TRANSFER</th>
                        <th>TEAM</th>
                      </tr>
                    </tfoot>
                    <tbody>
                         <?php


                            $users = users(true);

                            foreach($users as $row){
                            

                                
                                print " <tr> ";
                                print "<td>" . $row['id'] . "</td>";
                                print "<td>" . $row['username'] . "</td>";
                                print "<td>" . $row['full_names']. "</td>";
                                print "<td>" . $row['mobile_phone']. "</td>";
                                print "<td>" . $row['email_addr']. "</td>";
                                print "<td>" . $row['roles']. "</td>";
                                print "<td>" . $row['department']. "</td>";
                                print "<td>" . $row['status']. "</td>";
                                print("<td>");
                                print('<a class="btn btn-success" href="/crm/admin/tt.php?tiketNo='.$tiketNo.'&action=assign&uid='.$row['username'].'"><i class="fa fa-edit"></i></a>');
                                print("</td>");
                                print("<td>");
                                print('<a class="btn btn-danger" href="/crm/admin/tt.php?tiketNo='.$tiketNo.'&action=assign&uid='.$row['username'].'"><i class="fa fa-users"></i></a>');
                                print("</td>");
                                
                            }
                        ?>
                    </tbody>
                    </table>
                    </div>
                </div>
                </div>




                <!-- users table  -->
                    <hr>
                
                <hr>

                <?php

                    if (isset($_REQUEST['action'])){
                        if($_REQUEST['action']== 'child'){

                            ?>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                         <h6 class="m-0 font-weight-bold text-primary"> ADD A CHILD INCIDENT</h6>
                        </div>
                            <div class= "col-lg-8" style= "allign: right">
                            <form action="" method="POST">
                            <div class="form-group">
                            <label class="label label-danger">SOURCE TYPE</label>
                                <select name="source" id="color" required>
                                  <option value="email">EMAIL</option>
                                  <option value="tellephone">TELLEPHONE</option>
                                  <option value="chat" >CHAT</option>
                                  
        
                                  
                                </select>
                            </div>
        
                           
                            <div class="form-group">
                            <label class="label label-danger">INCIDENT TYPE</label>
                                <select name="type" id="color" required>
                                  <option value="enquiry">ENQUIRY</option>
                                  <option value="request">SERVICE REQUEST</option>
                                  <option value="complain" >COMPLAIN</option>
                                  <option value="compliment" >COMPLIMENT</option>
        
                                  
                                </select>
                            </div>
                        
                        
                     
                            
                            <div class="form-group">
                              <label>COMPLAIN/INQUIRY</label>
                              <textarea type="text" class="form-control" id="exampleInputPasswordRepeat"
                                 name="complain"></textarea>
                            </div>
                            <div class="form-group">
                              <label>COMMENTS</label>
                              <input type="text" class="form-control" id="exampleInputPasswordRepeat"
                                 name="comments">
                            </div>
                            
                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block" name="add" >ADD CHILD TICKET</button>
                            </div>
        
                            </form>
                            </div>

                            <?php
                        }


                    }
                //

                if (isset($_REQUEST['action'])){
                    if($_REQUEST['action']== 'reply'){

                        ?>
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary" id = "reply2"> REPLY TO CUSTOMER</h6>
                        </div>
                         <form action="" method="POST" id='reply'>  
                         <div class="form-group">
                            <label class="label label-danger">REPLY CHANNEL</label>
                                <select name="chanel" id="color" required>
                                  <option value="sms">SMS</option>
                                  <option value="email">EMAIL</option>
                                  
                                </select>
                            </div>

                        <div class="form-group">
                          <label>COMPLAIN/INQUIRY</label>
                          <textarea type="text" class="form-control" id="exampleInputPasswordRepeat"
                             name="replyM"></textarea>
                        </div>
                        <div class="form-group">
                          <label>COMMENTS</label>
                          <input type="text" class="form-control" id="exampleInputPasswordRepeat"
                             name="comments">
                        </div>
                        
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="reply" >REPLY</button>
                        </div>
    
                        </form>

                        <?php
                    }


                }


                ?>
                    

              </div>
              <!-- CARDS -->
            <!-- <div class="col-lg-12">
              <div class="card sm mb-4"> -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">ACTION BOARD  </h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 mb-4">
                    <A href = "<?php echo("tBoard.php?action=close&tiketNo=$tiketNo"); ?>">
                      <div class="card bg-gradient-primary text-white">
                        <div class="card-body">
                          CLOSE TICKET
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "<?php echo("tBoard.php?action=reply&tiketNo=$tiketNo#reply2"); ?>">
                      <div class="card bg-gradient-info text-white">
                        <div class="card-body">
                          REPLY TO CUSTOMER
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "<?php echo("tt.php?action=transfer&tiketNo=$tiketNo#reply2"); ?>">
                      <div class="card bg-gradient-danger text-white">
                        <div class="card-body">
                          TRANSFER THE TICKET
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "cticket.php">
                      <div class="card bg-gradient-success text-white">
                        <div class="card-body">
                          ESCALATE TICKET
                          <div class="text-white-100 medium"></div>
                        </div>
                      </div>
                      </a>
                    </div>
                    
                    
                    </div>
                  </div>
                </div>
              </div>
            <!-- </div>

          </div> -->

            <!--END OF CARDS -->
            </div>

            
            <!-- DataTable with Hover -->









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

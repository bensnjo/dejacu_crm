<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/sendSms.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/Smail.php");
session_start();

access();
//$members = allTickets();

if (isset($_REQUEST['tiketNo'])){
    $db = getConnection();
    $tiketNo = $_REQUEST['tiketNo'];
    $query2 = "SELECT * FROM insidence WHERE tiketNo = '$tiketNo'";
    $result1 = mysqli_query($db, $query2);
    $result1 = mysqli_fetch_assoc($result1);
    $pin = $result1['pin'];
    $massage = strip_tags($result1['massage']);
    $email = $result1['email'];
    $tell =  $result1['tell'];
    $category = $result1['category'];
    $status = $result1['status'];
    $actionTo = $result1['actionTo'];

    
    $user = $_SESSION['username'];

    $succcess = null;

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

                 // audit trail

                 $ip = getip();
                 $t = time();
                 
                   $d = date("Y-m-d G:i:s",$t);
 
                 $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address, `data`)
                 VALUES('$user','$d', 'reply_ticket', 'success', '$tiketNo', '$ip' , '$reply')";
                 mysqli_query($db, $audit);
 
               //
            }

        }elseif($_POST['chanel'] == "email") {
            $subject = "KESRA CUSTOMER SUPPORT FOR TICKET NO -- $tiketNo";

            //send_mail_by_PHPMailer($email, $subject, $reply);
            //sendSms($tell, $_POST['replyM']);
                $user = $_SESSION['username'];
                $comment = mysqli_real_escape_string($db, $_POST['comments']);
                $reply = mysqli_real_escape_string($db, $_POST['replyM']);

                //echo($_FILES['attach1']['name']);

                //echo(count($_FILES));
                

                if(isset($_FILES['attach1'])){

                  
                    $errors= array();
                    $file_name = $_FILES['attach1']['name'];
                    $file_size = $_FILES['attach1']['size'];
                    $file_tmp = $_FILES['attach1']['tmp_name'];
                    $file_type = $_FILES['attach1']['type'];
                    $file_ext=@strtolower(end(explode('.',$_FILES['attach1']['name'])));
                    $docRoot = $_SERVER['DOCUMENT_ROOT']."/crm";
                    
                    $expensions= array("jpeg","jpg","png","pdf","doc","docx","xml","xls","apk","mp4","mp3","ini","img","ppt","pps","xls","zip");
                    
                    if(in_array($file_ext,$expensions)=== false){
                      $errors[]="extension not allowed, please choose a PDF, JPEG or PNG file.";
                    }
                    
                    if($file_size > 30971520) {
                      $errors[]='File size must be excately 30 MB';
                    }
                    
                    if(empty($errors)==true) {
                      move_uploaded_file($file_tmp, $docRoot."/"."uploads/".$file_name); //The folder where you would like your file to be saved
                      //echo "Success";
                    }else{
                      print_r($errors);
                    }
                  //
                  $attach = $docRoot."/"."uploads/".$file_name;
                  $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
                VALUES ('$tiketNo','$pin','$reply','$comment','$category','$user','kra')";
                mysqli_query($db, $query3);
                send_mail_by_PHPMailer($email, $subject, $reply, $attach);
                //echo "funyula";

                }else{
                $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
                VALUES ('$tiketNo','$pin','$reply','$comment','$category','$user','kra')";
                mysqli_query($db, $query3);
                send_mail_by_PHPMailer($email, $subject, $reply);
                //echo "funyula2002";
                }


                // audit trail

                $ip = getip();
                $t = time();
                
                  $d = date("Y-m-d G:i:s",$t);

                $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address, `data`)
                VALUES('$user','$d', 'reply_ticket', 'success', '$tiketNo', '$ip' , '$reply')";
                mysqli_query($db, $audit);

              //
        }else{ 

                $user = $_SESSION['username'];
                $comment = mysqli_real_escape_string($db, $_POST['comments']);
                $reply = mysqli_real_escape_string($db, $_POST['replyM']);
                $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
                VALUES ('$tiketNo','$pin','$reply','$comment','$category','$user','kra')";
                mysqli_query($db, $query3);


                // audit trail

                $ip = getip();
                $t = time();
                
                  $d = date("Y-m-d G:i:s",$t);

                $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address, `data`)
                VALUES('$user','$d', 'reply_ticket', 'success', '$tiketNo', '$ip' , '$reply')";
                mysqli_query($db, $audit);
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
            <h1 class="h3 mb-0 text-gray-800">Ticket Details</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Members</li>
              <li class="breadcrumb-item active" aria-current="page">View a Member</li>
            </ol>
          </div>

           <!-- Toast for closed ticket -->
               <div id="toast" style="display: none">
                  <div class="alert alert-success alert-dismissible fade show ml-4 mr-4" des$designation="alert">
                   Ticket Closed
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                </div>

                <div id="toast2" style="display: none">
                  <div id="toast2msg" class="alert alert-success alert-dismissible fade show ml-4 mr-4" des$designation="alert">
                   Ticket Escalated Success
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                </div>

                <script>
                  function showToast(msg = undefined){
                    if(!msg){
                   document.getElementById("toast").style.display = "";
                    }else{
                      document.getElementById("toast2msg").innerHTML = msg;
                      document.getElementById("toast2").style.display = "";
                    }
                  setTimeout(()=>{
                   // window.open("/crm/main/cticket.php", "_self");
                   document.getElementById("toast").style.display = "none";
                   document.getElementById("toast2").style.display = "none";
                  }, 4000)
                }
                
                </script>




          <!-- PUT YOUR CODE HERE -->
          <div class="col-lg-12 d-flex justify-content-between ">
              
                <div class="form-group col-lg-3">
                      <label>PIN</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        value="<?php echo $pin ;?>" name = "tel" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>MOBILE NO</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        value ="<?php echo $tell ;?>" name = "tel" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                      <label>EMAIL</label>
                      <input type="text" class="form-control" id="exampleInputEmail" 
                        value ="<?php echo $email ;?>" name = "tel" readonly>
                    </div>
                    <div class="form-group col-lg-3">
                    <label>TICKET STATUS</label>
                  <button id="stat" style="width: 100%;" class="form-control <?php if($status == 'closed'){ echo 'btn-success' ;} else{ echo 'btn-danger';}?> "> <?php echo $status; ?>
                  </div>
                
                </a>
                </div>
              </div>
            </div>


             <!-- Datatables -->
             <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" id='ticketNo'>INCIDENT <?php echo "&nbsp -- NO -".$tiketNo ;?></h6>
                  <input id="mticket" style= "display: none" value="<?php echo $tiketNo ;?>">
                   
                  <div style="display: none">
                    <h6>TICKET STATUS</h6>
                  <button id="stat" style="width: 150px;" class="btn <?php if($status == 'closed'){ echo 'btn-danger' ;} else{ echo 'btn-success';}?> "> <?php echo $status; ?>
                  </div>
                </div>
                <div style="display: flex">
                
                <div class= "col-lg-8" style= "allign: left">
                <p style = "background-color: #ffcccc;
                                            padding: 10px;
                                            border-radius: 10px;
                                            min-height: 40px;
                                            color: black;" readonly><?php echo $massage ;?></p>
                
                </div>
                <div class= "col-lg-4" style= "allign: right; display: flex;" id="actionTo">

                <button type="button" class="btn btn-danger" style="width: 150px; height: 40px;" id="assign" onclick="pop('assign', 'dep')">
                  Assign
                </button>     
                <div class="form-group" style="display: none; min-height: 40px; " id="dep">
                    <label class="label label-danger">ACTIONED TO</label>
                        <select name="actionTo" id="dep1" class="form-control1" onchange="pop('dep', 'cat')" required>
                        <?php 
                           $deps =  getDep();
                           foreach($deps as $grade){
                             echo '<option value="'.$grade['name'].'">'.$grade['name'].'</option>';
                           }
                        ?>
                          
                        </select>
                    </div>

                    <div class="form-group" style="display: none; min-height: 40px; " id="cat" onchange="comp()">
                    <label class="label label-danger">INCIDENT TYPE</label>
                        <select name="type" id="cat1" class="form-control1" required>
                        <option value="">--SELECT --</option>
                          <option value="enquiry">ENQUIRY</option>
                          <option value="request">SERVICE REQUEST</option>
                          <option value="complain" >COMPLAINT</option>
                          <option value="compliment" >COMPLIMENT</option>

                          
                        </select>
                    </div>                   

                </div>
                
                </div>
                <?php
                if(isset($result1['actionTo'])){ ?>

                  <script type="text/javascript">
                  document.getElementById('actionTo').style.display = 'none';

                  </script>



                      <?php } ?>

                <?php 
                $getAttach = "SELECT * FROM `mail_attachment` WHERE ticketNo ='$tiketNo'";
                $attach = mysqli_query($db, $getAttach);

                ?>

                <div class="row ml-4">

                <?php
                //if($attach){
                foreach($attach as $att){
                  $url = $att['url'];
                  $Aname = $att['aName']
                  ?>
                  <div class="col-lg-1 p-2">
                  <a  href="<?php echo $url; ?>"><button class=" btn-primary"><i class="fa fa-file fa-1x text-info"></i><?php echo $Aname; ?></button></a>
                  </div>
               <?php } ?>
                

                </div>

              
                <hr>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" id = "reply2">INCIDENT HISTORY</h6>
                </div>
                    <div class="chat" style="margin:20px, 20px;
                padding:10px;
                background-color: #F0FFFF;
                height: 250px;
                border-radius: 10px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
                display: flex;
                flex-direction: column"
                 >
                    <?php
                    foreach ($child as $row){
                        $massage2 = $row['massage'];
                        $date = $row['date_c'];
                        $origin = $row['origin'];

                        if(isset($massage2)){
                            if($origin== "customer"){
                                ?>
                                <div class= "col-lg-8" style= "align-self: flex-start">
                                <p style = "background-color: #ffcccc;
                                            padding: 10px;
                                            border-radius: 10px;
                                            min-height: 40px;
                                            color: black;" readonly><?php echo $massage2 ;?></p>
                                <p ><?php echo $date ;?></p>
                                 </div>
                                 <?php

                            }else {
                                ?>
                                <div class= "col-lg-8" style= "align-self: flex-end">
                                <p style = "background-color: #98FB98;
                                            padding: 10px;
                                            border-radius: 10px;
                                            min-height: 40px;
                                            color: black;" readonly><?php echo $massage2 ;?></p>
                                <p ><?php echo $date ;?></p>
                                 </div>
                                 <?php
                            }
                        }


                    }
                    ?>
                    </div>
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
                            <h6 class="m-0 font-weight-bold text-primary" id = "reply1"> REPLY TO CUSTOMER</h6>
                        </div>

                      <div style = "background-color: #4dd0e1CC; padding: 10px; border-radius: 10px; min-height: 200px; margin: 20px;" >
                         <form  action="" method="POST" id='reply' enctype="multipart/form-data">  
                         <div class="form-group">
                            <label class="label label-danger">REPLY CHANNEL</label>
                                <select name="chanel" id="color" required>
                                  <option value="sms">SMS</option>
                                  <option value="email">EMAIL</option>
                                  <option value="chat">CHAT</option>
                                  
                                </select>
                            </div>

                        <div class="form-group">
                          <label>COMPLAIN/INQUIRY</label>
                          <textarea type="text" class="form-control" id="exampleInputPasswordRepeat"
                             name="replyM" required></textarea>
                        </div>
                        <div class="form-group">
                          <label>COMMENTS</label>
                          <input type="text" class="form-control" id="exampleInputPasswordRepeat"
                             name="comments" />
                        </div>
                        <div class="form-group">
                          <label>Add Attachment</label>
                          <input type="file" class="form-control1" id="exampleInputPasswordRepeat1"
                             name="attach1" />
                        </div>
                        
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" name="reply" >REPLY</button>
                        </div>
    
                        </form>
                        </div>

                        <?php
                    }


                }

                if (isset($_REQUEST['action'])){
                  if($_REQUEST['action']== 'close'){

                    $date = date("Y-m-d G:i:s");

                    $query5 = "UPDATE `insidence` SET `status`='closed', `resolved_at` = '$date' WHERE `tiketNo` = '$tiketNo'";
                    mysqli_query($db, $query5);
                   // header("location: tBoard.php?action=close&tiketNo=$tiketNo");

                   // audit trail

                    $ip = getip();
                    $t = time();
                    
                      $d = date("Y-m-d G:i:s",$t);

                    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$user','$d', 'close_ticket', 'success', '$tiketNo', '$ip')";
                    mysqli_query($db, $audit);

                    echo'
                    <script>
                    showToast();
                    window.location.replace("/crm/main/tBoard.php?tiketNo='.$tiketNo.'");
                    </script>
                    
                    ';

                  //

                  }
                }

                //REOPEN TICKET STAT

                if (isset($_REQUEST['action'])){
                  if($_REQUEST['action']== 'reopen'){

                    $date = date("Y-m-d G:i:s");

                    $query5 = "UPDATE `insidence` SET `status`='Active', `resolved_at` = '$date' WHERE `tiketNo` = '$tiketNo'";
                    mysqli_query($db, $query5);
                   // header("location: tBoard.php?action=close&tiketNo=$tiketNo");

                   // audit trail

                    $ip = getip();
                    $t = time();
                    
                      $d = date("Y-m-d G:i:s",$t);

                    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$user','$d', 'reopen_ticket', 'success', '$tiketNo', '$ip')";
                    mysqli_query($db, $audit);

                    //unset($_POST['action']);

                    echo'
                    <script>
                    showToast();
                    window.location.replace("/crm/main/tBoard.php?tiketNo='.$tiketNo.'");
                   
                    </script>
                    
                    ';
                    

                  //

                  }
                }

                //
                if (isset($_REQUEST['action'])){
                  if($_REQUEST['action']== 'escalate'){

                    echo "stage 1";

                    $teams = "SELECT * FROM users WHERE username = '$user'";
                    $tresults = mysqli_query($db, $teams);
                    $tresults = mysqli_fetch_assoc($tresults);
                    $position = $tresults['grade'];
                    $team = $tresults['team'];
                    $grade = $position + 1;


                    // get supervisor
                      $Squery = "SELECT username FROM users WHERE team = '$team' AND grade = '$grade' ";
                      $sresults = mysqli_query($db, $Squery);
                      $sresults = mysqli_fetch_assoc($sresults);
                      $sup = $sresults['username'];
                      // allocate ticket to sup
                      $upticket = "UPDATE `insidence` SET `createdBy`='$sup' WHERE `tiketNo` = '$tiketNo'";
                      mysqli_query($db, $upticket);
                      // add logs
                      $ip = getip();
                    $t = time();
                    
                      $d = date("Y-m-d G:i:s",$t);

                    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$user','$d', 'escalate_ticket', 'success', '$tiketNo', '$ip')";
                    mysqli_query($db, $audit);
                    // send mail notification

                    $getMail = "SELECT `email_addr` FROM users WHERE username = '$sup'";
                    $semail = mysqli_query($db, $getMail);
                    $semail = mysqli_fetch_assoc($semail);
                    $semail = $semail['email_addr'];
                  
                    $tmessage = " DEAR ".$sup." THE FOLLOWING TICKET: ".$tiketNo." HAS BEEN ESCALATED TO YOU FROM ".$user."BY ".$_SESSION['uFullName'];
                    $tsubject = "ESCALATION OF TICKET NO ".$tiketNo;


                    send_mail_by_PHPMailer($semail, $tsubject, $tmessage);

                    echo'
                    <script>
                    showToast("Ticket Escalated Successfully to '.$sup.'");
                    window.location.replace("/crm/main/mTiket.php");
                    </script>
                    ';

                   

                  }
                }


                ?>
                    

              </div>
              <!-- CARDS -->
            <!-- <div class="col-lg-12">
              <div class="card sm mb-4"> -->
                <?php 
                if ($status == 'Active') {
                ?>

              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">ACTION BOARD  </h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 mb-4">
                    <A href = "<?php echo("tBoard.php?action=close&tiketNo=$tiketNo"); ?>" onclick="alert('Are you sure you want to close?')">
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
                    <A href = "<?php echo("tt.php?action=transfer&tiketNo=$tiketNo"); ?>">
                      <div class="card bg-gradient-danger text-white">
                        <div class="card-body">
                          TRANSFER THE TICKET
                          <div class="text-white-100 medium"> </div>
                        </div>
                      </div>
                      </a>
                    </div>
                    <div class="col-lg-3 mb-4">
                    <A href = "<?php echo("tBoard.php?action=escalate&tiketNo=$tiketNo"); ?>">
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
              <?php } else{ ?>

              <div class="col-lg-3 mb-4">
              <A href = "<?php echo("tBoard.php?action=reopen&tiketNo=$tiketNo");  ?>" onclick="alert('Are you sure you want to reopen this Ticket?');" onchangeFocus="showToast('Ticket reopened Successfully')">
                <div class="card bg-gradient-success text-white">
                  <div class="card-body">
                    REOPEN TICKET
                    <div class="text-white-100 medium"></div>
                  </div>
                </div>
                </a>
              </div>
            <?php  }
              
              ?>
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
  function pop(from, to){
 document.getElementById(to).style.display = "";
 document.getElementById(from).style.display = "none";

  }
  //

function comp(){

    var dept = document.getElementById('dep1').value;
    var category = document.getElementById('cat1').value;
    var ticketNo = document.getElementById('mticket').value;

      //     // data to be sent to the POST request
      // let _data = {
      //   department: dept,
      //   category: category, 
      //   ticketNo: ticketNo
      // }

      
      var vm = "http://localhost/crm/update.php?ticketNo=".concat(ticketNo,"&").concat("category=",category,"&").concat("department=",dept);
      
      //alert(ticketNo);

      fetch(vm);

      // fetch('http://localhost/crm/update.php', {
      //   method: "POST",
      //   body: JSON.stringify(_data),
      //   headers: {"Content-type": "application/json; charset=UTF-8"}
      // })
      // .then(response => response.json()) 
      // //.then(json => console.log(json));
      //.catch(err => console.log(err));

      document.getElementById('cat').style.display = "none";
        var msg = "Ticket categorised Succesfull";
      showToast(msg);

}

    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>

<?php  

require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/chat.php");



//session_start();
if(isset($_POST['start'])){

$_SESSION['customer']= $_POST['email'];
$_SESSION['pin'] = $_POST['pin'];
$_SESSION['tell'] = $_POST['tell'];
$_SESSION['conter'] = 1;
$email = $_POST['email'];
$tell = $_POST['tell'];
$pin = $_POST['pin'];
echo $email;

}

if(isset($_POST['send'])){

    $content = $_POST['content'];
    $email = $_SESSION['customer'];
    $pin = $_SESSION['pin'];
    $tell = $_SESSION['tell'];
    if(!isset($pin)){
        $pin = "n/a";
    }
    if(!isset($tell)){
        $tell = "n/a";
    }
    

    sendChat($content, $email, $pin, $tell);



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
  <title>Dejavu Chats</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>
<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12" >
                <div class="login-form" style = "background-color: #fff; padding: 10px; border-radius: 10px; min-height: 200px; margin: 20px;">
                  <div class="text-center">

                  <!-- start #4dd0e1CC -->
                  <?php
                  if(!isset($_SESSION['customer'])){
                      ?>
                   <div class="text-center">
                           <img style="width: 100px; height: 100px" src="img/logo.png" >
                        </div>
                      <div class="form-group"> 
                         <h2 style="color:#464646; font-family:'Times New Roman', Times, serif "> 
                            Welcome to Dejavu Care
                          </h2>
                          <h4 style="color:#464646;  font-family:'Times New Roman', Times, serif"> 
                            Chat with a member of our support team.
                          </h4>
                          <h4 style = "color:#ff0000; font-family:'Times New Roman', Times">Let us know who you are . . .</h4>
                      </div>
                  <form class="user" action="" method="POST">
                  <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputPassword" placeholder="Enter your email" name="email" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputPassword" placeholder="Telephone (optional)" name="tell">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputPassword" placeholder="PIN (optional)" name="pin">
                    </div>
                    
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-block" name="start" value="continue">
                    </div>
                    <hr>
                    
                  </form>
                    <?php } else { ?>

                    <div>

                    <div>
                        <div class="text-center">
                           <img style="width: 100px; height: 100px" src="img/logo.png" >
                        </div>
                      <div class="form-group"> 
                         <h2 style="color:#464646; font-family:'Times New Roman', Times, serif "> 
                            Welcome to Dejavy Care
                          </h2>
                          <h4 style="color:#464646;  font-family:'Times New Roman', Times, serif"> 
                            Chat with a member of our support team.
                          </h4>
                          <p ><i>Include as many details as possible </i></p>
                      </div>

                    <iframe src="disp.php#last" style="height: 400px;width:100%; border: none" title="Iframe Example"></iframe>
                        <?php 
                        //

                         //@chat();

                        
                        ?>
                    </div>
                        <div >
                        <form class="user" action="" method="POST">
                        <div class="d-flex justify-content-center">
                       <textarea type="text" class="form-control" id="exampleInputPassword" placeholder="Say something" name="content" required></textarea>
                       
                       <input type="submit" class="btn btn-danger " name="send" value="send">
                      </div>
                    </form>
                    </div>
                    </div>
                      

                    
                        
                   <?php }



                    function chat(){ 
                        
                        
                        $massage =@tickethead(); 

                        if($massage != null or strlen($massage)>1){
                          $_SESSION['conter'] = 8;
                        }
                        ?>

   <div class="chat" style="margin:20px, 20px;
                padding:10px;
                background-color: #F0FFFF;
                height: 350px;
                border-radius: 10px;
                overflow-x: hidden;
                overflow-y: auto;
                text-align:justify;
                display: flex;
                flex-direction: column" >


                    <div class= "col-lg-8" style= "align-self: flex-start">
                                <p style = "background-color: #ffcccc;
                                            padding: 10px;
                                            border-radius: 10px;
                                            min-height: 40px;
                                            color: black;" readonly><?php echo $massage ;?></p>
                                <p ><?php echo $date ;?></p>
                 
                    <?php

                        

                    $child = childTickets($_SESSION['ticket']);
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

                    <?php

                    }
                    
                    
                    ?>

                  <!-- end -->
                  </div>

                </div>

              </div>

            </div>

           </div>

        </div>
      </div>

    </div>

   </div>
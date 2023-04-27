<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="refresh" content="7">
  <link href="img/devajuLogo.jpeg" rel="icon">
  <title>Dejavu Tickets</title>
  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>



<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/crm/chat.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");

//session_start();

chat();
function chat(){ 
                        
                        
    $massage =@tickethead();
    ?>

<div class="chat" style="margin:20px, 20px;
padding:10px;
background-color: #fff;
height: 350px;
border-radius: 10px 10px 10px 10px;
overflow-x: hidden;
overflow-y: auto;
text-align:justify;
display: flex;
flex-direction: column" >


<div class= "col-lg-8" style= "align-self: flex-start">
            <p style = "background-color: #ffcccc;
                        padding: 10px;
                        border-radius: 10px 10px 10px 0px;
                        min-height: 60px;
                        color: black;" readonly><?php echo $massage ;?></p>
            <p ><?php echo '' ;?></p></div>

<?php

    

$child = childTickets($_SESSION['ticket']);
//echo $_SESSION['ticket'];
foreach ($child as $row){
    $massage2 = $row['massage'];
    $date = $row['date_c'];
    $origin = $row['origin'];

    if(isset($massage2)){
        if($origin== "customer"){
            ?>
            <div  style= "align-self: flex-start">
            <p style = "background-color: #ffcccc;
                        padding: 10px;
                        border-radius: 20px 20px 20px 0px;
                        width: 350px;
                        min-height: 60px;
                        color: black;" readonly><?php echo $massage2 ;?></p>
            <p ><?php echo $date ;?></p>
             </div>
             <?php

        }else {
            ?>
            <div  style= "align-self: flex-end">
            <p style = "background-color: #98FB98;
                        padding: 10px;
                        width: 350px;
                        border-radius: 20px 20px 0px 20px;
                        min-height: 60px;
                        color: black;" readonly><?php echo $massage2 ;?></p>
            <p ><?php echo $date ;?></p>
             </div>
             <?php
        }
    }


}

?>
<hr id="last" style="color:#fff;">
</div>

<?php

}
?>
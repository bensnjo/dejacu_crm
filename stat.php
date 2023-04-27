<?php
//include ('service.php');

function noOfTickets($agent = null){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM insidence";

    if($agent){
        $query = "SELECT COUNT(*) as count FROM insidence WHERE createdBy = '$agent'";
    }

    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}

function openT($agent = null){
    $db = getConnection();
    
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE `status` = 'OPEN' ";
    if($agent){
        $query = "SELECT COUNT(*) as count FROM `insidence` WHERE `status` = 'OPEN' AND createdBy = '$agent'";
    }
    $result = mysqli_query($db, $query);
    $no=mysqli_fetch_assoc($result)['count'];
return $no;
}


function closedT($user){
    $db = getConnection();

    $date = date("Y-m-d");
    
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE `status` = 'CLOSED'
     AND `createdBy`= '$user' AND `resolvedAt` > '$date'";
    $result = mysqli_query($db, $query);

    echo(mysqli_error($db));

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}

function myT($agent){
    $db = getConnection();
    
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE `status` = 'Active' AND `createdBy` = '$agent'";
    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}

function noOfabsent(){
    $db = getConnection();
    $service = getService();
    $query= "SELECT COUNT(*) as count FROM `attendance` WHERE `state` = 0 AND sevice= '$service'";
    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}
function noOfvisitors(){
    $db = getConnection();
    $service = getService();
    $query= "SELECT COUNT(*) as count  FROM `attendance` WHERE `state` = 1 AND sevice= '$service' AND `serviceGroup`= 'visitor' or `serviceGroup`= 'NewBeliver' ";
    $result = mysqli_query($db, $query);
    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}
function noOfservices(){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM `service` ";
    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}
function noOfchildren(){
    $db = getConnection();
    $service = getService();
    $query= "SELECT COUNT(*) as count FROM `attendance` WHERE `sevice` = '$service' AND `age` BETWEEN 0.1 AND 14 AND state = 1";
    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}
function AttendancePer(){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM operator";
    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
}

function Agents(){
    $db = getConnection();
    $query = "SELECT COUNT(*) as count FROM users WHERE `status` = 'Active'";
    $result = mysqli_query($db, $query);

    $no=mysqli_fetch_assoc($result)['count'];

return $no;
    
    }

    function closedT2(){
        $db = getConnection();
        $query = "SELECT COUNT(*) as count FROM insidence WHERE `status` = 'closed'";
        $result = mysqli_query($db, $query);
    
        $no=mysqli_fetch_assoc($result)['count'];
    
    return $no;
        
    }


 function summary($agent){
     $db = getConnection();
     $query = "SELECT ticketDate FROM insidence WHERE createdBy = '$agent' GROUP BY ticketDate";
     $res = mysqli_query($db, $query);

    //  $nums = [];

    //  while($row = mysqli_fetch_assoc($res)){
    //      $nums [] = $row;
    //  }
    //  $db->close();
     return $res;
 }   

 function totalDay($agentU, $td){
    $db = getConnection();
    $query = "SELECT COUNT(id) FROM insidence WHERE createdBy = '$agentU' AND createdDate = '$td'";
  $result =   mysqli_query($db, $query );
  return $result;
 }


?>
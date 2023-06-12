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

function AllT(){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM `insidence`";
    $result = mysqli_query($db, $query);
    $no=mysqli_fetch_assoc($result)['count'];
return $no;
}
function perctmyt($agent){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE `status`='OPEN' AND DATE(`dateCreated`) = (SELECT MAX(DATE(`dateCreated`)) FROM `insidence` WHERE DATE(`dateCreated`) < CURDATE())";
    $result = mysqli_query($db, $query);
    $no1=intval(mysqli_fetch_assoc($result)['count']);
    $query2= "SELECT COUNT(*) as count FROM `insidence` WHERE `status`='OPEN' AND DATE(`dateCreated`)= CURDATE()";
    $result2 = mysqli_query($db, $query2);
    $no2=intval(mysqli_fetch_assoc($result2)['count']);
    if($no2<=0){
        return intval(0);
        }
       else{
        return number_format(floatval(($no2/$no1)*100), 2, '.', '') ;
    }     
    }

function perctopent(){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM `insidence`";
    $result = mysqli_query($db, $query);
    $no1=intval(mysqli_fetch_assoc($result)['count']);
    $query2= "SELECT COUNT(*) as count FROM `insidence` WHERE `status`='OPEN'";
    $result2 = mysqli_query($db, $query2);
    $no2=intval(mysqli_fetch_assoc($result2)['count']);
    if($no2<=0){
        return intval(0);
        }
       else{
        return number_format(floatval(($no2/$no1)*100), 2, '.', '') ;
    }     
    }
//percent of ticket increase
function perctT(){
    $db = getConnection();
    $month = date("m");
    $date = date("d"); // Today's date
    $year = date("Y"); 
    $d = date("Y-m-d");
    //$yesterday=date('Y-m-d', mktime(0,0,0,$month,($date-1),$year)); 
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE DATE(`dateCreated`) = (SELECT MAX(DATE(`dateCreated`)) FROM `insidence` WHERE DATE(`dateCreated`) < CURDATE())";
    $result = mysqli_query($db, $query);
    $no1=intval(mysqli_fetch_assoc($result)['count']);
    //echo $no1;
    $query2= "SELECT COUNT(*) as count FROM `insidence` WHERE DATE(`dateCreated`)= CURDATE()";
    $result2 = mysqli_query($db, $query2);
    $no2=intval(mysqli_fetch_assoc($result2)['count']);
    if($no2<=0){
        return intval(0);
        }
       else{
        return number_format(floatval(($no2/$no1)*100), 2, '.', '') ;
    }     
    }
    //percent of my ticket increase
function perctmyTickets($agent){
    $db = getConnection();
    $month = date("m");
    $date = date("d"); // Today's date
    $year = date("Y"); 
    $d = date("Y-m-d");
    //$yesterday=date('Y-m-d', mktime(0,0,0,$month,($date-1),$year)); 
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE `createdBy`='$agent' AND DATE(`dateCreated`) = (SELECT MAX(DATE(`dateCreated`)) FROM `insidence` WHERE DATE(`dateCreated`) < CURDATE())";
    $result = mysqli_query($db, $query);
    $no1=intval(mysqli_fetch_assoc($result)['count']);
    //echo $no1;
    $query2= "SELECT COUNT(*) as count FROM `insidence` WHERE `createdBy`='$agent' AND DATE(`dateCreated`)= CURDATE()";
    $result2 = mysqli_query($db, $query2);
    $no2=intval(mysqli_fetch_assoc($result2)['count']);
    if($no2<=0){
        return intval(0);
        }
       else{
        return number_format(floatval(($no2/$no1)*100), 2, '.', '') ;
    }     
    }
    //percent job cards increase/decrease
    function perctjobcards(){
        $db = getConnection();
        $query= "SELECT COUNT(*) as count FROM  `jobcards` WHERE DATE(`dateCreated`) = (SELECT MAX(DATE(`dateCreated`)) FROM  `jobcards` WHERE DATE(`dateCreated`) < CURDATE())";
        $result = mysqli_query($db, $query);
        $no1=intval(mysqli_fetch_assoc($result)['count']);
        //echo $no1;
        $query2= "SELECT COUNT(*) as count FROM  `jobcards` WHERE DATE(`dateCreated`)= CURDATE()";
        $result2 = mysqli_query($db, $query2);
        $no2=intval(mysqli_fetch_assoc($result2)['count']);
        if($no2<=0){
            return intval(0);
            }
           else{
            return number_format(floatval(($no2/$no1)*100), 2, '.', '') ;
        }     
        }
        //percent my job cards increase/decrease
    function perctmyjobcards(){
        $db = getConnection();
        $query= "SELECT COUNT(*) as count FROM  `jobcards` WHERE DATE(`dateCreated`) = (SELECT MAX(DATE(`dateCreated`)) FROM  `jobcards` WHERE DATE(`dateCreated`) < CURDATE())";
        $result = mysqli_query($db, $query);
        $no1=intval(mysqli_fetch_assoc($result)['count']);
        //echo $no1;
        $query2= "SELECT COUNT(*) as count FROM  `jobcards` WHERE DATE(`dateCreated`)= CURDATE()";
        $result2 = mysqli_query($db, $query2);
        $no2=intval(mysqli_fetch_assoc($result2)['count']);
        if($no2<=0){
            return intval(0);
            }
           else{
            return number_format(floatval(($no2/$no1)*100), 2, '.', '') ;
        }     
        }
    //all open job cards
    function perctOJB(){
        $db = getConnection();
         
        $query= "SELECT COUNT(*) as count FROM `jobcards` WHERE `status`=1";
        $result = mysqli_query($db, $query);
        $no1=intval(mysqli_fetch_assoc($result)['count']);
        //echo $no1;
        $query2= "SELECT COUNT(*) as count FROM `jobcards`";
        $result2 = mysqli_query($db, $query2);
        $no2=intval(mysqli_fetch_assoc($result2)['count']);
        if($no2<=0){
            return intval(0);
            }
           else{
            return number_format(floatval(($no1/$no2)*100), 2, '.', '') ;
        }     
        }
function AllJ(){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM `jobcards`";
    $result = mysqli_query($db, $query);
    $no=mysqli_fetch_assoc($result)['count'];
return $no;
}

function AllopenJ(){
    $db = getConnection();
    $query= "SELECT COUNT(*) as count FROM `jobcards`WHERE `status`=1";
    $result = mysqli_query($db, $query);
    $no=mysqli_fetch_assoc($result)['count'];
return $no;
}
function AllMyJ($user){
    $db = getConnection();
    $queryagent= "SELECT `full_names` FROM `users` WHERE `username` = '$user'";
    $resultagent = mysqli_query($db, $queryagent);
    $agentname=mysqli_fetch_assoc($resultagent)['full_names'];
    $query= "SELECT COUNT(*) as count FROM `jobcards`WHERE `techn`='$agentname' OR`createdBy`='$user'";
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
    $queryagent= "SELECT `full_names` FROM `users` WHERE `username` = '$agent'";
    $resultagent = mysqli_query($db, $queryagent);
    $agentname=mysqli_fetch_assoc($resultagent)['full_names'];
    $query= "SELECT COUNT(*) as count FROM `insidence` WHERE `AssignedTo`='$agentname' OR `createdBy` = '$agent'";
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
    function getAgentTicketz($agent)
    {
        $db = getConnection();
        $query = "SELECT * FROM insidence WHERE createdBy = '$agent' ORDER BY id DESC LIMIT 3 ";
        $result = mysqli_query($db, $query);
        return $result;
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

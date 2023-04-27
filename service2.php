<?php
//require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");

createService();



// ADMIT MEMBER INTO A SERVICE
function admit($memberNo,$temp){
$db = getConnection();
$member1 = getMember($memberNo);
echo $memberNo;
$sevice = getService();
//$member = mysqli_fetch_assoc($member);
foreach ($member1 as $member){

$name = $member["name"];
$age = $member["age"];
$idNo = $member["idNo"];
$contact = $member['contact'];
$residence = $member['residence'];
$serviceGroup = $member['serviceGroup'];
$time = date("H:i:s");;
$state = 1;

$query = "SELECT * FROM `attendance` WHERE `sevice` ='$sevice' AND `memberNo` = '$memberNo' ";
$results = mysqli_query($db, $query);
if (mysqli_num_rows($results) == 1) {
    $query1 = "UPDATE `attendance` SET `temperature`='$temp',`time`='$time', `state`='$state' WHERE `sevice` = '$sevice' AND memberNo = '$memberNo'";
    mysqli_query($db, $query1);
} else{
    $query2 = "INSERT INTO `attendance`(`memberNo`, `name`, `age`, `idNo`, `contact`, `residence`, `temperature`, `time`, `serviceGroup`, `state`, `sevice`) 
    VALUES ('$memberNo','$name','$age','$idNo','$contact','$residence','$temp','$time','$serviceGroup','$state','$sevice')";
    mysqli_query($db, $query2);
}

if(mysqli_error($db)){
    echo mysqli_error($db);
 }
}
}
//GET CURRENT SERVICE
function getService(){
    $db = getConnection();
    $query = "SELECT servicename FROM `service` ORDER BY id DESC LIMIT 1";
    $results = mysqli_query($db, $query);
    $results = mysqli_fetch_assoc($results);
    $service = $results['servicename'];
    return $service;
}
// CREATE A SERVICE
function createService(){
    $db = getConnection();
    $day = date("l");
    $date = date("Y-m-d");
    $location = "METROLOGY";
    //echo "ch1";
if ($day == 'Sunday'){
    $serviceName = $day.$date;
    $query1 = "SELECT * FROM `service` WHERE `servicename` = '$serviceName' ";
    $results = mysqli_query($db, $query1);
    //echo(mysqli_num_rows($results));
    if (mysqli_num_rows($results) == 0) {
        $date2 = date("Y-m-d");
        echo "ch2";
        $query = "INSERT INTO `service`(`servicename`,  `location`) 
        VALUES ('$serviceName', '$location')";
        mysqli_query($db, $query);
        populate();
        updatev();

   }
   //updatev();

   if(mysqli_error($db)){
    echo mysqli_error($db);
    }
}
}
// all services without limits
function allservice(){
    $db = getConnection();
    $query = "SELECT * FROM `service` ORDER BY id DESC ";
    $results = mysqli_query($db, $query);
    return $results;
}



function allservices(){
    $db = getConnection();
    $query = "SELECT * FROM `service` ORDER BY id DESC LIMIT 7";
    $results = mysqli_query($db, $query);
    return $results;
}
function getvisitors(){
    $db = getConnection();
    $service = getService();
    $query = "SELECT * FROM `attendance` WHERE `state` = 1 AND sevice= '$service' AND `serviceGroup`= 'visitor'";
    $results = mysqli_query($db, $query);
    //$results = mysqli_fetch_assoc($results);
    
    return $results;

}

function attendance(){
    $db = getConnection();
    $service = getService();
    //echo $service;
    $query = "SELECT * FROM `attendance` WHERE `state` = 1 AND sevice= '$service'";
    $results = mysqli_query($db, $query);
    //$results = mysqli_fetch_assoc($results);
    
    return $results;
}

// absent function

function absentee(){
    $db = getConnection();
    $service = getService();
    //echo $service;
    $query = "SELECT * FROM `attendance` WHERE `state` = 0 AND sevice= '$service'";
    $results = mysqli_query($db, $query);
    //$results = mysqli_fetch_assoc($results);
    
    return $results;
}

function populate(){

    // populate service.

$db = getConnection(); 
$queryp = " SELECT * FROM members";
$member1 = mysqli_query($db, $queryp);
$sevice = getService();

foreach ($member1 as $member){


    $name = $member["name"];
    $age = $member["age"];
    $idNo = $member["idNo"];
    $contact = $member['contact'];
    $residence = $member['residence'];
    $serviceGroup = $member['serviceGroup'];
    $time = date("H:i:s");;
    $state = 0;
    $memberNo = $member['memberNo'];
    $memberNo = trim($memberNo);
    $temp = 0;
    
        $query2 = "INSERT INTO `attendance`(`memberNo`, `name`, `age`, `idNo`, `contact`, `residence`, `temperature`, `time`, `serviceGroup`, `state`, `sevice`) 
        VALUES ('$memberNo','$name','$age','$idNo','$contact','$residence','$temp','$time','$serviceGroup','$state','$sevice')";
        mysqli_query($db, $query2);
    
    
    if(mysqli_error($db)){
        echo mysqli_error($db);
    
     }
    }
}
function updatev(){
    $db = getConnection(); 
    $query= "UPDATE `members` SET `serviceGroup`= 'NewBelivers' WHERE `serviceGroup`= 'visitor'";
    mysqli_query($db, $query);
    
}
function gm(){
    $db = getConnection(); 
    $query = "SELECT * FROM `accSupp`";
    $data = mysqli_query($db, $query);

    return $data;

}

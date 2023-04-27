<?php

include ('connection.php');

$db = getConnection();

// if (!file_get_contents('php://input')){
// // Takes raw data from the request
// $json = file_get_contents('php://input');

// // Converts it into a PHP object
// $data = json_decode($json);

// $category = $json['category'];
// $department = $json['department'];
// $ticketNo = $json['ticketNo'];

// $query = "UPDATE `insidence` SET `category`='$category',`actionTo`='$department' WHERE `tiketNo` = '$ticketNo'";
// mysqli_query($db, $query);

// }


if (isset($_REQUEST['ticketNo'])){

$category = $_REQUEST['category'];
$department = $_REQUEST['department'];
$ticketNo = $_REQUEST['ticketNo'];
$agent = getagent($department);

$query = "UPDATE `insidence` SET `category`='$category',`actionTo`='$department', `createdBy`='$agent' WHERE `tiketNo` = '$ticketNo'";
mysqli_query($db, $query);

echo 1234;

}
echo "null";

function getagent($department){

    $agents = array();
     $db = getConnection();

     // get all active users

     $query = "SELECT `username` FROM `users` WHERE `status` = 'Active' and `department` = '$department'";
     $result = mysqli_query($db, $query);
     
     foreach ($result as $row){
        array_push($agents, $row['username']);

        
     }
     // LAST ASSIGNED

     //echo(json_encode($agents));

     $query1 = "SELECT `createdBy` FROM `insidence` ORDER BY `id` DESC LIMIT 1";
     $result1 = mysqli_query($db, $query1);
     $lastA = mysqli_fetch_assoc($result1)['createdBy'];

     $lastNo = array_search($lastA,$agents);
     $nextNo = $lastNo +1;
        $max = count($agents);
        if ($nextNo == $max){
            $nextNo = 0;
        }

     $user = $agents[$nextNo];
     return $user;
    
}

?>
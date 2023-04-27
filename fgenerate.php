<?php
session_start();

function sendChat($content, $email, $pin, $tell){

    $db = getConnection();

    $tiketNo = generateNo();
    $status = "Active";
    $category = "complain";
    $createdBy = getagent();
    $comment = "n/a";
    $source = "facebook";
    
    $counter = $_SESSION['conter'];

    if ($counter == 1){
    $_SESSION['conter'] = $counter;
    $tiketNo = generateNo();
    $_SESSION['ticket'] =$tiketNo;

    //insert into db

    echo "recived";

    $query1 = "INSERT INTO `insidence`(`tiketNo`, `pin`, `tell`, `email`, `massage`, `createdBy`, `category`, `status`, `source`, `creator`) 
    VALUES ('$tiketNo','$pin','$tell','$email','$content','$createdBy','$category','$status','$source', 'facebook')";
    mysqli_query($db, $query1);

    if(mysqli_error($db)){
        echo(mysqli_error($db));
    }

    $counter = $counter + 1;

    $_SESSION['conter'] = $counter;

    }else {
        $tiketNo = $_SESSION['ticket'];
        $query3 = "INSERT INTO `childIncident`(`tiketNo`, `pin`, `massage`, `comment`, `category`, `createdBy`, `origin`) 
        VALUES ('$tiketNo','$pin','$content','$comment','$category','$createdBy','customer')";
        mysqli_query($db, $query3);

        if(mysqli_error($db)){
            echo(mysqli_error($db));
        }

        $counter = $counter + 1;

        $_SESSION['conter'] = $counter;
    }
}

// MEMBER NO GENERATION
function generateNo(){
    $no = rand(1000000, 9999999);
    $no = "KT".$no;
    
    return $no;

}
function getagent(){

    $agents = array();
     $db = getConnection();

     // get all active users

     $query = "SELECT `username` FROM `users` WHERE `status` = 'Active'";
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

//get child ticket

function childTickets($ticketNo){
    $db = getConnection();
    $query = "SELECT * FROM childIncident WHERE  tiketNo = '$ticketNo'";
    $result = mysqli_query($db, $query);
    return $result;
}

function tickethead(){
    $email = $_SESSION['customer'];

    $db = getConnection();
    $query2 = "SELECT * FROM insidence WHERE email = '$email' AND `status` = 'Active' AND source = 'chat'";
    $result1 = mysqli_query($db, $query2);
    $result1 = mysqli_fetch_assoc($result1);
    $pin = $result1['pin'];
    $massage = $result1['massage'];
    $_SESSION['ticket']= $result1['tiketNo'];
    return $massage;
}


?>
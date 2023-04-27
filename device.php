<?php
//include ("connection.php");


//unasigened();

function registerdevice(){
    $db = getConnection();

    $base1=array( 'A', 'B','C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'W', 'Z');
    $base2 =rand(0,25);
    $no = rand(1000000, 9999999);

    $generatedKey=$base1[rand(0,25)]
                .$base1[rand(0,25)]
                .$base1[rand(0,25)]
                .$base1[rand(0,25)]
                .$no.$base1[rand(0,25)]
                .$base1[rand(0,25)]
                .$base1[rand(0,25)]
                .$base1[rand(0,25)]
                .$base1[rand(0,25)];
                
    
    $customer = mysqli_real_escape_string($db, $_POST['customerSelect']);
    $serialNumber= mysqli_real_escape_string($db, $_POST['serialNumber']);
    $username= $_SESSION['username'] ;
    
    if (empty($serialNumber)) { 
        array_push($GLOBALS ['errors'], "Serial number is required");
     }
    
     else {
        $device_check_query = "SELECT * FROM devices WHERE serialNumber='$serialNumber' or `customerName` = '$customer' LIMIT 1";
        $result = mysqli_query($db, $device_check_query);
        $device = mysqli_fetch_assoc($result);

        if ($device) { // if device exists
            if ($device['serialNumber'] === $serialNumber) {
                array_push($GLOBALS ['errors'], "Device  is already activated");
            }
        }
        else {
            if (empty($customer) ) { 
                array_push($GLOBALS ['errors'], "Customer Name is required");
             }
            else {
                $customer_check_query = "SELECT * FROM `customers` WHERE `cusName`='$customer' LIMIT 1";
                $customerresult = mysqli_query($db, $customer_check_query);
                $customerobj = mysqli_fetch_assoc($customerresult); 
                echo "I am here";

                if($customerobj>0){

                   $CustomerPin= $customerobj['pin'];
                   $CustomerID=$customerobj['id'];

                   $status="ACTIVE";
                    //echo "hey hey";
                    
                    $d = date("Y-m-d G:i:s");
                    $query="INSERT INTO `devices`( `dateCreated`, `customerName`, `pin`, `serialNumber`, `deviceKey`, `cusID`, `status`, `userID`) 
                    VALUES ('$d','$customer','$CustomerPin','$serialNumber','$generatedKey','$CustomerID','$status','$username')";
                    mysqli_query($db, $query);

                    $_SESSION['addition'] = "Device added Successful ";
                }
                else {
                    array_push($GLOBALS ['errors'], "The Customer is not registered");  
                }

            }

                

        }
     

           
    }

}
function generateKey(){
    $db = getConnection();
     
     
     $customer = mysqli_real_escape_string($db, $_POST['customerSelect']);
     $serialNumber= mysqli_real_escape_string($db, $_POST['serialNumber']);
     $username= $_SESSION['username'] ;
     

     if (empty($customer) ) { array_push($GLOBALS ['errors'], "Customer is required"); }
     if (empty($serialNumber)) { array_push($GLOBALS ['errors'], "Serial is required"); }

     $device_check_query = "SELECT * FROM devices WHERE serialNumber='$serialNumber' or `customer` = '$customer' LIMIT 1";
     $result = mysqli_query($db, $device_check_query);
     $device = mysqli_fetch_assoc($result);
 
     if ($device) { // if user exists
         if ($device['serialNumber'] === $serialNumber) {
             array_push($GLOBALS ['errors'], "Device already is already activated");
         }
 
        
     }
 
     // Finally, register user if there are no errors in the form
     if (count($GLOBALS ['errors']) == 0) {
         $ip = getip();
        $t = time();
        $status="Active";
        //echo "hey hey";
         $d = date("Y-m-d G:i:s",$t);
         $query="INSERT INTO `devices`( `dateCreated`, `customer`, `serialNumber`, `status`, `userID`) VALUES 
         (' $d','$customer','$serialNumber','$status','$username')";

         mysqli_query($db, $query);
         $_SESSION['addition'] = "Device added Successful ";
         
         $username = $_SESSION['username'];
         //$username = "admin";

          //
                $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$username','$d', 'add_customer', 'success', '$customer', '$ip')";
                    mysqli_query($db, $audit);

                //
        // header('location: /crm/main/index.php');

        //  if(mysqli_error($db)){
        //     echo mysqli_error($db);
        //}
     }
 }
// capture ticket data
 function CreateTicket(){
    $db = getConnection();
    //receive all input values from the form
    //$memberNo = 1;
    $ticketNo = generateNo();
    
    $_SESSION['ticketNo'] = $ticketNo;
    $pin = mysqli_real_escape_string($db, $_POST['pin']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $idNo = mysqli_real_escape_string($db, $_POST['idNo']);
    $tell = mysqli_real_escape_string($db, $_POST['tel']);
    $middleName = mysqli_real_escape_string($db, $_POST['middlename']);
    $type = mysqli_real_escape_string($db, $_POST['type']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $complain = mysqli_real_escape_string($db, $_POST['complain']);
    $comment = mysqli_real_escape_string($db, $_POST['comments']);
    $source = mysqli_real_escape_string($db, $_POST['source']);
    $actionTo = mysqli_real_escape_string($db, $_POST['actionTo']);
    $user = $_SESSION['username'];


    $ip = getip();
        $t = time();
        //echo "hey hey";
         $d = date("Y-m-d G:i:s",$t);

    $query = "INSERT INTO `insidence`(`tiketNo`, `pin`, `tell`, `email`, `massage`, `comment`,  `createdBy`, `category`, `source`, `creator`, `actionTo`) 
         VALUES ('$ticketNo','$pin','$tell','$email','$complain','$comment','$user', '$type', '$source', '$user', '$actionTo')";
         mysqli_query($db, $query);

         $_SESSION['iaddition'] = "Ticket ".$ticketNo." added Successful ";

         //
         $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'add_ticket', 'success', '$ticketNo', '$ip')";
         mysqli_query($db, $audit);

     //

 }

// MEMBER NO GENERATION
function generateNo(){
    $no = rand(1000000, 9999999);
    $no = "KSR".$no;
    
    return $no;

}
// GET A agents TICKET
function getAgentTiket($agent, $resolved = false){
    $db = getConnection();
    $query = "SELECT * FROM insidence WHERE createdBy = '$agent' AND `status`= 'Active' ORDER BY id DESC LIMIT 10";
    $result = mysqli_query($db, $query);
    if(mysqli_error($db)){
        echo mysqli_error($db);
    }

    return $result;
}
function getCustomerData(){
    $db = getConnection();
    $searchTerm = $_GET['term']; 
    $query = "SELECT * FROM `customers` WHERE  `cusName` LIKE '%".$searchTerm."%' ORDER BY  `cusName` ASC";
    $result = mysqli_query($db, $query);
    $skillData = array(); 
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['cusName']; 
        echo $data['vaalue'];
        array_push($skillData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 
    

}

function getAgentTikets($agent, $resolved = false){
    $db = getConnection();
    $query = "SELECT * FROM insidence WHERE createdBy = '$agent'  AND `status`= 'Active' ORDER BY id DESC ";

    if($resolved){
        $query = "SELECT * FROM insidence WHERE createdBy = '$agent'  AND `status`= 'closed' ORDER BY id DESC ";
    }

    $result = mysqli_query($db, $query);
    // if(mysqli_error($db)){
    //     echo mysqli_error($db);
    // }

    return $result;
}


function getAgentTikets2($agent, $resolved = false){
    $db = getConnection();
    $query = "SELECT * FROM insidence WHERE createdBy = '$agent'  AND `status`= 'Active' ORDER BY id DESC ";

    if($resolved){
        $query = "SELECT * FROM insidence WHERE  `status`= 'closed' ORDER BY id DESC ";
    }

    $result = mysqli_query($db, $query);
    // if(mysqli_error($db)){
    //     echo mysqli_error($db);
    // }

    return $result;
}

// all customers
function alldevices(){
    $db = getConnection();
    $query = "SELECT * FROM `devices`";
    $result = mysqli_query($db, $query);
    return $result;
}

//  GET ALL tickets
function allTickets(){
    $db = getConnection();
    $query = "SELECT * FROM insidence WHERE `status` = 'Active'";
    $result = mysqli_query($db, $query);
    return $result;
}
//get child ticket

function childTickets($ticketNo){
    $db = getConnection();
    $query = "SELECT * FROM childIncident WHERE  tiketNo = '$ticketNo'";
    $result = mysqli_query($db, $query);
    return $result;
}

// CHILDREN

function allchildren(){
    $db = getConnection();
    $query = "SELECT * FROM members WHERE `age` BETWEEN 0.1 AND 15";
    $result = mysqli_query($db, $query);
    return $result;
}

function unasigened(){
    $db = getConnection();
    $query = "SELECT memberNo from members where name='' AND contact =''";
    $result = mysqli_query($db, $query);
    if(mysqli_error($db)){
        echo mysqli_error($db);
    }
    //echo($result);
    //$result = mysqli_fetch_assoc($result);
    //echo($result);
    $no=71;
    $number2=1411;
    foreach ($result as $row){
        if(isset($row['memberNo'])){
            //echo($row['memberNo']);
            $number = $row['memberNo'];
            echo $number;

        //    $query2 = "SELECT count(*) as count from members2";
        //    $result2 = mysqli_query($db, $query2);
        //    $no=mysqli_fetch_assoc($result2)['count'];

        //    for ($x =1; $x<$no; $x++) { 
            
            $query1 = "UPDATE `members2` SET `memberNo`='$number2' WHERE `id` = $no";
           $r= mysqli_query($db, $query1);
            $no=$no + 1;
            $number2= $number2 + 1;
            echo($no);
            if(mysqli_error($db)){
                echo mysqli_error($db);
            }
        //}
       }
    }
}



?>
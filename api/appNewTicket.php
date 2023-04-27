<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");


   
if(!empty($_POST['pin']) && !empty($_POST['serialNumber']) && !empty($_POST['priority']) && !empty($_POST['description'])) {
   
        // New Data Input
        $db=getConnection();
         $ticketNo = generateNo();
         $d = date("Y-m-d G:i");
         $cusromerPin= $_POST['pin'];
         $serialNumber= $_POST['serialNumber'];
         $priority= $_POST['priority'];
         $complain= $_POST['description'];

         //get Customer details
            $customer_check_query = "SELECT * FROM `customers` WHERE `pin`='$cusromerPin' LIMIT 1";
            $customerResult = mysqli_query($db, $customer_check_query);
            $customer = mysqli_fetch_assoc($customerResult);
            
            if ($customer) { 
                        
                        $cusName = $customer['cusName'];
                        $mobileNumber = $customer['phoneNumber'];
                        $businessName = $customer['businessName'];
                        $source ="APPLICATION";
                        $dStatus ="NOT BOOKED IN";
                        $status="OPEN";
                       

                        $queryTicket = "INSERT INTO `insidence`( `dateCreated`, `ticketNumber`,
                        `cusName`, `mobileNumber`, `businessName`, 
                        `serialNumber`, `source`, `dStatus`, 
                        `priority`, `complain`, `createdBy`,`status`) 
                        VALUES (
                        '$d','$ticketNo','$cusName',
                        '$mobileNumber','$businessName','$serialNumber',
                        '$source', '$dStatus', '$priority', 
                        '$complain', '$cusName', '$status')";

                     if(mysqli_query($db, $queryTicket)){
                           $response['Ticket']="Saved Successfully";
                     }
                     else{
                           $response['Ticket']="Failed: Could not be saved";
                     }
                     
                     http_response_code(400);
                     echo json_encode($response);
            }
            
            else {
                     $response['status']="Not Registered";

                     http_response_code(400);
                     echo json_encode($response); 
            }
         
    }

       
?>

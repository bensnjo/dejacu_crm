<?php
include("sendSms.php");
include("Smail.php");


//unasigened();
$GLOBALS['errors'] = array();
function registercustomer()
{
    $db = getConnection();
    //receive all input values from the form
    //$memberNo = 1;
    //$ticketNo = generateNo();

    //$_SESSION['ticketNo'] = $ticketNo;
    //$pin = mysqli_real_escape_string($db, $_POST['pin']);
    $cusname = mysqli_real_escape_string($db, $_POST['cusname']);;
    $pin = mysqli_real_escape_string($db, $_POST['pin']);
    $idNo = mysqli_real_escape_string($db, $_POST['idNo']);
    $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
    $businessName = mysqli_real_escape_string($db, $_POST['businessName']);
    $businessAddress = mysqli_real_escape_string($db, $_POST['businessAddress']);
    $county = mysqli_real_escape_string($db, $_POST['county']);
    $email = mysqli_real_escape_string($db, $_POST['email']);


    //form validation: ensure that the form is correctly filled ...
    //by adding (array_push()) corresponding error unto $GLOBALS ['errors'] array
    if (empty($idNo)) {
        array_push($GLOBALS['errors'], "ID  is required");
    }
    if (empty($phoneNumber)) {
        array_push($GLOBALS['errors'], "Mobile Phone Number  is required");
    }
    if (empty($cusname)) {
        array_push($GLOBALS['errors'], "Customer name is required");
    }
    if (empty($pin)) {
        array_push($GLOBALS['errors'], "KRA pin  is required");
    }
    if (empty($businessAddress)) {
        array_push($GLOBALS['errors'], "Mobile Phone Number  is required");
    }
    if (empty($businessName)) {
        array_push($GLOBALS['errors'], "Business name is required");
    }
    if (empty($county)) {
        array_push($GLOBALS['errors'], "County name is required");
    }
    if (empty($email)) {
        array_push($GLOBALS['errors'], "Email Address is required");
    }


    //  first check the database to make sure 
    //  a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM customers WHERE idNumber='$idNo' or `pin` = '$pin' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['idNumber'] === $idNo) {
            array_push($GLOBALS['errors'], "Customer  already exists");
        }

        if ($user['pin'] === $pin) {
            array_push($GLOBALS['errors'], "KRA Pin Number already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($GLOBALS['errors']) == 0) {
        $ip = getip();
        $username = $_SESSION['username'];
        $msg = "Dear " . $cusname . ",Thank you for believing in us. We appreciate you joining us. We aspire to serve you best. Thank you";
        $t = time();
        //echo "hey hey";
        $d = date("Y-m-d G:i:s", $t);
        $query = "INSERT INTO `customers`(`dateCreated`, `idNumber`, `pin`, `phoneNumber`, `cusName`, `businessName`, `businessAddress`, `county`, `email`, `createdBy`) 
         VALUES ('$d','$idNo','$pin','$phoneNumber','$cusname','$businessName','$businessAddress','$county','$email','$username ')";
        mysqli_query($db, $query);

        //send sms
        sendSMSnew($phoneNumber, $msg);
        //save sms
        $insertSms = "INSERT INTO `sms`( `customer`, `phoneNumber`, `message`, `type`) 
          VALUES ('$cusname','$phoneNumber','$msg','New_Customer')";
        mysqli_query($db, $insertSms);

        $_SESSION['addition'] = "Customer added Successful ";
        $username = $_SESSION['username'];
        //$username = "admin";

        //
        $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$username','$d', 'add_customer', 'success', '$pin', '$ip')";
        mysqli_query($db, $audit);

        //
        // header('location: /crm/main/index.php');

        //  if(mysqli_error($db)){
        //     echo mysqli_error($db);
        //}
    }
}
// capture ticket data
function regcomplain()
{
    $db = getConnection();
    $ticketNo = generateNo();
    $_SESSION['ticketNo'] = $ticketNo;
    $cusName = mysqli_real_escape_string($db, $_POST['cusName']);
    $mobileNumber = mysqli_real_escape_string($db, $_POST['mobileNumber']);
    $businessName = mysqli_real_escape_string($db, $_POST['businessName']);
    $serialNumber = mysqli_real_escape_string($db, $_POST['serialNumber']);
    $source = mysqli_real_escape_string($db, $_POST['source']);
    $resolved = mysqli_real_escape_string($db, $_POST['resolved']);
    $dStatus = mysqli_real_escape_string($db, $_POST['dStatus']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $complain = mysqli_real_escape_string($db, $_POST['complain']);
    $msg = "Dear " . $cusName . ", a ticket with ticket No. " . $ticketNo . " has been created. We will inform your on the progres of the Ticket. Thank you";
    if($resolved=="CLOSED"){
        $status = "CLOSED";
        $resolvedat=date("Y-m-d G:i");
        $resolvedby=$_SESSION['username'];
    }
    else{
        $status = "OPEN";
        $resolvedat=null;
        $resolvedby='';
         sendSMSnew($mobileNumber, $msg);
    }
   
    $assignedto = mysqli_real_escape_string($db, $_POST['assigned']);
    $user = $_SESSION['username'];
   
    $ip = getip();
    $t = time();
    //echo "hey hey";
    $d = date("Y-m-d G:i", $t);
    $query = "INSERT INTO `insidence`( `dateCreated`, `ticketNumber`, `cusName`, `mobileNumber`, `businessName`, `serialNumber`, `source`, `dStatus`, `priority`, `complain`, `createdBy`, `status`, `AssignedTo`, `resolvedAt`, `resolvedby`) 
    VALUES ( '$d','$ticketNo','$cusName','$mobileNumber','$businessName','$serialNumber','$source', '$dStatus', '$priority','$complain', '$user', '$status', '$assignedto','$resolvedat','$resolvedby')";
    mysqli_query($db, $query);
    //send sms
   
    //save sms
    $insertSms = "INSERT INTO `sms`( `customer`, `phoneNumber`, `message`, `type`) 
            VALUES ('$cusName','$mobileNumber','$msg','Ticket')";
    mysqli_query($db, $insertSms);

    $_SESSION['iaddition'] = "Ticket " . $ticketNo . " added Successful ";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'add_ticket', 'success', '$ticketNo', '$ip')";
    mysqli_query($db, $audit);

    //

}
function updatecomplain($id)
{
    $db = getConnection();
    $ticketNo = generateNo();
    $_SESSION['ticketNo'] = $ticketNo;
    $cusName = mysqli_real_escape_string($db, $_POST['cusName']);
    $mobileNumber = mysqli_real_escape_string($db, $_POST['mobileNumber']);
    $businessName = mysqli_real_escape_string($db, $_POST['businessName']);
    $serialNumber = mysqli_real_escape_string($db, $_POST['serialNumber']);
    $source = mysqli_real_escape_string($db, $_POST['source']);
    $resolved = mysqli_real_escape_string($db, $_POST['resolved']);
    $dStatus = mysqli_real_escape_string($db, $_POST['dStatus']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $complain = mysqli_real_escape_string($db, $_POST['complain']);
    $assignedto = mysqli_real_escape_string($db, $_POST['assigned']);
    $user = $_SESSION['username'];
    $ip = getip();
    $t = time();
    $d = date("Y-m-d G:i", $t);

     if($resolved=="CLOSED"){
        $status = "CLOSED";
        $query = "UPDATE `insidence` SET `cusName`='$cusName',`mobileNumber`='$mobileNumber',`businessName`='$businessName',
        `serialNumber`='$serialNumber',`source`='$source',`dStatus`='$dStatus',`priority`='$priority',
        `complain`='$complain',`status`='$status',`AssignedTo`='$assignedto' WHERE `id`='$id'";
        mysqli_query($db, $query);
    }
    else{
        $status = "OPEN";
        $resolvedat=null;
        $resolvedby='';
        $query1 = "UPDATE `insidence` SET `cusName`='$cusName',`mobileNumber`='$mobileNumber',`businessName`='$businessName',
        `serialNumber`='$serialNumber',`source`='$source',`dStatus`='$dStatus',`priority`='$priority',
        `complain`='$complain',`status`='$status',`AssignedTo`='$assignedto',`resolvedAt`='$resolvedat',`resolvedby`='$resolvedby' WHERE `id`='$id'";
        mysqli_query($db, $query1); 
    }
    //send sms

    $_SESSION['iaddition'] = "Ticket " . $ticketNo . " updated successfully ";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'update_ticket', 'success', '$ticketNo', '$ip')";
    mysqli_query($db, $audit);
    //
}

function regjobcard()
{
    $db = getConnection();
    $jobcardNo = generateJobCardNo();
    $_SESSION['jobcardNo'] = $jobcardNo;
    $cusName = mysqli_real_escape_string($db, $_POST['cusName']);
    $mobileNumber = mysqli_real_escape_string($db, $_POST['mobileNumber']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $equipment = mysqli_real_escape_string($db, $_POST['equipment']);
    $charger = mysqli_real_escape_string($db, $_POST['charger']);
    $qty = mysqli_real_escape_string($db, $_POST['qty']);
    $modelseq = mysqli_real_escape_string($db, $_POST['modelseq']);
    $serialNumber = mysqli_real_escape_string($db, $_POST['serialNumber']);
    $fault = mysqli_real_escape_string($db, $_POST['fault']);
    //$workdone = mysqli_real_escape_string($db, $_POST['workdone']);
    $technician = mysqli_real_escape_string($db, $_POST['technician']);
    $user = $_SESSION['username'];
    $status = 1;
    $msg = "Dear " . $cusName . ", a Job Card with number " . $jobcardNo . " has been created. We will keep you updated on the progres of the job card. Thank you";
    $ip = getip();
    $d = date("Y-m-d G:i");
    $query = " INSERT INTO `jobcards`(`dateCreated`, `jbcrdNum`, `customer`, `phoneNumber`, `serialNumber`, `email`, `devicename`, `charger`, `qty`, `model`, `fault`, `techn`, `createdBy`, `status`)
    VALUES ('$d','$jobcardNo','$cusName','$mobileNumber','$serialNumber','$email','$equipment','$charger','$qty','$modelseq','$fault','$technician','$user','$status')";
    if (mysqli_query($db, $query)) {
        //send sms
        sendSMSnew($mobileNumber, $msg);
        //save sms
        $insertSms = "INSERT INTO `sms`( `customer`, `phoneNumber`, `message`, `type`) 
            VALUES ('$cusName','$mobileNumber','$msg','JobCard')";
        if(mysqli_query($db, $insertSms)){
        $_SESSION['iaddition'] = "Job Card " . $jobcardNo . " added Successful ";
        //send sms to technician
        $msgtech="Dejavu Note: Jobcard ". $jobcardNo ." created at ".$d." has been assigned to you. Kindly address.";
        $techniciannum=mysqli_fetch_assoc(mysqli_query($db, "SELECT  `mobile_phone` FROM `users` where full_names='$technician'"));
        $techn= $techniciannum['mobile_phone'];
        if(sendSMSnew($techn, $msgtech)){
        //save sms
        $insertSms2 = "INSERT INTO `sms`( `customer`, `phoneNumber`, `message`, `type`) 
        VALUES ('$user','$techn','$msgtech','JobCard')";
        mysqli_query($db, $insertSms2);
        }
        }
        $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'add_ticket', 'success', '$jobcardNo', '$ip')";
        mysqli_query($db, $audit);
    }
}
function updateJobcard($jobcardNo){
    $db = getConnection();
    $d = date("Y-m-d G:i");
    $ip = getip();
    //$cusName = mysqli_real_escape_string($db, $_POST['cusName']);
   //$mobileNumber = mysqli_real_escape_string($db, $_POST['mobileNumber']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $equipment = mysqli_real_escape_string($db, $_POST['equipment']);
    $charger = mysqli_real_escape_string($db, $_POST['charger']);
    $qty = mysqli_real_escape_string($db, $_POST['qty']);
    $modelseq = mysqli_real_escape_string($db, $_POST['modelseq']);
    $serialNumber = mysqli_real_escape_string($db, $_POST['serialNumber']);
    $fault = mysqli_real_escape_string($db, $_POST['fault']);
    //$technician = mysqli_real_escape_string($db, $_POST['technician']);
    $user = $_SESSION['username'];
    $query = "UPDATE `jobcards` SET `serialNumber`='$serialNumber',`email`='$email',`devicename`=' $equipment]',`charger`='$charger',
    `qty`='$qty',`model`='$modelseq',`fault`='$fault',`work`='[value-13]' WHERE `jbcrdNum`='$jobcardNo'";
    $result = mysqli_query($db, $query);
    //sendSMSnew($cusnum, $msgtech);
    $_SESSION['iaddition'] = "Jobcard".$jobcardNo." closed succcessfully";
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
    VALUES('$user','$d', 'update_jbc', 'success', '$jobcardNo', '$ip')";
    mysqli_query($db, $audit);
    return $result;
}
function closejobcard($jobNumber,$cusnum)
{
    $db = getConnection();
    $d = date("Y-m-d G:i");
    $ip = getip();
    $status=1;
    $jobcardstatus = mysqli_real_escape_string($db, $_POST['closeJobcard']);
    if( $jobcardstatus=="CLOSE"){
        $status=0;
        $msgtech="Job card ".$jobNumber." has been closed. Thank you";
        $user = $_SESSION['username'];
    $query = "UPDATE `jobcards` SET `status` ='$status',`closedBy`='$user' WHERE `jbcrdNum`='$jobNumber'";
    $result = mysqli_query($db, $query);
    sendSMSnew($cusnum, $msgtech);
    }
    $_SESSION['iaddition'] = "Jobcard".$jobNumber." closed succcessfully";
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
    VALUES('$user','$d', 'close jbc', 'success', '$jobNumber', '$ip')";
    mysqli_query($db, $audit);
    return $result;
}

function issuemachine($jobNumber){
    $db = getConnection();
    $d = date("Y-m-d G:i");
    $ip = getip();
    $machinestatus = mysqli_real_escape_string($db, $_POST['issuedmachine']);
    if( $machinestatus=="ISSUED"){
        $status=1;
        //$msgtech="Job card ".$jobNumber." has been closed. Thank you";
        $user = $_SESSION['username'];
    $query = "UPDATE `jobcards` SET `issued`='$status',`issuedby`='$user' WHERE `jbcrdNum`='$jobNumber'";
    $result = mysqli_query($db, $query);
    //sendSMSnew($cusnum, $msgtech);
    }
    $_SESSION['iaddition'] = "Machine issued succcessfully";
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
    VALUES('$user','$d', 'issue_machine', 'success', '$jobNumber', '$ip')";
    mysqli_query($db, $audit);
    return $result;

}
// MEMBER NO GENERATION
function generateNo()
{
    $db = getConnection();
    $query2 = "SELECT `ticketNumber` FROM `djv_nums`";
    $fetchNumber = mysqli_query($db, $query2);
    $keyAvailable = mysqli_fetch_assoc($fetchNumber);
    $no = $keyAvailable['ticketNumber'];
    $newNo = ++$no;
    $newNumber =  "DJV" . $newNo . "T";

    $updatequery = "UPDATE `djv_nums` SET `ticketNumber`=' $newNo' WHERE id=1";
    if (mysqli_query($db, $updatequery)) {
        return $newNumber;
    }
}
function generateJobCardNo()
{
    $db = getConnection();
    $query2 = "SELECT `jobcardNumber` FROM `djv_nums`";
    $fetchNumber = mysqli_query($db, $query2);
    $keyAvailable = mysqli_fetch_assoc($fetchNumber);
    $no = $keyAvailable['jobcardNumber'];
    $newNo = ++$no;
    $newNumber =  "DJV" . $newNo . "JB";

    $updatequery = "UPDATE `djv_nums` SET `jobcardNumber`=' $newNo' WHERE id=1";
    if (mysqli_query($db, $updatequery)) {
        return $newNumber;
    }
}
// GET A agents TICKET
function getAgentTiket($agent, $resolved = false)
{
    $db = getConnection();
    $query = "SELECT * FROM `insidence` WHERE `createdBy`= '$agent'  ORDER BY id DESC LIMIT 10";
    $result = mysqli_query($db, $query);
    if (mysqli_error($db)) {
        echo mysqli_error($db);
    }

    return $result;
}

//getjobcards
function getAgentjobcards($agent)
{
    $db = getConnection();
    $queryjobcards = "SELECT * FROM `jobcards` WHERE `createdBy`='$agent' ORDER BY id DESC LIMIT 10";
    $result = mysqli_query($db, $queryjobcards);
    if (mysqli_error($db)) {
        echo mysqli_error($db);
    }

    return $result;
}
function getAlljobcards()
{
    $db = getConnection();
    $queryjobcards = "SELECT * FROM `jobcards` ORDER BY id asc";
    $result = mysqli_query($db, $queryjobcards);
    if (mysqli_error($db)) {
        echo mysqli_error($db);
    }

    return $result;
}
function getAgentTikets($agent)
{
    $db = getConnection();
    $query = "SELECT * FROM insidence WHERE createdBy = '$agent' ORDER BY id DESC ";
    $result = mysqli_query($db, $query);
    return $result;
}


function getAgentTikets2($agent, $resolved = false)
{
    $db = getConnection();
    $query = "SELECT * FROM insidence WHERE createdBy = '$agent'  AND `status`= 'Active' ORDER BY id DESC ";

    if ($resolved) {
        $query = "SELECT * FROM insidence WHERE  `status`= 'closed' ORDER BY id DESC ";
    }

    $result = mysqli_query($db, $query);
    // if(mysqli_error($db)){
    //     echo mysqli_error($db);
    // }

    return $result;
}

// all customers
function allcustomers()
{
    $db = getConnection();
    $query = "SELECT * FROM customers ";
    $result = mysqli_query($db, $query);
    return $result;
}
function registerlead(){
$db = getConnection();
    $ldName = mysqli_real_escape_string($db, $_POST['leadname']);
    $businessname = mysqli_real_escape_string($db, $_POST['businessname']);
    $phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
    $location = mysqli_real_escape_string($db, $_POST['location']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $industry = mysqli_real_escape_string($db, $_POST['industry']);
    $county = mysqli_real_escape_string($db, $_POST['county']);

    $user = $_SESSION['username']; $ip = getip();
    $t = time();
    $d = date("Y-m-d G:i");
    $query = "INSERT INTO `djvuleads`( `customer`, `phoneNumber`, `email`,`business_name`, `location`, `industry`, `county`, `datecreated`, `created by`)
     VALUES ('$ldName','$phonenumber','$email','$businessname', '$location','$industry','$county','$d','$user')";
    mysqli_query($db, $query);
    $_SESSION['iaddition'] = "Lead added Successful ";
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'add_lead', 'success', '$ldName', '$ip')";
    mysqli_query($db, $audit);

}
function allleads(){
    $db = getConnection();
    $query = "SELECT * FROM djvuleads";
    $result = mysqli_query($db, $query);
    return $result;
}
function agentleads($agent){
    $db = getConnection();
    $query = "SELECT * FROM `djvuleads` WHERE `created by`='$agent'";
    $result = mysqli_query($db, $query);
    return $result;  
}
function updatelead($id){
    $db = getConnection();
    $cusName =  $_POST['leadname'];
    $phoneNumber = $_POST['phonenumber'];
    $businessName = $_POST['businessname'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $industry = $_POST['industry'];
    $county = $_POST['county'];
    $user = $_SESSION['username'];
    $query2 = "UPDATE `djvuleads` SET `customer`='$cusName',`phoneNumber`='$phoneNumber',`business_name`='$businessName',`email`='$email',`location`=' $location', `industry`=' $industry',`county`='$county' WHERE `id`='$id'";
    mysqli_query($db, $query2);
    $ip = getip();
    $t = time();
    $d = date("Y-m-d G:i:s", $t);
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
 VALUES('$user','$d', 'Lead_update', 'success', '$cusName', '$ip')";
    mysqli_query($db, $audit);
    $_SESSION['iaddition'] = "Lead updated Successfully ";
}
function addcontact($id)
{
    $db = getConnection();
    $groupid = $id;
    $d = date("Y-m-d G:i");
    $ip = getip();
    $cusName = mysqli_real_escape_string($db, $_POST['contactName']);
    $mobileNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $user = $_SESSION['username'];

    $query = "INSERT INTO `group_join`( `group_id`, `name`, `phonenumber`, `email`, `dateCreated`, `createdby`) 
    VALUES ('$groupid','$cusName','$mobileNumber','$email','$d','$user')";
    $result = mysqli_query($db, $query);

    $_SESSION['iaddition'] = "Contact added Successful ";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
    VALUES('$user','$d', 'add_contact', 'success', '$cusName ', '$ip')";
    mysqli_query($db, $audit);
    return $result;
}
function editcontact($id)
{
    $db = getConnection();
    $d = date("Y-m-d G:i");
    $ip = getip();
    $cusName = mysqli_real_escape_string($db, $_POST['contactName']);
    $mobileNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $user = $_SESSION['username'];

    $query = "UPDATE `group_join` SET `name`='$cusName',`phonenumber`='$mobileNumber',`email`='$email' WHERE `id`=$id";
    $result = mysqli_query($db, $query);

    $_SESSION['iaddition'] = "Contact updated Successful ";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
    VALUES('$user','$d', 'edit_contact', 'success', '$cusName ', '$ip')";
    mysqli_query($db, $audit);
    return $result;
}
function addgroup()
{
    $db = getConnection();
    $d = date("Y-m-d G:i");
    $ip = getip();
    $groupname = mysqli_real_escape_string($db, $_POST['groupname']);
    $status = 1;
    $user = $_SESSION['username'];

    $query = "INSERT INTO `groups`( `name`, `reference`, `status`) VALUES ('$groupname','$groupname','$status')";
    $result = mysqli_query($db, $query);

    $_SESSION['iaddition'] = "Group created succcessfully";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
    VALUES('$user','$d', 'add_group', 'success', '$groupname', '$ip')";
    mysqli_query($db, $audit);
    return $result;
}
//  GET ALL tickets
function allTickets()
{
    $db = getConnection();
    $query = "SELECT * FROM `insidence`";
    $result = mysqli_query($db, $query);
    return $result;
}
function openTickets()
{   $status="OPEN";
    $db = getConnection();
    $query = "SELECT * FROM `insidence` WHERE `status`='$status'";
    $result = mysqli_query($db, $query);
    return $result;
}
function groupcontact($id)
{
    $db = getConnection();
    $query = "SELECT * FROM `group_join` WHERE `group_id`='$id'";
    $result = mysqli_query($db, $query);
    return $result;
}
function smsgroup($groupid)
{
    $db = getConnection();
    set_time_limit(5000);
    $d = date("Y-m-d G:i");
    $ip = getip();
    //fetch contact
    $contacts = groupcontact($groupid);
    $textmessage = mysqli_real_escape_string($db, $_POST['smsname']);
    $user = $_SESSION['username'];

    foreach ($contacts as $contact) {
        $number = $contact['phonenumber'];
        //$name = $contact['name'];
        sendSMSnew($number, $textmessage);
    }
    $mobileNumber = "Group Numbers";
    $groupname = getgroupname($groupid);
    $insertSms = "INSERT INTO `sms`( `customer`, `phoneNumber`, `message`, `type`) 
            VALUES ('$groupname','$mobileNumber','$textmessage','JobCard')";
    mysqli_query($db, $insertSms);
    $_SESSION['iaddition'] = "Job Card  added Successful ";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'groupsms', 'success', '$textmessage', '$ip')";
    mysqli_query($db, $audit);
}
function emailgroup($groupid)
{
    set_time_limit(5000);
    $db = getConnection();
    $d = date("Y-m-d G:i");
    $ip = getip();
    //fetch contact
    $contacts = groupcontact($groupid);
    $subject = mysqli_real_escape_string($db, $_POST['emailsubject']);
    $message = mysqli_real_escape_string($db, $_POST['emailmsg']);
    $user = $_SESSION['username'];

    foreach ($contacts as $contact) {
        $email = $contact['email'];
        send_mail_by_PHPMailer($email, $subject, $message);
    }
    $groupname = getgroupname($groupid);
    $emails = "Group emails to". $groupname;
    $type=" Bulk";
    $insertSms = "INSERT INTO `emails`( `recipient`, `message`, `dateCreated`, `type`, `sender`)
    VALUES ('$emails','$message', '$d', '$type', '$user')";
    mysqli_query($db, $insertSms);
    $_SESSION['iaddition'] = "Email sent ";
    //
    $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
         VALUES('$user','$d', 'groupemail', 'success', '$message', '$ip')";
    mysqli_query($db, $audit);
}
function getgroupname($id)
{
    $db = getConnection();
    $query = "SELECT `name` FROM `groups` WHERE `id`='$id'";
    $result = mysqli_query($db, $query);
    $name = mysqli_fetch_assoc($result)['name'];
    return $name;
}
function allResolvedTickets()
{
    $db = getConnection();
    $query = "SELECT * FROM `insidence` WHERE `resolvedAt` IS NOT NULL AND `resolvedby` IS NOT NULL";
    $result = mysqli_query($db, $query);
    return $result;
}
//get child ticket

function getclosedjobcards()
{
    
    $db = getConnection();
    $query = "SELECT * FROM `jobcards` WHERE `status`=0 AND `issued`=0";
    $result = mysqli_query($db, $query);
    return $result;
}
function getissuedjobcards()
{
    
    $db = getConnection();
    $query = "SELECT * FROM `jobcards` WHERE `status`=0 AND `issued`=1 order by id asc";
    $result = mysqli_query($db, $query);
    return $result;
}
function getopenjobcards()
{
    
    $db = getConnection();
    $query = "SELECT * FROM `jobcards` WHERE `status`=1";
    $result = mysqli_query($db, $query);
    return $result;
}
function getmyjobcards($agent)
{
    $db = getConnection();
    $query = "SELECT * FROM `jobcards` WHERE `techn`='$agent' or `createdBy`='$agent'";
    $result = mysqli_query($db, $query);
    return $result;
}

// CHILDREN

function allchildren()
{
    $db = getConnection();
    $query = "SELECT * FROM members WHERE `age` BETWEEN 0.1 AND 15";
    $result = mysqli_query($db, $query);
    return $result;
}

function unasigened()
{
    $db = getConnection();
    $query = "SELECT memberNo from members where name='' AND contact =''";
    $result = mysqli_query($db, $query);
    if (mysqli_error($db)) {
        echo mysqli_error($db);
    }
    //echo($result);
    //$result = mysqli_fetch_assoc($result);
    //echo($result);
    $no = 71;
    $number2 = 1411;
    foreach ($result as $row) {
        if (isset($row['memberNo'])) {
            //echo($row['memberNo']);
            $number = $row['memberNo'];
            echo $number;

            //    $query2 = "SELECT count(*) as count from members2";
            //    $result2 = mysqli_query($db, $query2);
            //    $no=mysqli_fetch_assoc($result2)['count'];

            //    for ($x =1; $x<$no; $x++) { 

            $query1 = "UPDATE `members2` SET `memberNo`='$number2' WHERE `id` = $no";
            $r = mysqli_query($db, $query1);
            $no = $no + 1;
            $number2 = $number2 + 1;
            echo ($no);
            if (mysqli_error($db)) {
                echo mysqli_error($db);
            }
            //}
        }
    }
}

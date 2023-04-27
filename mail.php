<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/Smail.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/sendSms.php");
include ('mconn.php');
include ('connection.php');
include ('member.php');

$GLOBALS ['start1'] = getlastMsgno();
//$GLOBALS ['end1'] = latestMsgno();

@readmail();
@createTicket();
function readmail(){
    $db = getConnection();
    $mail = getmconn();
    $start = getlastMsgno();

    $start = $start + 1;
    $end = $start + 10 ; //latestMsgno();
    

    $GLOBALS ['start1'] = $start;
    $GLOBALS ['end1'] = $end;

    //sleep(5);

    for ($x=$start; $x< $end;  $x++){
        //echo "dec 2.1";
        $header = imap_header($mail, $x);
        
       $header = json_encode($header);
       // echo $header;
        if ($header == null){
            echo 'wamlambez';
            continue;
        }

        $header = json_decode($header, true);
        
        //echo $header['date'];
        if(isset($header['date'])){


        $date = $header['date'];
        $msgno = $header['Msgno'];
        $subject = $header['Subject'];
        $toAdress =$header['toaddress'];
        $name = $header['from'][0]['personal'];
        $from = $header['from'][0]['mailbox']."@".$header['from'][0]['host'];
        $udate = $header['udate'];

        //
                $st = imap_fetchstructure($mail, $x);
        if (!empty($st->parts)) { 
            for ($i = 0, $j = count($st->parts); $i < $j; $i++) { 
                $part = $st->parts[$i]; 
                if ($part->subtype == 'PLAIN') { 
                    $body = imap_fetchbody($mail, $x, $i+1); 
                    } 
                } 
            } else { $body = imap_body($mail, $x); 
            } 

        $massage = strip_tags($body);
        $massage = $subject."\n".$massage;

        $query = "INSERT INTO `mailtable`(`msgno`, `m_date`, `subject`, `toAdress`, `s_name`, `fromAdress`, `udate`, `massage`, `attachmentID`, `host`) 
        VALUES ('$msgno','$date','$subject','$toAdress','$name','$from','$udate','$massage','na','na')";
        mysqli_query($db, $query);

        //echo 'soma completed';

        //GET ATTACHMENTS
        getAttach($mail, $msgno);

        }
        sleep(3);

    }
    imap_close($mail); 
}



//////// creating a ticket//


function createTicket(){
    $db = getConnection();
   $start = $GLOBALS ['start1'];
    $end = getlastMsgno()+1;

    

    //echo $end;
    //echo "creation start";
   //echo $start;
    $x= $start;

    
    while ($x<$end){
        // getting mail extract
        $query = "SELECT * FROM `mailtable` WHERE msgno = $x LIMIT 1";
//echo 'loop start';
        //echo "this query";
       //echo $x;
        $result = mysqli_query($db, $query);
        var_dump($result);
        if(mysqli_num_rows($result)==0){

            //echo 'wamlambaz';
            $x++;
            continue;
        }
        $result = mysqli_fetch_assoc($result);
        echo (mysqli_error($db));
        $email = $result['fromAdress'];
        $massage = $result['massage'];
        $name = $result['s_name'];
        $massage = mysqli_real_escape_string($db, $massage);

        $tiketNo = generateNo();
        $status = "Active";
        $source = "email";
        $createdBy = getagent();
       // echo $createdBy;
        $category = "complain";
        $pin = "na";
        $tell = "na";
        // find the customer
        $ss = checkcustomer($email);
        if ($ss == "un"){

            addcustomer($email, $pin, $tell, $name);
            
        }else {
            $pin = getcpin($email);
            $tell = getctell($email);

        }

        //insert into db

        $query1 = "INSERT INTO `insidence`(`tiketNo`, `pin`, `tell`, `email`, `massage`, `createdBy`, `category`, `status`, `source`, `creator`) 
        VALUES ('$tiketNo','$pin','$tell','$email','$massage','$createdBy','$category','$status','$source', 'mail')";
        mysqli_query($db, $query1);

        //echo "fika";
        notify_agents($createdBy);
        //update attachments table to link with tickets

        $queryAttachments = "SELECT COUNT(*) as count FROM mail_attachment WHERE msgNo = '$x'";
        $result = mysqli_query($db, $queryAttachments);
        $no=mysqli_fetch_assoc($result)['count'];

        if ($no>0) {
            $updateQ = "UPDATE `mail_attachment` SET `ticketNo`='$tiketNo' WHERE msgNo = '$x'";
            mysqli_query($db, $updateQ);
        }


        

        if(mysqli_error($db)){
           // echo mysqli_error($db);
        }

        // send feedback
        $subjectm = "DEJAVU CUSTOMER SUPPORT FOR TICKET NO -- $tiketNo";
        $replym = "Thank you $name for contacting Dejavu Technologies. Your email has been received and is being attended to by our customer service team.";
       @send_mail_by_PHPMailer($email, $subjectm, $replym);

        // send feedback

        $x++;
    }

}
function getagent(){

    $agents = array();
     $db = getConnection();

     // get all active users

     $query = "SELECT `username` FROM `users` WHERE `status` = 'Active' and `team` = 'BDM'";
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

function notify_agents($agents){

   $agent =  getAgentEmailByID($agents);
   $email = $agent['email_addr'];
   $name = $agent['full_names'];
   $phoneNumber = $agent['mobile_phone'];

   $massage = " Dear $name you have been a located a ticket. Please login to the system and resolve the ticket Dejavu .For any guidance contact us";
   $subject =  "ALLOCATION OF TICKETS";
   @send_mail_by_PHPMailer($email, $subject, $massage);
   @sendSms($phoneNumber, $massage);

    }

function getAgentEmailByID($agents){
    $db = getConnection();
    $query = "SELECT * FROM users WHERE `username` = '$agents'";
    $result = mysqli_query($db, $query);
    $result=mysqli_fetch_assoc($result);
    //$email = $result['email_addr'];
    return $result;
}

function checkcustomer($email){
    $db = getConnection();
    $query = "SELECT `id` FROM customers WHERE email='$email'   ORDER BY id DESC LIMIT 1";
            $results = mysqli_query($db, $query);
            $no=mysqli_fetch_assoc($results);
            $no = $no['id'];
            if (!$no) {
                // 
                return "un";
            }else {

                return $no;
            }
}

function getctell($email){
    $db = getConnection();
    $query = "SELECT * FROM customers WHERE email='$email";
    $results = mysqli_query($db, $query);
    $result = mysqli_fetch_assoc($results);
    $tell = $result['tell'];
    //$pin = $result['pin'];
    return $tell ;

}
function getcpin($email){
    $db = getConnection();
    $query = "SELECT * FROM customers WHERE email='$email";
    $results = mysqli_query($db, $query);
    $result = mysqli_fetch_assoc($results);
    //$tell = $result['tell'];
    $pin = $result['pin'];
    
    return $pin;

}

function addcustomer($email, $pin, $tell, $name){

    $db = getConnection();
    $query = "INSERT INTO `customers`(`pin`, `tell`, `firstName`,  `email`) 
    VALUES ('$pin','$tell','$name','$email')";
    mysqli_query($db, $query);
}

function getlastMsgno(){

    $db = getConnection();
    $query ="SELECT msgno FROM mailtable ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($db, $query);
    $result = mysqli_fetch_assoc($result);
   $msgno = $result['msgno'];

    return $msgno;
  
}

function latestMsgno(){
    $mail = getmconn();
    $last = imap_num_msg($mail); 

    imap_close($mail); 

    return $last;
    
    }

    function getAttach($inbox,$email_number){
        $db = getConnection();


        /* get information specific to this email */
        $overview = imap_fetch_overview($inbox,$email_number,0);

        $message = imap_fetchbody($inbox,$email_number,2);

        /* get mail structure */
        $structure = imap_fetchstructure($inbox, $email_number);

        $attachments = array();

        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts)) 
        {
            for($i = 0; $i < count($structure->parts); $i++) 
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );

                if($structure->parts[$i]->ifdparameters) 
                {
                    foreach($structure->parts[$i]->dparameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'filename') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }

                if($structure->parts[$i]->ifparameters) 
                {
                    foreach($structure->parts[$i]->parameters as $object) 
                    {
                        if(strtolower($object->attribute) == 'name') 
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }

                if($attachments[$i]['is_attachment']) 
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);

                    /* 3 = BASE64 encoding */
                    if($structure->parts[$i]->encoding == 3) 
                    { 
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    /* 4 = QUOTED-PRINTABLE encoding */
                    elseif($structure->parts[$i]->encoding == 4) 
                    { 
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $docRoot = $_SERVER['DOCUMENT_ROOT']."/crm";

                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];

                if(empty($filename)) $filename = time() . ".dat";
                $folder = "attachment";
                if(!is_dir($folder))
                {
                     mkdir($folder);
                }
                $fp = fopen($docRoot."/". $folder ."/". $email_number . "-" . $filename, "w+");
                
                $fileDir = "/crm"."/". $folder ."/". $email_number . "-" . $filename;

                fwrite($fp, $attachment['attachment']);
                //writting to db
                $query = "INSERT INTO `mail_attachment`(`msgNo`, `url`, `ticketNo`, `aName`) VALUES ('$email_number','$fileDir','na', '$filename')";
                mysqli_query($db, $query);

                fclose($fp);
            }
        }
    }


?>
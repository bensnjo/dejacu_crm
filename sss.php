<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/Smail.php");
include ('mconn.php');
include ('connection.php');
include ('member.php');

$GLOBALS ['start1'] = getlastMsgno();
$GLOBALS ['end1'] = latestMsgno();

//readmail();
//createTicket();
echo ($GLOBALS ['end1']);


function readmail(){
    $db = getConnection();
    $mail = getmconn();
    
    $start = getlastMsgno();
    $start = $start + 1;
    $end = latestMsgno();

    $GLOBALS ['start1'] = $start;
    $GLOBALS ['end1'] = $end;

    for ($x=$start; $x< $end;  $x++){
        $header = imap_header($mail, $x);
        $header = json_encode($header);
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

        echo $date;
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

        $massage = $body;

        $query = "INSERT INTO `mailtable`(`msgno`, `m_date`, `subject`, `toAdress`, `s_name`, `fromAdress`, `udate`, `massage`, `attachmentID`, `host`) 
        VALUES ('$msgno','$date','$subject','$toAdress','$name','$from','$udate','$massage','na','na')";
        mysqli_query($db, $query);

        }

    }
    imap_close($mail); 
}



//////// creating a ticket//


function createTicket(){
    $db = getConnection();
    $start = $GLOBALS ['start1'];
    $end = $GLOBALS ['end1'];

    echo $end;
    echo "hello";
    echo $start;
    $x=$start;
    while ($x<$end){
        // getting mail extract
        $query = "SELECT * FROM `mailtable` WHERE msgno = $x LIMIT 1";

        //echo "this query";
       // echo $x;
        $result = mysqli_query($db, $query);
        $result = mysqli_fetch_assoc($result);
        $email = $result['fromAdress'];
        $massage = $result['massage'];
        $name = $result['s_name'];
        $massage = mysqli_real_escape_string($db, $massage);

        $tiketNo = generateNo();
        $status = "Active";
        $source = "email";
        $createdBy = getagent();
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

        echo "fika";

        if(mysqli_error($db)){
            echo mysqli_error($db);
        }

        // send feedback
        $subjectm = "DEJAVU CUSTOMER SUPPORT FOR TICKET NO -- $tiketNo";
        $replym = "THANK YOU $name FOR CONTACTING DEJAVU, YOUR ISSUE HAS BEEN RECEIVED AND IS BEING ATTENDED TO BY OUR AGENTS";
       // send_mail_by_PHPMailer($email, $subjectm, $replym);

        // send feedback

        $x++;
    }

}
function getagent(){

    $db = getConnection();

    $query = "SELECT COUNT(*) as count FROM `users`";
    $result = mysqli_query($db, $query);
    $no=mysqli_fetch_assoc($result)['count'];

    $userId = rand(1,$no);

    $query1 = "SELECT username FROM users WHERE id = $userId";
    $result1 = mysqli_query($db, $query1);
    $user = mysqli_fetch_assoc($result1)['username'];

    return $user;
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
    $result = mysqli_fetch_assoc($result);
    $tell = $result['tell'];
    //$pin = $result['pin'];
    return $tell ;

}
function getcpin($email){
    $db = getConnection();
    $query = "SELECT * FROM customers WHERE email='$email";
    $results = mysqli_query($db, $query);
    $result = mysqli_fetch_assoc($result);
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
    return $last;
    
    }


?>
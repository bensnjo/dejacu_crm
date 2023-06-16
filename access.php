<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/main/sendsms.php");
$GLOBALS ['errors'] = array();

// LOGIN FUNCTION
function login($username1, $password1){
    // connecting to db
    $db = getConnection();
    // getting ip
    $ip = getip();
    
    
        $username = mysqli_real_escape_string($db, $username1);
        $password = mysqli_real_escape_string($db, $password1);
    
        if (empty($username)) {
            array_push($GLOBALS['errors'], "Username is required");
        }
        if (empty($password)) {
            array_push($GLOBALS['errors'], "Password is required");
        }
    
        if (count($GLOBALS['errors']) == 0) {
            $password = md5($username.$password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $arrayAssoc=mysqli_fetch_assoc($results);
                //echo("here");
                session_start();
                $t = time();
                $d = date("Y-m-d G:i:s",$t);
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                $_SESSION['usertype']=$arrayAssoc['roles'];
                $_SESSION['roles']=$arrayAssoc['roles'];
                $_SESSION['uFullName'] = $arrayAssoc['full_names'];
                $_SESSION['status']=$arrayAssoc['status'];

                if ($_SESSION['status'] == 'New'){

                    $query1 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$username','$d', 'sign_up', 'succes', '$username', '$ip')";
                     mysqli_query($db, $query1);

                    header('location: /crm/main/cp.php');
                }elseif ($_SESSION['status'] == 'Suspended') {

                    $query1 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$username','$d', 'login', 'rejected', '$username', '$ip')";
                     mysqli_query($db, $query1);
                     $msg = "Your Account is suspended Please Contact The Sytem Admin";

                     echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    '.$msg.'
                  </div>
                    ';
                    //header('location: /crm/main/cp.php');
                }elseif ($_SESSION['status'] == 'Disabled'){

                    $query1 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$username','$d', 'login', 'rejected', '$username', '$ip')";
                     mysqli_query($db, $query1);
                     $msg = "Your Account is Disabled Please Contact The Sytem Admin";

                     echo '
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    '.$msg.'
                  </div>
                    ';
                }else {
                $_SESSION['ip']= $ip;
                $query1 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                           VALUES('$username','$d', 'login', 'succes', '$username', '$ip')";
                mysqli_query($db, $query1);

                if ($_SESSION['usertype']=='admin'){
                    header('location: /crm/admin/index.php');
                }else{
                header('location: /crm/main/index.php');
                }}
            }else {
                $t = time();
                $d = date("Y-m-d G:i:s",$t);
                
                array_push($GLOBALS['errors'], "Wrong username/password combination");
                $query2 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                           VALUES('$username','$d', 'login', 'failed', '$username', '$ip')";
                mysqli_query($db, $query2);
            }
        }
}

// IP FUNCTION
function getip(){
        // 

        $ip_address = "";
        //whether ip is from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        $ip = $ip_address;
        return $ip;
}

// REGISTER
function register(){
    
    //
    $ip = getip();
    //
    $db = getConnection();
     //receive all input values from the form
     $username = mysqli_real_escape_string($db, $_POST['username']);
     $full_names = mysqli_real_escape_string($db, $_POST['fullname']);
     $email = mysqli_real_escape_string($db, $_POST['email']);
     $dept = mysqli_real_escape_string($db, $_POST['department']);
     $position = mysqli_real_escape_string($db, $_POST['position']);
     $team = mysqli_real_escape_string($db, $_POST['teams']);
     //$team = 'default';
     $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
     
     
     $user_role = "user";
    //  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    //  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
     $created_by = "admin";

     //form validation: ensure that the form is correctly filled ...
     //by adding (array_push()) corresponding error unto $GLOBALS['errors'] array
     if (empty($username)) { array_push($GLOBALS['errors'], "Username is required"); }
     if (empty($email)) { array_push($GLOBALS['errors'], "Email is required"); }
     if (empty($telephone)) { array_push($GLOBALS['errors'], "telepnone is required"); }
     if (empty($user_role)) { array_push($GLOBALS['errors'], "role is required is required"); }

     #newton--- Remove check password
    //  if (empty($password_1)) { array_push($GLOBALS['errors'], "Password is required"); }
    //  if ($password_1 != $password_2) {
    //     array_push($GLOBALS['errors'], "The two passwords do not match");
    // }

    //  $pollicy = isPasswordOkay($password_1);
    //  if ($pollicy === true){
     #End removed check password


     
     // first check the database to make sure 
     // a user does not already exist with the same username and/or email
     $user_check_query = "SELECT * FROM users WHERE username='$username' OR email_addr='$email' LIMIT 1";
     $result = mysqli_query($db, $user_check_query);


     $user = mysqli_fetch_assoc($result);
 
     if ($user) { // if user exists
         if ($user['username'] === $username) {
             array_push($GLOBALS['errors'], "Username already exists");
         }
 
         if ($user['email_addr'] === $email) {
             array_push($GLOBALS['errors'], "Email already exists");
         }
     }
      //echo"fika hapa";
     // Finally, register user if there are no errors in the form
     if (count($GLOBALS['errors']) == 0) {
         //echo("prog1");

         $password_1 = generatePassword();
         $password = md5($username.$password_1);//encrypt the password before saving in the database


         $t = time();
         $d = date("Y-m-d G:i:s",$t);
         $query = "INSERT INTO `users`(`username`, `password`, `full_names`, `mobile_phone`, `email_addr`, `roles`, `department`, `status`, `created_by`, `grade`, `team`) 
         VALUES ('$username','$password','$full_names','$telephone','$email','$user_role','$dept','New','$created_by','$position','$team')";
         if(mysqli_query($db, $query)){
            $type="new_user";
            $loggedin = getUser($_SESSION['username']);
            $subject="Your Registration as a user, CRM";
            $message="Dear ".$full_names.", Welcome to Dejavu Technologies LTD!\r\n\nYou have been registered as a user on Dejavu CRM (https://dejavutechkenya.com/crm/main/login.php).\r\n\n
            Your username is <b>".$username."</b>\r\n\nYour password is <b>" .$password_1."</b>. After logging in with the provided details, you will be prompted to change your password.\r\n\n
            Let's do great things together!\r\n\n
            Thank you ".$username;
            send_mail_by_PHPMailer($email, $subject, $message);
            
            $querymail = "INSERT INTO `emails`( `recipient`, `message`, `address`, `type`, `sender`) VALUES ('$full_names','$message','$email','$type','root')";
            mysqli_query($db, $querymail);
         }
         //session_start();
        //  $_SESSION['username'] = $username;
        //  $_SESSION['success'] = "You are now logged in";
        //  $_SESSION['usertype']= $user_role;
        //  $_SESSION['team'] = $team;
        //audit trail

         $query2 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$username','$d', 'create_user', 'success', '$username', $ip)";
         mysqli_query($db, $query2);

            
         //audit trail
         //$_SESSION['registerSucc'] = "$full_names Registered Success";
         
        // $_SESSION['registeredUser'] = ['username' => $username, 'name'=> $full_names, 'password'=>$password_1, 'email'=> $email];

     
    }
 
}



function update(){

        //
        $ip = getip();
        //
        $db = getConnection();
         //receive all input values from the form
         $username = mysqli_real_escape_string($db, $_POST['username']);
         $full_names = mysqli_real_escape_string($db, $_POST['fullname']);
         $email = mysqli_real_escape_string($db, $_POST['email']);
         $dept = mysqli_real_escape_string($db, $_POST['department']);
         $position = mysqli_real_escape_string($db, $_POST['position']);
         $team = mysqli_real_escape_string($db, $_POST['teams']);
         $telephone = mysqli_real_escape_string($db, $_POST['telephone']);
         $status = mysqli_real_escape_string($db, $_POST['status']);
         
         
         $user_role = "user";
         $created_by = "admin";
         //form validation: ensure that the form is correctly filled ...
         //by adding (array_push()) corresponding error unto $GLOBALS['errors'] array
         if (empty($username)) { array_push($GLOBALS['errors'], "Username is required"); }
         if (empty($email)) { array_push($GLOBALS['errors'], "Email is required"); }
         if (empty($telephone)) { array_push($GLOBALS['errors'], "telepnone is required"); }

          //echo"fika hapa";
         // Finally, register user if there are no errors in the form
         if (count($GLOBALS['errors']) == 0) {
             
             $t = time();
             $d = date("Y-m-d G:i:s",$t);
             $query = "UPDATE `users` SET `username` ='$username' , `full_names` ='$full_names' , `mobile_phone`= '$telephone', 
             `email_addr` = '$email', `department` = '$dept', `status` = '$status', `grade` = '$position', `team` = '$team'
               WHERE `username` = '$username'"; 
           

             mysqli_query($db, $query);

             if(mysqli_error($db)){
                echo(mysqli_error($db));
            }
            
            if($_SESSION['usertype']!='admin'){
             $_SESSION['username'] = $username;
             $_SESSION['usertype']= $user_role;
             $_SESSION['team'] = $team;
            }

             $_SESSION['successUp'] = "Profile updated success";

            //audit trail
    
             $query2 = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                        VALUES('$username','$d', 'update_user', 'success', '$username', $ip)";
             mysqli_query($db, $query2);
    
             //audit trail

             //$massage = "Profile updated Successfully ";

             
                 
         }

}



function getUser($username){
    $db = getConnection();
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $db->query($query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}


// change password - while logged in

function cp($oldp, $newp, $rp, $user){
    $db = getConnection();
    $ip = getip();

    $t = time();
     $d = date("Y-m-d G:i:s",$t);
     $pollicy = isPasswordOkay($newp);
     if ($pollicy === true){

     
    if (!$newp == $rp){
        array_push($GLOBALS['errors'], "Passwords do not match");
    }else {
        $password = md5($user.$oldp);
            $query = "SELECT * FROM users WHERE username='$user' AND password='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $pass2 = md5($user.$newp);
                
                $query2 = "UPDATE users SET `password` = '$pass2', `status` = 'Active' WHERE username='$user'";
                mysqli_query($db, $query2);

                //
                $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$user','$d', 'change_password', 'success', '$user', $ip)";
                    mysqli_query($db, $audit);

             $GLOBALS['rPassword'] = "Password Reset Successfully";

            header("location: index.php");


            }else{
                array_push($GLOBALS['errors'], "Incorrect Current Password");
            }
    }
}
}


// ACCESS
function access(){
        //session_start();

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['usertype']);
        header("location: login.php");
    }
}

// ADMIN
function admin(){
    if ($_SESSION['roles']!= "admin"){
        header("location: /crm/main/index.php");
    }
}


function users($onlyActive = false){
    $db = getConnection();
    $query = "SELECT * FROM `users` ";

    if($onlyActive){
        $query = "SELECT * FROM `users` WHERE `status`= 'Active'";
    }

    $result = mysqli_query($db, $query);

return $result;

}



function myLogs(){
    $db = getConnection();
    $username = $_SESSION['username'];

    $query = "SELECT * FROM `audit_trail` WHERE `username` = '$username' or `impact` = '$username' LIMIT 1000";

    $data = mysqli_query($db, $query);

    //$data = mysqli_fetch_assoc($data);

    return $data;

}



//////////////////////////////////
//////////////////////////////////


function genOtp(){

    $code = rand(10000, 99999);
    return $code;
}


function fp($user){
    $db = getConnection();
    $query = "SELECT * FROM users WHERE username='$user'";
    echo $user;
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                //session_start();
                $_SESSION['userhold'] = $user;

                $tell = getUser($user);
                $tell = $tell['mobile_phone'];
                //$cusname = $tell['full_names'];

                $code = genOtp();

                $massage = "Your otp code for password reset is ".$code ;

                sendSMSnew($tell, $massage);
                $otpquery = "INSERT INTO `otp`(`code`, `username`) 
                VALUES ('$code','$user')";
                mysqli_query($db, $otpquery);

                header("location: /crm/main/cp2.php");

                
            }else {
                array_push($GLOBALS['errors'], "Username Entered does Not exist");
            }
}



//// CHANGE PASSWORD - FORGOT PASSWORD ////
function cp2($otp, $newp, $rp, $user){
    $db = getConnection();
    $ip = getip();

    $t = time();
     $d = date("Y-m-d G:i:s",$t);

     $pollicy = isPasswordOkay($newp);
     if ($pollicy === true){

    if (!$newp == $rp){
        array_push($GLOBALS['errors'], "passwords are not similar");
    }else {
        
            $query = "SELECT * FROM otp WHERE username='$user' AND code='$otp'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $pass2 = md5($user.$newp);
                
                $query2 = "UPDATE users SET `password` = '$pass2' WHERE username='$user'";
                mysqli_query($db, $query2);

                //
                $audit = "INSERT INTO audit_trail (username, time_stamp, `action`, results, impact, ip_address)
                    VALUES('$user','$d', 'change_password', 'success', '$user', $ip)";
                    mysqli_query($db, $audit);

                //

                header("location: login.php");

            }
    }
}
}

function addTeam(){

 $db = getConnection();
 $team =$_POST['team'];
 $desp =$_POST['disp'];

    $query = "INSERT INTO `teams`(`teamName`, `discription`) 
    VALUES ('$team','$desp')";
    mysqli_query($db, $query);
    $_SESSION['tddition'] = "Team added Successful ";

}

function allteams(){
    $db = getConnection();
    $query = "SELECT * FROM `teams` ";
    $teams = mysqli_query($db, $query);
    return $teams;
}
function isPasswordOkay($password){
	$isOkay=true;
	
	
   
    if (strlen($password) < 8) {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
		$isOkay=false;
		
		
	   
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
		$isOkay=false;
		
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
		$isOkay=false;
		
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
		$isOkay=false;
		
		
    }


if(isset($passwordErr)){

 $alert='<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert" style="margin:5px;">'
          .$passwordErr.
         '</div>';
    echo($alert);
    echo('<script>hideToast()</script>');

}

return $isOkay;
}


function generatePassword(){
    // $lcLetters = 'abcdefghijklmnopqrstuvwxyz';
    // $ucLetters = 'ABCDEFGHIKLMNOPQRSTVWXYZ';
    // $sChars = 'abcdefghijklmnopqrstuvwxyz';

    // $first = $ucLetters[rand(0,strlen($ucLetters)-1)];
    // $second = $lcLetters[rand(0,strlen($lcLetters)-1)];
    // $third = $sChars[rand(0,strlen($sChars)-1)];
    // $fourth = rand(100000,99999999);
    $length=12;
    $pass = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

    return $pass;

}

function getDep(){
    $db = getConnection();
    $query = "SELECT * FROM `departments`";
     $departments = mysqli_query($db, $query);
     return $departments;
}

function getgroups(){
    $db = getConnection();
    $query = "SELECT * FROM `groups`";
    $result = mysqli_query($db, $query);
    if(mysqli_error($db)){
        echo mysqli_error($db);
    }
    return $result;
}


?>

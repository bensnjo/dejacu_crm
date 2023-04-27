<?php
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/connection.php");


//
$db = getConnection();
    $query = "SELECT * from members2 ";
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
        if(isset($row['contact'])){
            //echo($row['memberNo']);
        //     $number = $row['memberNo'];
           echo $row['contact'];

        // //    $query2 = "SELECT count(*) as count from members2";
        // //    $result2 = mysqli_query($db, $query2);
        // //    $no=mysqli_fetch_assoc($result2)['count'];

        // //    for ($x =1; $x<$no; $x++) { 
            
        //     $query1 = "UPDATE `members2` SET `memberNo`='$number2' WHERE `id` = $no";
        //    $r= mysqli_query($db, $query1);
        //     $no=$no + 1;
        //     $number2= $number2 + 1;
        //     echo($no);
        //     if(mysqli_error($db)){
        //         echo mysqli_error($db);
        //     }
        //}
            $api_key = "b6nXpLJi87My4avjNSoq5cGW1gKVHtxIOEDkmCZrUelFwzY0fhP9TBQ2dRAu3s";
            $shortcode = "Tilil";
            $serviceId = '0';
            //$mobile = "0715745434";
            $mobile = $row['contact'];
            $message = "Beloved saint welcome to our Sunday service! your Membership  number is".$row['memberNo'];
            $smsdata = array(
            "api_key" => $api_key,
            "shortcode" => $shortcode,
            "mobile" => $mobile,
            "message" => $message,
            "serviceId" => $serviceId,
            "response_type" => "json",
            );
            $smsdata_string = json_encode($smsdata);
            echo $smsdata_string . "\n";
            $smsURL = "https://api.tililtech.com/sms/v3/sendsms";
            //POST
            $ch = curl_init($smsURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $smsdata_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($smsdata_string))
            );
            $apiresult = curl_exec($ch);
            echo("API Response: $apiresult\n");
                
            // for ($x=156; $x<160; $x++){
            // echo $apiresult['API Response'][$x];
            // }
            if (!$apiresult) {
            die("ERROR on URL[$urls] | error[" . curl_error($ch) . "] | error code[" . curl_errno($ch) . "]\n");
            }
        }
    }

?>
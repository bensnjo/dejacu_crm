<?php
// sendSms('0715745434', "come here");

// function sendSms($cont,$msg){


//             $api_key = "b6nXpLJi87My4avjNSoq5cGW1gKVHtxIOEDkmCZrUelFwzY0fhP9TBQ2dRAu3s";
//             $shortcode = "Tilil";
//             $serviceId = '0';
//             //$mobile = "0715745434";
//             $mobile = $cont;
//             $message = $msg;
//             $smsdata = array(
//             "api_key" => $api_key,
//             "shortcode" => $shortcode,
//             "mobile" => $mobile,
//             "message" => $message,
//             "serviceId" => $serviceId,
//             "response_type" => "json",
//             );
//             $smsdata_string = json_encode($smsdata);
//             //echo $smsdata_string . "\n";
//             $smsURL = "https://api.tililtech.com/sms/v3/sendsms";
//             //POST
//             $ch = curl_init($smsURL);
//             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//             curl_setopt($ch, CURLOPT_POSTFIELDS, $smsdata_string);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//             'Content-Type: application/json',
//             'Content-Length: ' . strlen($smsdata_string))
//             );
//             $apiresult = curl_exec($ch);
//            // echo("API Response: $apiresult\n");
                
//             // for ($x=156; $x<160; $x++){
//             // echo $apiresult['API Response'][$x];
//             // }
//             if (!$apiresult) {
//             die("ERROR on URL[$urls] | error[" . curl_error($ch) . "] | error code[" . curl_errno($ch) . "]\n");
//         }  
//     }



    function sendSms2w($phoneNumber, $message){
        // create curl resource 
                $ch = curl_init(); 
                
                
                $action=urlencode("sendmessage");
                $username=urlencode("Dejavu");
                $password=urlencode("30814916f35661ac876c47e9de172f8143d3911b876d4760a26af45a6a5f8cad");
                $message=urlencode($message);
                $recipient=urlencode($phoneNumber);
                
                $url="https://smsgw-int-vip.kra.go.ke/sms?action=".$action."&username=".$username."&password=".$password."&recipient=".$recipient."&messagedata=".$message;
                   
                   //echo($url);

                //$url="https://10.150.1.59".$action."&username=".$username."&password=".$password."&recipient=".$recipient."&messagedata=".$message;
                  
                // set url 
                curl_setopt($ch, CURLOPT_URL,$url); 
        
                //return the transfer as a string 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        
                // $output contains the output string 
                $output = curl_exec($ch); 
                echo($output);
        
                // close curl resource to free up system resources 
                curl_close($ch);      
        }
        function sendSMSnew($cont,$msg){
            $db = getConnection();
            
            //$cont = mysqli_real_escape_string($db, $_POST['phoneNumber']);;
            //$msg = mysqli_real_escape_string($db, $_POST['smsMessage']);
            set_time_limit(500);
            $url = 'https://roberms.co.ke/sms/v1/roberms/send/simple/sms';
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json',
            'Authorization:Token c33733b48e4f41a0f318ce7fd55fa8cd9788aa89'));
            $curl_post_data = [
            "message" => $msg,
            "phone_number"=> $cont,
            "sender_name" => "DEJAVU_TECH",
            "unique_identifier" => "DEJAVU TECHNOLOGIES"
            ];
            $data_string = json_encode($curl_post_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            $curl_response = curl_exec($curl);
            $curl_response = json_decode($curl_response);
            return $curl_response;      
            }
?>

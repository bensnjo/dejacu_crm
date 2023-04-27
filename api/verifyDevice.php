<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
   
if(!empty($_POST['pin']) && !empty($_POST['key'])) {
        // New Data Input
        $db=getConnection();
        
         $cusromerPin= $_POST['pin'];
         $DeviceKey= $_POST['key'];
         $DeviceStatus="ACTIVE";
      $device_check_query = "SELECT * FROM devices WHERE deviceKey ='$DeviceKey' AND `pin` = '$cusromerPin' AND `status`='$DeviceStatus' LIMIT 1";
      $resultDevice = mysqli_query($db, $device_check_query);
      $device = mysqli_fetch_assoc($resultDevice);
      if ($device) { // if device exists
         $result['Serial Number'] = $device['serialNumber'];
            $result['status'] = $device['status'];
                  }
      else {
            $result['Not found'] = 'No Device';
            }
         http_response_code(200);
         echo json_encode($result);
     
    }     
?>

<?php
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/connection.php");

function addTrail($username, $input_data, $recommendation, $remarks, $results){
  $t = time();
  $d = date("Y-m-d G:i:s", $t);

  $connection = getConnection();

  $sql = "INSERT INTO audit_trail(username, input_data, recommendation, remarks, results, time_stamp)
          VALUES('$username', '$input_data', '$recommendation', '$remarks', '$results', '$d')";

  $d = $connection->query($sql);

  $connection->close();
}
?>

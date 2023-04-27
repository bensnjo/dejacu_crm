<?php
header('Content-Type: application/json');
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/connection.php");
$conn = getConnection();

//$sqlQuery = "SELECT distinct(time) FROM `attendance` ORDER BY time ASC ";

//$result1 = mysqli_query($conn,$sqlQuery);


$t1 = strtotime('03:00:00');
$t2 = strtotime('04:00:00');
$t3 = strtotime('03:00:00');
$t4 = strtotime('03:00:00');

//


$query1 = "SELECT '6-7' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN STR_TO_DATE('03:00:00','%H:%i:%s') AND STR_TO_DATE('04:00:00','%H:%i:%s') AND `state`= 1
UNION
SELECT '7-8' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN '04:00:00' AND '05:00:00' AND `state`= 1
UNION 
SELECT '8-9' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN '06:00:00' AND '07:00:00' AND `state`= 1
UNION 
SELECT '9-10' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN '07:00:00' AND '08:00:00' AND `state`= 1
UNION 
SELECT '10-11' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN '09:00:00' AND '10:00:00' AND `state`= 1
UNION 
SELECT '11-12' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN '11:00:00' AND '12:00:00' AND `state`= 1
UNION 
SELECT '12 ++' AS Category, COUNT(*) AS cnt FROM `attendance` WHERE `time` BETWEEN '13:00:00' AND '14:00:00'   AND `state`= 1 "  ;

$result = mysqli_query($conn,$query1);
//);


$data = array();
foreach ($result as $row) {
// 	$row = $row['time'];
// $query = " SELECT COUNT(*) as count FROM `attendance` where `time` = '$row' " ;
// $count = mysqli_query($conn,$query);
// $count =mysqli_fetch_assoc($count)['cnt'];

// $reload = array();
// $reload['time']= $row ;
// $reload['no']= $count;

// 	$data[] = $reload;
$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
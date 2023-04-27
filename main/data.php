<?php
header('Content-Type: application/json');
require_once($_SERVER['DOCUMENT_ROOT']."/yaya/connection.php");

$conn = getConnection();

$sqlQuery = "SELECT distinct(age) FROM `members` ORDER BY age ASC ";

$result1 = mysqli_query($conn,$sqlQuery);




//


$query1 = "SELECT '0-10' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 0 AND 10
UNION
SELECT '10-20' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 10 AND 20
UNION 
SELECT '20-30' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 20 AND 30
UNION 
SELECT '30-40' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 30 AND 40
UNION 
SELECT '40-50' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 40 AND 50
UNION 
SELECT '50-60' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 50 AND 60 
UNION 
SELECT '60 & above' AS Category, COUNT(*) AS cnt FROM `members` WHERE `age` BETWEEN 60 AND 120 "  ;

$result = mysqli_query($conn,$query1);
//

$data = array();
foreach ($result as $row) {
// 	$row = $row['age'];
// $query = " SELECT COUNT(*) as count FROM `members` where `age` = '$row' " ;
// $count = mysqli_query($conn,$query);
// $count =mysqli_fetch_assoc($count)['cnt'];

// $reload = array();
// $reload['age']= $row ;
// $reload['no']= $count;

// 	$data[] = $reload;
$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>
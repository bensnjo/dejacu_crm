<?php
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: GET");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
 	require_once($_SERVER['DOCUMENT_ROOT']."connection.php");
	require_once($_SERVER['DOCUMENT_ROOT']."member.php");
	require_once($_SERVER['DOCUMENT_ROOT']."access.php");
	session_start();
	access();
 	$db = getConnection();
	echo "Ronjo";


function get_city($conn , $term){	
	$query = "SELECT * FROM customers WHERE cusName LIKE '%".$term."%' ORDER BY cusName ASC";
	$result = mysqli_query($conn, $query);	
	$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
	return $data;	
}

if (isset($_GET['term'])) {
	$getCustomer = get_city($conn, $_GET['term']);
	$CustomerList = array();
	foreach($getCustomer as $customer){
		array_push($CustomerList,$customer['cusName']);
	}
}
	echo json_encode($CustomerList);

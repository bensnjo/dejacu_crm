<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/connection.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/crm/access.php");
session_start();

access();

$db = getConnection();

$id = $_GET['id']; // get id through query string
$gid = $_GET['is'];
$del = mysqli_query($db,"DELETE FROM `group_join` WHERE `id`='$id'"); // delete query

if($del)
{
    mysqli_close($db); // Close connection
    header("location:viewgroup.php?id=$gid"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
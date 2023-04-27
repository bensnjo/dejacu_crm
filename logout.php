<?php
require_once($_SERVER['DOCUMENT_ROOT']."/crm/addTrail.php");
session_start();
$username= $_SESSION['username'];
addTrail($username, 'logout', 'n/a', 'n/a', 'success');

    unset($_SESSION['username']);
    unset($_SESSION['usertype']);
    unset($_SESSION["fullname"]);
	session_destroy();
    header("location: /crm/main/login.php");
	?>
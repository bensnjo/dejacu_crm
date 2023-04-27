<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['usertype']);
unset($_SESSION);
//unset($GLOBALS);
session_destroy();
session_unset();

header("location: /crm/main/login.php");

	?>
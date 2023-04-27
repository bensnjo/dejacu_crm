<?php

function getConnection($connectionType="mysqli"){

    $database = "crm";
    $username = "root";
    $password = '';
    $hostname = "localhost:3308";

    $connection;

    if($connectionType == 'mysqli'){
        $connection = new mysqli($hostname, $username, $password, $database);
    }else{
        try{
            $connection = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
        }catch(PDOException $e){
            echo("ERROR :".$e->getMessage());
        }
    }
    return $connection;
}
?>

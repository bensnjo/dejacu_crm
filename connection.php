<?php

function getConnection($connectionType="mysqli"){


    $database = "dejavute_crm";
    $username = "dejavute_crm";
    $password = "Password@2023";
    $hostname = "localhost";

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

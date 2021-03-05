<?php
include_once 'db.php';
include_once 'user.php';
session_start();

$con = new DBConnector();
$pdo = $con->connectToDB();

//print_r($_POST);
if($_POST["event"] == "order"){
	echo "<script language='javascript'>
                    alert('⚠This feature is currently Unavailable');
                    window.location.href = 'homepage.html'; 
                    </script>";

}



?>
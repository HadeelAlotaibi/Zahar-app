<?php

$host = "localhost";
$db = "zahar";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$host;dbname=$db",$username,$password);	
} catch (PDOException $e) {
	echo "Error : ". $e->getMessage();
}
?>
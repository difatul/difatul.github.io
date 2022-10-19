<?php
$server="localhost";
$user="root";
$pass="";

try{
	// creating connection for mysql
	$conn = new PDO("mysql:host=$server;dbname=ulistrik", $user, $pass);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "Koneksi Gagal: ".$e->getMassage();
}
?>
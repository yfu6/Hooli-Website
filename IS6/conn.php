<?php
error_reporting(0);
session_start();
$dbConf= array(  
		'host'=>'localhost',  
		'user'=>'root',  
		'password'=>'',
		'dbName'=>'kxo205',  
		'charSet'=>'utf8',  
			'port'=>'3306');

function openDb($dbConf){  
    $conn=mysqli_connect($dbConf['host'],$dbConf['user'],$dbConf['password'],$dbConf['dbName'],$dbConf['port']) or die('open failed');  
    mysqli_set_charset($conn,$dbConf['charSet']);
    return $conn;  
}  
function closeDb($conn){  
    mysqli_close($conn);  
} 

$conn=openDb($dbConf);  
?>
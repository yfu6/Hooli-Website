<?php
include_once 'conn.php'; 
session_start();
$_SESSION["uid"]=null;
$_SESSION["access"]=null;
$_SESSION["username"]=null;
echo "<script>window.location.href='login.php';</script>";


closeDb($conn);  

?>

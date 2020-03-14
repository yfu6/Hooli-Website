<?php
include_once 'db_conn.php'; 
session_start();
$name=$_POST["name"];
$password=md5($_POST["password"]);


$sql="select * from users where username='{$name}' and  password='{$password}'";
$result=$conn->query($sql);

$uid=0;
$access=2;
while($attr=$result->fetch_row())
{
$uid=$attr[0];
$access=$attr[6];
}

if($uid>0)
{
	$_SESSION["uid"]=$uid;
	$_SESSION["access"]=$access;
	$_SESSION["username"]=$name;
	if($access==2){
	header("location:index.php");
	}
}
else{
	echo "<script>alert('Invalid username or password');window.location.href='login.php';</script>";
}

closeDb($db_conn);  

?>

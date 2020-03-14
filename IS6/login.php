<?php include_once 'conn.php'; ?>
<?php
$result="";
if(isset($_GET["action"])){ 
	if($_GET["action"]=="save"){

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
			$result= "Invalid username or password";
		}

		closeDb($conn);  

	}

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script src="js/modernizr.custom.js"></script>
<!-- /js files -->
    <title>Log In</title>
    <style type="text/css">
<!--
-->

body{background-image:url(img/login.jpg); background-size:cover;}
.header{color:#FFFFFF; margin-top:2%;}
td{
    font-weight: bold;
    text-align:justify;
    text-justify:distribute-all-lines;
	width:auto;
	color:#000000;

}

.main{
    width: 400px;
    margin-top:5%;
	margin-bottom:30%;
	margin-left:auto;
	margin-right:auto;
    background-color: rgba(255,255,255,0.4);
    border-radius: 10px;
}
.a1{
    height: 40px;
    background-color: rgba(255,255,255,0.4);
    text-align: center;
    color: black;
    line-height: 40px;
    font-size: 20px;
    font-weight: bold;
    border-radius: 6px;
}
input{
    border-radius: 4px;
    border: 1px solid #666666;
    line-height: 18px;
    padding: 3px 3px;
    margin: 3px 3px;

}
.a2{
    margin: 10px 50px;
}
#yhm,#yx,#mm,#qrmm{
    font-size: 12px;
    color: red;
    text-align: left;
}
select{
    width: 80px;
    height: 22px;
    margin-left: 5px;
    border-radius: 5px;
}
    .STYLE2 {font-size: 16px}
    </style>

 <body>
 <img src="img/logo.png" width="450" height="110" hspace="100">
 <div class="header">
	<h1 align="center" class="STYLE9">LOG IN</h1>
</div>
<div class="main STYLE3">
    <div class="a2">
        <form  name="myform" action="?action=save" method="post">
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="name"  required></td>
                </tr>
                <tr>
                    <td></td>
                    <td id="yx">&nbsp;</td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td id="qrmm">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                <input type="submit" value="Log In">				</tr>
                 <tr>
            <td colspan="2"><div align="center" class="STYLE9">Don't have an Account? <a href="signup.php" class="STYLE2">Sign Up</a></div></td>
		  </tr> 
		  <tr>
			<td colspan="2"><div align="center" class="STYLE9">Return to <a href="home.php" class="STYLE2">Home</a></div></td>
		  </tr> 
            </table>
        </form>
    </div><h2 style="color:red;"><?php echo $result; ?></h2>
</div>

 </body>

</html>
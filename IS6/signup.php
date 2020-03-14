<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">  
<head>  
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>  
 <title>log in</title>  
 <style type="text/css">
 
 tr{font:x-large;}
 tr{height:auto;}
 .table {
	margin-top:1%;
	color: #FFFFFF;
	font-weight: bold;
    text-align:justify;
    text-justify:distribute-all-lines;
	width:auto;
	
}
 table{margin-top:4%;     background-color: rgba(255,255,255,0.4);  border-radius: 10px; background-size:cover;font-size:20px;}
 body{background-image:url(img/signup.jpg); background-size:cover;}
h1{color:#FFFFFF;}
 .STYLE9 {font-family: "Times New Roman", Times, serif; }
.STYLE28 {font-size: 18px}
 .STYLE29 {font-size: 18; font-weight: bold; }
.STYLE30 {font-size: 18}
 </style>  

<?php
include('session.php');
include('db_conn.php');

$Username="";
$Password="";
$retypepassword="";
$Name="";
$Email="";
$DOB="";
$YYYY="";
$MM="";
$DD="";

if(isset($_POST['signup'])) { 
 $Username=$_POST['Username']; 
 $Password=$_POST['Password']; 
 $encrypt_password=MD5($Password); 
 $retypepassword=$_POST['retypepassword']; 
 $Name=$_POST['Name'];
 $DOB=$_POST["YYYY"].$_POST["MM"].$_POST["DD"];
 $YYYY=$_POST["YYYY"];
 $MM=$_POST["MM"];
 $DD=$_POST["DD"];
 $Email=$_POST['Email'];
 $error="";

 $query = "SELECT * FROM users WHERE Username='$Username'";
    $result = $mysqli->query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);

    if($Username==""){
    	 $error.=" The username must contain at least one letter"."<br/>";
    }
    if($row['Username']==$Username)
    {
        $error.=" The username has already existed"."<br/>";
    } 
    
    if($Password==""){
    	  $error.=" Please type the password"."<br/>";
    }
    if(strlen($Password)<5){
    	
    	 $error.=" The password must contain at least five letters"."<br/>";
    }
    if(preg_match("/ /", $Password)){
 	
	 $error.=" The password can not have a space"."<br/>";
    }
	
	//email validation
	
    if($retypepassword!=$Password)
    {
        $error.=" The retype-password is different from the password"."<br/>";
    }
    if($Name==""){
        $error.=" Please type the name"."<br/>";
    }
    
    if($Email==""){
        $error.=" Please type your email address"."<br/>";
	}elseif(filter_var($Email,FILTER_VALIDATE_EMAIL)==FALSE){
		//if the email is not proper..(format)
		$error.=" Please type the correct format of email address"."<br/>";
    }
    if($error==""){
        $insertquery="INSERT INTO `users`(Username,Password,Name,DOB,Email,Access) VALUES('$Username','$encrypt_password','$Name','$YYYY.$MM.$DD','$Email',2)";
	$mysqli->query($insertquery);
        $session_user=$Username;
        $_SESSION['user']=$session_user;
        $session_access=2;
        $_SESSION['access']=$session_access;
	echo "<script> alert('Success!');"
        . "window.location.href = './login.php';</script>";
   
    }
    } 

?>

<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sign Up</title>
        <link rel="stylesheet" href="signup.css">
       <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
    <body>
	<div align="left"><img src="img/logo.png" width="450" height="110" hspace="80"></div>
	<div class="header">
	<h1 align="center" class="STYLE9">REGISTER</h1>
</div>


<form method="post" class="signForm" name="DOB">
		<table align="center">
			<tr>
			  <td><div align="center" class="STYLE29">*</font> Username :</div></td>
			</tr>
			<tr>	
				<td>
				  <div align="center" class="STYLE29">
			        <input type='text' name='Username' value="<?php echo $Username;?>"/>
		          </div></td>
			</tr>
                        <tr>
                          <td><div align="center" class="STYLE29">* Password (At least five characters) :</div></td>
						</tr>
						<tr>
                                <td>
                                  <div align="center" class="STYLE29">
                                    <input type='password' name='Password' value="<?php echo $Password;?>"/>
                                  </div></td>
                        </tr>    
			<tr>
			  <td><div align="center" class="STYLE29">* Retype Password :</div></td>
			</tr>
			<tr>
				<td>
				  <div align="center" class="STYLE29">
			        <input type='password' name='retypepassword' value="<?php echo $retypepassword;?>"/>
		          </div></td>
			</tr>     
			<tr>
              <td><div align="center" class="STYLE29">* Name:</div></td>
			</tr>
			<tr>
			<td>
			  <div align="center" class="STYLE29">
		        <input type='text' name='Name' value="<?php echo $Name;?>"/>
		      </div></td>
			</tr>
 <tr> <td><div align="center" class="STYLE29">* Date of Birth:</div></td>
 </tr>
 <tr>
<td>
  <div align="center" class="STYLE29">
    <select name="YYYY" onChange="YYYYDD(this.value)" value="<?php echo $YYYY;?>"/>
    
    
    
    <option value="">Please select Year first</option>
    </select>
    <select name="MM" onChange="MMDD(this.value)"  value="<?php echo $MM;?>"/>
    
    
    
        <option value="">Please select Month first</option>
        </select>
        <select name="DD" onChange="DDD(this.value)" value="<?php echo $DD;?>"/>
        
        
    
        <option value="">Please select Day first</option>
        </select>
  </div></td>
</tr>          
<tr> <td><div align="center" class="STYLE29">* Email:</div></td>
</tr>
<tr>
<td>
  <div align="center" class="STYLE29">
    <input name="Email" type="text" id="Email"value="<?php echo $Email;?>"/>
  </div></td>
</tr>
<tr> <td><div align="center"><span class="STYLE28"><span class="STYLE30"></span></span></div></td>
          <tr><td><div align="center" class="STYLE30"><strong>
                <input type='submit' name='signup' value='Sign Up'/>
                <input type="reset" name="reset" value="Reset">
              </strong></div></td>
          </tr>
            
          <td>    <span class="STYLE30"><strong>
              </tr>
                </strong>
		  </span>
          <tr>
            <td colspan="2"><div align="center" class="STYLE30"><strong>Have an Account?  <a href="login.php" class="STYLE2">LogIn</a></strong></div></td>
		  </tr>
		  <tr>
			<td colspan="2"><div align="center" class="STYLE30"><strong>Return to   <a href="home.php" class="STYLE2">Home</a></strong></div></td>
		  </tr> 
  </table>
	</form>
	</div>
        	<?php
	if(isset($error))
	{
     echo "<p>".$error."</p>"; 
	 }
	 ?>


<script language="JavaScript">
		
    var changeDD = 1;
    function YYYYMMDDstart() {
        MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var y = new Date().getFullYear();
        for (var i = (y - 99); i < (y + 1); i++) 
            document.DOB.YYYY.options.add(new Option(" " + i, i));
       
        for (var i = 1; i < 13; i++)
            document.DOB.MM.options.add(new Option(" " + i, i));
        document.DOB.YYYY.value = y;
        document.DOB.MM.value = new Date().getMonth() + 1;
        var n = MonHead[new Date().getMonth()];
        if (new Date().getMonth() == 1 && IsPinYear(YYYYvalue)) n++;
        writeDay(n); 
    }
    if (document.attachEvent)
        window.attachEvent("onload", YYYYMMDDstart);
    else
        window.addEventListener('load', YYYYMMDDstart, false);

    function YYYYDD(str) 
    {
        var MMvalue = document.DOB.MM.options[document.DOB.MM.selectedIndex].value;
        if (MMvalue == "") {

            optionsClear(e);
            return;
        }
        var n = MonHead[MMvalue - 1];
        if (MMvalue == 2 && IsPinYear(str)) n++;
        writeDay(n)
    }

    function MMDD(str) 
    {
        var YYYYvalue = document.DOB.YYYY.options[document.DOB.YYYY.selectedIndex].value;
        if (YYYYvalue == "") {
            var e = document.DOB.DD;
            optionsClear(e);
            return;
        }
        var n = MonHead[str - 1];
        if (str == 2 && IsPinYear(YYYYvalue)) n++;
        writeDay(n)
    }

    function writeDay(n) 
    {
        var e = document.DOB.DD;
        optionsClear(e);
        for (var i = 1; i < (n + 1); i++)
        {
            e.options.add(new Option(" " + i, i));
            if(i == changeDD){
                e.options[i].selected = true;  
            }
        }

    }

    function IsPinYear(year) 
    {
        return (0 == year % 4 && (year % 100 != 0 || year % 400 == 0));
    }

    function optionsClear(e) {
        e.options.length = 1;
    }
    function DDD(str){
        changeDD = str;
    }

</script>

    </body>
</html>

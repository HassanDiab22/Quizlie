<?php
session_start();
require("Config.php");
// clean user entries
$username = mysqli_real_escape_string($con, $_POST["Username"]);
$pass = mysqli_real_escape_string($con,$_POST["Pass"]);

$query = "SELECT * FROM user WHERE username='".$username."'";
$result = mysqli_query($con, $query);

if(!$result)
	die(mysqli_error()); // error in query or connection

if(mysqli_num_rows($result) == 0)
{
	$_SESSION["ERROR"] = "Invalid username"; // no result returned
	header("Location: login.php");
}
else{
	// username exists => continue to check password
	$row=mysqli_fetch_array($result);
	// hash the new logging password
	$hash1 = hash('sha256', $pass);
	$salt = $row["salt"]; //from database already encrypted with md5
	$finalPassword = hash('sha256', $hash1.$salt);
	if($finalPassword == $row["password"]){
	
	
			echo "login Successful";
			$_SESSION["LoggedIN"] = true;
			$_SESSION["Username"] = $username;
			$_SESSION["UserId"] = $row["user_id"];
			header("Location: index.php");
		
	}
	else{
		$_SESSION["ERROR"] = "Invalid Password";
		header("Location: login.php");
	}
}

?>
<?php

/******Adding Users To The Database And Updating Their Info If They Are Already Registered**************/

function checkAndAddUser($Fuid,$fname,$lname,$gender,$email,$fullname,$fblink,$dp,$referal){
	require 'credentials.php';
	$connection = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD) or die( "Unable to connect");
	$database = mysqli_select_db($connection ,$DB_DATABASE) or die( "Unable to select database");
		$check = mysqli_query($connection,"select * from users where email='$email'");
		
		$check = mysqli_num_rows($check);
		if (empty($check)) { // if new user . Insert a new record		
	
			$query = "INSERT INTO users (Fuid,fname,lname,email,fullname,fblink,gender,dp,lastlogin,referal) VALUES ('$Fuid','$fname','$lname','$email','$fullname','$fblink','$gender','$dp',now(),'$referal')";
			mysqli_query($connection, $query);	
			$_SESSION['user_check']=$email;
		} 
		else {   // If Returned user . update the user record	
			$_SESSION['user_check']=$email;
			$query = "UPDATE Users SET  lastlogin=now() WHERE email='$email' ";
			mysqli_query($connection,$query);
		}
}?>

<?php
	
	/******SQL Server Credentials**************/
	$DB_SERVER='localhost';
	$DB_USERNAME='root';
	$DB_PASSWORD='';
	$DB_DATABASE='api';

	$connection = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD) or die( "Unable to connect");
	$database = mysqli_select_db($connection ,$DB_DATABASE) or die( "Unable to select database");
		//echo "<pre>"; print_r($_POST); exit;
   //if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $mypassword = mysqli_real_escape_string($connection,$_POST['password']);
     // $email = "rohit@gmail.com";
	 // $mypassword = "rohit@123";
	 // echo "abc"; exit;
      $sql = "SELECT * FROM users WHERE email = '".$email."' and password = '".$mypassword."'";
      $result = mysqli_query($connection,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      $_SESSION['user_check']=$email;
      // If result matched $myusername and $mypassword, table row must be 1 row
		$respose_var= "";
      if($count == 1) {
        // session_register("email");
        // echo "<pre>"; print_r($row); exit;
		 $array_response = array("output"=>array("respone"=>true,"message"=>"login successful","userdata"=>$row));
		 
		 $respose_var = json_encode($array_response);
         
         //header("location: welcome.php");
      }else {
		  $array_response = array("output"=>array("respone"=>false,"message"=>"our Login Name or Password is invalid","userdata"=>""));
		  $respose_var =  json_encode($array_response);
         //$error = "Your Login Name or Password is invalid";
      }
	  
	  echo $respose_var;
 //  }

	/*print_r($connection);
	exit();
	
		/*$check = mysqli_query($connection,"select * from users where email='$email'");
		
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
		}*/
?>

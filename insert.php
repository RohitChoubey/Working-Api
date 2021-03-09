<?php
	$DB_SERVER='localhost';
	$DB_USERNAME='root';
	$DB_PASSWORD='';
	$DB_DATABASE='api';
	 
	$connection = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD) or die( "Unable to connect");
	$database = mysqli_select_db($connection ,$DB_DATABASE) or die( "Unable to select database");
		/* $link = mysqli_connect("localhost", "root", "", "api");
		// Check connection
		 if($connection === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		} */
		
	// Escape user inputs for security
	$email = mysqli_real_escape_string($connection, $_REQUEST['email']);
	$password = mysqli_real_escape_string($connection, $_REQUEST['password']);
	$name = mysqli_real_escape_string($connection, $_REQUEST['name']);
	$age = mysqli_real_escape_string($connection, $_REQUEST['age']);

	$respose_var= "";
	// Attempt insert query execution
	$sql = "INSERT INTO users (email, password, name,age) VALUES ('$email', '$password', '$name','$age')";
	if(mysqli_query($connection, $sql)) {
		$array_response = array("output"=>array("respone"=>true,"message"=>"Registrated successful",));
		 $respose_var = json_encode($array_response);
		//echo "Records added successfully.";
		header("Location: index.php");
		echo "Records added successfully.";
	} 
	else {
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
	}
	
	// Close connection
	mysqli_close($connection);
?>
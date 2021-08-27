<?php

include 'driver_conn.php';
 
// Creating MySQL Connection.
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
// Storing the received JSON into $json variable.
$json = file_get_contents('php://input');
 
// Decode the received JSON and Store into $obj variable.
$obj = json_decode($json,true);
 
// Getting Username from $obj object.
$username = $obj['username'];
 
// Getting Email from $obj object.
$email = $obj['email'];
 
// Getting Password from $obj object.
$password = $obj['password'];

// Getting Address from $obj object.
$address = $obj['address'];

// Getting Phone from $obj object.
$phone = $obj['phone'];
 
// Checking whether Email is Already Exist or Not in MySQL Table.
$CheckSQL = "SELECT * FROM driver WHERE username='$username'";
 
// Executing Email Check MySQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){
 
	 $userExist = 'Username Already Exist, Please Try Again';
	 
	 // Converting the message into JSON format.
	$existUserJSON = json_encode($userExist);
	 
	// Echo the message on Screen.
	 echo $existUserJSON ; 
 
  }
 else{
 
	 // Creating SQL query and insert the record into MySQL database table.
	 $Sql_Query = "insert into driver (resellerid, username, password, email, address, phone) values (1,'$username',PASSWORD('$password'),'$email','$address',$phone)";
	 
	 
	 if(mysqli_query($con,$Sql_Query)){
	 
		 // If the record inserted successfully then show the message.
		$MSG = 'User Registered Successfully' ;
		 
		// Converting the message into JSON format.
		$json = json_encode($MSG);
		 
		// Echo the message.
		 echo $json ;
	 
	 }
	 else{
	 
		echo 'Try Again';
	 
	 }
 }
 mysqli_close($con);
 ?>
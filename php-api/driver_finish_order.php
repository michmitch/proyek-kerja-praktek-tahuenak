<?php

include 'driver_conn.php';

// Creating MySQL Connection.
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

// Storing the received JSON into $json variable.
$json = file_get_contents('php://input');

// Decode the received JSON and Store into $obj variable.
$obj = json_decode($json,true);

// Getting Username from $obj object.
$id = $obj['id'];

date_default_timezone_set('Asia/Bangkok');
$tgl = date("Y-m-d");

// Creating SQL query and insert the record into MySQL database table.
$sql_query = "UPDATE orderdetail SET status='Selesai' WHERE orderid=$id";

$sql_update_tgl = "UPDATE orders SET date='$tgl' WHERE orderid=$id";

if(mysqli_query($con,$sql_query) && mysqli_query($con, $sql_update_tgl)){

	$MSG = 'Finished' ;
	$json = json_encode($MSG);
	echo $json ;

}
else{

	echo 'Try Again';

}
mysqli_close($con);
?>
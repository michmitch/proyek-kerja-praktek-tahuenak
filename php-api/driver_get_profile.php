<?php
include 'driver_conn.php';

// Creating MySQL Connection.
$con = new mysqli($HostName,$HostUser,$HostPass,$DatabaseName);

// if($con->connect_error){
// 	die("Connection Failed: ".$con->connect_error);
// }

$username = $_GET['user'];
$sql = "SELECT *FROM driver where username='$username'";
$queryResult = $con->query($sql);
$result = array();

while ($fetchData = $queryResult->fetch_assoc()) {
	$result[] = $fetchData;
}

echo json_encode($result);
$con->close();
?>
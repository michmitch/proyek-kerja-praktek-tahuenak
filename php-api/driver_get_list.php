<?php
include 'driver_conn.php';

// Creating MySQL Connection.
$con = new mysqli($HostName,$HostUser,$HostPass,$DatabaseName);

// if($con->connect_error){
// 	die("Connection Failed: ".$con->connect_error);
// }

$username = $_GET['user'];

//check if order from customer
$sql = "SELECT *, t.price, t.qty, o.address, o.zone, o.phone, concat(dayname(CONVERT_TZ(LOCALTIME,'+00:00','+07:00')), date_format(CONVERT_TZ(LOCALTIME,'+00:00','+07:00'),', %d-%m-%Y')) as tgl FROM orders o join orderdetail t on t.orderid = o.orderid join stock s on s.stockid = t.stockid join driver d on d.id = o.driverid where username='$username' and status!='Selesai'";
$queryResult = $con->query($sql);
$result = array();
if($queryResult->num_rows > 0){
	while ($fetchData = $queryResult->fetch_assoc()) {
		$result[] = $fetchData;
	}
}
else{
$result[]='No Orders Yet';
}

// if($queryResult->num_rows > 0){
// 	while ($row[] = $queryResult->fetch_assoc()) {
// 		$item = $row;
// 		$json = json_encode($item, JSON_NUMERIC_CHECK);
// 	}
// }
// else{
// 	echo "No Data Found";
// }
// echo $json;

echo json_encode($result);
$con->close();
?>
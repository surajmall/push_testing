<?php

require_once('dbconnect.php');

$token = $_POST['token'];

//echo "SUCCESS SURAJ : ".$token;
$token1 = $token;
$token = mysqli_real_escape_string($conn, $token);

$sql = "INSERT INTO `fcm-push`.`token` (`token`) VALUES ('".$token."')";
$query = mysqli_query($conn, $sql);
if(!$query){
	$obj = array();
	$obj['success'] = 0;
	$obj['reason'] = "Failed to inser.";

	echo json_encode($obj);
}else{

	$obj = array();
	$obj['success'] = 1;
	$obj['reason'] = "success";
	$obj['token'] = $token1;

	echo json_encode($obj);
}

?>


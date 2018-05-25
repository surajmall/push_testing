<?php
	
		$conn = mysqli_connect("localhost", "root", "", "fcm-push");
		if(mysqli_connect_errno()){
			echo "Connection Error:".mysqli_connect_errno();
			exit;
		}

?>
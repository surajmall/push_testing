<?php

	define('SERVER_API_KEY', 'AIzaSyBQrbhnWVD9rZPMEq8Q1NZePX--KdQi-Mo');
	$tokens = ['ch9J6447FPQ:APA91bGgiobnB--u5M7TxnEdwkcDLzpVvJnLpr4cni47wVXklC5Pw2N6sSyaetebeedrFrTAQiJ3gv_jcNIOOAhn7rlXUxfCbxTF_Pfn2ileiTH6V8EdWeJjS1Z-ihXybWhXOJLAVclA'];

	$header = [
		'Authorization: Key' .SERVER_API_KEY,
		'Content-Type: Application/json'
	];

	$msg = [
		'title' => 'Testing push notification',
		'body' =>'Testing notification from localhost',
		'icon' => 'img/logo.svg',
		'image' => 'img/kuch.jpg',
	];

	$payload = [
		'registration_ids' => $tokens,
		'data' => $msg

	];

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode($payload),
	  CURLOPT_HTTPHEADER => $header
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}

?>
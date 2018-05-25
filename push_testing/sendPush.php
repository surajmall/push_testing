<?php


#API access key from Google API's Console
//define( 'API_ACCESS_KEY', 'AAAAlbXP7Ms:APA91bFALe6bZZvikS7mRE2Pl64RTy0JIMvQC7hQvsUVjW49NqeroqDjjF1ow-OFpZk7MxNkwM8BPhweOQuQvPgOoIXAw9HwRpusKNEIu_9MxuR0u1kBLAvlM7o3nvvi9YBgFFagnqE-');

define('SERVER_API_KEY', 'AIzaSyAGSk09AGEq6gqZu8dLOkbKTk1eMF6emTo');

$icon = 'https://agostini.tech/wp-content/uploads/2017/06/developer-coding-programming-firebase-google-icon.png';
$image = 'https://www.livemint.com/rf/Image-621x414/LiveMint/Period2/2016/06/03/Photos/Processed/tatacliq-kxwD--621x414@LiveMint.jpg';
$title = "Firebase Test Messaging : Suraj";
$message = "Successfully Sent the message";
$url = "https://compare.buyhatke.com/";
//$IMEI = urldecode($_GET['email']);
$registrationIds = ['cPCuP-WxE4I:APA91bGoK8MztdZ2EtfUMu8RFGkNbcZOwovjpv7QaVaHK-fu5QoC-fPxswAV7flRr1cKnpmCmHpwG4cZxVwyZ24EEkjbJ9cJLsTCcIKXw28jXhFMTMvrRgp_SPpzMhXck4FRLVa3B6MP'];


// echo "<br>Title : ".$title;
// echo "<br>image : ".$image;
// echo "<br>message : ".$message;
// echo "<br>URL : ".$url;
// echo "<br>token : ".$registrationIds;



$msg1 = (object)[
'title'	=> $title,
'message' => $message,
'url' => $url,
'icon' => $icon,
'image' => $image
];

$fields = array(
'registration_ids' => $registrationIds,
'data'	=> $msg1
);

// $fields = array(
// 'registration_ids' => $registrationIds,
// 'data'	=> $msg1
// );



//echo "\nFields : ".json_encode($fields);
print_r($fields);
//echo "\n";

$headers = array(
'Authorization: key=' . SERVER_API_KEY,
'Content-Type: application/json'
);
#Send Reponse To FireBase Server

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
#Echo Result Of FireBase Server
echo "Result : \n".$result;
//print_r(json_decode($result, true));
?>
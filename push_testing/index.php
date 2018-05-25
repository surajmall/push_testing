<!DOCTYPE html>
<html>
	<head>
		<title>push notification</title>
			<script src="https://www.gstatic.com/firebasejs/5.0.3/firebase.js"></script>
			<link rel="manifest" href="manifest.json">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

            <script>
  			// Initialize Firebase
  			var config = {
	    		apiKey: "AIzaSyBQrbhnWVD9rZPMEq8Q1NZePX--KdQi-Mo",
	    		authDomain: "push-testing-77256.firebaseapp.com",
	    		databaseURL: "https://push-testing-77256.firebaseio.com",
	    		projectId: "push-testing-77256",
	    		storageBucket: "push-testing-77256.appspot.com",
	    		messagingSenderId: "513207873626"
	  		};
	  		firebase.initializeApp(config);

	  		//Retrieve Firebase Messaging object.
	  		const messaging = firebase.messaging();

	  		//make a promise for consent the user to send push notifications----
	  		messaging.requestPermission().then(function(){

	  			console.log('permission granted by the user');
	  			if(isTokenSentToServer()){
	  				console.log('token is already send to server');
	  			}else{

	  				getRegToken();
	  			}
	  			//getRegToken();
	  		}).catch(function(err){
	  			console.log('permission denied by the user');
	  		});

	  		function getRegToken() {

	  			messaging.getToken().then(function(currentToken) {
	  			  if (currentToken) {
	  			  	saveToken(currentToken);
	  			  	//console.log(currentToken);
	  			  	setTokenSentToServer(true);
	  			    //sendTokenToServer(currentToken);
	  			  }else{
	  			    // Show permission request.
	  			    console.log('No Instance ID token available. Request permission to generate one.');
	  			    setTokenSentToServer(false);
	  			  }
	  			}).catch(function(err) {
	  			  console.log('An error occurred while retrieving token. ', err);
	  			  setTokenSentToServer(false);
	  			});
	  		}

	  		function setTokenSentToServer(sent) {
	  		    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
	  		}

	  		function isTokenSentToServer() {
	  		    return window.localStorage.getItem('sentToServer') === '1';
	  		}

	  		function saveToken(currentToken) {

	  			var params = {
	  				'token': currentToken
	  			};


	  			$.ajax({
	  				url : 'https://localhost/push_testing/action.php',
	  				method : 'post',
	  				data : params
	  			}).done(function(result){
	  				console.log(result);
	  			})
	  		}

	  		messaging.onMessage(function(payload) {
	  		  //console.log('Message received. ', payload);
	  		  Title = payload.data.title;
	  		  var fecha = Date.now("Y-m-d");
	  		  Options = {
	  		  	body : payload.data.message,
	  		  	icon : payload.data.icon,
	  		  	image : payload.data.image,
	  		  	timestamp :fecha
	  		  }
	  		  var notification = new Notification(Title, Options);
	  		  notification.onclick = function(event){
	  		  event.preventDefault();
	  		  window.open(payload.data.url);
	  		  }
	  		});
	  		
		</script>
	</head>
	<body>
		<p>this is push notification testing web app</p>

	</body>
</html>
importScripts('https://www.gstatic.com/firebasejs/5.0.3/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.0.3/firebase-messaging.js');

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

var messaging = firebase.messaging();
var url;

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  var notificationTitle = payload.data.title;
  var notificationOptions = {
    body: payload.data.message,
    icon: payload.data.icon,
    image: payload.data.image
  };
  url = payload.data.url;

  return self.registration.showNotification(notificationTitle, notificationOptions);
  
});

self.addEventListener('notificationclick', function(event) {
    console.log('Notification click: tag ', event.notification.tag);
    event.notification.close();
    //var url = 'https://youtu.be/gYMkEMCHtJ4';
    event.waitUntil(
        clients.matchAll({
            type: 'window'
        })
        .then(function(windowClients) {
            for (var i = 0; i < windowClients.length; i++) {
                var client = windowClients[i];
                if (client.url === url && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});
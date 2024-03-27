// Assuming compatibility with Firebase version 9 is confirmed

importScripts(
    "https://www.gstatic.com/firebasejs/9.15.0/firebase-app-compat.js"
  );
  importScripts(
    "https://www.gstatic.com/firebasejs/9.15.0/firebase-messaging-compat.js"
  );
  
  // Your existing Firebase project configuration (unchanged)
  var firebaseConfig = {
    apiKey: "AIzaSyCMsVgp_a8yTZWDje-ihAZmxaqvu-CJyIo",
    authDomain: "app-lab-90759.firebaseapp.com",
    projectId: "app-lab-90759",
    storageBucket: "app-lab-90759.appspot.com",
    messagingSenderId: "184716463926",
    appId: "1:184716463926:web:933d046b34148b79ddad97",
    measurementId: "G-GJQEWGRBMZ",
  };
  
  const messaging = firebase.messaging();
  messaging.setBackgroundMessageHandler(function ({ data: { title, body, icon } }) {
    return self.registration.showNotification(title, { body, icon });
  });
  
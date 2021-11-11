import firebase from 'firebase/compat/app';

const firebaseConfig = {
  apiKey: "AIzaSyAN0sN-WbOIYFmGngH-99fZOTaE0n6Hb_c",
  authDomain: "bc-gim.firebaseapp.com",
  databaseURL: "https://bc-gim.firebaseio.com",
  projectId: "bc-gim",
  storageBucket: "bc-gim.appspot.com",
  messagingSenderId: "815072522968",
  appId: "1:815072522968:web:77a50fe685fadc90da1dad"
};

// Exporto Firebase Inicializado
export default firebase.initializeApp(firebaseConfig);

//******************* Version de Firebase en Package.json
//"firebase": "^9.1.0",

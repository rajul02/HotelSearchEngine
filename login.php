<?php 

 include 'dbFunction.php';
include_once 'dbConnect.php';

  if(isset($_POST['register']))
  {
    header("Location: register.php");
  }

?>


<script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>

<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDPWVJyImvZvLD-bjFpfY1EqAg2rW2H-VA",
    authDomain: "alibaba-d3b78.firebaseapp.com",
    databaseURL: "https://alibaba-d3b78.firebaseio.com",
    projectId: "alibaba-d3b78",
    storageBucket: "alibaba-d3b78.appspot.com",
    messagingSenderId: "184167858652"
  };
  firebase.initializeApp(config);
  var provider = new firebase.auth.GoogleAuthProvider();

  firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Google Access Token. You can use it to access the Google API.
  var token = result.credential.accessToken;
  console.log(token);
  // The signed-in user info.
  var user = result.user;

  window.alert(user.email);
  // ...
}).catch(function(error) {
  // Handle Errors here.
  var errorCode = error.code;
  var errorMessage = error.message;
  // The email of the user's account used.
  var email = error.email;
  // The firebase.auth.AuthCredential type that was used.
  var credential = error.credential;
  // ...
});

</script>




<html>
<head>
  <meta charset="utf-8">
    <title>SellNBuy</title>
    
    <link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.min.js"></script>


</head>
<body style="background: #ffffff;
  color: #606468;"><center>
<?php  include 'header.php';?>
   <div id="login" ng-app="myApp"><center>
   <h1 style=" color: Black; font-family: sans-sherif"><center>Alibaba</center></h1>
   <h2 style=" color: Black; font-family: arial"><center>Login</center></h2>
      <form name="myForm" ng-controller="myCtrl" method="post" action="">

          <input type="text"  name= "userName"  placeholder="Username" required="required" ng-model="userName" >
<span ng-show="myForm.userName.$touched && myForm.userName.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
  <input type="password"  name="password"  placeholder="Password" required="required" ng-model="password" ng-minlength="3">
  <span ng-show="myForm.password.$touched && myForm.password.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>

          <input type="submit" ng-click="myFunc()" value="Login" name="login">
          <p>The button has been clicked {{count}} times.</p>
         <a class="forgot" href="forgot.php">Forgot Password?</a>
        <br><br>


</form>
      <br>

      <form method="post" action="">
         <input type="submit" value="Register" name="register">
      </form>
        
</center>
    </div>
    </center>
</body>

   
</html>
<script>
angular.module('myApp', [])
.controller('myCtrl', ['$scope', function($scope) {
    $scope.count = 0;
    $scope.myFunc = function() {
        $scope.count++;
    };
}]);
</script>
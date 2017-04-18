<?php 

 include 'dbFunction.php';
  include_once 'dbConnect.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_SESSION['userId'])){
    
    echo $_SESSION['userId'];
    include_once 'dbConnect.php';

    $funobj = new dbFunction($conn);

    $data = $funobj->getUserDetail($_SESSION['userId']);


    }else {
      echo "<script>
alert('Login First');
window.location.href='login.php';
</script>";

      
    }


  
?>





<html>
<head>
  <meta charset="utf-8">
    <title>SellNBuy</title>
    
    <link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.min.js"></script>


</head><body style="background: #ffffff;
  color: #606468;"><center>

<?php  include 'header.php';?>
<?php if(count($data) > 0): ?>
  <div style=""  ng-app="myApp" 
        ng-controller="myController">
   <div id="login"  style=""><center>
   <h2 style=" color: Black; font-family: arial"><center>Edit Profile</center></h2>
      <form name='register' method="post"   action="" >

       
         Name:&nbsp;&nbsp;&nbsp; <input type="text" id="user" name= "userName"  ng-model="userName" value="<?php echo $data['name'];?>" >
<button ng-click="setFocus()"><i class="glyphicon glyphicon-pencil"></i></button>
       
         Email:&nbsp;&nbsp;&nbsp; <input type="email" id="email" name="email"   required="required" ng-model="email" value="<?php echo $data['email'];?>">
<button ng-click="document.getElementById('email').focus();"><i class="glyphicon glyphicon-pencil"></i></button>

       
          Phone:&nbsp;&nbsp;&nbsp; <input type="text" id="phone" name= "phone" required="required" ng-model="phone" value="<?php echo $data['phone'];?>">
<button><i class="glyphicon glyphicon-pencil"></i></button>
       
       Loaction:&nbsp;<input type="text" id="phone" name= "phone" required="required" ng-model="phone" value="<?php echo $data['location'];?>">
<button><i class="glyphicon glyphicon-pencil"></i></button>
               <p>Enter your name: <input type="text" id="name" /></p>
            <p><button ng-click="setFocus()" id="bt">Click to Set Focus</button></p>
        <p>Enter your age: <input type="number" id="age" /></p>



        
          <input type="submit" ng-click="myFunc()" value="register" name="register">
      </form>
       <br><br>
       <p>Already Registered?</p>
      <form method="post" action="">
        <input type="submit" value="Login here" name="login11">
      </form>
      </center>
    </div>
    </div>
    </center>
>
<script>
    var myApp = angular.module('myApp', []);
    myApp.controller('myController',
        function ($scope, $window) {

            $scope.setFocus = function () {
                var name = $window.document.getElementById('name');
                var age = $window.document.getElementById('age');
                if (name.value != '')
                    age.focus();
                else {
                    alert('Invalid name');
                    name.focus();
                }
            };
        });
</script>


<?php endif; ?>

<?php include 'footer.php'; ?>

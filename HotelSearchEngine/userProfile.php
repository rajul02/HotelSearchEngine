<?php 

 include 'dbFunction.php';
  include_once 'dbConnect.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    //$_SESSION['userId']= 16;
echo $_SESSION['userId'];
    if(isset($_SESSION['userId'])){
    
    include_once 'dbConnect.php';

    $funObj = new dbFunction($conn);

    $data = $funObj->getUserDetail($_SESSION['userId']);
	 if(count($data) > 0)
	 {
		 $name=$data['name'];
		 $email=$data['email'];
		 $phone=$data['phone'];
		 $location=$data['location'];
	 }


    }else {
      echo "<script>
alert('Login First');
window.location.href='login.php';
</script>";

      
    }

      if(isset($_POST['Save'])){
        $name2=$_POST['userName'];
        $email2=$_POST['email'];
        $phone2=$_POST['phone'];
        $location2=$_POST['location'];
        $id=$_SESSION['userId'];
       $user = $funObj->UpdateUser($id,$name,$email,$phone,$location);
       if($user===True){
         echo "<script>
alert('Changes Saved');
</script>";

       }
       else{
        echo $funObj->db->error;
         //echo "<script>
//alert('Error in saving changes');
//</script>";

       }


      }
      if(isset($_POST['save_pass'])){
        $new=$_POST['newpassword'];
        $old=$_POST['cpassword'];
        $id=$_SESSION['userId'];
       if(sha256($old)==$data['password']){
		$user = $funObj->ChangePassword($id,$new);
		if($user===True){
         echo "<script>
		alert('Password changed');
		</script>";

       }
       else{
        echo $funObj->db->error;
         //echo "<script>
//alert('Error in saving changes');
//</script>";

       }

	   }
	   else{
		 echo "<script>
		alert('Old password is wrong');
		</script>";
  
	   }
	   
       

      }





  
?>





<html>
<head>
  <meta charset="utf-8">
    <title>SellNBuy</title>
    
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-route.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>


</head><body style="background: #ffffff;
  color: #606468;">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
       <img alt="Brand" src="images/leo.jpg" style="width: 30px;height: 30px" >
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <select id="selectFilter" class="selectpicker" title="Select Filter...">
            
              <option value="location">Location</option>
              <option value="rating">Rating</option>
              <option value="roomPrice">Price</option>
            
          </select>
        </div>

        <div class="form-group" id="filterValuesDiv">
      
          <div class="col-lg-10">
            <select id="filterValues" class= "selectpicker show-tick" multiple data-max-options="1" data-live-search="true" required>
              
            </select>
          </div>
        </div>

        <div class="input-group">
          <input id="searchBox" type="text" class="form-control" placeholder="Search">

          <div class="input-group-btn">
            <p><i class="glyphicon glyphicon-search"></i></p>
          </div>
        </div>
        
      </form>
      </ul>
      <ul class="nav navbar-nav navbar-right" style="float: right;">

      <?php if(!isset($_SESSION['userId'])): ?>
        <li><a href="login.php">Login</a></li>
        
      <?php else: ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notification <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#">Another action</a></li>
             <li role="separator" class="divider"></li>
            <li><a href="#">Something else here</a></li>
          </ul>
        </li>
        <li><a href="userprofile.php">My Profile</a></li>
        <li><a href="logout.php">Log out</a></li>

        
      <?php endif; ?> 
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<?php if(count($data) > 0): ?>
  <div style=""  ng-app="myApp" 
        ng-controller="myController">
   <div id="login"  style="margin-left:200px;"><center>
   <h2 style=" color: Black; font-family: arial"><center>Edit Profile</center></h2>
      <form name='register' method="post"   action="" >

         <span id="icon" class="glyphicon glyphicon-pencil"></span>
         <p>Name:&nbsp;&nbsp;&nbsp; 
		 <input type="text" id="user" name= "userName"   required="required" value="<?php echo $name;?> " ></p>
         <span id="icon" class="glyphicon glyphicon-pencil"></span>

       
        <p> Email:&nbsp;&nbsp;&nbsp; <input type="email" id="email" name="email" value="<?php echo $email;?>" required="required" ></p>
         <span id="icon" class="glyphicon glyphicon-pencil"></span>

       
         <p> Phone:&nbsp;&nbsp;&nbsp; <input type="text" id="phone" name= "phone" required="required"  value="<?php echo $phone;?>" minlength="10" maxlength="10" ></p>
          <span id="icon" class="glyphicon glyphicon-pencil"></span>

       <p>Loaction:&nbsp;<input type="text" id="location" name= "location" required="required"  value="<?php echo $location;?>"></p>
	   



        
          <input type="submit"  value="Save Changes"  name="Save">
      </form>
	  <br>
	  <br>
	  </div>
   <div id="login"  style=" position:fixed; left:700px; top:120px;"><center>
	  <form>
      <input type="submit" ng-click="showTheForm = !showTheForm" value="Change Password"/>
	  </form>
      <form ng-show="showTheForm"  method="post" action="" name="change">
          <input type="password" id="oldpassword" name="cpassword"  placeholder=" Enter Old Password" required="required" ng-model="cpassword"> 
          <span ng-show="change.cpassword.$touched && change.cpassword.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
		<input type="password" id="newpassword" name="newpassword"  placeholder=" Enter New Password" required="required" ng-model="newpassword"> 
        <span ng-show="change.newpassword.$touched && change.newpassword.$invalid" class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red"></span>
		<input type="password" id="rpassword" name="rpassword"  placeholder=" Reenter New Password" required="required" ng-model="rpassword" > 
        <span ng-show="change.rpassword.$touched && change.rpassword.$invalid " class="glyphicon glyphicon-remove" aria-hidden = "true" style="color: red" ></span>

<input type="submit"  value="Save Changes"  name="save_pass">

	
</form>
</center>
</div>
    </center>

    </div>
    </div>
	<script>
angular.module('myApp', [])
.controller('myController', ['$scope', function($scope) {
    $scope.showTheForm = false;
	
    $scope.processForm = function() {
    // execute something
    $scope.showTheForm = false;
}

}]);
angular.module('myApp.directives', [])
  .directive('pwCheck', [function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var firstPassword = '#' + attrs.pwCheck;
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('pwmatch', v);
          });
        });
      }
    }
  }]);
</script>
>

<?php endif; ?>

<?php include 'footer.php'; ?>

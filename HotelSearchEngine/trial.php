<?php
session_start();
?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Hotel Search engine</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
            <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.js"></script> 		   
           <style>  
           li{  
                cursor:pointer;  
           }  
           li:hover  
           {  
                background-color:#f9f9f9;  
           }  
           </style>  
      </head>  
      <body>  
           <br /><br />  
		   <?php if($_SESSION['FULLNAME']){?>
		   <form method="post" action="start.php">
		   <button type="submit" style="margin-left:1300px;">LogOut</button>
			<img style="width:50px; height:50px; margin-left:1300px; margin-top:20px;" src="<?php echo $_SESSION['imagesrc']; ?>">
			<p style="margin-left:1300px;"><?php echo $_SESSION['FULLNAME'];?></p>
		   
		   </form>
		   <?php } else{ ?>
		   <form method="post" action="login.php">
		   
		   <button type="submit" style="margin-left:1300px;">Login</button>
		   </form>
		   <?php }?>
           <div class="container" style="width:500px;">  
                
                <div ng-app="myapp" ng-controller="usercontroller">  
                     <label>Enter City Name</label>  
				<form method="post" action="shop.php">
						<input type="submit" name="sub" style="margin-left:500px; margin-top:0px; position:absolute;" value="Search">
                     <input type="text" name="country" id="country" ng-model="country" value="" ng-keyup="complete(country)" class="form-control" />  
					 <script>
    $(document).ready(function(){
        function displayLocation(latitude,longitude){
        var request = new XMLHttpRequest();

       var method = 'GET';
       var url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='+latitude+','+longitude+'&sensor=true';
       var async = true;

       request.open(method, url, async);
       request.onreadystatechange = function(){
       if(request.readyState == 4 && request.status == 200){
         var data = JSON.parse(request.responseText);
         //alert(request.responseText); // check under which type your city is stored, later comment this line
         var addressComponents = data.results[0].address_components;
         for(i=0;i<addressComponents.length;i++){
            var types = addressComponents[i].types
            //alert(types);
            if(types=="locality,political"){
              // alert(addressComponents[i].long_name);
               $("#country").val(addressComponents[i].long_name);
              // $('#country').html(location.results[0].addressComponents[i].long_name);
                // this should be your city, depending on where you are
             }
           }
        //alert(address.city.short_name);
       }
    };
   request.send();
 };

 var successCallback = function(position){
 var x = position.coords.latitude;
 var y = position.coords.longitude;
 displayLocation(x,y);
  };


 navigator.geolocation.getCurrentPosition(successCallback);

  });
 </script>

                     <ul class="list-group" ng-model="hidethis" ng-hide="hidethis">  
                          <li class="list-group-item" ng-repeat="countrydata in filterCountry" ng-click="fillTextbox(countrydata)">{{countrydata}}</li>  
                     </ul>  
					 
					 </form>
                </div>  
           </div>
			
      </body>  
 </html>  
 <script>  
 var app = angular.module("myapp",[]);  
 var str="";
 var cities=[];
 app.controller("usercontroller", ['$scope', '$http', function ($scope, $http) {
$http.get("ajax.php")
                .success(function(data){
                    $scope.data = data;
					//alert("hiiiiii");
					
					for (var key in data) {
	 cities.push(data[key].cityname);
    
  }				
					
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                });	 
      $scope.countryList =  
					cities;
          
				
      $scope.complete = function(string){  
           $scope.hidethis = false;  
           var output = [];  
           angular.forEach($scope.countryList, function(country){  
                if(country.toLowerCase().indexOf(string.toLowerCase()) >= 0)  
                {  
                     output.push(country);  
                }  
           });  
           $scope.filterCountry = output;  
      }  
      $scope.fillTextbox = function(string){  
           $scope.country = string;
           $scope.hidethis = true;  
      }  
 }]);  
 </script>  
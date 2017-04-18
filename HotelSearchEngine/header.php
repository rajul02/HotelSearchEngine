<?php
include 'dbFunction.php';
  include_once 'dbConnect.php';
   $funObj = new dbFunction($conn);
   $review = $funObj->getReviews(1);
   //print_r($review);

  if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 

  /*if(isset($_SESSION['userId'])){
    echo("user id: ".$_SESSION['userId']);
    echo("<br>"."User is login");
  }else{
   echo("User is logout");
  }*/

?>

<!DOCTYPE html>
<html>
<head>
  <title>Leo</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.css">
  <link rel="stylesheet" href="dist/css/bootstrap-select.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

  <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>
  <script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js"></script>

  
  <script>
    
    $(document).ready(function(){

        $("#filterValues").selectpicker("hide");

        $("#selectFilter").change(function(){
         // alert($("#selectFilter option:selected").text());

         var filterBy = $("#selectFilter option:selected").val();
         console.log(filterBy);
            $.post("getFilterValues.php",
            {
                filter: filterBy,
            },
            function(data, status){
                
                if(filterBy == "location"){
                  var data = JSON.parse(data);
                  $("#filterValues").empty();
                  for(i in data){
                   // console.log(data[i]);
                    var option = new Option(data[i],data[i]);
                    $("#filterValues").append($(option));
                  }
                  $("#filterValues").selectpicker('refresh');
                  $("#filterValues").selectpicker("show");
                }else if(filterBy == "roomPrice"){
                  var data = JSON.parse(data);
                  $("#filterValues").empty();
                  for(i in data){
                   // console.log(data[i]);
                    var option = new Option(data[i],data[i]);
                    $("#filterValues").append($(option));
                  }
                  $("#filterValues").selectpicker('refresh');
                  $("#filterValues").selectpicker("show");
                }else if(filterBy == "rating"){
                  var data = JSON.parse(data);
                  $("#filterValues").empty();
                  for(i in data){
                    //console.log(data[i]);
                    var option = new Option(data[i],data[i]);
                    $("#filterValues").append($(option));
                  }
                  $("#filterValues").selectpicker('refresh');
                  $("#filterValues").selectpicker("show");
                }
            });
        });

    $("#filterValues").change(function(){
        var filterBy = $("#selectFilter option:selected").val();
         var filter = $("#filterValues option:selected").text();
         var searchTag =  $("#searchBox").val();
          $.post("search_hotels.php",
          {
              "filterBy": filterBy,
              "filter": filter,
              "searchTag": searchTag

          },
          function(data, status){
              //alert(data)
                             console.log(data);
              var dataArray = JSON.parse(data);
              var re = JSON.parse('<?php echo $review;?>');
              //console.log(re);
              $("#main").empty();
              for(i=0;i<dataArray.length;i++){
                var obj = dataArray[i];

              $("#main").append("<div class='card'><div class='col-md-12 card' style='height:250px margin:20px '>"+"<div class='col-md-4' align='left'>"+"<img src='images/leo.jpg' height='180px' width='200px'style='margin:10px'>"+"</div>"+"<div class='col-md-4' align='left'>"+"<p>Hotel:  "+obj['hotelName']+"</p>"+"<p>Price of 1 room:  "+obj['roomPrice']+"Rs.</p>"+"<p>location:  "+obj['location']+"</p>"+"<p>Available Rooms:  "+obj['availableRooms']+"</p>"+"<p>rating:  "+obj['rating']+"</p>"+"<form method='post' action='booking.php'><input type='hidden' name='hid' value='"+obj['hotelId']+"'><input type='submit' name='book' value='book'></form><br>"+"</div>"+"<div class='col-md-4'><marquee  HEIGHT=200 id='"+obj['hotelId']+"' direction = 'up'> ");

             
              
              console.log(re);

              for(l = 0;l<re.length;l++)
                if(re[l]['hotelId']==obj['hotelId'])
                $("#"+obj['hotelId']+"").append("<center>"+re[l]['userId']+". "+re[l]['reviewMsg']+"</center>");
                 $("#main").append("</marquee></div></div></div>");
             }
          });
    });
    $("#searchBox").on("input",function(){
       // console.log($("#searchBox").val());
         var filterBy = $("#selectFilter option:selected").val();
         var filter = $("#filterValues option:selected").text();
         var searchTag =  $("#searchBox").val();
          $.post("search_hotels.php",
          {
              "filterBy": filterBy,
              "filter": filter,
              "searchTag": searchTag

          },
          function(data, status){
              //alert(data)
                             console.log(data);
              var dataArray = JSON.parse(data);
              var re = JSON.parse('<?php echo $review;?>');
              //console.log(re);
              $("#main").empty();
              for(i=0;i<dataArray.length;i++){
                var obj = dataArray[i];

              $("#main").append("<div class='card'><div class='col-md-12 card' style='height:250px margin:20px '>"+"<div class='col-md-4' align='left'>"+"<img src='images/leo.jpg' height='180px' width='200px'style='margin:10px'>"+"</div>"+"<div class='col-md-4' align='left'>"+"<p>Hotel:  "+obj['hotelName']+"</p>"+"<p>Price of 1 room:  "+obj['roomPrice']+"Rs.</p>"+"<p>location:  "+obj['location']+"</p>"+"<p>Available Rooms:  "+obj['availableRooms']+"</p>"+"<p>rating:  "+obj['rating']+"</p>"+"<form method='post' action='booking.php'><input type='hidden' name='hid' value='"+obj['hotelId']+"'><input type='submit' name='book' value='book'></form><br>"+"</div>"+"<div class='col-md-4'><marquee  HEIGHT=200 id='"+obj['hotelId']+"' direction = 'up'> ");

             
              
              console.log(re);

              for(l = 0;l<re.length;l++)
                if(re[l]['hotelId']==obj['hotelId'])
                $("#"+obj['hotelId']+"").append("<center>"+re[l]['userId']+". "+re[l]['reviewMsg']+"</center>");
                 $("#main").append("</marquee></div></div></div>");
             }
                        });
    });
        $("#btn").click(function(){
        alert("The paragraph was clicked.");
    });
        

    });

/*function call(hid){
      $("#hid").append("<p>hello</p>");

    }*/
   
  </script>
</head>
<body style="color:black">
<center>
<!--Navbar Start-->
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


<!--Navbar Ends-->


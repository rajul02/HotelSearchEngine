<?php 

?>




<!DOCTYPE html>

<html>


<head>

<script type="text/javascript">
function hello()
{
  <?php echo "rdtfyuioipo[srdyyuisrdyhiopfyguo"?>;
}
</script>
 
<style>
  
.header .header-nav ul#nav-account ul.dropdown-menu,
.header .header-nav ul#nav-library ul.dropdown-menu {
    position: relative;
    z-index: 10000;
    
}

</style>

<link rel="stylesheet" href="css/bootstrap.css">
  
</head>
<body style="background: #2c3338;
  color: #606468;">

<?php
    if(!isset($_SESSION)) 
    { 
        session_start();
       
        include 'dbFunction.php';
       include_once 'dbConnect.php';
        $funObj = new dbFunction($conn);
        if(isset($_SESSION['user_ID']))
        $data0 = $funObj->getNotification($_SESSION['user_ID']);
    } 

      $url = $_SERVER['REQUEST_URI'];

    $url = basename($url);

?>
    <div>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Sell-N-Buy</a>
    </div>
    <ul class="nav navbar-nav">
            <?php if($url == "index.php"): ?>
              <li class="active"><a href="index.php">Home</a></li>
            <?php else: ?>
              <li ><a href="index.php">Home</a></li>
            <?php endif; ?>

      <?php if(isset($_SESSION['username'])): ?>

        <?php if($url == "sellproduct.php"): ?>
          <li class="active"><a href="sellproduct.php">Sell Product</a></li>
        <?php else: ?>
          <li><a href="sellproduct.php">Sell Product</a></li>
        <?php endif; ?>  
      <?php endif; ?>


      <?php if($url == "contact.php"): ?>
          <li class="active"><a href="#">Contact</a></li>
        <?php else: ?>
          <li><a href="#">Contact</a></li>
        <?php endif; ?>

        <?php if($url == "aboutus.php"): ?>
          <li class="active"><a href="myprofile.php">About Us</a></li> 
        <?php else: ?>
          <li><a href="myprofile.php">About Us</a></li> 
        <?php endif; ?>


    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php if(isset($_SESSION['username']) && $_SESSION['username'] != "Admin"): ?>
      <?php if($url == "myprofile.php"): ?>
          <li class="active"><a href="myprofile.php"><span class="glyphicon glyphicon-user"></span> Hi, <?php echo $_SESSION['username']; ?></a></li>
        <?php else: ?>
          <li><a href="myprofile.php"><span class="glyphicon glyphicon-user"></span> Hi, <?php echo $_SESSION['username']; ?></a></li>
        <?php endif; ?>


      <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notification <span class="caret"></span></a>
          <ul class="dropdown-menu">

          <?php $count = 1;?>
            <?php foreach($data0 as $item): ?>
              <?php if ($count<=7): ?>
              <li onclick="hello();"> <?php echo "For product no ".$item['item_ID']." ".$item['message'];?></li>
              <li role="separator" class="divider"></li>
              <?php $count++; endif;?>
            <?php endforeach; ?>
            <li>
              <form>
                <input type="submit" value="Seen" name="seen" style="width:100%">
              </form>


            </li>
            <?php  $funObj = new dbFunction($conn); $funObj->trial();?>
           </ul>
      </li>

      <?php if($url == "your_items.php"): ?>
          <li class="active"><a href="your_items.php"><span class="glyphicon glyphicon-th-large"></span> Your Items</a></li>
        <?php else: ?>
          <li><a href="your_items.php"><span class="glyphicon glyphicon-th-large"></span> Your Items</a></li>
        <?php endif; ?>


      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    <?php elseif(isset($_SESSION['username']) && $_SESSION['username'] == "Admin"): ?>
      <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span> Hi, <?php echo $_SESSION['username']; ?></a></li>
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statistics <span class="caret"></span></a>
          <ul class="dropdown-menu">
             <li>
                <form name="new_items" method="post" action="">
                   <input type="submit" name="new_items" value="New Item" style="width:100%; margin-right:20px;border:none; background-color:#f1f1f1">
                </form> 
                </li>

                <li>
                <form name="profit" method="post" action="">
                   <input type="submit" name="profit" value="Profit/Item" style="width:100%;border:none; background-color:#f1f1f1">
                </form> 
                </li>

                <li>
                <form name="stop_bid" method="post" action="">
                   <input type="submit" name="profit1" value="Profit/User" style="width:100%; margin-right:20px;border:none; background-color:#f1f1f1">
                </form> 
                </li>


                <li>
                <form name="tolal_sell" method="post" action="">
                   <input type="submit" name="total_sell" value="Items Sold" style="width:100%; margin-right:20px;border:none; background-color:#f1f1f1">
                </form> 
                </li>


               <li>
                <form name="items_left" method="post" action="">
                   <input type="submit" name="items_left" value="Items Left" style="width:100%; margin-right:20px;border:none; background-color:#f1f1f1">
                </form> 
                </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    <?php else: ?>
      <?php if($url == "register.php"): ?>
          <li class="active"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <?php else: ?>
          <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <?php endif; ?>

        <?php if($url == "login.php"): ?>
          <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php else: ?>
          <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> 
        <?php endif; ?>
    <?php endif; ?>
    </ul>
  </div>
</nav>
</div>
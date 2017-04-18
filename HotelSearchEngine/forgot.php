



<html>
<head>
  <meta charset="utf-8">
    <title>SellNBuy</title>
    
    <link rel="stylesheet" href="style.css">

</head>
<body style="background: #2c3338;
  color: #606468;">
<?php  include 'header.php';?>

<?php 

	 $funObj = new dbFunction($conn);

	if(isset($_POST['Submit']))
	{
		$data = $funObj->getPasswordByEmail($_POST['email']);
	}
	else
		$data = [];

?>


 <div id="login">
<h4 style=" color: White; font-family: arial"><center>enter your Email </center></h4>
      <form name='form-login' method="post" action="">

       
          <input type="text" id="email" name= "email"  placeholder="Email" required="required">
        
        <input type="submit" value="Login" name="Submit">
        
        <br><br>

      </form>
      </div>
      <div>
      <?php foreach($data as $item): ?>
      		<?php echo $item['username'];?>
      		<br>
      		<?php echo $item['password'];?>

      		Decrypt your password<a href="http://www.md5online.org/">Here</a>
      <?php endforeach; ?>


      </body>
      </html>
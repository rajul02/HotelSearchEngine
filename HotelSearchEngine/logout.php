<?php 

//echo("loging out...."."<br>");
 if(!isset($_SESSION)) 
  { 
      session_start(); 
  } 
			session_unset();
			session_destroy();
			header("Location: index.php");
  
?>


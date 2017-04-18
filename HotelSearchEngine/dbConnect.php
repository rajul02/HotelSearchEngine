<?php


$conn = new mysqli("localhost","root","","hotelsearchengine");
if(!$conn)//testing connection
	 		{
	 			die("Cannot connect to the database");
			}
	else{
		//echo "connected";
	}
?>

<?php
 include 'dbFunction.php';
  include_once 'dbConnect.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


 
 	$search=$_POST['searchTag'];
 	$filterby=$_POST['filterBy'];
 	$filter=$_POST['filter'];


    $funobj = new dbFunction($conn);
	$hotel=$funobj->search_hotels($filter,$filterby,$search);
  	$num= $hotel->num_rows;
	$rows = array();
	if($num>0) {
            $i=0;
            while($r = $hotel->fetch_assoc()) {
                array_push($rows,$r);
            }
	}
	 echo json_encode($rows);
	
?>
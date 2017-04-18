<?php

	include_once 'dbConnect.php';

	if(isset($_POST["filter"])){
		//echo(strcasecmp($_POST["filter"],"City"));
		if(strcasecmp($_POST["filter"],"location") == 0){

			
			$query = "SELECT DISTINCT location FROM `hoteldetails` WHERE 1";

			$result = mysqli_query($conn,$query);
	//		echo mysqli_error($this->db);
	
			if ($result->num_rows > 0) {
				$data = array();
				//$row = mysqli_fetch_array($result,MYSQLI_NUM);
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			    	//print_r($row["location"]);
			       array_push($data,$row["location"]);
			    }
				echo(json_encode($data));
			}

		}else if(strcasecmp($_POST["filter"],"rating") == 0){
			$data = array(1,2,3,4,5);
			echo(json_encode($data));
		}else if(strcasecmp($_POST["filter"],"roomPrice") == 0){
			$data = array("0-2000","2000-5000","5000-9000","9000-12000","12000-18000","18000-25000");
			echo(json_encode($data));
		}
	}

?>
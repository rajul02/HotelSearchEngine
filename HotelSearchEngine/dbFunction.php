<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	class dbFunction
	{
		//FOR CONNECTION
		public function __construct($conn)
		{
			//conecting to database
			$this->db = $conn;
		}

	/*	public function getPasswordByEmail($email)
		{
			//echo $email;
			$query = "SELECT * FROM user_details WHERE email= '$email'";
			$data = mysqli_query($this->db,$query);
			return $data;
		}


		public function bdngValue($id)
	{
		$query = "SELECT MAX(bid_value) from bidding_table WHERE item_ID='$id'";
		$result = mysqli_query($this->db,$query);	

		$bdng = mysqli_fetch_array($result);
		if(count($bdng)  > 0) {
			//echo "success";
			return $bdng;
		}
		else{
			return $bdng=[];
		}
	}

	public function bidding($id,$bid_value){
	//$bd= $id;
	//echo $bd;
	// check login first
	If(!isset($_SESSION['user_ID'])){
		header('Location: login.php');
	}
	else{
	$q="SELECT user_ID from item where item_ID=$id";
	$res = mysqli_query($this->db,$q);
	$bidder_id= $_SESSION['user_ID'];
	$row= mysqli_fetch_assoc($res);
	$res2= $row['user_ID'];
    $SQL = "INSERT INTO `bidding_table`(`bid_ID`, `seller_ID`, `bidder_ID`, `item_ID`, `bid_value`) VALUES ('','$res2','$bidder_id','$id','$bid_value')";
    $result = mysqli_query($this->db,$SQL);
    $mes= "Your item was bid by" . $bidder_id;
    $SQL = "INSERT INTO `bid_notify`(`notify_id`, `user_ID`, `item_ID`, `message`, `seen`) VALUES ('','$res2','$id','$mes',0)";
    $result = mysqli_query($this->db,$SQL);
    echo mysqli_error($this->db);
    header('Location: index.php');
}



}

public function productDetail($id)
	{
		$query = "SELECT * from item NATURAL JOIN item_detail where item.item_ID='$id'";
		$result = mysqli_query($this->db,$query);	

		$data = mysqli_fetch_array($result);
		if(count($data)  > 0) {
			//echo "success";
			return $data;
		}
		else{
			return $data=[];
		}
	}



		//FOR LOGIN
		public function Login($username,$password)
		{
			$res = mysqli_query($this->db, "SELECT * FROM user_details WHERE username='$username' and password='$password'");
			if (!$res) {
    		echo 'Could not run query: ' . mysqli_error();
    		exit;
		}
			$no_rows = mysqli_num_rows($res);
			$user_data=mysqli_fetch_assoc($res);

			if($user_data["user_ID"])

			{	
				$_SESSION['user_ID'] = $user_data["user_ID"];
				$_SESSION['username'] = $user_data["username"];
				//header("Location: blogger.php");
				//echo $user_data["username"];
				return $user_data["user_ID"];
			}
			else
			{
				return false;
			}
		}




*/


		public function Login($password,$email)
		{
			
				$res = mysqli_query($this->db, "SELECT * FROM userdetails WHERE email='$email' and password='$password'");
			if (!$res) {
    		echo 'Could not run query: ' . mysqli_error();
    		exit;
		}
			$no_rows = mysqli_num_rows($res);
			$user_data=mysqli_fetch_assoc($res);

			if($user_data["userId"])

			{	
							$_SESSION['userId'] = $user_data["userId"];
				//$_SESSION['username'] = $user_data["username"];
				//header("Location: blogger.php");
				//echo $user_data["username"];
				return $user_data["userId"];
			}
			else
			{
				return false;
			}


			
			
		}

		public function getReviews($id){
			$query = "SELECT * FROM `review` WHERE 1";
			$res = mysqli_query($this->db,$query);
			if (!$res) {
    		echo 'Could not run query: ' . mysqli_error();
    		exit;
			}
			$no_rows = mysqli_num_rows($res);
			$rows = array();
			if($no_rows>0) {
            $i=0;
            while($r = $res->fetch_assoc()) {
                array_push($rows,$r);
            }
	}
	 

			return json_encode($rows);

		}

		//FOR REGISTRATION
		public function Register($password,$email)
		{
			
			//$d = date_create()->format('Y-m-d');
		
			$password = md5($password);
			//mysqli_query($this->db, "INSERT INTO `userdetails`(  `password`,  `email`) VALUES ('$password','$email')");
			$query = "INSERT INTO `userdetails`(  `password`,  `email`) VALUES ('$password','$email')";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				echo mysqli_error($this->db);
				return false;
			}
			 if(!isset($_SESSION)) 
			  { 
			      session_start(); 
			  } 
			$last_id =$this->db->insert_id;
			print_r($last_id);
			$_SESSION['userId']=$last_id;

			return true;


			
			
		}

		public function ChangePassword($id,$password){
			$query="UPDATE userdetails SET password='md5($password)' WHERE userId='$id' ";
			$q=$this->db->query($query);
			return $q;


		}
		

		public function Registertw($password,$username)
		{
			
			//$d = date_create()->format('Y-m-d');
		
			
			//mysqli_query($this->db, "INSERT INTO `userdetails`(  `password`,  `email`) VALUES ('$password','$email')");
			$query = "INSERT INTO `userdetails`(  `password`,  `name`) VALUES ('$password','$username')";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				echo mysqli_error($this->db);
				return false;
			}
			session_start();
			    $last_id =$this->db->insert_id;
			$_SESSION['userId']=$last_id;

			return true;


			
			
		}

		public function UpdateUser($id,$name,$email,$phone,$location){
			$query="UPDATE userdetails SET name='$name', phone='$phone' ,email='$email',location='$location' WHERE userId='$id' ";
			$q=$this->db->query($query);
			return $q;


		}


		public function Logout()
		{
			session_destroy();
			header("Location: index.php");
		}
		public function getUserDetail($uid)
		{
			$query = "select * from userdetails where userId = $uid limit 1";

			$result = mysqli_query($this->db,$query);
	//		echo mysqli_error($this->db);
	
			if($result) {
				$data = mysqli_fetch_assoc($result);
				return $data;
			}
			else {
				return [];
			}
		}
		public function gethotels()
		{
			$query = "select * from hoteldetails ORDER BY rating DESC";

			$result = $this->db->query($query);

			return $result;
			
		}


		
		public function userCheck($name){
			$query = "SELECT `userId` FROM `userdetails` WHERE name LIKE '$name' OR email Like '$name'";
			print_r($query);
			$result = mysqli_query($this->db,$query);
			print_r($result);
			$user_data=mysqli_fetch_assoc($result);
			print_r($user_data);
			if(isset($_SESSION['userId']))
			session_start();
			$_SESSION['userId']=$user_data['userId'];

			return $user_data['userId'];
		}

		public function book($userId,$hid,$st_date,$ed_date){
			$query = "INSERT INTO booking(userId,hotelId,startDate,endDate,checkoutStatus) VALUES ('$userId','$hid','$st_date','$ed_date',0)";
			$q = mysqli_query($this->db,$query);
			if(!$q){
				echo mysqli_error($this->db);
				return false;
			}
			return true;
		}
		
public function search_hotels($filter,$filterby,$search){

			$query = "";
			if($filter==""){
				if($search==""){
					$query="select * from hoteldetails where 1";					
				}else{
					$query = "select * from hoteldetails where hotelName LIKE '%$search%' or location LIKE '%$search%'";
				}
			}
			else{
				
				if($filterby=='location'){
					$query="select * from hoteldetails where $filterby = '$filter'";
						if($search!=""){
							$query.= " and (hotelName LIKE '%$search%' or location LIKE '%$search%')";
						}
						$query.=" ORDER BY rating DESC";
				}else if($filterby=='roomPrice'){
						$range=explode('-', $filter);
						$min=$range[0];
						$max=$range[1];
					//	print_r($min." ".$max);
						$query="select * from hoteldetails where (roomPrice between $min and $max)";
						if($search!=""){
								$query.= " and (hotelName LIKE '%$search%' or location LIKE '%$search%')";
						}
												$query.=" ORDER BY rating DESC";

					}else{
							$query="select * from hoteldetails where rating >= $filter";
							if($search!=""){
								$query.= " and (hotelName LIKE '%$search%' or location LIKE '%$search%')";

							}

						$query.=" ORDER BY rating DESC";

						}	
				
					
			}
			//print_r($query);
			//echo("<br>");
			$result = $this->db->query($query);
			//print_r($result);
			return $result;



		}



		/*public function addsellingitem($data)
		{
			$d = date_create()->format('Y-m-d');
			$userid= $data['user_id'];
			$cat = $data['category'];
			$price=$data['price'];
			$q = $data['quantity'];
			$query = "INSERT INTO `item`(`item_ID`, `user_ID`, `category`, `price`, `quantity`, `permission`, `date`) VALUES ('','$userid','$cat','$price','$q','0','$d')";

			

			//echo $query;

			$q = mysqli_query($this->db,$query);
			//$id = mysql_insert_id();
			//echo $q;
			if($q) {
				$query = "SELECT LAST_INSERT_ID()";
				$result = mysqli_query($this->db,$query);
				$id = $result->fetch_assoc();
				$id = $id['LAST_INSERT_ID()'];
				$item_desc=$data['item_desc'];
				$tit=$data['item_title'];
				$img=$data['item_image'];
				$query = "INSERT INTO `item_detail`(`item_detail_ID`, `item_ID`, `item_desc`, `item_title`, `item_image`) VALUES ('','$id','$item_desc','$tit','$img')";

				//echo $query;
				
				$q = mysqli_query($this->db,$query);

				if($q) {
					return true;
				}
				//echo 'success';
				return true;

			}else {
				echo mysqli_error($this->db);
				return false;
			}
			//print_r($q);
		}

		public function getSellingItemById($id) {
			if($id != "*") {
				$query = "SELECT * from item NATURAL JOIN item_detail WHERE item.user_ID = '$id'";
				//echo $query;
				$result = mysqli_query($this->db,$query);
				//echo mysqli_error($this->db);
				//print_r($result);
				if ($result->num_rows > 0) {
					
				    while($row = $result->fetch_assoc()) {
				        $data[] = $row;
				    }
				} 
				else {
					$data = [];
				    echo "No Product";
				}

				return $data;
			}
			else {
				$query = "SELECT * from item NATURAL JOIN item_detail WHERE item.permission= '1' and item.sold='0'";

				$result = mysqli_query($this->db,$query);
				//echo mysqli_error($this->db);
				//print_r($result);
				if ($result->num_rows > 0) {
					
				    while($row = $result->fetch_assoc()) {
				        $data[] = $row;
				    }
				} 
				else {
				    echo "0 results";
				}

				return $data;
			}
		}

		public function removeProduct($pid)
		{

			$uid = $_SESSION['user_ID'];
			$query1 = "INSERT INTO `bid_notify`(notify_id,`user_ID`, `item_ID`, `message`,seen) VALUES ('','$uid','$pid','deleted product',0)";
			$result1 = mysqli_query($this->db,$query1);
			$query = "DELETE FROM `item` WHERE item_ID = '$pid'";

			$result = mysqli_query($this->db,$query);
			//echo mysqli_error($this->db);
			if($result) {
				return true;
			}
			else {
				return false;
			}
		}

		public function getProductForPermission()
		{
			$query = "SELECT * from item NATURAL JOIN item_detail WHERE item.permission= '0'";

				$result = mysqli_query($this->db,$query);
				//echo mysqli_error($this->db);
				if ($result->num_rows > 0) {
					
				    while($row = $result->fetch_assoc()) {
				        $data[] = $row;
				    }
				    return $data;
				} 
				else {
				    echo "0 results";
				}

				return $data;
		}



		


		public function trial()
		{
			$id = $_SESSION['user_ID'];
			$query = "UPDATE bid_notify set seen=1 where user_ID= $id";
			$result = mysqli_query($this->db, $query);
		}



		public function permissionProduct($pid)
		{
			$query = "UPDATE `item` SET `permission`=1 WHERE item_ID='$pid'";
			$result = mysqli_query($this->db,$query);
			$temp = "SELECT user_ID FROM item WHERE item_ID= '$pid'";
			$result1= mysqli_query($this->db,$temp);
			$row1 = mysqli_fetch_array($result1);
			$uid = $row1['user_ID'];
			$m="allowed product";
			$query1 = "INSERT INTO `bid_notify`(notify_id,`user_ID`, `item_ID`, `message`,seen) VALUES ('','$uid','$pid','$m',0)";
			$result1 = mysqli_query($this->db,$query1);
			
			if($result){
				return true;
			}
			else {
				return false;
			}
		}

		public function stopBidding($pid)
		{
			$temp = "SELECT user_ID FROM item WHERE item_ID= '$pid'";
			$result1= mysqli_query($this->db,$temp);


			$row1 = mysqli_fetch_array($result1);
			$uid = $row1['user_ID'];
			$query1 = "INSERT INTO `bid_notify`(notify_id,`user_ID`, `item_ID`, `message`,seen) VALUES ('','$uid','$pid','bidding stopped',0)";
			$result1 = mysqli_query($this->db,$query1);


			$query = "SELECT MAX(bid_value), bidder_ID, seller_ID, item_ID FROM `bidding_table` WHERE item_ID= '$pid'";
			$result1=mysqli_query($this->db,$query);


			$row1 = mysqli_fetch_assoc($result1);
			$bidderid=$row1['bidder_ID'];
			$sellerid=$row1['seller_ID'];
			$bidvalue=$row1['MAX(bid_value)'];
			$d = date_create()->format('Y-m-d');

			$query= "INSERT INTO `bid_notify`(notify_id,`user_ID`, `item_ID`, `message`,seen) VALUES ('','$bidderid','$pid','you buyed this',0)";
			$result1 = mysqli_query($this->db,$query);


			$query = "INSERT INTO `bid_end`(`item_ID`, `buyer_ID`, `seller_ID`, `sold_value`, `sold_date`) VALUES ('$pid','$bidderid','$sellerid','$bidvalue','$d')";
			$result1=mysqli_query($this->db,$query);


			$query= "DELETE FROM `bidding_table` WHERE item_ID='$pid'";
			$result= mysqli_query($this->db,$query);

			$query= "UPDATE `item` SET sold =1 WHERE item_ID='$pid'";
			$result= mysqli_query($this->db,$query);


			if($result1){
				return true;
			}
			else {
				return false;
			}
		}

		public function newItemPermission()
		{
			$query1 = "SELECT * FROM item natural join item_detail WHERE item.permission= '0'";
			
			
    $result1 = mysqli_query($this->db,$query1);

    while ($row1 = mysqli_fetch_array($result1)) { 
            $item_id = $row1['item_ID'];
            $category = $row1['category'];
            $price = $row1['price'];
            $item_desc = $row1['item_desc'];
            $item_title = $row1['item_title'];

          
   // $funObj = new dbFunction($conn);
  
  
    $image_name= $row1["item_image"];      $image_path="images";
        

            //echo "<div style='border: ridge;padding: 20;height=500px'>";
             echo "<div class='container'>";
             echo '<div class="col-md-3">';
    
            echo '<div class="card">';
    
          echo "<img src=".$image_path."/".$image_name." height=200 width=100%><br>";
          
          echo '<div class="container" >';
                 
                  echo ' <p>';
                  echo $item_title; 
                  echo '</p>';
                  echo ' <p style="float: bottom">';
                  echo "Price:-".$price;
                  echo '</p>';
          echo "</div>";
         
                 
         
        ?>
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="item_id" value="<?php print $item_id; ?>"/> 
        <input type="submit" name="item_permission" value="Give Permission" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white; margin-left:50px"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>"; 
       

    }  
    echo "</div>";
		}


	public function profitPerItem()
	{
		$query = "SELECT item_ID, price, sold_value FROM item NATURAL JOIN bid_end where item.sold='1'";
		$result = mysqli_query($this->db,$query);
		
		return $result;

	}


	public function profitPerUser()
	{
		$query = "SELECT item_ID, SUM(price) as base, SUM(sold_value) as total,user_ID FROM item NATURAL JOIN bid_end where item.sold='1' GROUP BY user_ID";
		$result = mysqli_query($this->db,$query);
		return $result;

	}

	public function totalSell()
	{
		$query = "SELECT * FROM bid_end";
		$result = mysqli_query($this->db,$query);
		return $result;
	}


	public function itemsLeft()
	{
		$query = "SELECT * FROM item WHERE sold = 0";
		$result = mysqli_query($this->db,$query);
		return $result;
	}

	public function getNotification($id)
	{
		$query = "SELECT * FROM bid_notify WHERE user_ID= '$id' and seen=0";
		$result = mysqli_query($this->db,$query);
		return $result;
	}

	public function stopBid()
	{

			$query1 = "SELECT * FROM item natural join item_detail WHERE item.stop_bid= 0";
			
			
    $result1 = mysqli_query($this->db,$query1);

    while ($row1 = mysqli_fetch_array($result1)) { 
            $item_id = $row1['item_ID'];
            $category = $row1['category'];
            $price = $row1['price'];
            $item_desc = $row1['item_desc'];
            $item_title = $row1['item_title'];

          
   // $funObj = new dbFunction($conn);
  
  
    $image_name= $row1["item_image"];      $image_path="images";
        

            //echo "<div style='border: ridge;padding: 20;height=500px'>";
             echo "<div class='container'>";
             echo '<div class="col-md-3">';
    
            echo '<div class="card">';
    
          echo "<img src=".$image_path."/".$image_name." height=200 width=100%><br>";
          
          echo '<div class="container" >';
                 
                  echo ' <p>';
                  echo $item_title; 
                  echo '</p>';
                  echo ' <p style="float: bottom">';
                  echo "Price:-".$price;
                  echo '</p>';
          echo "</div>";
         
                 
         
        ?>
        
        <form id="delete" method="post" action="">
        <input type="hidden" name="item_id" value="<?php print $item_id; ?>"/> 
        <input type="submit" name="stop_item_bid" value="Stop Bid" style="background-color:#4a245e; height: 30px;width: 150px;border: solid; border-color:#4a245e;color: white; margin-left:50px"/>    

        </form>
        <?php
        echo "</div>";
        echo "</div>"; 
       

    }  
    echo "</div>";
		
	}
		

*/
	}

		
?>
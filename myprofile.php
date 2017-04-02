<?php include 'header.php'; ?>

<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_SESSION['username'])){
		
		
		include_once 'dbConnect.php';

		$funobj = new dbFunction($conn);

		$data = $funobj->getUserDetail($_SESSION['user_ID']);
		//print_r($data);


    }else {
    	echo "Login";
    	header("Location: index.php");
    	
    }

?>

<?php if(count($data) > 0): ?>
	<div class="container" style="background-color: #112255">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12" style="padding: 10px; background-color: #774488">
				<img class="img-responsive" src="images/profile/mohit.jpg">
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12" style="padding: 10px">
				<div class="card" style="background-color: yellow">
				  <ul class="list-group list-group-flush">
				    <li class="list-group-item">Name: <?php echo $data['username'];?></li>
				    <li class="list-group-item">Email: <?php echo $data['email'];?></li>
				    <li class="list-group-item">Mobile Number: <?php echo $data['contact'];?></li>
				  </ul>
				</div>
				
			</div>
		</div>
	</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
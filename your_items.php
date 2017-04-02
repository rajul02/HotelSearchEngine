<?php include 'header.php'; ?>


<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_SESSION['username'])){
    	
    	

		$funobj = new dbFunction($conn);

		$data = $funobj->getSellingItemById($_SESSION['user_ID']);
		//print_r($data);
		if(count($data) == 0){
			$data = [];
		}

    }else {

    	header("Location: index.php");
    }

    if(isset($_POST['remove_product'])) {
    	if($funobj->removeProduct($_POST['remove_product'])) {
    		header("Location: your_items.php");
    		die();
    	}else {
    		echo "Delete Failed";
    	}
    }

    if(isset($_POST['stopbid']))
    {

    	if($funobj->stopBidding($_POST['stopbid']))
    	{

    	}
    }
?>
 <link rel="stylesheet" href="style.css">
<div class="container">
	
	<?php foreach($data as $item): ?>
		
		<div class="col-md-3 col-sm-4 col-xs-6" style="padding: 5px;margin: 5px;height: 360px;width: 250px">

			<div class="card">
				<div class="rating" align="right" style="margin: 5px">
				<!--<form action="" method="post">
					 <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?>><i class="glyphicon glyphicon-remove"></i></button> 
				</form> -->
					<button type="button" class="btn btn-primary" style="background-color: green;" data-toggle="modal" data-target=".stop-<?php echo $item['item_ID']; ?>"><i class="glyphicon glyphicon-exclamation-sign"></i></button>
					<button type="button" class="btn btn-primary" style="background-color: red; data-toggle="modal" data-target=".bs-<?php echo $item['item_ID']; ?>"><i class="glyphicon glyphicon-remove"></i></button>
				</div>
					<img class="img-responsive" style="height: 220px" src="uploads/<?php echo $item['item_image']; ?>.jpg">
					<div class="container">

						<h5><b><?php echo $item['item_title'].'('.$item['item_ID'].')'; ?></b></h5> 
						<p>Starting Price: ₹<?php echo $item['price'];?>
						</p>
						<p>Quantity: <?php echo $item['quantity']; ?></p>
					</div>
			</div>
					
		</div>

			<div class="modal fade bs-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to remove Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Delete</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>



			<div class="modal fade stop-<?php echo $item['item_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			  <div class="modal-dialog modal-sm" role="document">
			    <div class="modal-content">
			    	<div class="modal-body">
			    		<p>Are You Sure you want to stop bidding for Product: <?php echo $item['item_title']; ?></p>
			      	</div>
			      	<form action="" method="post">
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        
			        <button type="submit" name="stopbid" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Stop Bid</button>
			       
			      </div>
			       </form>
			    </div>
			  </div>
			</div>
	<?php endforeach; ?>
</div>

		
	
	


<?php include 'footer.php'; ?>

<?php 
  include 'dbFunction.php';
  include_once 'dbConnect.php';
  $funObj = new dbFunction($conn);
  
    if(isset($_POST['new_items']))
    {
      $data = $funObj->getProductForPermission();
    }
    else {
      $data = [];
    }

    if(isset($_POST['permit_product'])) {

      if($funObj->permissionProduct($_POST['permit_product'])) {
         
         header("Location: admin.php?r=new_items");
          //$data = $funObj->getProductForPermission();
          // print_r($data);
        
      }else {
        echo "Delete Failed";
      }
    }



    if(isset($_POST['profit']))
    {
        $profitItemList = $funObj->profitPerItem();
    }
    else
    {
      $profitItemList = [];
    }



     if(isset($_POST['profit1']))
    {
        $profitUserList = $funObj->profitPerUser();
    }
    else
    {
      $profitUserList = [];
    }


    if(isset($_POST['total_sell']))
    {
      $totalsell = $funObj->totalSell();
    }
    else
    {
      $totalsell= [];
    }

    if(isset($_POST['items_left']))
    {
      $itemleft = $funObj->itemsLeft();
    }
    else
    {
      $itemleft = [];
    }


     if(isset($_POST['stopbid']))
    {
      $funObj->stopBid();
    }
     if(isset($_POST['stop_item_bid']))
     {
       $id = $_POST['item_id']; 
      
       $query = "UPDATE item SET permission = 0  WHERE item_id = '$id'";
       $query1 = "UPDATE item SET stop_bid=1 WHERE item_id = '$id'";  
       $result = mysqli_query($conn,$query);
       $result1 = mysqli_query($conn,$query1);
       if(!$result || !$result1)
       {
        echo "failed";
       }
       $funObj->stopBid();
    }
    if(isset($_GET['r']))
  {
  	
  	$data = $funObj->getProductForPermission();

  }




?>



<!DOCTYPE>
<html>
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="style.css">


<style>
ul.sidebar-nav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 200px;
    background-color: #f1f1f1;
}

ul.sidebar-nav input  {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}



ul.sidebar-nav li input:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>


</head>

<body style="background: #2c3338;
  color: #606468;">
	<?php include 'header.php';?>

        <div class="container" id='rajul'>
  
  <?php foreach($data as $item): ?>
    
    <div class="col-md-3 col-sm-4 col-xs-6" style="padding: 5px;margin: 5px;height: 360px;width: 250px">

      <div class="card">
        <div class="rating" align="right" style="margin: 5px">
        <!--<form action="" method="post">
           <button type="submit" name="remove_product" value=<?php echo $item['item_ID'];?>><i class="glyphicon glyphicon-remove"></i></button> 
        </form> -->
          <button type="button" class="btn btn-primary" style="background-color:green" data-toggle="modal" data-target=".bs-<?php echo $item['item_ID']; ?>"><i class="glyphicon glyphicon-right"></i></button>
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
              <p>Are You Sure you want to give permission to the Product: <?php echo $item['item_title']; ?></p>
              </div>
              <form action="" method="post">
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
              <button type="submit" name="permit_product" value=<?php echo $item['item_ID'];?> class="btn btn-primary">Permit</button>
             
            </div>
             </form>
          </div>
        </div>
      </div>
  <?php endforeach; ?>
  <?php $count = 1?>
    <table class="table" style="width:100%; border:solid ">
   <?php foreach($profitItemList as $item): ?>
       
  <?php if ($count== 1): ?>
   <thead>
      <tr>
        <th>Item ID</th>
        <th>Base Price</th>
        <th>Sold Value</th>
        <th>Profit</th>
      </tr>
    </thead>
    <?php $count=100; endif;?> 
    
    <tbody>
      <tr>
        <td><?php echo $item['item_ID']; ?></td>
        <td><?php echo $item['price']; ?></td>
        <td><?php echo $item['sold_value']; ?></td>
        <td><?php echo $item['sold_value']-$item['price']; ?></td>
      </tr>
    </tbody>


    <?php endforeach; ?>
     </table>

<?php $count = 1?>
        <table class="table" style="width:100%; border:solid ">
   <?php foreach($profitUserList as $item): ?>
       
  <?php if ($count== 1): ?>
   <thead>
      <tr>
        <th>User ID</th>
        <th>Base Price</th>
        <th>Total</th>
        <th>Profit</th>
      </tr>
    </thead>
   <?php $count=100; endif;?> 
    <tbody>
      <tr>
        <td><?php echo $item['user_ID']; ?></td>
        <td><?php echo $item['base']; ?></td>
        <td><?php echo $item['total']; ?></td>
        <td><?php echo $item['total']-$item['base']; ?></td>
      </tr>
    </tbody>


    <?php endforeach; ?>
     </table>

     <?php $count = 1?>
        <table class="table" style="width:100%; border:solid ">
   <?php foreach($totalsell as $item): ?>
       
  <?php if ($count== 1): ?>
   <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Item ID</th>
        <th>Bid Value</th>
        <th>End Date</th>
      </tr>
    </thead>
   <?php  endif;?> 
    <tbody>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $item['item_ID']; ?></td>
        <td><?php echo $item['sold_value']; ?></td>
        <td><?php echo $item['sold_date']; ?></td>
      </tr>
    </tbody>
    <?php $count++;?>

    <?php endforeach; ?>
     </table>

     <?php $count = 1?>
        <table class="table" style="width:100%; border:solid ">
   <?php foreach($itemleft as $item): ?>
       
  <?php if ($count== 1): ?>
   <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Item ID</th>
        <th>Start Date</th>
        
      </tr>
    </thead>
   <?php  endif;?> 
    <tbody>
      <tr>
        <td><?php echo $count; ?></td>
        <td><?php echo $item['item_ID']; ?></td>
        <td><?php echo $item['date']; ?></td>
   
      </tr>
    </tbody>
    <?php $count++;?>

    <?php endforeach; ?>
     </table>



</div>






 <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
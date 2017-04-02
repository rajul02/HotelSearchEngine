<?php include 'header.php';?>

<?php

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

include_once 'dbConnect.php';

  if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $file = $_FILES['file'];
    $cat = $_POST['category'];
    $price = $_POST['min_price'];
    $quantity = $_POST['quantity'];
    $targetDir = "uploads/";
    $targetFile = $targetDir.basename($title.".jpg");

    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)){
     // echo "File uploaded Successfully";
      $funobj = new dbFunction($conn);

      $data['item_title'] = $title;
      $data['item_desc'] = $desc;
      $data['item_image'] = $title;
      $data['user_id'] = $_SESSION['user_ID'];
      $data['category'] = $cat;
      $data['price'] = $price;
      $data['quantity'] = $quantity;


      if($funobj->addsellingitem($data)) {
        echo "File Uploaded";
        header("Location: your_items.php");
        die();
      }else {
        echo "Some Error";
      }

    }else {
      echo "File Not Uploaded<br>";
    }

    //echo $title."<br>".$desc;
  }

?>

<div class="container">
  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="title"  placeholder="Title" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Category</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="category"  placeholder="Category" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Description</label>
      <div class="col-sm-10">
        <textarea rows="6" class="form-control" name="desc"  placeholder="Description" ></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Minimum Price ₹:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="min_price"  placeholder="Minimum Price" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Quantity</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="quantity"  placeholder="Quantity" >
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label" for="exampleInputFile">File input</label>
        <div class="col-sm-10">
          <input type="file" name="file" id="exampleInputFile" >
        </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" value="submit" class="btn btn-default">Upload Product</button>
      </div>
    </div>
  </form>
</div>
  
<?php include 'footer.php'; ?>


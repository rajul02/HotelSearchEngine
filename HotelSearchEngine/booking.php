<?php include "header.php"; ?>
<?php 
$hid=$_POST['hid'];
?>
<?php
 if(!isset($_SESSION['userId'])){
	echo "<script>
alert('Login First');
window.location.href='login.php';
</script>";

}


?>
   <div id="login" ng-app="myApp" ><center>
   <h2 style=" color: Black; font-family: arial"><center>Book</center></h2>
      <form name="myForm" ng-controller="myCtrl" method="post" action="book_confirm.php">
      <input type='hidden' name='hid' value='<?php echo $hid; ?>'>
          <p>Start Date: <input type="date"  name= "start_date"  required="required" ></p>
          <p>End Date: <input type="date"  name= "end_date"   required="required" ></p>

          <input type="submit"  value="Book" name="book">
         
        <br>

        <br>


</form>

</center>
</div>
  



<?php include "footer.php"; ?>
<?php
	include_once 'dbConnect.php';
	include_once 'dbFunction.php';
if(isset($_POST['book'])){
$st_date=$_POST['start_date'];
	$ed_date=$_POST['end_date'];
	$hid=$_POST['hid'];
	echo $st_date;
	echo $ed_date;
	echo "<br>";
	echo $hid;
	$today=date("Y-m-d");
	if($st_date>$ed_date || $st_date<$today || $ed_date<$today){
		echo "<script>
alert('invalid_date');
window.location.href='index.php';
</script>";

	}
	else {
	$funObj = new dbFunction($conn);

    $book = $funObj->book($_SESSION['userId'],$hid,$st_date,$ed_date);
    if($book){
    	echo "<script>
alert('successfully booked');
window.location.href='index.php';
</script>";

    }
    else{
    	echo "<script>
alert('Error in Booking');
window.location.href='index.php';
</script>";

    }
	}



}


?>
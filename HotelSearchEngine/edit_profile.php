<?php
        session_start(); 
         include 'dbFunction.php';
  include_once 'dbConnect.php';


      if(isset($_POST['Save'])){
        $name=$_POST['userName'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $location=$_POST['location'];
        $id=$_SESSION['userId'];
            $funObj = new dbFunction($conn);

       $user = $funObj->UpdateUser($id,$name,$email,$phone,$location);
       if($user===True){
         echo "<script>
alert('Changes Saved');
</script>";
                      window.location.href = 'userProfile.php';



       }
       else{
        echo $funObj->db->error;
         //echo "<script>
//alert('Error in saving changes');
//</script>";

       }
     }
       ?>
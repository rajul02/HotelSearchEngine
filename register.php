<?php 

 include 'dbFunction.php';
  include_once 'dbConnect.php';


  $funObj = new dbFunction($conn);

  if(isset($_POST['register']))
  {

    $username = $_POST['username'];

    $password =md5($_POST['password']);

    $email = $_POST['email'];

    $contact = $_POST['contact'];
    $user = $funObj->Register($username,$password,$email,$contact);
    
  }

  if(isset($_POST['login11']))
  {
    echo "kdfjlkl";
    header("Location: login.php");
  }

?>





<html>
<head>
  <meta charset="utf-8">
    <title>SellNBuy</title>
    
    <link rel="stylesheet" href="style.css">

    <script type="text/javascript">
         <!--
          function validate()
           {
      
             if( document.register.username.value == "" )
             {
              alert( "Please provide your username!" );
              document.register.username.focus() ;
              return false;
             }

             if(document.register.username.value.length <=4)
             {
              alert("Username is too short. Enter at least 4 characters");
              document.register.username.focus() ;
              return false;
             }

             if(document.register.password.value.length <=4)
             {
              alert("Password is too short. Enter at least 4 characters");
              document.register.password.focus() ;
              return false;
             }

             if((document.register.password.value)!=(document.register.rpassword.value))
             {
              alert("Password does not match");
              document.register.password.focus();
              return false;
             }

             if(document.register.email.value)
             {
                 var x = document.register.email.value;
                 var atpos = x.indexOf("@");
                 var dotpos = x.lastIndexOf(".");
                 if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
                 alert("Not a valid e-mail address");
                 document.register.email.focus();
                 return false;
                   }
             }

             if(document.register.contact.value)
             {
                 var phoneno = /^\d{10}$/;  
                 if(document.register.contact.value.match(phoneno))  
                {  
                  return true;  
                }  
                 else  
                {  
                   alert("Not a valid Phone Number"); 
                   document.register.contact.focus(); 
                   return false;  
                }  
             }


           }
         //-->
    </script>


</head>
<?php  include 'header.php';?>
<div style="">
   <div id="login" style="">
   <h1 style=" color: White ; font-family: sans-sherif"><center>Sell N Buy</center></h1>
   <h2 style=" color: White; font-family: arial"><center>Register</center></h2>
      <form name='register' method="post"  onsubmit="return(validate())" action="">

       
          <input type="text" id="user" name= "username"  placeholder="Username" required="required">
       
       
          <input type="password" id="pass" name="password"  placeholder="Password" required="required">

       
          <input type="password" id="pass" name="rpassword"  placeholder=" Renter Password" required="required">

       
          <input type="text" id="contact" name="contact"  placeholder="1234567890" required="required">

       
          <input type="text" id="email" name="email"  placeholder="abc@xyz.com" required="required">
        
        
         <input type="submit" value="Register" name="register">
      </form>
       <br><br>
      <form method="post" action="">
        <input type="submit" value="Login" name="login11">
      </form>
    </div>
    </div>
</body>
   
</html>
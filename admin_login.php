<html>
  <head>
     <title>Admin Login </title>
	 <style>
	     .log form{
			 position: absolute;
			 left: 400px;
			 top:150px;
			 border-radius:4px;
			 border:2px solid sienna;
			 padding:20px;
			box-shadow: -2px 2px 8px 0px snow;
			background:#cecece;
		 }

		 .user{
    font-size: 20px;
    padding: 20px;
    font-family: -webkit-pictograph;
    color: sienna;
		 }
		 .admin_pass{              
    font-size: 20px;
    padding: 20px;
    font-family: -webkit-pictograph;
    color: sienna;
		 }
		 #admin_login_email{
			    width: 300px;
                padding-left: 20px;
                height: 40px;
                border: 2px solid sienna;
		 }
		 #log_password{
			    width: 300px;
    padding-left: 20px;
    height: 40px;
    border: 2px solid sienna; 
		 }
		 #admin_log_btn{
			 position: relative;
    width: 400px;
    height: 40px;
    color: #080808;
    font-family: system-ui;
    font-size: 27px;
    box-shadow: inset -1px 1px 20px 6px sienna;
	border: 3px solid sienna;
		 }
		 #admin_login_email:hover, #log_password:hover{
			 box-shadow:-1px 10px 20px 6px sienna;
			 border:2px solid snow;
		 }
		 #admin_log_btn:hover{
			 border:2px snow;
		 }
		 #sign{
			     position: absolute;
    top: 480px;
    font-family: sans-serif;
    font-size: 20px;
    color: seagreen;
    left: 450px;
		 }
		 #sign a:hover{
			 background:red;
		 }
		 .m{
			position: fixed;
            left: 440px;
            top: 160px;
            font-size: 20px;
            color: orangered;
            font-weight: bold;
		 }
		 #img{
			 position: absolute;
			 
		 }
		 
		 
		 </style>
   </head>
   <body>
      <?php require("heading.php");?>
	           <span id="img"><img src="login.jpg" width="250" height="150px" /></span>
      <div class="log"> 
	     <form method="post" action="">
	         <div class="user">
	             Email/Username <br>
				 <input type="text" name="log_email" id="admin_login_email"placeholder="Enter email-id">
		      </div>
		     <div class="admin_pass">
		         Password<br>
				 <input type="password" id="log_password" name="password" placeholder="Enter password">
		     </div>
		     <div class="admin_log_btn">
		        <input type="submit" name="login" value="login" id="admin_log_btn">
		     </div>
	     </form>
	  </div>
	  <b id="sign">If you want to SignUp then  <a href="admin_signup.php">click here.</a> </b>
	 </body>

<?php
if(isset($_POST["login"]))
{
  $user=$_POST["log_email"];
  $p=$_POST["password"];
  
  $conn=mysqli_connect("localhost","root","","grocery");
  if(!$conn)
	   echo "Database error",mysqli_error($conn);
   mysqli_select_db($conn,"grocery");
   $sql=mysqli_query($conn,"Select * from admin_signup where admin_email='".$user."' AND admin_password='".$p."'");
   $r=mysqli_num_rows($sql);
   if(($r>0)&&($r<2))
   {
	   while($rows=mysqli_fetch_array($sql))
	   {
		   $signeduser=$rows["admin_email"];
		   $signedpassword=$rows["admin_password"];
		}
      if(!($user==$signeduser)&&($p==$signedpassword)) 
      {   
         $msg="Your email or password is invalid!"; 
	      
      }
      else{
	    header("Location:adminaccess.php");
      }
   }
  else{
	 $msg="Please enter valid credential to validate!";
  }   
}
?>
<div class="m"> <?php if(isset($msg)) echo"$msg";?></div>
</html>
	  
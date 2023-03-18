<html>
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
     <title>sign Up </title>
	 <style>
	   body
	  {
		  background: #FFF5EE;
		  font-size: 20px;
		  font-weight: bold;
		  color: blue;
	  }
	  .Register
	  {
          position: absolute;
          top: 100px;
		  left: 250px;
          background: snow;
		  box-shadow: 2px 3px 7px 2px red;
		
	  }
	  #fname
	  {
		      height: 40px;
              width: 400px;
              padding: 20px;
              margin-left:80px;
              border: 2px solid #8d948a;
		  
	  }
	  #cpassword{
		      height: 40px;
              width: 300px;
              padding: 20px;
              margin: 20px;
              border: 2px solid #8d948a;
	  }
	  #fname:hover, #email:hover, #password:hover, #cpassword:hover, #mobile:hover{
		  border: 2px solid blue;
	  }
	  .name{
        padding:20px; 
	  }
	.email
	{
        padding: 20px;
	 }
	 
	#email
	{
             width: 300px;
             height: 50px;
             border: 2px solid #8d948a;
			  padding:20px;
			  margin-left:135px;
		  }
		  .password{
	
             padding:20px;
		  }
		  #password{
		     width: 300px;
             height: 50px;
             border: 2px solid #8d948a;
			 margin-left:100px;
			 padding:20px;
		  }
		  .login_btn{
			  padding: 20px;
			}
	     #btn{
           border: 2px solid white;
           background: red;
           color: white;
           font-size: 20px;
           font-weight: bold;
           width: 150px;
           height: 50px;
	       margin-left: 20px;
		 }
		 #btn:hover{
			 background: green;
			 color: red;
			 transition: 0.5s;
			 transform: translate(10px);
		 }
		 .tit{
			 position: fixed;
			top: auto;
            left: 500px;
			font-size: 25px;
			font-family: system-ui;
			font-weight: bold;
            box-shadow: inset -4px -1px 12px 8px red;
		 }
		form .name i{
			position: absolute;
			left: 500px;
			padding:20px;
		}
		form .email i{
			position: absolute;
			left: 460px;
			padding:20px;			
		}
		form .password i{
			position: absolute;
			left: 460px;
			padding:20px;			
		}
		form .confirmpassword i{
			position: absolute;
			left: 450px;
			padding:30px;			
		}
		#mobile{
			border: 2px solid #8d948a;
			width: 305px;
            position: absolute;
            left: 230px;
            height: 40px;
            padding: 20px;
		}
		.mobile{
			padding:20px;
		}
		
	</style>
   </head>
   <body>

        <div class="tit">
	 	   <form action="" method="POST">
		     <span >REGISTRATION</span>
		</div>
	    <div class="Register">
	         <form method="post" action="#" ">
			            <div class="name">
				              NAMES<input type="text" id="fname" placeholder="Enter First_name" name="name">
				      </div>
			            <div class="email">
				            <label for="email">E-MAIL </label><input type="email" id="email" placeholder="Enter E-mail" name="email">
				        </div>				   
		                <div class="password">
				            <label for="password">PASSWORD</label><input type="password" id="password" placeholder="Enter Passwordl" name="pass" >
                       </div>
			          <div class="confirmpassword">
				          <label for="password">CONFIRM PASSWORD<label><input type="password" id="cpassword" placeholder="Repeat Password" name="cpass">
				      </div>
					   <div class="mobile">
				          <label for="mobiler_number">MOBILE NUMBER<label><input type="number" id="mobile" placeholder="Enter mobile number" name="mobile">
                        </div>
                      <div class="login_btn">
				        <input type="submit" name="register" id="btn" value="REGISTER">
			         </div>
		       </form>
		</div>
<script>
   var name=
</script>
<?php
   $conn=mysqli_connect("localhost","root","","grocery");
   if(!$conn)
	   echo "Database error",mysqli_error($conn);
   mysqli_select_db($conn,"grocery");
   if(isset($_POST["create"]))
   {
	   $s=1;
	   $n=$_POST["fname"].$_POST["lname"];
	   $e= $_POST["sign_email"];
	   $m=$_POST["mobileno"];
	   $p=$_POST["password"];
	   $cp=$_POST["sign_confirmpassword"];
	   if($p!==$cp)
		   $msg="Passwords do not match!";
	   else
	   {
		  $sql="Insert into admin_signup(admin_name,admin_email,admin_password,admin_mobileno) values('$n','$e','$p','$m')";
	      $r=mysqli_query($conn,$sql);
		  if(!$r)
			  $msg="Error in inserting data!";
		  else{
			  $msg="Account created successfully!";
		  }
	   }
		   
   }	
   ?>
   <div class="msg">
      <?php if (isset($msg)) echo "$msg";
	  ?>
	</div>
  </body>
</html>
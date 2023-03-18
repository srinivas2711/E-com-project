<html>
   <head> 
   <title>Add categories </title>
   <style>
   .msg{
     color: red;
    position: absolute;
    top: 470px;
    left: 220px;
    font-size: 25px;
    font-family: emoji;
   }
      .box{
	 margin-top: 50px;
     margin-left: 200px;
     background: lightgoldenrodyellow;
     border: 5px solid whitesmoke;
     margin-right: 100px;
     font-family: system-ui;
     font-size: 30px;
     color: yellowgreen;  
   }
   .bb{
	   
   }
   #cat_id{
    width: 100%;
    height: 5%;
    border: 2px solid bisque;  
	padding: 20px;
	font-size: 15px
   }
      #cat_name{
	 width: 100%;
    height: 5%;
    border: 2px solid bisque;
	padding: 20px;
	font-size: 15px;
   }
   #cat_sta{
	width: 100%;
    height: 5%;
    border: 2px solid bisque;
	padding: 20px;
	font-size: 15px; 
   }
   #sbmt{
	 display: inline-block;
     width: 400px;
    height: 40px;
    background: darkgreen;
    border: 5px solid #ffffff;
    color: snow;
    font-family: cursive;
    font-size: 20px;
   }
   #bk{
	display: inline-block;
    width: 200px;
    height: 40px;
    background: darkgreen;
    border: 5px solid #ffffff;
    color: snow;
    font-family: cursive;
    font-size: 20px; 
   }
      	  .dash{
	 background: green;
    color: springgreen;
    text-align: center;
    margin-top: 20px;
    margin-left: 200px;
    margin-right: 200px;
    height: 60px;
    font-family: system-ui;
	  }
   </style>
   </head>
   <body>
            <div class="dash">
		   <h1> INSERTING CATEGORIES</h1>
         </div>
      <div class="box">
      <form method="POST" action="">
	        <div class="bb">
                CATEGORY ID     <input type="number" name="cat_id" id="cat_id" placeholder="Enter category id"> <br> <br>		   
                CATEGORY NAME   <input type="text" name="cat_name" id="cat_name" placeholder="Enter category name"> <br> <br>	
		        CATEGORY STATUS <input type="number" name="cat_sta" id="cat_sta" placeholder="Enter category status"> <br> <br>	
		         <input type="submit" value="INSERT CATEGORY" id="sbmt" name="submit"> <a href="categories.php?type=back"><button type="button" id="bk" name="bck">Back</button></a>
		    </div>
		</form>
	 </div>
<?php
  $msg="";
  $conn=mysqli_connect("localhost","root","","grocery");
  if(!$conn)
  {  $msg="Unable to connect with Servers. Try again later!!";
	 die();
  }
   if(isset($_POST["bck"]))
   {
      header("location:categories.php");
   }

   
   if(isset($_POST["submit"]))
   {
        $c=$_POST["cat_id"];
        $id=mysqli_query($conn,"Select * from categories where category_id ='".$c."'" );
        $chkid=mysqli_num_rows($id);
        if($chkid>=1)
	      $msg="CategoryId already exist!";
		$n=$_POST["cat_name"];
		$s=$_POST["cat_sta"];
		$str=trim($n);
		$chk=mysqli_query($conn,"select * from categories where category_name ='".$str."'");
		echo mysqli_error($conn);
		$r=mysqli_num_rows($chk);
		echo mysqli_error($conn);
		if(($r<=0) && ($msg==""))
		{
		   if(($c!=="")&&($n!=="")&&($s!==""))
	       {
		      $sql=mysqli_query($conn,"Insert into categories(category_id,category_name,category_status) values('".$c."','".$n."','".$s."')");
		      $msg="Category Inserted Successfully!";
		   }
	       else
			   $msg="To insert a new Category you need to enter all fields!";
		}
		else{
			$msg="Category already exist!";
		}
   }

 ?>
 <div class="msg">
     <?php if(isset($msg)) echo"$msg" ?>
</div>
</body>
</html>
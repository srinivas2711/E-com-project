<?php
  $conn=mysqli_connect("localhost","root","","grocery");
  if(!$conn)
	 die("unable to connect with servers");
   $i="";
   $j="";
	if(isset($_GET["id"]) && ($_GET["id"]!=" "))
    {
		$id=mysqli_real_escape_string($conn,$_GET["id"]);
	    $sql=mysqli_query($conn,"Select category_id,category_name from categories  where category_id = $id");
		if(mysqli_num_rows($sql)==1)
	    {
		   while($cat=mysqli_fetch_assoc($sql))
	       {
			  $i= $cat["category_id"];
			  $j= $cat["category_name"];
		   }
		   echo mysqli_error($conn);
		}
		else{
			$msg="Two or More categories has same name";
		}
	}

?>
<html>
   <head> 
   <title>Edit Categories </title>
   <style>
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
   .msg{
	 color: red;
    position: absolute;
    top: 350px;
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
   #cat_id:hover,#cat_name:hover{
	   
   }
   
   </style>
   </head>
   <body>	  
         <div class="dash">
		   <h1> EDITING CATEGORIES</h1>
         </div>
	   <div class="box">
           <form method="POST" action=" ">
		      <div class="bb">
	               CATEGORY ID <br>    <input type="number" name="cat_id" id="cat_id" placeholder="Enter category id" value="<?php echo $i?>"> <br> <br>		   
                   CATEGORY NAME  <br> <input type="text" name="cat_name" id="cat_name" placeholder="Enter category name" value="<?php echo $j?>"> <br> <br>	
		          <input type="submit" value="EDIT CATEGORY" id="sbmt" name="submit"> <a href="categories.php?type=back"><button type="button" id="bk"name="bck">Back</button></a>
		      </div>
		 </form>
		</div>
	</body>
	</html>
<?php
	if(isset($_POST["submit"]))
	{
		$a=$_POST["cat_id"];  
        $b=$_POST["cat_name"];
		$str=trim($b);
		$chk=mysqli_query($conn,"select * from categories where category_name ='".$str."'");
		$r=mysqli_num_rows($chk);
		if($r<1)
		{
			$s=mysqli_query($conn,"update categories set category_id ='".$a."',category_name='".$b."' where category_id = $id");
		    $msg="Category Edited Successfully!";
	    }
		else{
			$msg="Can't Edit Entered Category Already Exist!"; 
		}
		
        echo mysqli_error($conn); 			
	}
?>
<div class="msg">
     <?php if(isset($msg)) echo"$msg" ?>
</div>
</body>
</html>
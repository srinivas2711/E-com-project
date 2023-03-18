<?php
  $conn=mysqli_connect("localhost","root","","grocery");
  if(!$conn)
	 die("unable to connect with servers");
   $i="";
   $j="";
   $k="";
   $l="";
   $m="";
   $n="";
   $img="";
   
	if(isset($_GET["id"]) && ($_GET["id"]!=" "))
    {
		$id=mysqli_real_escape_string($conn,$_GET["id"]);
	    $sql=mysqli_query($conn,"Select * from product  where product_id = $id");
		if(mysqli_num_rows($sql)==1)
	    {
		   while($cat=mysqli_fetch_assoc($sql))
	       {
			  $i= $cat["product_id"];
			  $j= $cat["category_id"];
			  $k= $cat["product_name"];
			  $l= $cat["product_description"];
			  $m= $cat["product_quantity"];
			  $n= $cat["product_price"];
			  $img=$cat["product_image"];
			  echo mysqli_error($conn);
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
  .msg{
     color: red;
    position: absolute;
    top: 100px;
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
   #pro_id{
    width: 100%;
    height: 5%;
    border: 2px solid bisque;  
	padding: 20px;
	font-size: 15px
   }
   #c_id{
	width: 100%;
    height: 5%;
    border: 2px solid bisque;
	padding: 20px;
	font-size: 15px; 	   
   }
   #pdesc{
	width: 100%;
    height: 5%;
    border: 2px solid bisque;
	padding: 20px;
	font-size: 15px;   
   }
      #pro_name{
	 width: 100%;
    height: 5%;
    border: 2px solid bisque;
	padding: 20px;
	font-size: 15px;
   }
   #pro_qty{
	width: 100%;
    height: 5%;
    border: 2px solid bisque;
	padding: 20px;
	font-size: 15px; 	   
   }
   #pro_price{
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
      textarea{
          resize:none;
      }
   
   </style>
   </head>
   <body>	  
         <div class="dash">
		   <h1> EDITING CATEGORIES</h1>
         </div>
	   <div class="box">
           <form method="POST" action=" " enctype="multipart/form-data">
		      <div class="bb">
                ID     <input type="number" name="pro_id" id="pro_id" placeholder="Edit product id" value="<?php echo $i?>"> <br> <br>	
             CATEGORY ID <input type="number" name="C_id" id="c_id" placeholder="Edit product's category id"value="<?php echo $j?>"> <br> <br>     				
                NAME   <input type="text" name="pro_name" id="pro_name" placeholder="Edit product name"value="<?php echo $k?>"> <br> <br>	
		        DESCRIPTION <textarea name="desc" id="pdesc" placeholder="Edit product Description here..."value="<?php echo $l?>"> </textarea><br> <br>	
				QUANTITY <input type="number" name="pro_qty" id="pro_id" placeholder="Edit product quantity"value="<?php echo $m?>"> <br> <br>
				PRICE   <input type="number" name="pro_price" id="pro_id" placeholder="Edit product price"value="<?php echo $n?>"><br> <br>	
				IMAGE   <input type="file" name="image" id="image"value="<?php echo $img; ?>"><br><br>
		          <input type="submit" value="EDIT CATEGORY" id="sbmt" name="submit"> <a href="products.php?type=back"><button type="button" id="bk"name="bck">Back</button></a>
		      </div>
		 </form>
		</div>
	</body>
	</html>
<?php
	if(isset($_POST["submit"]))
	{
		$target_dir="uploads/";
	    $uok=0;
	    $target_file=$target_dir.basename($_FILES["image"]["name"]);
        $filetype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $image=$_FILES["image"]["name"];
        $isize=getimagesize($_FILES["image"]["tmp_name"]);
		if(($isize !== false) &&($filetype =="jpg" or "png")&&(move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)))
			$uok=1;
		$c=$_POST["pro_id"];
		$n=$_POST["pro_name"];
		$d=$_POST["desc"];
		$s=trim($d);
		$cid=$_POST["C_id"];
		$q=$_POST["pro_qty"];
		$p=$_POST["pro_price"];
		$str=trim($n);
		$chk=mysqli_query($conn,"select * from product where product_name ='".$str."'");
		$r=mysqli_num_rows($chk);
		if(($r<2)||($uok==1))
		{
			$s=mysqli_query($conn,"update product set product_id ='".$c."',categories_id ='".$cid."',product_name='".$n."',product_description ='".$d."',
            product_quantity ='".$q."',product_price ='".$p."',product_image='".$image."' where product_id = $id");
		    $msg="Product Edited Successfully!";
	    }
		else{
			$msg="Can't Edit Entered Product Already Exist!"; 
		}
		
        echo mysqli_error($conn); 			
	}
?>
<div class="msg">
     <?php if(isset($msg)) echo"$msg" ?>
</div>
</body>
</html>
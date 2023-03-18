 <html>
   <head> 
   <title>Add Products </title>
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
	  #pdesc{
		  overflow: hidden;
		  resize: none;
	  }

   </style>
   </head>
   <body>
            <div class="dash">
		   <h1> INSERTING PRODUCTS</h1>
         </div>
      <div class="box">
      <form method="POST" action="" enctype= "multipart/form-data">
	        <div class="bb">
                ID     <input type="number" name="pro_id" id="pro_id" placeholder="Enter product id"> <br> <br>	
             CATEGORY ID <input type="number" name="C_id" id="c_id" placeholder="Enter product's category id"> <br> <br>     				
                NAME   <input type="text" name="pro_name" id="pro_name" placeholder="Enter product name"> <br> <br>	
		        DESCRIPTION <textarea name="desc" id="pdesc" placeholder="Enter product Description here..." rows="40" cols="10"> </textarea><br> <br>	
				QUANTITY <input type="number" name="pro_qty" id="pro_qty" placeholder="Enter product quantity"> <br> <br>
				PRICE   <input type="number" name="pro_price" id="pro_price" placeholder="Enter product price"><br> <br>
			    INSERT IMAGE <input type="file" name="image" id="image" value="Select image"><br> <br>
		         <input type="submit" value="INSERT PRODUCT" id="sbmt" name="submit"> <a href="products.php?type=back"><button type="button" id="bk" name="bck">Back</button></a>
		    </div>
		</form>
	 </div>
<?php
  $conn=mysqli_connect("localhost","root","","grocery");
  if(!$conn)
  {  $msg="Unable to connect with Servers. Try again later!!";
	 die();
  }
   $target_dir="uploads/";
   $msg="";
   if(isset($_POST["bck"]))
   {
      header("location:products.php");
   }
   if(isset($_POST["submit"]))
   {
	    $uok=0;
	    $target_file=$target_dir.basename($_FILES["image"]["name"]);
        $filetype=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $image=$_FILES["image"]["name"];
        $isize=getimagesize($_FILES["image"]["tmp_name"]);
		if(($isize !== false) &&($filetype =="jpg" or "png")&&(move_uploaded_file($_FILES["image"]["tmp_name"],$target_file)))
			$uok=1;
	    $c=$_POST["pro_id"];
        $id=mysqli_query($conn,"Select * from product where product_id ='".$c."'" );
        $chkid=mysqli_num_rows($id);
        if($chkid>=1)
	      $msg="ProductId already exist!";
		$n=$_POST["pro_name"];
		$d=$_POST["desc"];
		$s=trim($d);
		$cid=$_POST["C_id"];
		$q=$_POST["pro_qty"];
		$p=$_POST["pro_price"];
		$str=trim($n);
		$chk=mysqli_query($conn,"select * from product where product_name ='".$str."'");
		$r=mysqli_num_rows($chk);
		if(($r<=0) && ($msg==""))
		{
		   if(($c!=="")&&($n!=="")&&($d!=="")&& ($cid!=="")&&($q!=="")&&($p!=="") && ($uok==1))
	       {
			         echo mysqli_error($conn);	
		      $sql=mysqli_query($conn,"Insert into product(product_id,categories_id,product_name,product_description,product_quantity,product_image,product_price) values('".$c."','".$cid."','".$n."','".$s."','".$q."','".$image."','".$p."')");
              echo mysqli_error($conn);		     
			 $msg="Product Inserted Successfully!";
		   }
	       else
			   $msg="To Add a new Product you need to enter all fields!";
		}
		else{
			$msg="Product already exist!";
		}
   }

 ?>
 <div class="msg">
     <?php if(isset($msg)) echo"$msg" ?>
</div>
</body>
</html>
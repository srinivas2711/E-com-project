<?php
   $conn=mysqli_connect("localhost","root","","grocery");
   if(!$conn)
	   die("unable to connect with servers");
   if(isset($_GET["type"]) && ($_GET["type"]!=" "))
   {
	   $type=mysqli_real_escape_string($conn,$_GET["type"]);
       if($type=="status")
       {
		    $operation=mysqli_real_escape_string($conn,$_GET['operation']);
		    $id= mysqli_real_escape_string($conn,$_GET['id']);
		    if($operation=="active")
		       $status=1;
	        else
		       $status=0;
	       $update=mysqli_query($conn,"update product set product_status='$status' where product_id = '$id'");
	   }
   }
   if(isset($_GET["type"]) && ($_GET["type"]!=" "))
    {
		$type=mysqli_real_escape_string($conn,$_GET["type"]);
	    if($type=="delete")
        {
		    $operation=mysqli_real_escape_string($conn,$_GET['operation']);
		    $id= mysqli_real_escape_string($conn,$_GET['id']);
			if($operation=="del")
				$del=mysqli_query($conn,"Delete from product where product_id = '$id'");
	    }
	}
	if(isset($_GET["id"]) && ($_GET["id"]!=" "))
    {
		$id=mysqli_real_escape_string($conn,$_GET["id"]);
	    $sql=mysqli_query($conn,"Select category_name from categories  where category_id = $id");
		$cat=mysqli_fetch_assoc($sql);

	}
   $sql=mysqli_query($conn,"Select P.*,C.category_name from product P,categories C where P.category_id = C.category_id order by P.product_id");
   echo mysqli_error($conn);
 

	   
 ?>
 <html>

   <head>
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> Dashboard </title>
      <style>
	  .dash{
	     background: green;
         color: springgreen;
         text-align: center;
         margin-top: 20px;
         margin-left: auto;
         height: 60px;
         font-family: system-ui;
         width: auto;
	  }
	  table{
		  border-collapse: collapse;
		  border: 3px solid ghostwhite;
		  background:snow;
	  }
	  td{
		  text-align:center;
		  vertical-align: center;
	  }
	  .tab{
		  width: auto;
		  height: auto;
		  margin-top: 30px;
		  border-radius: 3px solid ghostwhite;
		  background: grey;
	  }
	  .btns{
		  border-radius: 5px;
		  background: yellow;
		  
	  }
	  .btns:hover{
		  background:#FFFF99;
		  border-color:blue;
	  }
	  td a{
		  text-decoration: none;
		  font-family: 'Lakki Reddy', cursive;
		  color:#ff6600;
		  font-size: 20px;
	  }
	  .btn{
		  border-radius: 3px;
		  background: red;
	  }
	  .btn:hover{
		  background: #ffcccb;
	  }
	  .bt{
		  border-radius: 3px;
		  background: Blue;
	  }
	  .bt:hover{
		  background: lightblue;
	  }
	  .add{
		  margin-top: 20px;
		  border: 2px solid green;
		  background-color: darkgreen;
		  color:#ffffff;
		  font-family: 'Lakki Reddy', cursive;
		  font-size: 40px;
		  margin-left: 300px;
		  margin-right: 300px;
	  }
	  img{
		  width: 100px;
		  height: 100px;
	  }
	  tr:nth-child(even){
		  background:snow;
		  font-size:20px;
		  font-family:system-ui;
		  color:green;
	  }
	  	  tr:nth-child(odd){
		  background:green;
		  font-size:20px;
		  font-family:system-ui;
		  color:snow;
	  }

	  </style>
	</head>
	<body>
	       <div class="dash">
		       <h1> ADD / DELETE PRODUCTS</h1>
		   </div>
		   <div class="tab">
		      <table width="100%" cellspacing="0px" cellpadding="0px" border="2px solid grey" >
			     <tr>
				      <th> PRODUCT ID</th>
				      <th> CATEGORY</th>
				      <th> NAME</th>
					  <th> DESCRIPTION</th>
				      <th> QUANTITY</th>
				      <th> PRICE</th>
					  <th> IMAGE </th>
				
				</tr>
				<tr>
				      <?php while($r=mysqli_fetch_assoc($sql))
					  { ?>
                      <td><?php echo"$r[product_id]"?></td>
				      <td><?php echo"$r[category_name]"?> </td>
				      <td><?php echo"$r[product_name]"?></td>
					   <td><?php echo"$r[product_description]"?></td>
				      <td> <?php echo"$r[product_quantity]"?> </td>
					  <td><?php echo"$r[product_price]"?></td>
					  <td> <?php echo"<img src=uploads/$r[product_image] "?> </td>
				      <td> <div class="btns">
				     <?php
				           if($r['product_status']==1)
				               echo "<a href='?type=status&operation=Deactive&id=".$r['product_id']."'>ACTIVE</a>";
				           else
			                   echo"<a href='?type=status&operation=active&id=".$r['product_id']."'>DEACTIVE</a>";
					   ?>
					 </div>
					 </td>
				     <td> <div class="btn">
				          <?php
				              echo"<a href='?type=delete&operation=del&id=".$r['product_id']."'>DELETE</a>";
                           ?>
					     </div>
                     </td>
					 <td> <div class="bt">
				          <?php
				              echo"<a href='Edit_products.php?id=".$r['product_id']."'>EDIT</a>";
                           ?>
					     </div>
                     </td>
			   </tr>
					  <?php } ?>
					  <tr>
					     <td colspan="10"><div class="add">
                            <a href="Insert_products.php">ADD PRODUCTS </a>
		                 </div></td>
					  </tr>
             </table>
			</div>

	  </body>
</html> 		
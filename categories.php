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
	       $update=mysqli_query($conn,"update categories set category_status='$status' where category_id = '$id'");
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
				$del=mysqli_query($conn,"Delete from categories where category_id = '$id'");
	    }
	}
	if(isset($_GET["id"]) && ($_GET["id"]!=" "))
    {
		$id=mysqli_real_escape_string($conn,$_GET["id"]);
	    $sql=mysqli_query($conn,"Select category_name from categories  where category_id = $id");
		$cat=mysqli_fetch_assoc($sql);

	}
   $sql=mysqli_query($conn,"Select * from categories order by category_id");
 

	   
 ?>
 <html>
   <head>
   <link rel="preconnect" href="https://fonts.gstatic.com">
      <title> Dashboard </title>
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
		  width: 100%;
		  height: 100%;
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
		  border-radius: 5px;
		  background: red;
	  }
	  .btn:hover{
		  background: #ffcccb;
	  }
	  .bt{
		  border-radius: 5px;
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
	  tr:nth-child(even){
		  background:snow;
		   font-size: 20px;
		  font-family: system-ui;
          color: green;
	  }
	  tr:nth-child(odd){
		  background:green;
		  font-size: 20px;
		  font-family: system-ui;
          color: snow;
	  }

	  </style>
	</head>
	<body>
	       <div class="dash">
		       <h1> ADD / DELETE CATEGORIES</h1>
		   </div>
		   <div class="tab">
		      <table width="100%" cellspacing="20px" cellpadding="20px" border="2px solid grey" >
			     <tr>
				      <th> CATEGORY ID</th>
				      <th> CATEGORY NAME </th>
				      <th> CATEGORY STATUS </th>
				</tr>
				<tr>
				      <?php while($r=mysqli_fetch_assoc($sql))
					  { ?>
                      <td><?php echo"$r[category_id]"?></td>
				      <td> <?php echo"$r[category_name]"?> </td>
				      <td><?php echo"$r[category_status]"?></td>
				      <td> <div class="btns">
				     <?php
				           if($r['category_status']==1)
				               echo "<a href='?type=status&operation=Deactive&id=".$r['category_id']."'>ACTIVE</a>";
				           else
			                   echo"<a href='?type=status&operation=active&id=".$r['category_id']."'>DEACTIVE</a>";
					   ?>
					 </div>
					 </td>
				     <td> <div class="btn">
				          <?php
				              echo"<a href='?type=delete&operation=del&id=".$r['category_id']."'>DELETE</a>";
                           ?>
					     </div>
                     </td>
					 <td> <div class="bt">
				          <?php
				              echo"<a href='edit_categories.php?id=".$r['category_id']."'>EDIT</a>";
                           ?>
					     </div>
                     </td>
			   </tr>
					  <?php } ?>
					  <tr>
					     <td colspan="6"><div class="add">
                            <a href="Insert_categories.php">ADD CATEGORIES </a>
		                 </div></td>
					  </tr>
             </table>
			</div>

	  </body>
</html> 		
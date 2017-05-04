<!DOCTYPE html>
<?php
include("includes/db.php");
include("functions/functions.php");
?>
<html>
   <head>
    <title>My Online Shop</title>
	<link rel="stylesheet" href="styles/style.css  " media="all">
   </head>
<body>
<!--Main Container starts here-->
<div class="main_wrapper">
     
	 <!--Header starts here-->
     <div class="header_wrapper">
	    <img id="logo" src="images/2.jpg"/>
        <img id="banner" src="images/1.jpg"/>	     	
	</div>
	<!--Header ends here-->
	<!--Navbar starts here-->
		<div class="menubar">
		   <ul id="menu">
		       <li><a href="index.php">Home</a></li>
			   <li><a href="all_products.php">All Product</a></li>
			   <li><a href="customer/my_account.php">My Account</a></li>
			   <li><a href="customer_register.php">Sign Up</a></li>
			   <li><a href="cart.php">Shopping Cart</a></li>
			   <li><a href="#">Contact Us</a></li>
		   </ul>
		   <div id="form">
		       <form method="get" action="results.php" enctype="multipart/form-data">
			    <input type="text" name="user_query" placeholder="Search a Product"/>
				<input type="submit" name="search" value="Search"/>
		   
		       </form>
		   </div>
		</div>
	 <!--Navbar ends here-->
	 <!--Content wrapper starts here-->
	 <div class="content_wrapper">
	      <div id="sidebar">
		    <div id="sidebar_title">Categories</div>
		    <ul id="cats">
			<?php getCats(); ?> 
			</ul>
		  <div id="sidebar_title">Brands</div>
		    <ul id="brands">
			  <?php getBrands(); ?>
			</ul>
		  </div>
	      <div id="content_area">
		      <div id="shopping_cart">
		        <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
				
				<?php
				if(isset($_SESSION['customer_email']))
				{
					echo "<b>Welcome:</b>".$_SESSION['customer_email']."<b style='color:yellow'>Your</b>";
				}
				else{
					echo "<b>Welcome Guest!</b>";
				}
				?>
				<b style="color:yellow"> Shopping Cart - </b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:yellow">  Go to Cart</a>
				
				</span>
			  </div>		  
		       <?php
                if(isset($_GET['pro_id'])){
					
			   $product_id=$_GET['pro_id'];
			   $get_pro="select * from product where product_id='$product_id'";

               $run_pro=mysql_query($get_pro);

               while($row_pro=mysql_fetch_array($run_pro))
               {
	           $pro_id=$row_pro['product_id'];
	           $pro_title=$row_pro['product_title'];
               $pro_price=$row_pro['product_price'];
	           $pro_image=$row_pro['product_image'];
			   $pro_desc=$row_pro['product_desc'];
	           echo "
	        <div id='single_product'>
	          <h3>$pro_title</h3>
			  <img src='admin_area/product_images/$pro_image' width='400' height='300'/>
			  <p style='color:red;'><b>Price: $$pro_price</b></p>
			  <p style='color:green;'>$pro_desc</p>
			  <a href='index.php' style='float:left; color:darkorchid;'>Go Back</a>
			  <a href='details.php?pro_id=$pro_id'><button style='float:right; background:darkgoldenrod; color:white;'>Add to Cart</button></a>
			  
	        </div>
	         ";
            }
			}
			?>
		  </div>
	 </div>
	 <!--Content wrapper ends here-->
	 <div id="footer">
	 <h2 style="text-align:center; padding-top:30px;">&copy; 2016 by www.Onlinewebsolutions.com</h2>
	 </div>
</div>
<!--Main Container ends here-->
</body>
</html>
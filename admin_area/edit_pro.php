<?php

if(!isset($_SESSION['user_email']))
{
	echo "<script>window.open('login.php?not_admin=You are not admin!','_self')</script>";
}
else
{
	
?>
<!DOCTYPE html>
<?php
include("includes/db.php");

if(isset($_GET['edit_pro'])){
	    $get_id=$_GET['edit_pro'];
		
		$get_pro="select * from product where product_id='$get_id'";
		$run_pro=mysql_query($get_pro);
		$row_pro=mysql_fetch_array($run_pro);
		
			$pro_id=$row_pro['product_id'];
			$pro_title=$row_pro['product_title'];
			$pro_image=$row_pro['product_image'];
			$pro_price=$row_pro['product_price'];
			$pro_desc=$row_pro['product_desc'];
			$pro_keywords=$row_pro['product_keywords'];
			$pro_cat=$row_pro['product_cat'];
			$pro_brand=$row_pro['product_brand'];
			
			$get_cat="select * from categories where cat_id='$pro_cat'";
			$run_cat=mysql_query($get_cat);
			$row_cat=mysql_fetch_array($run_cat);
			$category_title=$row_cat['cat_title'];
			
			$get_brand="select * from brands where brand_id='$pro_brand'";
			$run_brand=mysql_query($get_brand);
			$row_brand=mysql_fetch_array($run_brand);
			$brand_title=$row_brand['brand_title'];
}
?>
<html>
<head>
  <title>Update Product</title>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="skyblue">
<form action="" method="post" enctype="multipart/form-data">
  <table align="center" width="795" border="2" bgcolor="orange">
   <tr align="center">   
     <td colspan="6"><h2>Edit & Update Product</h2></td>
   </tr>
   <tr>
     <td align="right"><b>Product Title:</b></td>
	 <td><input type="text" name="product_title" size="60" value="<?php echo $pro_title; ?>" required/></td>
   </tr>
   <tr>
     <td align="right"><b>Product Category:</b></td>
	 <td>
	     <select name="product_cat" required>
	         <option><?php echo $category_title; ?></option>
			 <?php
			 $get_cats="SELECT * FROM categories";
             $run_cats=mysql_query($get_cats);	
             while($row_cats=mysql_fetch_array($run_cats))
             {
	         $cat_id=$row_cats['cat_id'];
	         $cat_title=$row_cats['cat_title'];
	         echo "<option value='$cat_id'>$cat_title</option>";
             }
			 ?>
	     </select>
	 </td>
   </tr>
   <tr>
     <td align="right"><b>Product Brand:</b></td>
	 <td>
	 <select name="product_brand" required>
	 <option><?php echo $brand_title; ?></option>
	 <?php
	   $get_brands="SELECT * FROM brands";
       $run_brands=mysql_query($get_brands);	
       while($row_brands=mysql_fetch_array($run_brands))
       {
	   $brand_id=$row_brands['brand_id'];
	   $brand_title=$row_brands['brand_title'];
	   echo "<option value='$brand_id'>$brand_title</option>";
       }
	   
	 ?>
	 </select>
	 </td>
   </tr>
   <tr>
     <td align="right"><b>Product Image:</b></td>
	 <td><input type="file" name="product_image" required/><img src="product_images/<?php echo $pro_image; ?>" width="30" height="30"/></td>
   </tr>
   <tr>
     <td align="right"><b>Product price:</b></td>
	 <td><input type="text" name="product_price" value="<?php echo $pro_price; ?>" required/></td>
   </tr>
   <tr>
     <td align="right"><b>Product Discription:</b></td>
	 <td><textarea name="product_desc" cols="20" rows="10"><?php echo $pro_desc; ?></textarea></td>
   </tr>
   <tr>
     <td align="right"><b>Product Keywords:</b></td>
	 <td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords; ?>" required/></td>
   </tr>
   <tr align="center">
	 <td colspan="6"><input type="submit" name="update_product" value="Update Now"/></td>
   </tr>
  </table>
</form>
</body>
</html>

<?php
if(isset($_POST['update_product']))
{
	$update_id=$pro_id;
	$product_title=$_POST['product_title'];
	$product_cat=$_POST['product_cat'];
	$product_brand=$_POST['product_brand'];
	$product_price=$_POST['product_price'];
	$product_desc=$_POST['product_desc'];
	$product_keywords=$_POST['product_keywords'];
	$product_image=$_FILES['product_image']['name'];
	$product_image_tmp=$_FILES['product_image']['tmp_name'];
	
	move_uploaded_file($product_image_tmp,"product_images/$product_image");
	
    $update_product="update product set product_cat='$product_cat',product_brand='$product_brand',product_title='$product_title',product_price='$product_price',product_desc='$product_desc',product_image='$product_image',product_keywords='$product_keywords' where product_id='$update_id'";

	$run_product=mysql_query($update_product);
	
	if($run_product)
	{
		echo "<script>alert('Product has been updated successfully!')</script>";
		echo "<script>window.open('index.php?view_products','_self')</script>";
	}	
}
?>

<?php } ?>
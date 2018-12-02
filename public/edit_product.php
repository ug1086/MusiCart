<?php 
    
    // admin page to show all the products in the products table
    include_once ("LIB_project1.php");
	require "../includes/db.class.php";

	adminAuthentication(); // function used on all admin pages

	$db = new DB();

	$message = '';

	$allProducts = $db->getAllProducts();
?>

<?php
	

	if(isset($_GET['id'])){
		$saleItemCount = $db->getOnSaleProductsCount();
		if($saleItemCount>3){
			$delete = $db->deleteFromProduct($_GET['id']);
			if($delete){
				header("Location: edit_product.php");
			}
		} else {
			$message="Sale item cannot be deleted! Minimum 3 needed.";
		}
	}

?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Edit Product</title>
		<!-- Bootstrap CSS
		============================================ -->		
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Font Awesome CSS
		============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		 <!-- bootstrap JS
		============================================ -->		
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="container">
		<div class="row">
			<?php if($message!=''){ ?>
              <div class="alert alert-danger" role="alert">
                  <?php echo $message; ?>
              </div>
            <?php } ?>
		<h2>Product Listing</h2>
		<br />
		<table class="table">
	  		<thead>
	    		<tr>
			      <th scope="col">Name</th>
			      <th scope="col">Price</th>
			      <th scope="col">Quantity</th>
			      <th scope="col">Sale Price</th>
	    		</tr>
	  		</thead>
	  		<tbody>
	  		<?php foreach($allProducts as $row) { 
	  			$id = $row['id'];
	  			?>
	  			<tr>
			      <td><?php echo "{$row['name']}" ?></td>
			      <td><?php echo "{$row['price']}" ?></td>
			      <td><?php echo "{$row['quantity']}" ?></td>
			      <td><?php echo "{$row['sale_price']}" ?></td>
			      <td><a href="update_product.php?id=<?php echo $id ?>" class="btn btn-primary">Update</a>
			      <a href="edit_product.php?id=<?php echo $id ?>" class="btn btn-danger">Delete</a></td>
			    </tr>
			   <?php } ?> 
	 		</tbody>
	 	</table>
      <a class="btn btn-danger" href="admin.php">Go to Admin</a><br/><br/>
	 	</div>
	 	</div>
	 </body>
 </html>



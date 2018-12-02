<?php require_once("../includes/db.class.php");
      require_once("LIB_project1.php"); 

      adminAuthentication();

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
<?php include("../includes/layouts/header.php"); ?>
  <div id="page">
    <h2>Admin Menu</h2>
    <p>Welcome to the admin area.</p>
    <ul>
      <li><a href="manage_content.php">Add Products</a></li>
      <li><a href="edit_product.php">Edit/Delete Products</a></li>
    </ul>
    
<?php include("../includes/layouts/footer.php"); ?>
  </div>
</div> 
</div>
</body>
</html>



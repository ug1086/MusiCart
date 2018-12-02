<?php 
      require "../includes/db.class.php";
      include ("validations.php");
      include_once ("LIB_project1.php");
      
      // page to insert data into the products table
?>

<?php

    adminAuthentication(); // called on all the admin pages

    $db = new DB();

    $errorMsg = false;

    $message = "";

    function setMessage($msg){
      global $message;
      $message = $msg;
    }

    $fileActualExt = null;
    $filePath = null;

    if(isset($_POST['submit'])){

      if(isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['categoryid'], $_POST['brandid'], $_POST['onsale'], $_POST['saleprice'])){
        
        
        // Sanitizing the data received from the form
        $name = sanitizeString($_POST['name']);
        $description = sanitizeString($_POST['description']);
        $price = sanitizeString($_POST['price']);
        $quantity = sanitizeString($_POST['quantity']);
        $categoryid = sanitizeString($_POST['categoryid']);
        $brandid = sanitizeString($_POST['brandid']);
        $onsale = sanitizeString($_POST['onsale']);
        $saleprice = sanitizeString($_POST['saleprice']); 


      // Validating the data received from the form
      if($name == "" || !alphabetsNumbersHyphens($name)) {
        $message = $message.'You must enter a valid product name.<br />';
        $errorMsg = true;
      }
      //if ($description ="" && (sqlMetaChars($description) || sqlInjection($description) || sqlInjectionUnion($description) ||
      //sqlInjectionSelect($description) || sqlInjectionInsert($description) || sqlInjectionDelete($description) ||
       //sqlInjectionUpdate($description) || sqlInjectionDrop($description) || crossSiteScripting($description) ||
       //crossSiteScriptingImg($description))) {
        //$message = $message.'You entered an invalid description.<br />';
        //$errorMsg = true;      
      //}
      if($price == "" || !numbers($price)) {
        $message = $message.'You must enter a valid product price in the format ##.##.<br />';
        $errorMsg = true;
      }

      if($quantity == "" || !numbers($quantity)) {
        $message = $message.'You must enter a valid product quantity.<br />';
        $errorMsg = true;
      }

      if($categoryid == "" || !numbers($categoryid)) {
        $message = $message.'You must enter a valid product category id.<br />';
        $errorMsg = true;
      }

      if($brandid == "" || !numbers($brandid)) {
        $message = $message.'You must enter a valid product brand id.<br />';
        $errorMsg = true;
      }      

      if($onsale == "" || !numbers($onsale)) {
        $message = $message.'You must enter a valid product on sale value. (1 = on sale, 0 = not on sale)<br />';
        $errorMsg = true;
      }

      if($saleprice == "" || !numbers($saleprice)) {
        $message = $message.'You must enter a valid product sale price in the format ##.##. (Default - 0)<br />';
        $errorMsg = true;
      }


      // for uploading image
        $file = $_FILES['image'];

        $filename = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];
        $fileType = $_FILES['image']['type'];

        $fileExt = explode('.', $filename);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)){
          if($fileError===0){
              if($fileSize < 1000000){
                  $filePath = 'img/'.$filename;
                  move_uploaded_file($fileTmpName, $filePath);
              } else {
                   $message = $message. "Your image file is too big! It could not be uploaded.";

              }
          } else {
            $message = $message. "There was an error uploading your image file!";

          }
        } else {
          $message = $message. "You cannot upload files of this type!";
        }
        $imagepath = $filePath;

        //function to check count of sale items
        $saleItemCount = $db->getOnSaleProductsCount();

        if($saleprice>0){
          if($saleItemCount<5){
              if(!$errorMsg){
              $result = $db->insertIntoProducts($name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice);
                if($result){
                  setMessage("The product was added successfully!");
                }
              }     
          } else {
            setMessage("Sale items are full! Product could not be added.");
          }
        } else {
          if(!$errorMsg){
              $result = $db->insertIntoProducts($name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice);
              if($result){
                setMessage("The product was added successfully!");
              } 
            }    
        }
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
          <div id="page">
            <?php if($message!=''){ ?>
              <div class="alert alert-warning" role="alert">
                  <?php echo $message; ?>
              </div>
            <?php } ?>
          <h2 class="display-4">Create New Product</h2>
          <form action = "manage_content.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Product name:</label>
            <input class="form-control" type="text" name="name" size="30" placeholder="Enter the product name" required/>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" rows="3" cols="30" placeholder="Description" required></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input class="form-control" type="text" name="price" size="30" placeholder="Enter product price" required/>
          </div>
          <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input class="form-control" type="text" name="quantity" size="30" placeholder="Enter product quantity" required/>
          </div>
          <div class="form-group">
            <label for="categoryid">Category ID:</label>
            <input class="form-control" type="text" name="categoryid" size="30" placeholder="Enter product categoryID" required/>
          </div>
          <div class="form-group">
            <label for="image">Product Image:</label>
            <input class="btn" type="file" name="image"/>
          </div>
          <div class="form-group">
            <label for="brandid">Brand ID:</label>
            <input class="form-control" type="text" name="brandid" size="30" placeholder="Enter product brandID" required/>
          </div>
          <div class="form-group">
            <label for="onsale">On Sale:</label>
            <input class="form-control" type="text" name="onsale" size="30" placeholder="Enter On sale (1 for yes or 0 for no)" required/>
          </div>
          <div class="form-group">
            <label for="saleprice">Sale Price:</label>
            <input class="form-control" type="text" name="saleprice" size="30" placeholder="Enter sale price"/>
          </div>
          <div class="clearfix">
            <button class="btn" type="reset" value="Reset Form">Reset Form</button>
            <button class="btn btn-primary" type="submit" name="submit" value="Submit Form">Submit Form</button>
          </div>  
        </form>
          <br />
      <a class="btn btn-danger" href="admin.php">Go to Admin</a>
      <br />
      <br />

<?php include("../includes/layouts/footer.php"); ?>
        </div>
      </div>
      </div>
   </body>
</html>
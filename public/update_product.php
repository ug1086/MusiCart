<?php require "../includes/db.class.php";
      include ("validations.php");
      include_once ("LIB_project1.php");
      
      // Page for updating a particular product in the products table
      // Redirected to this page from the edit_products.php 
?>

<?php

    adminAuthentication(); // called on all the admin pages for authentication

    $db = new DB();

   $errorMsg = false;

    $message = "";

    function setMessage($msg){
      global $message;
      $message = $msg;
    }

    $fileActualExt = null;
    $filePath = null;
    $id = null;

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

      $singleProduct = $db->getSingleRow($id);


    if(isset($_POST['submit'])){

      if(isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['categoryid'], $_POST['brandid'], $_POST['onsale'], $_POST['saleprice'])){

        // Sanitizing data from the form
        $id = sanitizeString($_POST['id']);
        $name = sanitizeString($_POST['name']);
        $description = sanitizeString($_POST['description']);
        $price = sanitizeString($_POST['price']);
        $quantity = sanitizeString($_POST['quantity']);
        $categoryid = sanitizeString($_POST['categoryid']);
        $brandid = sanitizeString($_POST['brandid']);
        $onsale = sanitizeString($_POST['onsale']);
        $saleprice = sanitizeString($_POST['saleprice']); 

      // Validating data from the form
      if($name == "" || !alphabetsNumbersHyphens($name)) {
        $message = $message.'You must enter a valid product name.<br />';
        $errorMsg = true;
      }
      // if ($description ="" && (sqlMetaChars($description) || sqlInjection($description) || sqlInjectionUnion($description) ||
      // sqlInjectionSelect($description) || sqlInjectionInsert($description) || sqlInjectionDelete($description) ||
      //  sqlInjectionUpdate($description) || sqlInjectionDrop($description) || crossSiteScripting($description) ||
      //  crossSiteScriptingImg($description))) {
      //   $message = $message.'You entered an invalid description.<br />';
      //   $errorMsg = true;      
      // }
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

      if($saleprice=="" || !numbers($saleprice)) {
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
              if($fileSize < 100000){
                  $filePath = 'img/'.$filename;
                  move_uploaded_file($fileTmpName, $filePath);
              } else {
                   echo "Your file is too big!";
              }
          } else {
            echo "There was an error uploading your file!";
          }
        } else {
          echo "You cannot upload files of this type!";
        }
        $imagepath = $filePath;

        //function to check count of sale items
        $saleItemCount = $db->getOnSaleProductsCount($id);

        // Checking all the sale item constraints 
        if($saleprice>0){
          if($saleItemCount<5){
            if(!$errorMsg){
              // function also checks the case where if the sale items in the products table are 5 and you are updating a sale item, it sends the product id to the function
              // which checks the count of the sale items and excludes the item id which is passed (otherwise it will return 5 and error would be thrown on updating)
              // so that an error isn't thrown when the item is updated
              $result = $db->updateProducts($id, $name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice);
              if($result){
                setMessage("The product was added successfully!");
              }
            }     
          } else {
            setMessage("Sale items are full! Product could not be added.");
          }
        } else {
            if(!$errorMsg){
               $result = $db->updateProducts($id, $name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice);
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
          <h2 class="display-4">Update Product</h2>
          <form action = "update_product.php" method="POST" enctype="multipart/form-data">
          <?php foreach($singleProduct as $row){ ?>
          <div class="form-group">
            <label for="name">Product name:</label>
            <input class="form-control" type="text" name="name" size="30" value="<?php echo "{$row['name']}" ?>" />
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" rows="3" cols="30"><?php echo $row['description'] ?></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price:</label>
            <input class="form-control" type="text" name="price" size="30" value="<?php echo "{$row['price']}" ?>"/>
          </div>
          <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input class="form-control" type="text" name="quantity" size="30" value="<?php echo "{$row['quantity']}" ?>"/>
          </div>
          <div class="form-group">
            <label for="categoryid">Category ID:</label>
            <input class="form-control" type="text" name="categoryid" size="30" value="<?php echo "{$row['category_id']}" ?>"/>
          </div>
          <div class="form-group">
            <label for="image">Product Image:</label>
            <img style="width:50%;" class="primary-img" src="<?php echo "{$row['image_path']}" ?>" alt="product">
            <input class="btn" type="file" name="image"/>
          </div>
          <div class="form-group">
            <label for="brandid">Brand ID:</label>
            <input class="form-control" type="text" name="brandid" size="30" value="<?php echo "{$row['brand_id']}" ?>"/>
          </div>
          <div class="form-group">
            <label for="onsale">On Sale:</label>
            <input class="form-control" type="text" name="onsale" size="30" value="<?php echo "{$row['on_sale']}" ?>"/>
          </div>
          <div class="form-group">
            <label for="saleprice">Sale Price:</label>
            <input class="form-control" type="text" name="saleprice" size="30" value="<?php echo "{$row['sale_price']}" ?>"/>
          </div>
          <div class="form-group">
            <input type="hidden" name="id" size="30" value="<?php echo "{$row['id']}" ?>"/>
          </div>
          <div class="clearfix">
            <button class="btn" type="reset" value="Reset Form">Reset Form</button>
            <button class="btn btn-primary" type="submit" name="submit" value="Submit Form">Submit Form</button>
          </div>  
          <?php } ?>
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
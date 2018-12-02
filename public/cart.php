<?php 
  session_start();

  if(isset($_SESSION['id'])){

  require "../includes/db.class.php";

  $db = new DB();

  $cart = $db->getCartItems($_SESSION['id']);
  $count = 0;
  $sum = 0;

?>

<?php

  if(isset($_POST['delete_id'])){
    $db->deletecartitem($_POST['delete_id']);
  }
?>

<?php
  if(isset($_POST['emptycart'])){
    $db->emptycart($_SESSION['id']);
  }
?>


<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cart || Minoan</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon
    ============================================ -->    
        <link rel="shortcut icon" type="image/x-icon" href="img/logo/favicon.ico">
    
    <!-- Google Fonts
    ============================================ -->    
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
     
    <!-- Bootstrap CSS
    ============================================ -->    
        <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome CSS
    ============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Mean Menu CSS
    ============================================ -->      
        <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- owl.carousel CSS
    ============================================ -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- nivo-slider css
    ============================================ --> 
    <link rel="stylesheet" href="css/nivo-slider.css">
    <!-- Price slider css
    ============================================ --> 
    <link rel="stylesheet" href="css/jquery-ui-slider.css">
    <!-- Simple Lence css
    ============================================ --> 
    <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.simpleGallery.css">
    <!-- animate CSS
    ============================================ -->
        <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
    ============================================ -->
        <link rel="stylesheet" href="css/normalize.css">
    <!-- main CSS
    ============================================ -->
        <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
    ============================================ -->
        <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
    ============================================ -->
        <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
    ============================================ -->    
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- jquery
    ============================================ -->    
        <script src="js/vendor/jquery-1.11.3.min.js"></script>

      <script type="text/javascript" >
        $(function() {

            $(".delete-class").click(function() {
                var del_id = $(this).attr("id");
                var info = 'delete_id=' + del_id;
                if (confirm("Sure you want to delete this item? This cannot be undone later.")) {
                    //$(this).parent().parent().hide();
                    $.ajax({
                        type : "POST",
                        url : "cart.php", //URL to the delete php script
                        data : info,
                        success : function(data) {
                          location.reload();
                        }
                    });
                    $(this).parents(".record").animate("fast").animate({
                        opacity : "hide"
                    }, "slow");
                }
                return false;
            });
        });
      </script>

      <script type="text/javascript" >
        $(function() {
            $(".emptycart").click(function() {
                var set = $(this).attr("value");
                var info = 'emptycart='+ set;
                if (confirm("Are you sure you want to clear the cart? This cannot be undone later.")) {
                  $("#cart-tbody").hide();
                    $("#total").hide();
                  $(this).hide();
                    $.ajax({
                        type : "POST",
                        url : "cart.php", //URL to the delete php script
                        data : info,
                        success : function(data) {
                        }
                    });
                  }  
              });
          });
      </script>

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    
    <!-- Header Area -->
        <div class="header-area">
      <!-- Header bottom -->
      <div class="header-bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-sm-12">
              <!-- Header Search -->
              <div class="header-search">
              </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <!-- Header logo -->
            <div class="header-logo">
              <a href="index.html"><img style="max-height: 100px; max-width: 100px;" src="img/logo/logo6.png" alt="logo"></a>
              <h3 style="color: black">MusiCart <i class="fa fa-shopping-cart"></i></h3>
            </div>
            </div>
            <div class="col-md-4 col-sm-12">
              <!-- Header Cart Area-->
              <div class="header-cart-area">
                <div class="header-cart">
                  <ul>
                    <li>
                      <form action="logout.inc.php" method="POST">
                      <button class="btn btn-default" name="submit" type="submit">LOGOUT</button><br /><br />
                      </form>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="my-cart">My cart</span>
                        <span class="badge"><?php foreach($cart as $row){ $count += $row['c_quantity'];} echo $count; ?></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div><!-- End Header Cart Area-->
            </div>
          </div>
        </div>
      </div><!-- End Header bottom -->
    </div><!-- End Header Area -->
        <!-- Main Menu Area -->
    <div class="main-menu-area entire-main-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- Main Menu -->
            <div class="main-menu hidden-sm hidden-xs">
              <nav>
                <ul class="main-ul">
                  <li class="sub-menu-li"><a href="index.php">Home</a>
                  </li>
                  <li><a href="cart.php">My Cart</a>
                  <li class="small-megamenu-li"><a href="index.php">My Wishlist</a>
                  </li>
                  <li class="sub-menu-li"><a href="index.php" class="new-arrivals">My Account</a>
                  </li>
                </ul>
              </nav>
            </div><!-- End Main Menu -->
            
          </div>
        </div>
      </div>
    </div><!-- End Main Menu Area -->
    <!-- Cart Area -->
    <div class="chart-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="cart-title">
              <h2>Shopping Cart</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <!-- Cart Item -->
            <div class="chart-item table-responsive fix">
              <table class="col-md-12">
                <thead>
                  <tr>
                    <th class="th-delate">Remove</th>
                    <th class="th-product">Images</th>
                    <th class="th-details">Product Name</th>
                    <th class="th-price">Unit Price</th>
                    <th class="th-qty">Qty</th>
                    <th class="th-total">Subtotal</th>
                  </tr>
                </thead>
                <tbody id="cart-tbody">


                <!--getting data from the cart table-->
                <!-- loop -->
                <?php foreach($cart as $row){ ?>
                  <tr>
                    <td class="th-delate"><button class="delete-class btn" id="<?php echo "{$row['c_id']}" ?>">X</button></td>
                    <td class="th-product">
                      <a href="#"><img style="width:50%;" src="<?php echo "{$row['p_image_path']}" ?>" alt="cart"></a>
                    </td>
                    <td class="th-details">
                      <h2><a href="#"><?php echo "{$row['p_name']}" ?></a></h2>
                    </td>
                    <td class="th-price"><?php if("{$row['p_on_sale']}" ==  0){echo "{$row['p_price']}";} else{echo "{$row['p_sale_price']}";} ?></td>
                    <td class="th-qty">
                      <?php echo "{$row['c_quantity']}" ?>
                    </td>
                    <td class="th-total"><?php if("{$row['p_on_sale']}" ==  0){echo "{$row['p_price']}" * "{$row['c_quantity']}";} else {echo "{$row['p_sale_price']}" * "{$row['c_quantity']}" ;} ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- End Cart Item -->
            <div class="shoping-cart-button">
              <div class="cart-button-left">
                <a href="index.php"><button type="button" class="btn">Continue Shopping</button></a>
              </div>
              <div class="cart-button-right">
                <button type="submit" value="delete" class="emptycart btn">Clear Shopping Cart</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Cart Shoping Area -->
          <div class="cart-shopping-area fix">
            <div class="col-md-4 col-md-offset-8">
            
            
            <!--setting total and subtotal-->
            <?php foreach($cart as $row){ 
                    if($row['p_on_sale'] == 0){
                      $subtotal = $row['p_price'] * $row['c_quantity'];
                    } else if($row['p_on_sale'] == 1){
                      $subtotal = $row['p_sale_price'] * $row['c_quantity'];
                    }
                    $sum += $subtotal;
                  }
                ?>
              <div id="total" class="shopping-summary chart-all fix">
                <div class="shopping-cost-area">
                  <div class="shopping-cost">
                    <div class="shopping-cost-right">
                      <p>$<?php echo $sum?></p>
                      <p><b>$<?php if($sum == 0){echo '0';} else {echo $sum + 100;} ?></b></p>
                    </div>
                    <div class="shopping-cost-left">
                      <p class="floatright">Sub Total </p>
                      <p><b>GRAND TOTAL</b></p>
                      <p class="floatright">(With shipping)</p>
                    </div>
                  </div>
                  <div class="shiping-cart-button">
                    <button type="button" class="btn">Proceed to Checkout</button>
                  </div>
                  <a href="#">Checkout with Multiple Addresses</a>
                </div>
              </div>
            </div>
          </div><!-- End Cart Shopping Area -->
        </div>
      </div>
    </div><!-- End Cart Area -->
    <br /><br />
    
    <!-- Footer area -->
    <div class="footer-area">
      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div class="container">
          <!-- Copyright -->
            <div class="copyright">
              <p>Copyright &copy; <a href="#">Umang</a> All Rights Reserved.</p>
            </div>
        </div>
      </div><!-- End Footer Bottom -->
    </div><!-- End Footer area -->
    
    <!-- bootstrap JS
    ============================================ -->    
        <script src="js/bootstrap.min.js"></script>
    <!-- nivo slider js
    ============================================ --> 
    <script src="js/jquery.nivo.slider.pack.js"></script>
    <!-- Mean Menu js
    ============================================ -->         
        <script src="js/jquery.meanmenu.min.js"></script>
    <!-- wow JS
    ============================================ -->    
        <script src="js/wow.min.js"></script>
    <!-- price-slider JS
    ============================================ -->    
        <script src="js/jquery-price-slider.js"></script>
    <!-- Simple Lence JS
    ============================================ -->
    <script type="text/javascript" src="js/jquery.simpleGallery.min.js"></script>
    <script type="text/javascript" src="js/jquery.simpleLens.min.js"></script>
    <!-- owl.carousel JS
    ============================================ -->    
        <script src="js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
    ============================================ -->    
        <script src="js/jquery.scrollUp.min.js"></script>
    <!-- jquery Collapse JS
    ============================================ -->
        <script src="js/jquery.collapse.js"></script>
    <!-- plugins JS
    ============================================ -->    
        <script src="js/plugins.js"></script>
    <!-- main JS
    ============================================ -->    
        <script src="js/main.js"></script>

    </body>
</html>

<?php } else {
    header("Location: login.php");
    exit();
}

 ?>

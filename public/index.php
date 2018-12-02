<?php 

	session_start();
 
   // main page of the website

	if(isset($_SESSION['id'])){

	require "../includes/db.class.php";
	require_once("LIB_project1.php"); 

	$db = new DB();
 	
 	//Pagination code start
 	$page = isset($_GET["page"])?$_GET["page"]:1;
	$countArray = $db->getProductsNotOnSaleCount();
	$count = $countArray['prodCount'];
 	$limit = 4;
 	$totalPages = ceil($count/$limit);
 	$offset = $limit*($page-1);
 	$previous = $page-1;
 	$next = $page+1;
 	$previousHidden = $previous==0?"hidden":"";
 	$nextHidden = $next>$totalPages?"hidden":"";
	$product = $db->getProductsNotOnSale($limit, $offset);
	//Pagination code end

	$sale = $db->getOnSaleProducts();
	$fender = $db->getFenderProducts();
	$allProducts = $db->getAllProducts();
	$taylor = $db->getTaylorProducts();

?>


<?php
	if(isset($_POST['addtocart'])){
		$db->addtocart($_POST['addtocart'], $_SESSION['id']); // function call to add product item to cart table
	}
?>



<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>MusiCart</title>
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

        <!-- jquery function to set POST variable on click of the button -->
       	<script type="text/javascript">
        $(function() {
            $(".addtocart").click(function() {
                var pid = $(this).attr("id");
                var info = 'addtocart=' + pid;
                    $.ajax({
                        type : "POST",
                        url : "index.php", //URL to the delete php script
                        data : info,
                        success : function(data) {
                        	alert("Item has been added to your cart!");
                        	location.reload();
                        }
                    });
            	});
        	});
     	</script>

    </head>
    <body>
		
		<div class="wrraper home-5-area">
			<!-- Header Area -->
			<div class="header-area">
				<!-- Header logo -->
				<div class="header-logo">
					<a href="index.html"><img style="max-height: 100px; max-width: 100px;" src="img/logo/logo6.png" alt="logo"></a>
					<h3 style="color: white">MusiCart <i class="fa fa-shopping-cart"></i></h3>
				</div>
				<br /><br />
				<div class="container">
					<h5 class="cap-dec wow zoomInRight" style="color: white; font-family:Montserrat,sans-serif";><?php echo "Welcome {$_SESSION['first']}!"?></h5>
				</div>

				<!-- Main Menu Area -->
				<div class="main-menu-area home-5-main-menu-area">
					<!-- Main Menu -->
					<div class="main-menu hidden-sm hidden-xs">
						<nav>
							<ul class="main-ul">
								<li class="sub-menu-li"><a href="index.php" class="active">Products<i class="fa fa-chevron-right"></i></a>
								</li>
								<li class="small-megamenu-li"><a href="cart.php">My Cart</a>
								</li>
								<li><a href="index.php">My Wishlist</a>
								</li>
								<li><a href="index.php">My Account</a>
								</li>
								</ul>
						</nav>
					</div><!-- End Main Menu -->
				</div><!-- End Main Menu Area -->
				
				<!-- Header Link -->
				<!-- Header Link Area -->
				<div class="header-link-area">
					<div class="header-link">
						<ul>
							<li><a href="admin.php">Admin</a>
							</li>
						</ul>
					</div>
					<div class="header-link">
					</div>
				</div><!-- End Header Link Area -->
				<!-- Header Cart Area-->
				<div class="header-cart-area">
					<div class="header-cart">
						<ul>
							<li>
								<a href="cart.php">
									<i class="fa fa-shopping-cart"></i>
									<span class="my-cart">My cart </span>
								</a>
							</li>
						</ul>
					</div>
				</div><!-- End Header Cart Area-->
				<br />
				<br />
				<div class="container">
					<form action="logout.inc.php" method="post">
		            	<a><button style="margin-top: 20px;" class="btn btn-default" name="submit" type="submit">LOGOUT</button></a>
		          	</form>
	          	</div>
			</div><!-- End Header Area -->

			<!-- Main Slider Area -->
			<div class="main-slider-area home-4-main-slaider-area entire-home-main-slider home-5-main-slaider-area">
				<!-- Main Slider -->
				<div class="main-slider">
					<div class="slider">
						<div id="mainSlider" class="nivoSlider slider-image">
							<img src="img/guitarbackground1.jpg" alt="main slider" title="#htmlcaption1" />
							<img src="img/guitarbackground2.jpg" alt="main slider" title="#htmlcaption2"/>
						</div>
						<!-- Slider Caption One -->
						<div id="htmlcaption1" class="nivo-html-caption slider-caption-1">
							<div class="slider-progress"></div>									
							<div class="slide-text">
								<div class="middle-text">
									<div class="cap-dec">
										<h3 class="cap-dec wow zoomInRight" data-wow-duration="1.1s" data-wow-delay="0s">Welcome to MusiCart</h3>
									</div>	
								</div>	
							</div>
						</div>
						<!-- Slider Caption Two -->
						<div id="htmlcaption2" class="nivo-html-caption slider-caption-2">
							<div class="slider-progress"></div>					
							<div class="slide-text slide-text-2">
								<div class="middle-text">
									<div class="cap-dec">
										<h1 class="wow zoomInUp" data-wow-duration="1.1s" data-wow-delay="0s">Huge sale</h1>
										<p class="wow zoomInUp" data-wow-duration="1.3s" data-wow-delay="0s"> up to 30% off On Selected Instruments!</p>
									</div>	
									<div class="cap-readmore wow zoomInUp" data-wow-duration="1.3s" data-wow-delay=".3s">
										<a href="#">Shop Now</a>
									</div>	
								</div>	
							</div>
						</div>
					</div>
				</div><!-- End Main Slider -->
			</div><!-- End Main Slider Area -->		

			<!-- Product Catalog area -->
			<div class="product-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- Product Top Bar -->
							<div class="product-top-bar customize-tab-bar">
								<!-- Tab Button -->
								<ul class="nav nav-tabs">
									<li role="presentation" class="active"><a href="#p-bestseller" data-toggle="tab"><i class="fa fa-pencil-square-o"></i>Product Catalog</a></li>
								</ul><!-- End Tab Button -->
							</div><!-- End Product Top Bar -->
						</div>
						<div class="col-md-12">
							<!-- Single Product area -->
							<div class="single-product-area c-carousel-button">	
								<!-- Tab Content -->
								<div >
									<!-- Tab Pane One -->
									<div  id="p-bestseller">
										<div class="row">
											<!-- Single Product Carousel-->
											<div id="single-product-bestseller" class="owl-carousel">
												<!-- Start Single Product Column-->
	 											<?php
													foreach ($product as $row) {
												?>
												<div class="col-md-3">
													<div class="single-product">
														<div class="single-product-img">
																<img class="primary-img" src="<?php echo "{$row['image_path']}" ?>" alt="product">
														</div>
														<div class="single-product-content">
															<div class="product-content-head">
																<h2 class="product-title"><?php echo "{$row['name']}" ?></h2>
																<p class="product-price">$<?php echo "{$row['price']}" ?></p>
																<h2 class="product-quantity">Only <?php echo "{$row['quantity']}" ?> left!</h2>
															</div>
															<div class="product-bottom-action">
																<div class="product-action">
																	<div class="action-button">
																		<button class="btn addtocart" id="<?php echo "{$row['id']}" ?>"  type="submit"><i class="fa fa-shopping-cart"></i> <span>Add to cart</span></button>
																	</div>
																	<div class="action-view">
																		<button type="button" class="btn" data-toggle="modal" data-target="#<?php echo "{$row['id']}"  * 365?>"><i class="fa fa-search view_data"></i>Quick view</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div><!-- End Single Product Column -->
												<?php } ?>
											</div><!-- End Single Product Carousel-->
										</div>

											<?php paginate($previous, $previousHidden, $page, $totalPages, $next, $nextHidden)?>
									</div><!-- End Tab Pane One -->
									
								</div><!-- End Tab Content -->
							</div><!-- End Single Product area -->
						</div>
					</div>
				</div>
			</div><!-- End Product Catalog area -->

			<!-- On Sale Items area -->
			<div class="product-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<!-- Product Top Bar -->
							<div class="product-top-bar">
								<!-- Tab Button -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#p-bestseller" data-toggle="tab"><i class="fa fa-pencil-square-o"></i>On Sale</a></li>
								</ul><!-- End Tab Button -->
							</div><!-- End Product Top Bar -->
						</div>
						<div class="col-md-12">
							<!-- Single Product area -->
							<div >	
								<!-- Tab Content -->
								<div>
									<!-- Tab Pane One -->
									<div>
										<div class="row">
											<!-- Single Product Carousel-->
											<div id="single-product-bestseller">
												<!-- Start Single Product Column-->
	 											<?php
													foreach ($sale as $row) {
												?>
												<div class="col-md-3">
													<div class="single-product">
														<div class="single-product-img">
																<img class="primary-img" src="<?php echo "{$row['image_path']}" ?>" alt="product">
														</div>
														<div class="single-product-content">
															<div class="product-content-head">
																<h2 class="product-title"><?php echo "{$row['name']}" ?></h2>
																<p class="regular-price">Price: $<?php echo "{$row['price']}" ?></p>
																<p class="product-price">$<?php echo "{$row['sale_price']}" ?></p>
																<h2 class="product-quantity">Only <?php echo "{$row['quantity']}" ?> left!</h2>
															</div>
															<div class="product-bottom-action">
																<div class="product-action">
																	<div class="action-button">
																		<button class="btn addtocart" id="<?php echo "{$row['id']}" ?>"  type="submit"><i class="fa fa-shopping-cart"></i> <span>Add to cart</span></button>
																	</div>
																	<div class="action-view">
																		<button type="button" class="btn" data-toggle="modal" data-target="#<?php echo "{$row['id']}" * 365 ?>"><i class="fa fa-search view_data"></i>Quick view</button>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div><!-- End Single Product Column -->
												<?php } ?>
											</div><!-- End Single Product Carousel-->
										</div>
									</div><!-- End Tab Pane One -->
									
								</div><!-- End Tab Content -->
							</div><!-- End Single Product area -->
						</div>
					</div>
				</div>
			</div><!-- End Product Catalog area -->

			<!-- Brand Products area -->
			<div class="brand-products-area">
				<div class="container">
					<div class="row">
						<!-- Fender Products Column -->
						<div class="col-md-6 col-sm-6">
							<div class="brand-products brand-product-shoes c-carousel-button">
								<div class="row">
									<div class="col-md-12">
										<div class="products-head">
											<div class="products-head-title">
												<i class="fa fa-picture-o"></i>
												<h2>Fender Products</h2>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!-- Single Product Carousel-->
									<div id="product-brand-shoes" class="owl-carousel">
										<!-- Start Single Product Column -->
										<?php 
											foreach($fender as $row){
										?>
										<div class="col-md-6">
											<div class="single-product">
												<div class="single-product-img">
													<a href="#">
														<img class="primary-img" src="<?php echo "{$row['image_path']}" ?>" alt="product">
													</a>
												</div>
												<div class="single-product-content">
													<div class="product-content-head">
														<h2 class="product-title"><?php echo "{$row['name']}" ?></h2>
														<p class="product-price"><?php echo "{$row['price']}" ?></p>
														<h2 class="product-quantity">Only <?php echo "{$row['quantity']}" ?> left!</h2>
													</div>
													<div class="product-bottom-action">
														<div class="product-action">
															<div class="action-button">
																<form action="index.php" method="post">
																	<button class="btn" name="addtocart" id="<?php echo "{$row['id']}" ?>" type="submit"><i class="fa fa-shopping-cart"></i> <span>Add to cart</span></button>
																</form>
															</div>
															<div class="action-view">
																<button type="button" class="btn" data-toggle="modal" data-target="#<?php echo "{$row['id']}" * 365?>"><i class="fa fa-search"></i>Quick view</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- End Single Product Column -->
										<?php } ?>
									</div><!-- End Single Product Carousel -->
								</div>
							</div>
						</div><!-- End Brand Products Column -->
                           
						<!-- Taylor Products Column -->
						<div class="col-md-6 col-sm-6">
							<div class="brand-products c-carousel-button">
								<div class="row">
									<div class="col-md-12">
										<div class="products-head">
											<div class="products-head-title">
												<i class="fa fa-picture-o"></i>
												<h2>Taylor Products</h2>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<!-- Single Product Carousel-->
									<div id="product-brand-bag" class="owl-carousel">
										<!-- Start Single Product Column -->
										<?php 
											foreach($taylor as $row){
										?>
										<div class="col-md-6">
											<div class="single-product">
												<div class="single-product-img">
													<a href="#">
														<img class="primary-img" src="<?php echo "{$row['image_path']}" ?>" alt="product">
													</a>
												</div>
												<div class="single-product-content">
													<div class="product-content-head">
														<h2 class="product-title"><?php echo "{$row['name']}" ?></h2>
														<p class="product-price"><?php echo "{$row['price']}" ?></p>
														<h2 class="product-quantity">Only <?php echo "{$row['quantity']}" ?> left!</h2>
													</div>
													<div class="product-bottom-action">
														<div class="product-action">
															<div class="action-button">
																<form action="index.php" method="post">
																	<button class="btn" name="addtocart" id="<?php echo "{$row['id']}" ?>" type="submit"><i class="fa fa-shopping-cart"></i> <span>Add to cart</span></button>
																</form>
															</div>
															<div class="action-view">
																<button type="button" class="btn" data-toggle="modal" data-target="#<?php echo "{$row['id']}" * 365?>"><i class="fa fa-search"></i>Quick view</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- End Single Product Column -->
										<?php } ?>
									</div><!-- End Single Product Carousel-->
								</div>
							</div>
						</div><!-- End Brand Product Column -->
					</div>
				</div>
			</div><!-- End Brand Product area -->
			
			<!-- Brand Logo area -->
			<div class="brand-logo-area">
				<div class="container">
					<div class="brand-logo">
						<div class="brand-logo-title">
							<h2>Logo brands</h2>
						</div>
						<div id="brands-logo" class="owl-carousel">
							<div class="single-brand-logo">
								<a href="http://www.fender.com">
									<img style="max-height: 80px; max-width: 250px;" src="img/guitar brand logos/fender.png" alt="logo">
								</a>
							</div>
							<div class="single-brand-logo">
								<a href="http://www.taylorguitars.com">
									<img style="max-height: 80px; max-width: 250px;" src="img/guitar brand logos/taylor.png" alt="logo">
								</a>
							</div>
							<div class="single-brand-logo">
								<a href="http://www.gibson.com">
									<img style="max-height: 80px; max-width: 250px;" src="img/guitar brand logos/gibson.jpg" alt="logo">
								</a>
							</div>
							<div class="single-brand-logo">
								<a href="http://usa.yamaha.com/products/musical_instruments/guitars_basses/index.html">
									<img style="max-height: 80px; max-width: 250px;" src="img/guitar brand logos/yamaha.png" alt="logo">
								</a>
							</div>
							<div class="single-brand-logo">
								<a href="http://www.martinguitar.com">
									<img style="max-height: 80px; max-width: 250px;" src="img/guitar brand logos/martin.jpg" alt="logo">
								</a>
							</div>
							<div class="single-brand-logo">
								<a href="http://www.ibanez.com">
									<img style="max-height: 80px; max-width: 250px;" src="img/guitar brand logos/ibanez.png" alt="logo">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div><!-- End Brand Logo area -->
			<!-- Footer area -->
			<div class="footer-area">
				<!-- Footer Top -->
				
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
		</div>
		<!-- QUICKVIEW PRODUCT -->
		<div id="quickview-wrapper">
			<!-- Modal -->
			<?php
				foreach ($allProducts as $row) {
			?>
			<div class="modal fade" id="<?php echo "{$row['id']}" * 365 ?>" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<div class="modal-body">
							<div class="modal-product">
								<div class="product-images">
									<div class="main-image images">
										<img alt="product" src="<?php echo "{$row['image_path']}" ?>">
									</div>
								</div><!-- .product-images -->
								
								<div class="product-info">
									<h1><?php echo "{$row['name']}" ?></h1>
									<div class="price-box">
										<p class="price"><span class="special-price"><span class="amount"><?php if($row['on_sale'] == 0) {echo "$"."{$row['price']}";} ?>
										<p class="price"><span class="special-price"><span class="amount"><?php if($row['on_sale'] == 1){ echo "$"."{$row['sale_price']}";} else echo ""; ?></p></span></span></p>
									</div>
									<div class="quick-add-to-cart">
										<form method="post" class="cart">
											<div class="add-to-box add-to-box2">
											<div class="add-to-cart">
												<div class="input-content">
													<label for="qty">Qty Left:</label>
													
													<input name="qty" id="qty" maxlength="12" value="<?php echo "{$row['quantity']}" ?>" title="Qty" class="input-text qty">
													
												</div>

												<button class="btn addtocart" id="<?php echo "{$row['id']}" ?>" type="button"><span>Add to cart</span></button>
											</div>
										</div>
										</form>
									</div>
									<div class="quick-desc" style="height: 200px;overflow: scroll">
										<?php echo "{$row['description']}" ?>
									</div>
								</div><!-- .product-info -->
							</div><!-- .modal-product -->
						</div><!-- .modal-body -->
					</div><!-- .modal-content -->
				</div><!-- .modal-dialog -->
			</div><!-- END Modal -->
			<?php } ?>
		</div><!-- END QUICKVIEW PRODUCT -->	
	
	<?php footer() ?>

<?php } else {
    header("Location: login.php");
    exit();
} ?>
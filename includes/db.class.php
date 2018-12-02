<?php

// Create a database connection
class DB{
	public $connection;

	function __construct(){
		$this->connection = new mysqli($_SERVER['DB_SERVER'],
												$_SERVER['DB_USER'],
												$_SERVER['DB_PASSWORD'],
												$_SERVER['DB']);
												
			if($this->connection->connect_error){
				echo "connection failed: ".mysqli_connect_error();
				die();
			}
																
	}
    
    // function to get all products in the table
		function getAllProducts(){
		$data = array();
		$queryString = "Select * from products";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $description, $price, $quantity, $category_id, $image_path, $brand_id, $on_sale, $sale_price);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('id'=>$id,
									'name'=>$name,
									'description'=>$description,
									'price'=>$price,
									'quantity'=>$quantity,
									'category_id'=>$category_id,
									'image_path'=>$image_path,	
									'brand_id'=>$brand_id,
									'on_sale'=>$on_sale,
									'sale_price'=>$sale_price
									);
				}
			}
		}		
    
		return $data;
	}

  // function to get products from the products table which are not on sale
	function getProductsNotOnSale($limit=10, $offset=0){
		$data = array();
		$queryString = "Select * from products where on_sale = 0 AND quantity > 0 LIMIT ? OFFSET ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param('ii', $limit, $offset);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $description, $price, $quantity, $category_id, $image_path, $brand_id, $on_sale, $sale_price);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('id'=>$id,
									'name'=>$name,
									'description'=>$description,
									'price'=>$price,
									'quantity'=>$quantity,
									'category_id'=>$category_id,
									'image_path'=>$image_path,	
									'brand_id'=>$brand_id,
									'on_sale'=>$on_sale,
									'sale_price'=>$sale_price
									);
				}
			}
		}		
    
		return $data;
	}

    // function to get the count of the products not on sale
		function getProductsNotOnSaleCount(){
		$data = array();
		$queryString = "Select count(*) from products where on_sale = 0";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($prodCount);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data = array('prodCount'=>$prodCount
								);
				}
			}
		}		
    
		return $data;
	}


// 	function getProductsAsTable(){
// 		$data = $this->getProductDetails();
// 		$bigString = "";
//     echo "<h3>".count($data). " records found!</h3>";
// 		if(count($data)>0){
// 			$bigString = "<table border='1'>\n
// 							<tr><th>ID</th><th>name</th><th>description</th><th>price</th><th>quantity</th></tr>\n";
// 			foreach ($data as $row) {
// 				$bigString .= "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['description']}</td>
// 								<td>{$row['price']}</td><td>{$row['quantity']}</td></tr>\n";
// 			}
// 			$bigString .= "</table>\n";
// 		} else {
// 			echo "<h2>No products exist!</h2>";
// 		}
//    return $bigString;
// 	}

  // function to get on sale products from the products table
	function getOnSaleProducts(){
		$data = array();
		$queryString = "Select * from products where on_sale = 1 LIMIT 5";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $description, $price, $quantity, $category_id, $image_path, $brand_id, $on_sale, $sale_price);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('id'=>$id,
									'name'=>$name,
									'description'=>$description,
									'price'=>$price,
									'quantity'=>$quantity,
									'category_id'=>$category_id,
									'image_path'=>$image_path,	
									'brand_id'=>$brand_id,
									'on_sale'=>$on_sale,
									'sale_price'=>$sale_price
									);
				}
			}
		}		
    
		return $data;
	}

      // function to get on sale products count
	    function getOnSaleProductsCount($id){
        $count = "";
        if ($stmt = $this->connection->prepare("Select * from products where on_sale = 1 AND id <> ?")) {
			$stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->store_result();
            $count = $stmt->num_rows;
        }//all good
        return $count;

    }
	
 
 // function to get Fender products from the products table (Brand ID: 1)
	function getFenderProducts(){
		$data = array();
		$queryString = "Select * from products where brand_id=1";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $description, $price, $quantity, $category_id, $image_path, $brand_id, $on_sale, $sale_price);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('id'=>$id,
									'name'=>$name,
									'description'=>$description,
									'price'=>$price,
									'quantity'=>$quantity,
									'category_id'=>$category_id,
									'image_path'=>$image_path,	
									'brand_id'=>$brand_id,
									'on_sale'=>$on_sale,
									'sale_price'=>$sale_price
									);
				}
			}
		}		
    
		return $data;
	}

  // function to get Fender products from the products table (Brand ID: 5)
	function getTaylorProducts(){
		$data = array();
		$queryString = "Select * from products where brand_id=5";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $description, $price, $quantity, $category_id, $image_path, $brand_id, $on_sale, $sale_price);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('id'=>$id,
									'name'=>$name,
									'description'=>$description,
									'price'=>$price,
									'quantity'=>$quantity,
									'category_id'=>$category_id,
									'image_path'=>$image_path,	
									'brand_id'=>$brand_id,
									'on_sale'=>$on_sale,
									'sale_price'=>$sale_price
									);
				}
			}
		}		
    
		return $data;
	}
 
 
  // function to get a single row from the products table
	function getSingleRow($rowid){
		$data = array();
		$queryString = "Select * from products where id= ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param('i', $rowid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $description, $price, $quantity, $category_id, $image_path, $brand_id, $on_sale, $sale_price);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('id'=>$id,
									'name'=>$name,
									'description'=>$description,
									'price'=>$price,
									'quantity'=>$quantity,
									'category_id'=>$category_id,
									'image_path'=>$image_path,	
									'brand_id'=>$brand_id,
									'on_sale'=>$on_sale,
									'sale_price'=>$sale_price
									);
				}
			}
		}		
    
		return $data;
	}

  // function to increase the quantity of the products in the products table when
  // user empties an item or empties the whole cart
	function increaseQuantity($pid, $qty){
		$queryString = "update products set quantity = quantity + ? where id = ?";
		$insertId = -1;
		
		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("ii", $qty, $pid);
			$stmt->execute();
			$stmt->store_result();
			$numRows = $stmt->affected_rows;
		}
		
		return $numRows;
	} //update quantity - increase


    // function to decrease the product quantity from the products table when user adds an item to cart
		function decreaseQuantity($pid){
		$queryString = "update products set quantity = quantity - 1 where id = ?";
		$insertId = -1;
		
		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $pid);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		
		return $insertId;
	} //update quantity - decrease

	// function to get product_id from the cart table
	function getProductIdsFromCart($userid){
		$data = array();
		$queryString = "Select product_id from cart WHERE userid = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $userid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = $id;
				}
			}
		}		
    
		return $data;
	}
  
  // function to get product quantity and product id from the cart table using cart id
	function getProductQuantityAndIdFromCart($cid){
		$data = array();
		$queryString = "Select quantity, product_id from cart where id = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $cid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($qty, $pid);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data = array('qty'=>$qty,
								  'id'=>$pid
							 	 );
				}
			}
		}		
    
		return $data;
	}

	// function getProductIdForRow($rowid){
	// 	$data;
	// 	$queryString = "Select product_id from cart where id = ?";

	// 	if($stmt = $this->connection->prepare($queryString)){
	// 		$stmt->bind_param("i", $rowid);
	// 		$stmt->execute();
	// 		$stmt->store_result();
	// 		$stmt->bind_result($rowid);
	// 		if($stmt->num_rows>0){
	// 			while($stmt->fetch()){
	// 				$data[] = $rowid;
	// 			}
	// 		}

	// 	}		
    
	// 	return $data;
	// }

	// function to add product item to the cart table
	 function addtocart($pid, $userid){
	 	$this->decreaseQuantity($pid);
		$cartProductIds = $this->getProductIdsFromCart($userid);
		print_r($cartProductIds);
			if(in_array($pid, $cartProductIds)){
				echo "it worked";
				$queryString = "update cart set quantity = quantity + 1 where cart.product_id = ? AND cart.userid = ?";
				$insertId = -1;
		
				if($stmt = $this->connection->prepare($queryString)){
					$stmt->bind_param("is", $pid, $userid);
					$stmt->execute();
					$stmt->store_result();
					$insertId = $stmt->insert_id;
				}
			} else {
				$queryString = "insert into cart (userid, product_id, quantity) values (?,?,?)";
				$insertId = -1;
				$qty = 1;
		
				if($stmt = $this->connection->prepare($queryString)){
					$stmt->bind_param("iii", $userid, $pid, $qty);
					$stmt->execute();
					$stmt->store_result();
					$insertId = $stmt->insert_id;
				 }
			return $insertId;
			}

	} //insert

  // function to get cart items from the cart table and products table using a join between products table and cart table
	function getCartItems($userid){
		$data = array();
		$queryString = "Select cart.id, products.on_sale, products.name, products.image_path, products.price, products.sale_price, cart.quantity from products INNER JOIN cart ON products.id = cart.product_id WHERE cart.userid = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $userid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($c_id, $p_on_sale, $p_name, $p_image_path, $p_price, $p_sale_price, $c_quantity);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('c_id'=>$c_id,
									'p_on_sale'=>$p_on_sale,
									'p_name'=>$p_name,
									'p_image_path'=>$p_image_path,
									'p_price'=>$p_price,
									'p_sale_price'=>$p_sale_price,
									'c_quantity'=>$c_quantity
									);
				}
			}
		}		
    
		return $data;
	}

  // function to get product quantity and id from cart table for a particular user
	function getProductQuantityAndIdFromCartForUser($uid){
		$data = array();
		$queryString = "Select quantity, product_id from cart where userid = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $uid);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($qty, $pid);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data[] = array('qty'=>$qty,
								  'id'=>$pid
							 	 );
				}
			}
		}		
    
		return $data;
	}
  
  // function to empty the whole cart for a particular user 
	function emptycart($uid){
		$data = $this->getProductQuantityAndIdFromCartForUser($uid);
		foreach($data as $value) {
		$id = $value['id'];
		$qty = $value['qty'];
		$this->increaseQuantity($id, $qty);
		}

		$queryString = "Delete from cart WHERE userid = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $uid);
			$stmt->execute();
			$stmt->store_result();
			$numRows = $stmt->affected_rows;
			}	
    
		return $numRows;
	}

  // function to delete a cart item for a particular user
	function deletecartitem($cid){
		$data = $this->getProductQuantityAndIdFromCart($cid);
		//$prodId = $this->getProductIdForRow($rowid);
		$pid = $data['id'];
		$qty = $data['qty'];
		$this->increaseQuantity($pid, $qty);
		$queryString = "Delete from cart where id = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $cid);
			$stmt->execute();
			$stmt->store_result();
			$numRows = $stmt->affected_rows;
		}	
		return $numRows;
	}

  // function to insert products into products table
	function insertIntoProducts($name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice){
		$queryString = "insert into products (name, description, price, quantity, category_id, image_path, brand_id, on_sale, sale_price) values (?,?,?,?,?,?,?,?,?)";
		$insertId = -1;
		
		if($stmt = $this->connection->prepare($queryString)){
		$stmt->bind_param("ssdiisiid", $name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}

  // function to delete a product from the products table
	function deleteFromProduct($pid){
		$queryString = "Delete from products where id = ?";

		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("i", $pid);
			$stmt->execute();
			$stmt->store_result();
			$numRows = $stmt->affected_rows;
		}
		return $numRows;
	}

  // function to update products in the products table for a particular product id
	function updateProducts($id, $name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice){
		$queryString = "update products set name = ?, description = ?, price = ?, quantity = ?, category_id = ?, image_path = ?, brand_id = ?, on_sale = ?, sale_price = ? where id = ?";
		$insertId = -1;
		
		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("ssdiisiidi", $name, $description, $price, $quantity, $categoryid, $imagepath, $brandid, $onsale, $saleprice, $id);
			$stmt->execute();
			$stmt->store_result();
			$numRows = $stmt->affected_rows;
		}
		
		return $numRows;
	}

  // function to select all rows for a particular user id from the users table
	function checkUid($uid){
		$data;
		$queryString = "Select * from users where userid = ?";
        if ($stmt = $this->connection->prepare($queryString)) {
			$stmt->bind_param("s", $uid);
            $stmt->execute();
            $stmt->store_result();
			$stmt->bind_result($id, $first, $last, $email, $userid, $pwd);
			if($stmt->num_rows>0){
				while($stmt->fetch()){
					$data = array('id'=>$id,
								'first'=>$first,
								'last'=>$last,
								'email'=>$email,
								'userid'=>$userid,
								'pwd'=>$pwd
								);
				}
			}
		}		
    	return $data;
	}
  
  // function to insert users into the users table
	function insertUser($first, $last, $email, $uid, $pwd){
		$queryString = "insert into users (first, last, email, userid, pwd) values (?,?,?,?,?)";
		$insertId = -1;
		
		if($stmt = $this->connection->prepare($queryString)){
			$stmt->bind_param("sssss", $first, $last, $email, $uid, $pwd);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}

} //class

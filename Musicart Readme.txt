MUSICART ecommerce website

Instructions to run the website:
1) Connect to RIT network (use VPN if off-campus)
2) Go to the URL: http://serenity.ist.rit.edu/~ug1086/341/project1/public/index.php
3) On the login page, use the existing credentials (email-address: umang, password: umang) or create new ones using sign up.
4) To go to the admin page, click on the admin link on the left navbar (on the /index.php page).
5) Use the admin credentials (username: admin, password: admin) to access the admin pages.

Required Features:
1) The app features login and signup.
2) Users can Log in or Sign up into the application to use it.
3) The index.php page consists of all the products which are not on sale in the Products Catalog section and the on-sale products in the On Sale section.
4) The Product Catalog has a pagination based navigation system. 
5) The index.php page also has button for logging out, going to the admin page, checking the cart, etc.
6) The cart.php page has a cart table which displays the items added to the cart by the user.
7) User can remove separate items or empty the entire cart through the buttons provided on the table.
8) The total and subtotals are also calculated based on the items in the cart and displayed below the table.
9) The admin.php consists of clickable links through which the admin can either add a new product or update or delete existing products.

Above and Beyond:
1) Separate logins for user and admin. Used sessions for both so that the user (or admin) doesn't have to login and enter password every time.
2) The products on the index.php page have a Quick View button which pops up a modal to display the product info and description in a more clear way.
3) Every time the user clicks on the Add to Cart button, the item is added to the cart table and the product quantity is decreased.
4) In addition, every time the user clicks on the (X) button on the cart table to delete a particualar item, the product quantity is reset in the products table and on the index.php page.
5) Similarly, on clicking the Clear Shopping Cart button, the product count is reset in the products table.
6) Each user's cart table data is stored separately and is displayed when the user logs in. The cart is not shared between different users.   
7) For the admin, in addition to inserting/updating/deleting text inputs and similar data, the admin can also upload an image for the product which gets stored on the img folder in the project directory on the server. The image path is also automatically mapped and generated.
8) Extensive use of sanitization and validation functions to cleanse the data from the forms. (Both for content and login/signup).
9) Provided comments to describe input/outputs/purpose of functions.

References:
Theme: Minoan-Fashion eCommerce Bootstrap Template   
  


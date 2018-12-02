<?php 
      include_once("validations.php");
?>

<?php
      
    // function for admin authentication. Called on all admin pages. The session is destroyed as soon as the browser is closed.
    // The session persists if the admin URL is opened without closing the browser
    function adminAuthentication(){

        $valid_passwords = array ("admin" => "admin");
        $valid_users = array_keys($valid_passwords);

        $user = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];

        $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

        if (!$validated) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");
        }

        // If arrives here, is a valid user.
        echo "<br /><br />";
        echo "<div class='container'>";
        echo "<p>Welcome $user.</p>";
        echo "<p>This is the admin area.</p>";
        echo "</div>";
    }

    // function for setting page navigation on the index page
    function paginate($previous, $previousHidden, $page, $totalPages, $next, $nextHidden){

        $navigation = <<<EOT
<nav class="pgnav" aria-label="Page navigation">
<ul class="pagination">
<li class="page-item"><a class="page-link btn" href="index.php?page={$previous}" {$previousHidden}>Previous</a></li>
<li class="page-item"><span class="page-link btn">{$page} of {$totalPages}</span></li>
<li class="page-item"><a class="page-link btn" href="index.php?page={$next}" {$nextHidden}>Next</a></li>
</ul>
</nav>
EOT;

echo $navigation;
}

// footer function
function footer(){

    $footer = <<<EOT
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
EOT;

echo $footer;
}

?>

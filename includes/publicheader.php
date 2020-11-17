<?php session_start() ; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Time Watch</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="e-commerce site well design with responsive view." />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<link href="css/stylesheet.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="owl-carousel/owl.carousel.css" type="text/css" rel="stylesheet" media="screen" />
<link href="owl-carousel/owl.transitions.css" type="text/css" rel="stylesheet" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/custom.css">
<script src="javascript/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="javascript/jstree.min.js" type="text/javascript"></script>
<script src="javascript/template.js" type="text/javascript" ></script>
<script src="javascript/common.js" type="text/javascript"></script>
<script src="javascript/global.js" type="text/javascript"></script>
<script src="owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
</head>
<body>
<div class="preloader loader" style="display: block; background:#f2f2f2;"> <img src="image/loader.gif"  alt="#"/></div>
<header>
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="top-left pull-left">
            <div class="language">
              <form action="#" method="post" enctype="multipart/form-data" id="language">
                <div class="btn-group">
                  <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="image/flags/gb.png" alt="English" title="English">English <i class="fa fa-caret-down"></i></button>
                  <ul class="dropdown-menu">
                    <li><a href="#"><img src="image/flags/lb.png" alt="Arabic" title="Arabic"> Arabic</a></li>
                    <li><a href="#"><img src="image/flags/gb.png" alt="English" title="English"> English</a></li>
                  </ul>
                </div>
              </form>
            </div>
            <div class="currency">
              <form action="#" method="post" enctype="multipart/form-data" id="currency">
                <div class="btn-group">
                  <button class="btn btn-link dropdown-toggle" data-toggle="dropdown"> <strong>$</strong> <i class="fa fa-caret-down"></i> </button>
                  <ul class="dropdown-menu">
                    <li>
                      <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro</button>
                    </li>
                    <li>
                      <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound Sterling</button>
                    </li>
                    <li>
                      <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US Dollar</button>
                    </li>
                  </ul>
                </div>
              </form>
            </div>
          </div>
          <div class="top-right pull-right">
            <div id="top-links" class="nav pull-right">
              <ul class="list-inline">
                <li class="dropdown account"><a href="#" title="My Account" class="  dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user"></i><span>My Account</span> <span class="caret"></span></a>
                  <ul class="dropdown-menu dropdown-menu-right">
              <?php if(isset($_SESSION['customer'])){
                $email = $_SESSION['customer'] ;
                $queryq = "SELECT * FROM customers WHERE customer_email = '$email'" ;
                $res = mysqli_query($conn , $queryq) ;
                $arr2 = mysqli_fetch_assoc($res) ;
                $name = $arr2['customer_name'] ;
                $img = $arr2['customer_image'] ;
              ?>
              <center>
                <br>
                  <li><img src="<?php echo '../img/' . $img; ?>" style="width: 40%; height: auto;border-radius: 200px;border: 2px solid green;"></li>
                  <br>
                  <li><a href="#"><?php echo $name; ?></a></li>
                  <li><a href="logout.php">Logout</a></li>
                  <br>
                </center>
              <?php } else { ?> 
                  <li><a href="register.php">Register</a></li>
                  <li><a href="login.php">Login</a></li>
              <?php } ?>
                  </ul>
                </li>
                <li><a href="#" id="wishlist-total" title="Wish List (0)"><i class="fa fa-heart"></i><span>Wish List</span><span> (0)</span></a></li>
              </ul>
              <div class="search-box">
                <input class="input-text" placeholder="Search By Products.." type="text">
                <button class="search-btn"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="header-inner">
      <div class="col-sm-4 col-xs-6 header-left">
        <div class="shipping">
          <div class="shipping-img"></div>
          <div class="shipping-text">(+91) 000-1233<br>
            <span class="shipping-detail">24/7 Online Support</span></div>
        </div>
      </div>
      <div class="col-sm-4 col-xs-12 header-middle">
        <div class="header-middle-top">
          <div id="logo"> <a href="index-2.html"><img src="image/logo.png" title="E-Commerce" alt="E-Commerce" class="img-responsive" /></a> </div>
        </div>
      </div>
      <div class="col-sm-4 col-xs-12 header-right">
        <div id="cart" class="btn-group btn-block">
          <button type="button" class="btn btn-inverse btn-block btn-lg dropdown-toggle cart-dropdown-button"> <span id="cart-total"><span class="cart-title">Shopping Cart</span><br>
          <?php 
            if (isset($_SESSION['products'])) {
              $arr = $_SESSION['products'] ;
              $count = count($arr) ;
            }
            else {
              $count = 0 ;
            }
          ?>
          <?php echo $count; ?> item(s)</span> </button>
          <ul class="dropdown-menu pull-right cart-dropdown-menu">
            <li>
              <table class="table table-striped">
                <tbody>
                  <?php 
                  $total = 0 ;
                  if (isset($_SESSION['products'])) {
                      $arr = $_SESSION['products'] ;
                      foreach ($arr as $key => $value) {
                        $query3 = "SELECT * FROM products WHERE product_id = " . $key ;
                        $ans2 = mysqli_query($conn , $query3) ;
                        $array = mysqli_fetch_assoc($ans2) ;
                        $product_id2 = $key ;
                        $product_name2 = $array['product_name'] ;
                        $product_img2 = $array['product_img'] ;
                        $product_price2 = $array['product_price'] ;
                        $product_sale2 = $array['product_sale'] ;
                        $newprice = (int)$product_price2 - ((int)$product_price2 * (int)$product_sale2 / 100) ;
                        $total += ($newprice * $value) ;
                  ?>
                  <tr>
                    <td class="text-center"><a href="#"><img style="width: 75px; height: auto;" class="img-thumbnail" title="lorem ippsum dolor dummy" alt="lorem ippsum dolor dummy" src="<?php echo '../img/' . $product_img2; ?>"></a></td>
                    <td class="text-left"><a href="#"><?php echo $product_name2; ?></a></td>
                    <td class="text-right">x <?php echo $value ?></td>
                    <td class="text-right"><?php echo '$' . $newprice ; ?></td>
                    <td class="text-center"><button class="btn btn-danger btn-xs" title="Remove" type="button"><i class="fa fa-times"></i></button></td>
                  </tr>
                <?php } } ?>
                </tbody>
              </table>
            </li>
            <li>
              <div>
                <table class="table table-bordered">
                  <tbody>
                    <tr>
                      <td class="text-right"><strong>Total</strong></td>
                      <td class="text-right"><?php echo '$' . $total; ?></td>
                    </tr>
                  </tbody>
                </table>
                <p class="text-right"> <span class="btn-viewcart"><a href="viewcart.php"><strong><i class="fa fa-shopping-cart"></i> View Cart</strong></a></span> <span class="btn-checkout"><a href="login.php"><strong><i class="fa fa-share"></i> Checkout</strong></a></span> </p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <nav id="menu" class="navbar">
      <div class="nav-inner">
        <div class="navbar-header"><span id="category" class="visible-xs">Categories</span>
          <button type="button" class="btn btn-navbar navbar-toggle" ><i class="fa fa-bars"></i></button>
        </div>
        <div class="navbar-collapse">
          <ul class="main-navigation">
            <li><a href="index.php" class="parent">Home</a> </li>
            <li><a href="product.php" class="parent">Shop</a> </li>
            <li><a href="#" class="active parent">Categories</a>
              <ul>
                <?php 
                $s = "SELECT * FROM categories" ; 
                $res = mysqli_query($conn , $s) ;
                while ($row = mysqli_fetch_assoc($res)) {
                    $cat_id = $row['category_id'] ;
                    $cat_name = $row['category_name'] ;
                ?>
                    <li><a href="category.php?id=<?php echo $cat_id; ?>"><?php echo $cat_name ; ?></a></li>
                <?php } ?>
              </ul>
            </li>
            <li><a href="about.php" >About us</a></li>
            <li><a href="contact.php" >Contact Us</a> </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
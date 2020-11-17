<?php 

if(isset($_GET['id'])){
include '../includes/config.php' ;
include '../includes/publicheader.php' ;
$sql = "SELECT * FROM providers WHERE provider_id = {$_GET['id']}" ;
$res = mysqli_query($conn , $sql) ;
$arr = mysqli_fetch_assoc($res) ;

$id = $arr['provider_id'] ;
$name = $arr['provider_name'] ;
$Email = $arr['provider_email'] ;
$desc = $arr['provider_desc'] ;
$img = $arr['provider_img'] ;
$location = $arr['provider_location'] ;

?>
<div class="container">
<div class="jumbotron" id="maindiv">
  <center>
    <h1 id="providername"><?php echo $name; ?></h1>
 <div id="provider_img" style="background:#fff url('<?php echo '../img/' . $img ; ?>');"></div>
  </center>
</div>
</div>

<div class="container text-center">

  <h2 class="texti">About</h2>

  <h3 class="subtext">Location : <?php echo $location; ?></h3>
  <h3 class="subtext">Email Address : <?php echo $Email ?></h3>

  <br><br>

  <h2 class="texti">Products</h2>
  <div class="row">

    <div id="content" class="col-sm-12">
      <div class="customtab">
        <div id="tab-latest" class="tab-content">
          <div class="box">
            <div id="latest-slidertab" class="row owl-carousel product-slider">

            <!-------------------------------------------------------------------------------------->
                              <!-- Products -->
              <?php 
              $query2 = "SELECT * FROM products WHERE provider_id = {$_GET['id']}" ;
              $ans = mysqli_query($conn , $query2) ;
              while ($row = mysqli_fetch_assoc($ans)) {
                $product_id = $row['product_id'] ;
                $product_name = $row['product_name'] ;
                $product_price = $row['product_price'] ;
                $product_sale = $row['product_sale'] ;
                $product_img = $row['product_img'] ;
                $provider_id = $row['provider_id'] ;
                $product_desc = $row['product_desc'] ;
                $current_price = (int)$product_price - ((int)$product_price * (int)($product_sale) / 100) ;
              ?>
              <div class="item">
                <div class="product-thumb transition">
                  <div class="image product-imageblock"> 
                    <a href="product.html">
                      <div style="background-image: url('<?php echo '../img/' . $product_img ; ?>'); background-size: cover ; width: auto; height: 300px;"></div>
                    </a>
                    <div class="button-group">
                      <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                      <a href="item.php?id=<?php echo $product_id; ?>" type="button" class="addtocart-btn">Add to cart</a>
                      <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>

                  <div class="caption product-detail">
                    <h4 class="product-name"><a href="product.html" title="lorem ippsum dolor dummy"><?php echo $product_desc; ?></a></h4>
                    <p class="price product-price"> <span class="price-new">$<?php echo $current_price; ?></span> <span class="price-old">$<?php echo $product_price; ?></span> <span class="price-tax">Ex Tax: $210.00</span> </p>
                  </div>
                </div>
              </div>
              <?php  
              }
              ?>
            </div>
          </div>
        </div>
                                <!-- End Product -->
              <!-------------------------------------------------------------------------------------->

      </div>
    </div>
  </div>
</div>

<?php 

include '../includes/publicfooter.php' ;

} else {
  header('location:index.php') ;
}

?>


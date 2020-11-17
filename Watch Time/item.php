<?php 

if(isset($_GET['id'])){
include '../includes/config.php' ;
include '../includes/publicheader.php' ;
$sql = "SELECT * FROM products WHERE product_id = {$_GET['id']}" ;
$res = mysqli_query($conn , $sql) ;
$arr = mysqli_fetch_assoc($res) ;
$product_id = $arr['product_id'] ;
$product_name = $arr['product_name'] ;
$product_price = $arr['product_price'] ;
$product_sale = $arr['product_sale'] ;
$product_img = $arr['product_img'] ;
$product_desc = $arr['product_desc'] ;
$provider_id = $arr['provider_id'] ;
$prov = $arr['provider_id'] ;
$new_price = $product_price - ( $product_price * $product_sale / 100 ) ;
$s = "SELECT provider_name FROM providers WHERE provider_id = $provider_id";
$ans = mysqli_query($conn , $s) ; 
$a = mysqli_fetch_assoc($ans) ;
?>

<div class="container">
  <ul class="breadcrumb">
    <li><a href="index-2.html"><i class="fa fa-home"></i></a></li>
    <li><a href="category.html">Shop</a></li>
    <li><a href="#">Product</a></li>
  </ul>
  <div class="row">
    <div id="column-left" class="col-sm-3 hidden-xs column-left">
      <div class="column-block">
        <div class="column-block">
          <div class="columnblock-title">Categories</div>
            <div class="category_block">
               <ul class="box-category treeview-list treeview">
                    <?php  
                    $sql = "SELECT * FROM categories" ;
                    $res = mysqli_query($conn , $sql) ;
                    while($row = mysqli_fetch_assoc($res)){
                      $cat_id = $row['category_id'] ;
                      $cat_name = $row['category_name'] ;
                    ?>
                    <li>
                     <a href="category.php?id=<?php echo($cat_id); ?>"><?php echo $cat_name; ?></a>
                    </li>
                  <?php } ?>
               </ul>
            </div>
        </div>

      </div>
    </div>
    <div id="content" class="col-sm-9">
      <div class="row">
        <div class="col-sm-6">
          <div class="thumbnails">
            <div><a class="thumbnail" href="image/product/product8.jpg" title="lorem ippsum dolor dummy"><img src="<?php echo '../img/' . $product_img ; ?>" style="width: 60%; height: auto; border: 1px solid black;" title="lorem ippsum dolor dummy" alt="lorem ippsum dolor dummy" /></a></div>
            <div id="product-thumbnail" class="owl-carousel">
             
             <?php 

                $query = "SELECT * FROM product_image WHERE product_id = $product_id" ;
                $res2 = mysqli_query($conn , $query) ;
                while($row = mysqli_fetch_assoc($res2)){
                  $img = $row['image'] ;
                ?>
              <div class="item">
                <div class="image-additional"><a class="thumbnail  " href="<?php echo '../img/' . $img ; ?>" title="lorem ippsum dolor dummy"> <img src="<?php echo '../img/' . $img ; ?>" title="lorem ippsum dolor dummy" alt="lorem ippsum dolor dummy" /></a></div>
              </div>

            <?php } ?>

            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <h1 class="productpage-title"><?php echo $product_name; ?></h1>

          <ul class="list-unstyled productinfo-details-top">
            <li>
              <h2 class="productpage-price"><?php echo '$' . $new_price ?></h2>
            </li>
            <li><span class="productinfo-tax">SALE : <?php echo $product_sale . '%'; ?></span></li>
            <li><span class="productinfo-tax">OLD PRICE : <?php echo $product_price . '$'; ?></span></li>
          </ul>
          <hr>
          <ul class="list-unstyled product_info">
            <li>
              <label>Provider :</label>
              <span><a href="providers.php?id=<?php echo $prov; ?>"><?php echo $a['provider_name'] ; ?></a></span></li>
          </ul>
          <hr>
          <p class="product-desc">
          	<?php
          		echo $product_desc ; 
          	?>
          </p>
          <div id="product">
            <div class="form-group">
            <form method="post" action="addtocart.php">
              <label class="control-label qty-label" for="input-quantity">Qty</label>
              <input type="text" value="1" name="qty" size="2" id="input-quantity" class="form-control productpage-qty" />
              <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
              <div class="btn-group">
                <button type="button" data-toggle="tooltip" class="btn btn-default wishlist" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                <input type="submit" id="button-cart" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block addtocart" value="Add To Cart" name="add">
                <button type="button" data-toggle="tooltip" class="btn btn-default compare" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
              </div>
          </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
</div>


<?php 

include '../includes/publicfooter.php' ;
}
else {
	header('location:product.php') ;
}

?>
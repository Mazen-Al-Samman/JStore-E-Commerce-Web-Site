<?php  
include '../includes/config.php' ;
include '../includes/publicheader.php' ;
?>


<div class="container">
  <div class="mainbanner">
  <div id="main-banner" class="owl-carousel home-slider">
    <div class="item"> <a href="#"><img src="image/banners/Main-Banner1.jpg" alt="main-banner1" class="img-responsive" /></a> </div>
    <div class="item"> <a href="#"><img src="image/banners/Main-Banner2.jpg" alt="main-banner2" class="img-responsive" /></a> </div>
    <div class="item"> <a href="#"><img src="image/banners/Main-Banner3.jpg" alt="main-banner3" class="img-responsive" /></a> </div>
  </div>
</div>
</div>
<div class="container">

  <div class="row"> 

  		<!-------------------------------------------------------------------------------------->
  											<!-- Brands --> 
        <h3 class="productblock-title">Providers</h3>
        <div id="brand_carouse" class="owl-carousel brand-logo" style="margin-top: 0 !important ;">
        <?php  
        $query = "SELECT * FROM providers" ;
        $res = mysqli_query($conn , $query) ;
        while ($row = mysqli_fetch_assoc($res)) {
          $provider_id = $row['provider_id'] ;
          $provider_img = $row['provider_img'] ;
        ?>
          <div class="item text-center"> <a href="providers.php?id=<?php echo($provider_id) ?>"><img src="<?php echo '../img/'.$provider_img ; ?>" alt="<?php echo $provider_img ?>" class="img-responsive" /></a> </div>

        <?php
        }
        ?>
      </div>
      										<!-- End Brands -->
      <!-------------------------------------------------------------------------------------->

      <!-------------------------------------------------------------------------------------->
      										<!-- Categories -->
    <div class="cms_banner">
      <div class="col-md-4 cms-banner-left"> <a href="#"><img alt="#" src="image/banners/subbanner1.jpg"></a> </div>
      <div class="col-md-4 cms-banner-middle"><a href="#"> <img alt="#" src="image/banners/subbanner2.jpg"></a></div>
      <div class="col-md-4 cms-banner-right"> <a href="#"><img alt="#" src="image/banners/subbanner3.jpg"></a> </div>
    </div>
    										<!-- End Categories -->
    <!-------------------------------------------------------------------------------------->

  </div>


  <div class="row">

    <div id="content" class="col-sm-12">
      <div class="customtab">
        <div id="tabs" class="customtab-wrapper">
          <ul class='customtab-inner'>
            <li class='tab'><a href="#tab-latest">Latest Product</a></li>
          </ul>
        </div>
        <div id="tab-latest" class="tab-content">
          <div class="box">
            <div id="latest-slidertab" class="row owl-carousel product-slider">

            <!-------------------------------------------------------------------------------------->
            									<!-- Products -->
              <?php 
              $query2 = "SELECT * FROM products" ;
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
                  <div class="image product-imageblock"> <a href="item.php?id=<?php echo $product_id; ?>">
                    <div style="background-image: url('<?php echo '../img/' . $product_img ; ?>'); background-size: cover ; width: auto; height: 300px;">
                        </div>
                  </a>
                    <div class="button-group">
                      <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List" ><i class="fa fa-heart-o"></i></button>
                      <a href="item.php?id=<?php echo $product_id; ?>" type="button" class="addtocart-btn">Add to cart</a>
                      <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product" ><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>

                  <div class="caption product-detail">
                    <h4 class="product-name"><a href="item.php?id=<?php echo $product_id; ?>" title="lorem ippsum dolor dummy"><?php echo $product_desc; ?></a></h4>
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

<div id="subbanner4" class="banner" >
<div class="item"> <a href="#"><img src="image/banners/subbanner4.jpg" alt="Sub Banner4" class="img-responsive" /></a> </div>
</div>  
</div>

<?php  
include '../includes/publicfooter.php' ;
?>
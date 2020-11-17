<?php  
   include '../includes/config.php' ;
   include '../includes/publicheader.php' ;
   ?>
<div class="container">
   <!-- ================================================================== -->
   <!-- Current Page -->
   <ul class="breadcrumb">
      <li><a href="index-2.html"><i class="fa fa-home"></i></a></li>
      <li><a href="category.html">Category</a></li>
   </ul>
   <!-- End Current Page -->
   <!-- ================================================================== -->
   <div class="row">
      <!-- ================================================================== -->
      <!-- Categories -->
      <div id="column-left" class="col-sm-3 hidden-xs column-left">
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
         <!-- End Categories -->
         <!-- ================================================================== -->
         <!-- ================================================================== -->
         <!-- Filter -->
         <div class="panel panel-default filter">
            <div class="panel-heading columnblock-title">Refine Search</div>
            <div class="filter-block">
               <div class="list-group">
                  <a class="list-group-item">Color</a>
                  <div class="list-group-item">
                     <div id="filter-group1">
                        <label class="checkbox">
                        <input name="filter[]" type="checkbox" value="1" />
                        Black (7)</label>
                        <label class="checkbox">
                        <input name="filter[]" type="checkbox" value="2" />
                        Blue (6)</label>
                        <label class="checkbox">
                        <input name="filter[]" type="checkbox" value="3" />
                        Red (6)</label>
                     </div>
                  </div>
                  <a class="list-group-item">Price</a>
                  <div class="list-group-item">
                     <div id="filter-group2">
                        <label class="checkbox">
                        <input name="filter[]" type="checkbox" value="4" />
                        $100-$300 (6)</label>
                        <label class="checkbox">
                        <input name="filter[]" type="checkbox" value="5" />
                        $301-$1000 (6)</label>
                     </div>
                  </div>
               </div>
               <div class="panel-footer text-right">
                  <button type="button" id="button-filter" class="btn btn-primary">Refine Search</button>
               </div>
            </div>
         </div>
         <!-- End Filter -->
         <!-- ================================================================== -->
         <!-- ================================================================== -->
         <!-- Advertisment -->
         <div class="banner" >
            <div class="item"> <a href="#"><img src="image/banners/LeftBanner.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
         </div>
         <!-- End Advertisment -->
         <!-- ================================================================== -->
      </div>
      <div id="content" class="col-sm-9">
         <!-- ============================================================== -->
         <!-- Advertisment -->
         <div class="row category-banner">
            <div class="col-sm-12 category-image"><img src="image/banners/category-banner.jpg" alt="Desktops" title="Desktops" class="img-thumbnail" /></div>
            <div class="col-sm-12 category-desc"></div>
         </div>
         <!-- End Advertisment -->
         <!-- ============================================================== -->
         <div class="category-page-wrapper">
            <div class="col-md-6 list-grid-wrapper">
               <div class="btn-group btn-list-grid">
                  <button type="button" id="list-view" class="btn btn-default list" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default grid" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
               </div>
               <a href="#" id="compare-total">Product Compare (0)</a> 
            </div>
            <div class="col-md-1 text-right page-wrapper">
               <label class="control-label" for="input-limit">Show :</label>
               <div class="limit">
                  <select id="input-limit" class="form-control">
                     <option value="8" selected="selected">8</option>
                     <option value="25">25</option>
                     <option value="50">50</option>
                     <option value="75">75</option>
                     <option value="100">100</option>
                  </select>
               </div>
            </div>
            <div class="col-md-2 text-right sort-wrapper">
               <label class="control-label" for="input-sort">Sort By :</label>
               <div class="sort-inner">
                  <select id="input-sort" class="form-control">
                     <option value="ASC" selected="selected">Default</option>
                     <option value="ASC">Name (A - Z)</option>
                     <option value="DESC">Name (Z - A)</option>
                     <option value="ASC">Price (Low &gt; High)</option>
                     <option value="DESC">Price (High &gt; Low)</option>
                     <option value="DESC">Rating (Highest)</option>
                     <option value="ASC">Rating (Lowest)</option>
                     <option value="ASC">Model (A - Z)</option>
                     <option value="DESC">Model (Z - A)</option>
                  </select>
               </div>
            </div>
         </div>
         <br>
         <div class="grid-list-wrapper">
            <!-- ================================================================================================== -->
            <!-- Products -->
            <?php  
               $query = "SELECT * FROM products WHERE provider_id in (SELECT provider_id FROM providers WHERE provider_cat = {$_GET['id']})" ;
               $res = mysqli_query($conn , $query) ;
               while($row = mysqli_fetch_assoc($res)){
                 $product_id = $row['product_id'] ;
                 $product_name = $row['product_name'] ;
                 $product_price = $row['product_price'] ;
                 $product_sale = $row['product_sale'] ;
                 $product_img = $row['product_img'] ;
                 $provider_id = $row['provider_id'] ;
                 $product_desc = $row['product_desc'] ;
                 $current_price = (int)$product_price - ((int)$product_price * (int)($product_sale) / 100) ;
               ?>
            <div class="product-layout product-list col-xs-12">
               <div class="product-thumb">
                  <div class="image product-imageblock">
                     <a href="product.html">
                        <div style="background-image: url('<?php echo '../img/' . $product_img ; ?>'); background-size: cover ; width: 200px; height: 300px;">
                        </div>
                     </a>
                     <div class="button-group">
                        <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                        <a type="button" class="addtocart-btn" href="addtocart.php?<?php echo $product_id; ?>">Add to Cart</a>
                        <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                     </div>
                  </div>
                  <div class="caption product-detail">
                     <h4 class="product-name"> <a href="product.html" title=""><?php echo $product_name; ?></a> </h4>
                     <p class="product-desc"><?php echo $product_desc; ?>
                     </p>
                     <p class="price product-price"> <span class="price-new">$<?php echo $current_price; ?></span> <span class="price-old">$<?php echo $product_price; ?></span> </p>
                     <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                     <button type="button" class="wishlist" data-toggle="tooltip" title="Add to Wish List"><i class="fa fa-heart-o"></i></button>
                     <a type="button" class="addtocart-btn" href="addtocart.php?<?php echo $product_id; ?>">Add to Cart</a>
                     <button type="button" class="compare" data-toggle="tooltip" title="Compare this Product"><i class="fa fa-exchange"></i></button>
                  </div>
               </div>
            </div>
            <?php } ?>
            <!-- End Product -->
            <!-- ========================================================================================================= -->
         </div>
      </div>
   </div>
</div>
<?php  
  include '../includes/publicfooter.php' ;
?>
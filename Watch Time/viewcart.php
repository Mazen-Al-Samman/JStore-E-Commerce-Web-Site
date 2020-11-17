<?php  
   include '../includes/config.php' ;
   include '../includes/publicheader.php' ;
   $total2 = 0 ;

   ?>

<div class="container">
  <div class="row">
  <div class="col-sm-12" id="content">
      <h1>Shopping Cart</h1>
      <form enctype="multipart/form-data" method="post" action="#">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="15%" class="text-center">Image</th>
                <th width="10%" class="text-left">Product Name</th>
                <th width="10%" class="text-left">Quantity</th>
                <th width="10%" >Unit Price</th>
                <th width="10%">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php 

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
                        $totaltitem = ($newprice * $value) ;
                        $total2 += $totaltitem ;
                  ?>
              <tr>
                <td class="text-center"><a href="product.html"><img class="img-thumbnail" title="women's New Wine is an alcoholic" alt="women's New Wine is an alcoholic" style="width: 100px; height: auto;" src="<?php echo '../img/' . $product_img2; ?>"></a></td>
                <td class="text-left"><a href="product.html"><?php echo $product_name2; ?></a></td>
                <td class="text-left"><div style="max-width: 200px;" class="input-group btn-block">
                    <input type="text" class="form-control quantity" size="1" value="<?php echo($value); ?>" name="quantity">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" title="" data-toggle="tooltip" type="submit" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                    <button  class="btn btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                    </span></div></td>
                <td><?php echo '$' . $newprice; ?></td>
                <td><?php echo '$' . $totaltitem ; ?></td>
              </tr>
            <?php  } } ?>
            </tbody>
          </table>
        </div>
      </form>
      
</div>
</div>
</div>


<?php 

include '../includes/publicfooter.php' ;

?>
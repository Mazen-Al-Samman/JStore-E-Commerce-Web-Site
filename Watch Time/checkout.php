<?php 
ob_start();
include '../includes/config.php' ;
include '../includes/publicheader.php' ;
if(isset($_SESSION['products']) && isset($_SESSION['customer'])){
$total_price = 0 ;

if (isset($_POST['click'])) {
	if (!isset($_SESSION['products'])) {
		header('location:index.php') ;
	}
	$email = $_SESSION['customer'] ;
	$s = "SELECT customer_id FROM customers WHERE customer_email='$email'" ;
	$res = mysqli_query($conn , $s) ;
	$ar = mysqli_fetch_assoc($res) ;
	$id = $ar['customer_id'] ;
	$d = date('d-m-yy') ;
	$key = '';
	list($usec, $sec) = explode(' ', microtime());
	mt_srand((float) $sec + ((float) $usec * 100000));
	
   	$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));

   	for($i=0; $i<10; $i++)
	{
   	    $key .= $inputs{mt_rand(0,61)};
	}
 	$db = "INSERT INTO `orders`(`customer_id`, `order_date`, `order_state` , `order_key`) VALUES ( $id , '$d' , 'PENDING' , '$key' )";
 	mysqli_query($conn , $db) ;
 	$arr = $_SESSION['products'] ;
 	$q = "SELECT order_id FROM orders WHERE order_key='$key'" ;
 	$an = mysqli_query($conn , $q) ;
 	$arrr = mysqli_fetch_assoc($an) ;
 	$ord_id = $arrr['order_id'] ;

 	foreach ($arr as $key => $value) {
 			$sql = "INSERT INTO `order_details`(`order_id`, `order_item`, `quantity`) VALUES ($ord_id , $key , $value)" ;
 			mysqli_query($conn , $sql) ;
 		}	
 	session_unset('products') ;
 	header("Refresh:0");
}

?>
<div class="container">
  <ul class="breadcrumb">
    <li><a href="index-2.html"><i class="fa fa-home"></i></a></li>
    <li><a href="viewcart.php">Shopping Cart</a></li>
    <li><a href="checkout.php">Checkout</a></li>
  </ul>
  <div class="row">

    <div class="col-sm-12" id="content">
      <h1>Checkout</h1>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-checkout-confirm" aria-expanded="true">Confirm Order</a></h4>
          </div>
          <div id="collapse-checkout-confirm" role="heading" class="panel-collapse collapse in" aria-expanded="true" style="">
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Product Name</td>
                      <td class="text-left">Description</td>
                      <td class="text-right">Quantity</td>
                      <td class="text-right">Unit Price</td>
                      <td class="text-right">Total</td>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php  

                  	if (isset($_SESSION['products'])) {
                  		$arr = $_SESSION['products'] ;
                  		foreach ($arr as $key => $value) {
                  			$sql = "SELECT * FROM products WHERE product_id = $key";
                  			$ans = mysqli_query($conn , $sql) ;
                  			$a = mysqli_fetch_assoc($ans) ;
                  			$name = $a['product_name'] ;
                  			$product_price = $a['product_price'] ;
                  			$sale = $a['product_sale'] ;
                  			$new_pricce = $product_price - ( $product_price * $sale / 100 ) ;
                  			$desc = $a['product_desc'] ;
                  			$total = $new_pricce * $value ;
                  			$total_price += $total;

                  	?>
                    <tr>
                      <td class="text-left"><a href="http://localhost/opc001/index.php?route=product/product&amp;product_id=46"><?php echo $name ; ?></a></td>
                      <td class="text-left"><?php echo $desc ; ?></td>
                      <td class="text-right"><?php echo $value ; ?></td>
                      <td class="text-right"><?php echo '$' . $new_pricce; ?></td>
                      <td class="text-right"><?php echo "$" . $total; ?></td>
                    </tr>
                <?php } } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                      <td class="text-right"><?php echo '$' . $total_price; ?></td>
                    </tr>
                    <tr>
                      <td class="text-right" colspan="4"><strong>Delivery:</strong></td>
                      <td class="text-right">$5.00</td>
                    </tr>
                    <tr>
                      <td class="text-right" colspan="4"><strong>Total:</strong></td>
                      <td class="text-right"><?php echo '$' . ($total_price + 5); ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="buttons">
                <div class="pull-right">
            	<form method="post">
                  <input type="submit" data-loading-text="Loading..." class="btn btn-primary" id="button-confirm" name="click" value="Confirm Order">
                </form>
                </div>
              </div>
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
	echo "<script>console.write('Order Sent Successfully !');</script>" ;
	sleep(5) ;
	header('location:index.php') ;
}

?>
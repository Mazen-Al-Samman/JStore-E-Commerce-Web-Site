<?php  

if(isset($_GET['order_id'])){

include '../includes/config.php' ;
include '../includes/header.php' ;
$total = 0 ;

?>

<?php

$id = $_GET['order_id'] ;
$sql = "SELECT * FROM orders WHERE order_id = $id" ;
$sql2 = "SELECT * FROM order_details WHERE order_id = {$_GET['order_id']}" ;

$res = mysqli_query($conn , $sql) ;
$res2 = mysqli_query($conn , $sql2) ;

$arr = mysqli_fetch_assoc($res) ;

$cust = $arr['customer_id'] ;
$sql3 = "SELECT * FROM customers WHERE customer_id = $cust" ;
$res3 = mysqli_query($conn , $sql3) ;
$arr3 = mysqli_fetch_assoc($res3) ;
$customer = $arr3['customer_name'] ;

$order_date = $arr['order_date'] ;

$order_state = $arr['order_state'] ;

?>

<div id="content" class="main-content">
	<div class="container-fluid">
            <div class="layout-px-spacing">
                
                <div class="page-header">
                    <div class="page-title">
                        <h3>ORDER DETAIL</h3>
                    </div>
                </div>

                <div class="row" id="cancel-row">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6"  style="border: 1px solid blue ;">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table table-hover" style="width: 100%">
                                    <thead align="center">
                                        <tr>
                                            <th>customer</th>
                                            <th>DATE</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total price</th>
                                            <th>State</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
	

<?php

while($arr2 = mysqli_fetch_assoc($res2)){

$i = $arr2['order_item'] ; 
$sql4 = "SELECT product_name , product_price , product_sale FROM products WHERE product_id = $i" ;
$res4 = mysqli_query($conn , $sql4) ;
$arr4 = mysqli_fetch_assoc($res4) ;
$item = $arr4['product_name'] ;

$price = $arr4['product_price'] ;

$sale = $arr4['product_sale'] ;

$new_price = $price - ($price * $sale / 100) ;

$qty = $arr2['quantity'] ;

$total_item = (int)$qty * (int)$new_price ;

$total += $total_item ;

?>
<tr>
	<td><?php echo $customer; ?></td>
	<td><?php echo $order_date; ?></td>
	<td><?php echo $item; ?></td>
	<td><?php echo '$' . $new_price; ?></td>
	<td><?php echo $qty; ?></td>
	<td><?php echo $total_item; ?></td>
	<td><?php echo $order_state; ?></td>
</tr>
<?php } ?>
</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</table>

<div class="container">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4 text-center">
			<div class="alert alert-primary" role="alert">
			  TOTAL = <?php echo $total ; ?>
			</div>
		</div>
	</div>
</div>

<?php 

include '../includes/footer.php' ;
}
else {

}
?>
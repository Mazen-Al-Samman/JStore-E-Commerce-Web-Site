<?php  


if(isset($_GET['id'])){
include '../includes/config.php' ;
	$id = $_GET['id'] ;
	$sql = "UPDATE orders SET order_state = 'APPROVED' WHERE order_id = $id" ;
	mysqli_query($conn , $sql) ;
}
header('location:orders.php') ;

?>
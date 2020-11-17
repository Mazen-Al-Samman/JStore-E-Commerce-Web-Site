<?php 

session_start() ;

if (isset($_POST['add'])) {
	$id = $_POST['product_id'] ;
	$qty = $_POST['qty'] ;
	if (isset($_SESSION['products'])) {
		$arr = $_SESSION['products'];
		if (isset($arr[$id])) {
			$q = $arr[$id] ;
			$q += $qty ;
			$arr[$id] = $q ;
		}
		else {
			$arr[$id] = $qty ;
		}
	}
	else {
		$arr = array($id => $qty);
	}
	$_SESSION['products'] = $arr ;
	header('location:item.php?id=' . $id) ;
}
else {
	header('location:index.php') ;
}


?>
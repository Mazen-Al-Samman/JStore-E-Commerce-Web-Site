<?php 

session_start(); 
if (isset($_SESSION['customer'])) {
	session_unset('customer') ;
}
header('location:index.php') ;
?>
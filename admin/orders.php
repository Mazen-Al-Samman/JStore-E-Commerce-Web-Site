<?php 

session_start() ; 
if (isset($_SESSION['id'])) {
include '../includes/config.php' ;
include '../includes/header.php' ;

$sql = "SELECT * FROM orders" ;
$res = mysqli_query($conn , $sql) ;

?>

<div id="content" class="main-content">
	<div class="container-fluid">
            <div class="layout-px-spacing">
                
                <div class="page-header">
                    <div class="page-title">
                        <h3>ORDERS</h3>
                    </div>
                </div>

                <div class="row" id="cancel-row">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6" style="border: 1px solid blue ;">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="default-ordering" class="table table-hover" style="width: 100%">
                                    <thead align="center">
                                        <tr>
                                            <th>ID</th>
                                            <th>CUSTOMER</th>
                                            <th>DATE</th>
                                            <th>State</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php 

                                        while($row = mysqli_fetch_assoc($res)){
                                            $id = $row['order_id'] ;
                                            $s = "SELECT customer_name FROM customers WHERE customer_id = {$row['customer_id']}" ;
                                            $ans = mysqli_query($conn , $s) ;
                                            $arr = mysqli_fetch_assoc($ans) ;
                                            $customer = $arr['customer_name'] ;
                                            $state = $row['order_state'] ;
                                            $date = $row['order_date'] ;
                                        ?>
                                        <tr>
                                            <td><?php echo $id ; ?></td>
                                            <td><?php echo $customer; ?></td>
                                            <td><?php echo $date ; ?></td>
                                            <td><?php echo $state ; ?></td>
                                            <td>

                                                <a href="order_detail.php?order_id=<?php echo $id ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a>

                                                <a href="Edit_order.php?id=<?php echo $id; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg></a>
                                            </td>
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
 <?php 
include '../includes/footer.php' ;
?>

<?php  
}
else {
header("location:login.php") ;
}

?>
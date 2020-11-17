<?php 

session_start() ; 
if (isset($_SESSION['id'])) {
ob_start() ; 
include '../includes/config.php';
include '../includes/header.php' ;

$pro = "SELECT provider_id , provider_name FROM providers" ;
$res = mysqli_query($conn , $pro) ;

if ($_SERVER['REQUEST_METHOD']) {

	if (isset($_POST['insert'])) {

        $name = $_POST['pru_name'] ;
        $price = $_POST['pru_price'] ;
        $sale = $_POST['pru_sale'] ;
        $provider = $_POST['pro_id'] ;
        $desc = $_POST['pru_desc'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;

        $sql = "INSERT INTO `products`(`product_name`, `product_price`, `product_sale`, `product_img`, `provider_id` , product_desc) VALUES ('$name' , '$price' , '$sale' , '$img_name' , '$provider' , '$desc')" ;

        mysqli_query($conn , $sql) ;
        header("location:products2.php") ;
   }
}
$query = "SELECT * FROM products" ;
$result = mysqli_query($conn, $query);

if (isset($_POST['update'])) {
		$id = $_POST['id'] ;
		$name = $_POST['name'] ;
        $desc = $_POST['desc'] ;
        $sale = $_POST['sale'] ;
        $price = $_POST['price'] ;
        $pro_id = $_POST['pro_id'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;

        if ($_FILES['img']['error'] == 0) {

        $sql = "UPDATE products SET product_name = '$name' , product_desc = '$desc' , product_sale = '$sale' , product_price = '$price' , product_img = '$img_name' , provider_id = '$pro_id' WHERE product_id = $id" ;
        mysqli_query($conn , $sql) ;
    }
    else {
    	$sql = "UPDATE products SET product_name = '$name' , product_desc = '$desc' , product_sale = '$sale' , product_price = '$price' , provider_id = '$pro_id' WHERE product_id = $id" ; ;
        mysqli_query($conn , $sql) ;
    }
        header("location:products2.php") ;
   }

if (isset($_POST['delete'])) {
	$id = $_POST['id_del'] ;
	$q = "DELETE FROM products WHERE product_id=$id" ;
	mysqli_query($conn , $q) ;
	header("location:products2.php") ;
}
?>

<div id="content" class="main-content">
        <div class="container-fluid mt-5">

        	<!-- Form start -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mb-4 mt-5">
                    <input type="text" class="form-control" name="pru_name" id="" placeholder="Product Name" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="pru_price" id="" placeholder="Product Price" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="pru_sale" class="form-control" id="" placeholder="Product Sale" required="required">
                </div>

                <div class="form-group mb-4">
                    <input type="text" name="pru_desc" class="form-control" id="" placeholder="Product Description" required="required">
                </div>
                <div class="form-group mb-4">
                    <center>
                    <label>Provider</label><br>
                    <select name="pro_id" class="form-control" style="width: 100%">
                        <?php 
                            while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <option value=" <?php echo $row['provider_id'] ?>"> <?php echo $row['provider_name']; ?> </option>
                        <?php
                            }
                        ?> 
                    </select>
                    </center>
                </div>
                <center>
                <div class="input-group">
				  <div class="input-group-prepend" style="border: 1px solid blue">
				    <span class="input-group-text"  id="inputGroupFileAddon01" style="color: blue">Upload</span>
				  </div>
				  <div class="custom-file ml-1">
				    <input type="file" class="custom-file-input" name="img" 
				      aria-describedby="inputGroupFileAddon01">
				    <label class="custom-file-label" for="inputGroupFile01" style=" font-family: serif;">Choose file</label>
				  </div>
				</div>
				<br>

                <center>
                    <input type="submit" style="width: 50%; font-family: font1; letter-spacing: 5px;" name="insert" class="btn btn-primary btn-rounded" value="Insert a new Product">
                </center>
            </form>
        </div>
        <!-- Form End -->

        <!-- Table start -->
	    <div class="layout-px-spacing">
	        <div class="page-header">
	            <div class="page-title">
	                <h3>Providers</h3>
	            </div>
	        </div>

	        <div class="row" id="cancel-row">
	            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	                <div class="widget-content widget-content-area br-6">
	                    <div class="table-responsive mb-4 mt-4">
	                        <table id="zero-config" class="table table-hover" style="width:100%">
	                            <thead align="center">
	                                <tr>
	                                    <th style="width: 18%">Product Name</th>
	                                    <th style="width: 18%">Product Description</th>
                                      	<th style="width: 18%">Old Price</th>
                                        <th style="width: 18%">Product Sale</th>
                                        <th style="width: 18%">New Price</th>
                                        <th style="width: 18%">Product Image</th>
                                        <th style="width: 18%">Provider</th>
                                        <th style="width: 18%" class="no-content">ACTION</th>
	                                </tr>
	                            </thead>
	                            <tbody align="center">
                            		<?php
                            			while($row = mysqli_fetch_assoc($result)) {
                            				$Aid = $row['product_id'] ;
								            $Aname = $row['product_name'] ;
								            $Aprice = $row['product_price'] ;
								            $Asale = $row['product_sale'] ;
								            $Aimg = $row['product_img'] ;
								            $pid = $row['provider_id'] ;
								            $s = "SELECT provider_name FROM providers WHERE provider_id = $pid" ;
								            $res = mysqli_query($conn , $s) ;
								            $arr = mysqli_fetch_assoc($res) ;
								            $provider = $arr['provider_name'] ;
								            $desc = $row['product_desc'] ;
								            $new = $Aprice - ($Aprice * ($Asale / 100)) ;
								            ?>
								    <tr>
							            <td><?php echo $Aname; ?></td>
							            <td><?php echo $desc; ?></td>
							            <td>$<?php echo $Aprice; ?></td>
							            <td>%<?php echo $Asale; ?></td>
							            <td>$<?php echo $new; ?></td>
							            <td><img src="../img/<?php echo($Aimg) ?>" style="width: 100px; border-radius: 50%"></td>
							            <td><?php echo $provider; ?></td>
							            <td>
							            	<a href="product_img.php?id=<?php echo $Aid ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg><br></a>
							                <a onclick="f(<?php echo $Aid; ?> , '<?php echo $Aname; ?>', '<?php echo $desc; ?>' , '<?php echo $Aprice; ?>' ,' <?php echo $Asale; ?>' , '<?php echo $pid; ?>' , '<?php echo $Aimg; ?>' )" data-id="<?php echo($Aid) ; ?>" id="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" value="$Aid"><svg style="margin: 1px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
							                <form method="POST">
							                	<input type="hidden" name="id_del" value="<?php echo($Aid); ?>">
							                	<label>
							                		<svg  class="conf" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
							                		<input style="display: none" name="delete" type="submit">
							                	</label>
							                </form>
							            </td>
							            <form id="getID" method="POST">
							            	<input type="hidden" name="Aid" value="<?php echo($Aid) ; ?>">
							            </form>
							        </tr>
							        <?php } ?>
							        </tbody>
                                </table>
                                <!-- End table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit form -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Edit Product </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">
			        <form method="post" enctype="multipart/form-data">
			        		<input type="hidden" name="id" id="pru_id">
			                <div class="form-group mb-4 mt-5">
			                    <input type="text" class="form-control" name="name" id="prud_name" placeholder="Product Name" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="text" class="form-control" name="desc" id="prud_desc" placeholder="Product Description" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="text" name="price" class="form-control" id="prud_price" placeholder="Product Price" required="required">
			                </div>
							<div class="form-group mb-4">
			                    <input type="text" name="sale" class="form-control" id="prud_sale" placeholder="Product Sale" required="required">
			                </div>

			                <div class="form-group mb-4">
			                    <center>
			                    <label>Provider</label><br>
			                    <select name="pro_id" id="pro_id" class="form-control" style="width: 60%">
			                        <?php 
			                        	$pro = "SELECT provider_id , provider_name FROM providers" ;
										$res = mysqli_query($conn , $pro) ;
			                            while ($row = mysqli_fetch_assoc($res)) {
			                        ?>
			                            <option value= <?php echo $row['provider_id'] ?>> <?php echo $row['provider_name']; ?> </option>
			                        <?php
			                            }
			                        ?> 
			                    </select>
			                    </center>
			                </div>

		                <center>
		                <div class="form-group mb-4">
		                    <input class="" type="file" id="" name="img">
		                </div>
		                    <input type="submit" style="width: 75%; font-family: serif;letter-spacing: 2px" name="update" class="btn btn-primary" value="Update Admin info" required="required">
		                </center>
		                <br>
			        </form>
			      </div>
  			        	<button type="button" class="btn btn-secondary" style="width: 100%" data-dismiss="modal">Close</button>
			    </div>
			 </div>
		</div>

		<?php  
include '../includes/footer.php';
?>



<script type="text/javascript">

function f(id , name , desc , price , sale , provider , img){
	$('#pru_id').val(id) ;
	$('#prud_name').val(name) ;
	$('#prud_desc').val(desc) ;
	$('#prud_price').val(price) ;
	$('#prud_sale').val(sale) ;
	$('pro_id').val(provider) ;	
}
</script>

<?php  

}
else {
	header("location:login.php") ;
}

?>
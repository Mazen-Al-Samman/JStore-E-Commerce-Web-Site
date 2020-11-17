<?php 

session_start() ; 
if (isset($_SESSION['id'])) {
ob_start() ; 
include "../includes/config.php" ;
include "../includes/header.php" ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insert'])) {
        $name = $_POST['name'] ;
        $email = $_POST['email'] ;
        $pass = $_POST['pass'] ;
        $ads = $_POST['ads'] ;
        $phone = $_POST['phone'];
        $date = $_POST['dob'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;
        $sql = "INSERT INTO `customers`(`customer_name`, `customer_email`, `customer_pass`, `customer_image`, `customer_address`, `customer_phone`, `customer_dob`) VALUES ('$name' , '$email' , '$pass' , '$img_name' , '$ads' , '$phone' , '$date')" ;
        mysqli_query($conn , $sql) ;
        
        header("location:customers2.php") ;
   }
}
$query = "SELECT * FROM customers" ;
$result = mysqli_query($conn, $query);

if (isset($_POST['Edit'])) {
		$id = $_POST['id'] ;
		$name = $_POST['name'] ;
        $email = $_POST['email'] ;
        $pass = $_POST['pass'] ;
        $phone = $_POST['phone'] ;
        $ads = $_POST['ads'] ;
        $dob = $_POST['dob'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;

        if ($_FILES['img']['error'] != 0) {

        $sql = "UPDATE `customers` SET `customer_name`='$name',`customer_email`='$email',`customer_pass`='$pass',`customer_address`='$ads',`customer_phone`='$phone',`street_name`='$dob' WHERE  customer_id = $id" ;
        mysqli_query($conn , $sql) ;
    }
    else {
        $sql = "UPDATE `customers` SET `customer_name`='$name',`customer_email`='$email',`customer_pass`='$pass',`customer_image`='$img_name',`customer_address`='$ads',`customer_phone`='$phone',`street_name`='$dob'WHERE  customer_id = $id" ;
        mysqli_query($conn , $sql) ;
    }
        header("location:customers2.php") ;
   }

if (isset($_POST['delete'])) {
	$id = $_POST['id_del'] ;
	$q = "DELETE FROM customers WHERE customer_id=$id" ;
	mysqli_query($conn , $q) ;
	header("location:customers2.php") ;
}
?>

<div id="content" class="main-content">
        <div class="container-fluid mt-5">

        	<!-- Form start -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mb-4 mt-5">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Customer Name" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="email" class="form-control" name="email" id="formGroupExampleInput2" placeholder="Customer Email" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="password" name="pass" class="form-control" id="formGroupExampleInput2" placeholder="Customer Password" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="ads" class="form-control" id="formGroupExampleInput2" placeholder="Customer Address" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="phone" class="form-control" id="formGroupExampleInput2" placeholder="Customer Phone" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="date" name="dob" class="form-control" id="formGroupExampleInput2" placeholder="Date Of Birth" required="required">
                </div>
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
                    <input type="submit" style="width: 50%; font-family: font1; letter-spacing: 5px;" name="insert" class="btn btn-primary btn-rounded" value="Insert a new Customer">
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
	            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing" >
	                <div class="widget-content widget-content-area br-6" style="border: 1px solid blue ;">
	                    <div class="table-responsive mb-4 mt-4">
	                        <table id="zero-config" class="table table-hover" style="width:100%">
	                            <thead align="center">
	                                <tr>
	                                  	<th style="width: 15%">Name</th>
                                        <th style="width: 15%">Email</th>
                                        <th style="width: 15%">Image</th>
                                        <th style="width: 15%">City</th>
                                        <th style="width: 15%">Street</th>
                                        <th style="width: 15%">Phone</th>
                                        <th style="width: 15%" class="no-content">ACTION</th>
	                                </tr>
	                            </thead>
	                            <tbody align="center">
                            		<?php
                            			while($row = mysqli_fetch_assoc($result)) {
								            $Aname = $row['customer_name'] ;
								            $Aemail = $row['customer_email'] ;
								            $Aimg = $row['customer_image'] ;
								            $Aads = $row['customer_address'] ;
								            $Aphone = $row['customer_phone'] ;
								            $Adob = $row['street_name'] ;
								            $Aid = $row['customer_id'] ;
								            $Apass = $row['customer_pass']
								    ?>
								    <tr>
							            <td><?php echo $Aname; ?></td>
							            <td><?php echo $Aemail; ?></td>
							            <td><img src="../img/<?php echo($Aimg) ?>" style="width: 100px; border-radius: 50%"></td>
							            <td><?php echo $Aads; ?></td>
							            <td><?php echo $Adob; ?></td>
							            <td><?php echo $Aphone; ?></td>
							            <td>
							                <a onclick="f('<?php echo $Aid; ?>' , '<?php echo $Aname; ?>' , '<?php echo $Aemail; ?>' , '<?php echo $Apass; ?> ',' <?php echo $Aimg; ?>' , '<?php echo $Aads; ?>' , '<?php echo $Aphone; ?>' , '<?php echo $Adob ?>')" data-id="<?php echo($Aid) ; ?>" id="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" value="$Aid"><svg style="margin: 1px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
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
			        <h5 class="modal-title" id="exampleModalLabel">Edit Customer </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">
			        <form method="post" enctype="multipart/form-data">
			        	<input type="hidden" name="id" id="cus_id">
				        <div class="form-group mb-4 mt-5">
				            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name">
				        </div>
				        <div class="form-group mb-4">
				            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
				        </div>
				        <div class="form-group mb-4">
				            <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
				        </div>
				        <div class="form-group mb-4">
				            <input type="text" name="ads" class="form-control" id="ads" placeholder="Address">
				        </div>
				        <div class="form-group mb-4">
				            <input type="text" name="dob" class="form-control" id="dob" placeholder="Date of birth">
				        </div>
				        <div class="form-group mb-4">
				            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone">
				        </div>
				        <center>
				        <div class="form-group mb-4">
				            <input type="file" id="img" name="img">
				        </div>
				        </center>
				        <center>
				        <input type="submit" style="width: 75%" name="Edit" class="btn btn-primary" value="Update">
				        </center>
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

function f(id , name , email , pass , img , ads , phone , dob){
	$('#cus_id').val(id) ;
	$('#name').val(name) ;
	$('#email').val(email) ;
	$('#pass').val(pass);
	$('#ads').val(ads);
	$('#phone').val(phone);
	$('#dob').val(dob);	
}

</script>

<?php 

}
else {
header('location:login.php') ;
}
 ?>

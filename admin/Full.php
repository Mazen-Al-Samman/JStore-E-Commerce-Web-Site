<?php 

session_start() ; 
if (isset($_SESSION['id'])) {
ob_start() ; 
include '../includes/config.php';
include '../includes/header.php';

$sql2 = "SELECT * FROM categories" ;
$res2 = mysqli_query($conn , $sql2) ;

$query = "SELECT * FROM providers" ;
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insert'])) {

        $cat_id = $_POST['cats'] ;
        $name = $_POST['name'] ;
        $email = $_POST['email'] ;
        $pass = $_POST['pass'] ;
        $ads = $_POST['ads'] ;
        $desc = $_POST['desc'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;
        

        $sql = "INSERT INTO `providers`(`provider_name`, `provider_email`, `provider_pass`, `provider_desc`, `provider_img`, `provider_location`, `provider_cat`) VALUES ('$name' , '$email' , '$pass' , '$desc' , '$img_name' , '$ads' , $cat_id)" ;

        mysqli_query($conn , $sql) ;
        header("location:full.php") ;
   }
}

if (isset($_POST['update'])) {
	$id = $_POST['pro_id'] ;
	$cat_id = $_POST['cats'] ;
    $name = $_POST['name'] ;
    $email = $_POST['email'] ;
    $pass = $_POST['pass'] ;
    $ads = $_POST['ads'] ;
    $desc = $_POST['desc'] ;
    $tmp = $_FILES['img']['tmp_name'] ;
    $img_name = $_FILES['img']['name'] ;
    $file_name = '../img/' ;
    $dest = $file_name . $img_name ;
    move_uploaded_file($tmp, $dest) ;
    $sql = "" ;
    echo $img_name;
    if ($_FILES['img']['error'] == 0) {
        $sql = "UPDATE `providers` SET `provider_name`='$name',`provider_email`='$email',`provider_pass`='$pass',`provider_desc`='$desc',`provider_img`='$img_name',`provider_location`='$ads',`provider_cat`='$cat_id' WHERE provider_id = $id" ;
    }
    else {
        $sql = "UPDATE `providers` SET `provider_name`='$name',`provider_email`='$email',`provider_pass`='$pass',`provider_desc`='$desc',`provider_location`='$ads',`provider_cat`='$cat_id' WHERE provider_id = $id" ;
    }
    mysqli_query($conn , $sql) ;
    header("location:full.php") ;
}

if (isset($_POST['delete'])) {
	$id = $_POST['id_del'] ;
	$q = "DELETE FROM providers WHERE provider_id=$id" ;
	mysqli_query($conn , $q) ;
	header("location:full.php") ;
}
?>

<div id="content" class="main-content">
        <div class="container-fluid mt-5">

        	<!-- Form start -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mb-4 mt-5">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Provider Name" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="email" class="form-control" name="email" id="formGroupExampleInput2" placeholder="Provider Email" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="password" name="pass" class="form-control" id="formGroupExampleInput2" placeholder="Provider Password" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="ads" class="form-control" id="formGroupExampleInput2" placeholder="Provider Address" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" name="desc" class="form-control" id="formGroupExampleInput2" placeholder="Provider Description" required="required">
                </div>
                <div class="form-group mb-4">
                    <center>
                    <label>CATEGORY</label><br>
                    <select name="cats" class="form-control" style="width: 100%">
                        <?php 
                            while ($row = mysqli_fetch_assoc($res2)) {
                        ?>
                            <option value= <?php echo $row['category_id'] ?>> <?php echo $row['category_name']; ?> </option>
                        <?php
                            }
                        ?> 
                    </select>
                    </center>
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
                    <input type="submit" style="width: 50%; font-family: font1; letter-spacing: 5px;" name="insert" class="btn btn-primary btn-rounded" value="Insert a new Provider">
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
	                <div class="widget-content widget-content-area br-6" style="border: 1px solid blue ;">
	                    <div class="table-responsive mb-4 mt-4">
	                        <table id="zero-config" class="table table-hover" style="width:100%">
	                            <thead align="center">
	                                <tr>
	                                    <th style="width: 15%">Name</th>
	                                    <th style="width: 15%">Email</th>
	                                    <th style="width: 15%">Image</th>
	                                    <th style="width: 15%">Address</th>
	                                    <th style="width: 15%">Description</th>
	                                    <th style="width: 15%">Category</th>
	                                    <th style="width: 15%" colspan="2" class="no-content">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody align="center">
                            		<?php
                            			$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
								        while($row = mysqli_fetch_assoc($result)) {
								            $Aname = $row['provider_name'] ;
								            $Aemail = $row['provider_email'] ;
								            $Apass = $row['provider_pass'] ;
								            $Aimg = $row['provider_img'] ;
								            $Aads = $row['provider_location'] ;
								            $Adesc = $row['provider_desc'] ;
								            $Aid = $row['provider_id'] ;
								            $s = "SELECT * FROM categories WHERE category_id = (SELECT provider_cat FROM providers WHERE provider_id = $Aid)" ;
								            $res = mysqli_query($conn , $s) ;
								            $arr = mysqli_fetch_assoc($res) ;
								            $cat = $arr['category_name'] ;
								            $cat2 = $arr['category_id'] ;
								            
								            
								    ?>
								    <tr>
							            <td><?php echo $Aname; ?></td>
							            <td><?php echo $Aemail; ?></td>
							            <td><img src="../img/<?php echo($Aimg) ?>" style="width: 100px; border-radius: 50%"></td>
							            <td><?php echo $Aads; ?></td>
							            <td><?php echo $Adesc; ?></td>
							            <td><?php echo $cat; ?></td>
							            <td>
							                <a onclick="f('<?php echo $Aid; ?>' , '<?php echo $Aname; ?>' , '<?php echo $Aemail; ?>' , '<?php echo $Apass; ?> ',' <?php echo $Aimg; ?>' , '<?php echo $Adesc; ?>' , '<?php echo $cat2; ?>' , '<?php echo($Aads); ?>')" data-id="<?php echo($Aid) ; ?>" id="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" value="$Aid"><svg style="margin: 1px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
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
			        <h5 class="modal-title" id="exampleModalLabel">Edit Provider </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">
			        <form method="post" enctype="multipart/form-data">
			        		<input type="hidden" name="pro_id" id="pro_id">
			                <div class="form-group mb-4 mt-5">
			                    <input type="text" class="form-control" name="name" id="pro_name" placeholder="Provider Name" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="email" class="form-control" name="email" id="pro_email" placeholder="Provider Email" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="password" name="pass" class="form-control" id="pro_pass" placeholder="Provider Password" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="text" name="ads" class="form-control" id="pro_ads" placeholder="Provider Address" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="text" name="desc" class="form-control" id="pro_desc" placeholder="Provider Description" required="required">
			                </div>
			                <div class="form-group mb-4">

		                    <center>
		                    <label>CATEGORY</label><br>
		                    <select name="cats" class="form-control" style="width: 60%" id="pro_cat">
		                        <?php 
		                        	$sql2 = "SELECT * FROM categories" ;
									$res2 = mysqli_query($conn , $sql2) ;
		                            while ($row = mysqli_fetch_assoc($res2)) {
		                        ?>
		                            <option value= <?php echo $row['category_id'] ?>> <?php echo $row['category_name']; ?> </option>
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

		                    <input type="submit" style="width: 75%; font-family: serif;letter-spacing: 2px" name="update" class="btn btn-primary" value="Update provider info" required="required">
		                </center>
		                <br>
			        </form>
			      </div>
  			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    </div>
			 </div>
		</div>

		<?php  
include '../includes/footer.php';
?>



<script type="text/javascript">

function f(id , name , email , pass , img , desc , cat , ads){
	$("#pro_id").val(id) ; 
	$("#pro_name").val(name) ;
	$("#pro_email").val(email) ;
	$("#pro_pass").val(pass) ;
	$("#pro_desc").val(desc) ;
	$("#pro_img").val(img) ;
	$("#pro_cat").val(cat) ;
	$("#pro_ads").val(ads) ;
}

function del(id){
	
}

</script>

<?php  

}
else {
	header("location:login.php") ;
}

?>
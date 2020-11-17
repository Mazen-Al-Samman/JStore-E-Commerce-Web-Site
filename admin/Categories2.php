<?php

session_start() ; 
if (isset($_SESSION['id'])) {

ob_start() ; 
include '../includes/config.php';
include '../includes/header.php';

$query = "SELECT * FROM categories" ;
$result = mysqli_query($conn , $query) ;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insert'])) {

        $name = $_POST['name'] ;
        $desc = $_POST['desc'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;

        $sql = "INSERT INTO `categories`(`category_name`, `category_img`, `category_desc`) VALUES ('$name' , '$img_name' , '$desc')" ;

        mysqli_query($conn , $sql) ;
        header("location:categories2.php") ;
   }
}

if (isset($_POST['update'])) {
	$id = $_POST['cat_id'] ;
    $name = $_POST['cat_name'] ;
    $desc = $_POST['cat_desc'] ;
    $tmp = $_FILES['img']['tmp_name'] ;
    $img_name = $_FILES['img']['name'] ;
    $file_name = '../img/' ;
    $dest = $file_name . $img_name ;
    move_uploaded_file($tmp, $dest) ;
    $sql = "" ;
    echo $img_name;
    if ($_FILES['img']['error'] == 0) {
        $sql = "UPDATE `categories` SET category_name = '$name' , category_desc = '$desc' , category_img = '$img_name' WHERE category_id = $id" ;
    }
    else {
        $sql = "UPDATE `categories` SET category_name = '$name' , category_desc = '$desc' WHERE category_id = $id" ;
    }
    mysqli_query($conn , $sql) ;
    header("location:categories2.php") ;
}

if (isset($_POST['delete'])) {
	$id = $_POST['id_del'] ;
	$q = "DELETE FROM categories WHERE category_id=$id" ;
	mysqli_query($conn , $q) ;
	header("location:Categories2.php") ;
}
?>

<div id="content" class="main-content">
        <div class="container-fluid mt-5">

        	<!-- Form start -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mb-4 mt-5">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Category Name" required="required">
                </div>
                <div class="form-group mt-3 mb-3">
                    <input type="text" class="form-control" name="desc" id="formGroupExampleInput" placeholder="Category Description" required="required">
                </div>

     			<div class="input-group">
				  <div class="input-group-prepend" style="border: 1px solid blue">
				    <span class="input-group-text"  id="inputGroupFileAddon01" style="color: blue">Upload</span>
				  </div>
				  <div class="custom-file ml-1">
				    <input type="file" class="custom-file-input" name="img" 
				      aria-describedby="inputGroupFileAddon01" required="required">
				    <label class="custom-file-label" for="inputGroupFile01" style=" font-family: serif;">Choose file</label>
				  </div>
				</div>
				<br>

                <center>
                    <input type="submit" style="width: 50%; font-family: font1; letter-spacing: 5px;" name="insert" class="btn btn-primary btn-rounded" value="Insert a new Category">
                </center>
            </form>
        </div>
        <!-- Form End -->

        <!-- Table start -->
	    <div class="layout-px-spacing">
	        <div class="page-header">
	            <div class="page-title">
	                <h3>Categories</h3>
	            </div>
	        </div>

	        <div class="row" id="cancel-row">
	            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
	                <div class="widget-content widget-content-area br-6" style="border: 1px solid blue">
	                    <div class="table-responsive mb-4 mt-4">
	                        <table id="zero-config" class="table table-hover" style="width:100%">
	                            <thead align="center">
	                                <tr>
	                                    <th style="width: 25%">Name</th>
                                        <th style="width: 25%">Description</th>
                                        <th style="width: 25%">Image</th>
                                        <th style="width: 25%" class="no-content">ACTION</th>
	                                </tr>
	                            </thead>
	                            <tbody align="center">
                            		<?php
                            			while($row = mysqli_fetch_assoc($result)) {
							            $Aname = $row['category_name'] ;
							            $Aimg = $row['category_img'] ;
							            $Adesc = $row['category_desc'] ;
							            $Aid = $row['category_id'] ;
								    ?>
								    <tr>
							            <td><?php echo $Aname; ?></td>
							            <td><?php echo $Adesc; ?></td>
							            <td><img src="../img/<?php echo($Aimg) ?>" style="width: 100px; border-radius: 50%"></td>
							            <td>
							                <a onclick="f(<?php echo $Aid; ?>  , '<?php echo $Aname; ?>' , '<?php echo $Adesc; ?>');" data-id="<?php echo($Aid) ; ?>" id="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" value="$Aid"><svg style="margin: 1px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
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
			        <h5 class="modal-title" id="exampleModalLabel">Edit Category </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">
			        <form method="post" enctype="multipart/form-data">
			        		<input type="hidden" name="cat_id" id="id">
			                <div class="form-group mb-4 mt-5">
			                    <input type="text" class="form-control" name="cat_name" id="name" placeholder="Category Name" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="text" class="form-control" name="cat_desc" id="desc" placeholder="Category descriptition" required="required">
			                </div>
			                <center>
			                <div class="form-group mb-4">
		                    <input class="" type="file" id="" name="img">
		                	</div>
		                    <input type="submit" style="width: 75%; font-family: serif;letter-spacing: 2px" name="update" class="btn btn-primary" value="Update category info" required="required">
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

function f(id , name , desc){
	$('#id').val(id);
	$('#name').val(name) ;
	$('#desc').val(desc) ;
}

</script>

<?php 

}
else {
	header("location:login.php") ;
}

?>
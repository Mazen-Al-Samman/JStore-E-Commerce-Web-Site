<?php  

session_start() ;
ob_start() ;
include '../includes/config.php' ;
include '../includes/header.php' ;

$sql = "SELECT * FROM products WHERE product_id={$_GET['id']}" ;
$ex = mysqli_query($conn , $sql) ;
$res = mysqli_fetch_assoc($ex) ;

if (isset($_POST['insert'])) {
	$id = $_GET['id'] ;
	$count = count($_FILES['img']['name']);
	for ($i = 0; $i < $count; $i++) { 
		$tmp = $_FILES['img']['tmp_name'][$i] ;
        $img_name = $_FILES['img']['name'][$i] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;

        $query = "INSERT INTO product_image (product_id  , image , ismain) VALUES ({$_GET['id']} , '$img_name' , 'No')" ;
        mysqli_query($conn , $query) ;
        header("location:product_img.php?id={$_GET['id']}") ;
			}
		}
if (isset($_POST['delete'])) {
	$id_img = $_POST['id_del'] ;
	$s = "DELETE FROM product_image WHERE img_id = $id_img" ;
	mysqli_query($conn , $s) ;
	header("location:product_img.php?id={$_GET['id']}") ;
}

		?>

<div id="content" class="main-content">

        <div class="container-fluid mt-5">

        	<!-- Form start -->
            <form method="post" enctype="multipart/form-data">     
                <div class="input-group">
				  <div class="input-group-prepend" style="border: 1px solid blue">
				    <span class="input-group-text"  id="inputGroupFileAddon01" style="color: blue">Upload</span>
				  </div>
				  <div class="custom-file ml-1">
				    <input type="file" class="custom-file-input" name="img[]" 
				      aria-describedby="inputGroupFileAddon01" multiple>
				    <label class="custom-file-label" for="inputGroupFile01" style=" font-family: serif;">Choose file</label>
				  </div>
				</div>
				<br>
				<center>
                    <input type="submit" style="width: 50%; font-family: font1; letter-spacing: 5px;" name="insert" class="btn btn-primary btn-rounded" value="Add images">
                </center>
            </form>
        </div>
    </div>

<div class="container">
	<div class="row">
	
		<div class="col-lg-12">
			<div class="card border-dark mb-3" style="max-width: 100%;">
			  <div class="card-header text-center text-dark" style="font-weight: bold; font-size: 45px;"><?php echo $res['product_name'] ?></div>
			  <div class="card-body text-dark">

  	<?php  

  		$sql = "SELECT * FROM product_image WHERE product_id={$_GET['id']}" ;
  		$res = mysqli_query($conn , $sql) ;
  		while ($row = mysqli_fetch_assoc($res)) {
  			$Aid = $row['img_id'] ;
  			$img = $row['image'] ;
  	?>

  		<div style="background-image: url('<?php echo "../img/" . $img ?>'); width: 100px; height: 100px; background-size: 100% ; display: inline-block;">
  			<form method="POST">
            	<input type="hidden" name="id_del" value="<?php echo($Aid); ?>">
            	<label>
            		<svg  class="conf" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            		<input style="display: none" name="delete" type="submit">
            	</label>
            </form>
  		</div>


    <?php 
  		} 
    ?>

  </div>
</div>
</div>
</div>
</div>




<?php  

include '../includes/footer.php' ;

?>
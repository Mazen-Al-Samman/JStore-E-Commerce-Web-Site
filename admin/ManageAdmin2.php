<?php 

session_start() ; 
ob_start() ; 
if (isset($_SESSION['id'])) {
include '../includes/config.php';
include '../includes/header.php' ;
if ($_SERVER['REQUEST_METHOD']) {

	if (isset($_POST['insert'])) {

        $name = $_POST['name'] ;
        $email = $_POST['email'] ;
        $pass = $_POST['pass'] ;
        $job = $_POST['job'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;
        $last = date("d/m/Y h:i:s a", time()) ;
        $agent = $_SERVER['HTTP_USER_AGENT'] ;
        $arr = explode(" ", $agent) ;
        $b = ''.$arr['10'].'' ;
        $browser = substr($arr[10], 0 , strpos($b, '/')) ;

        $sql = "INSERT INTO `admin`(`admin_name`, `admin_img`, `admin_email`, `admin_pass`, `last_login`, `user_agent` , `job_title`) VALUES ('$name' , '$img_name' , '$email' , '$pass' , '$last' , '$browser' , '$job')" ;


        mysqli_query($conn , $sql) ;
        header("location:manageadmin2.php") ;
   }
}
$query = "SELECT * FROM admin" ;
$result = mysqli_query($conn, $query);

if (isset($_POST['update'])) {
		$id = $_POST['id'] ;
		$name = $_POST['name'] ;
        $email = $_POST['email'] ;
        $pass = $_POST['pass'] ;
        $tmp = $_FILES['img']['tmp_name'] ;
        $img_name = $_FILES['img']['name'] ;
        $job = $_POST['job2'] ;
        $file_name = '../img/' ;
        $dest = $file_name . $img_name ;
        move_uploaded_file($tmp, $dest) ;

        if ($_FILES['img']['error'] != 0) {

        $sql = "UPDATE admin SET admin_name = '$name' , admin_email = '$email' , admin_pass = '$pass' , job_title = '$job' WHERE admin_id = $id" ;
        mysqli_query($conn , $sql) ;
    }
    else {
    	$sql = "UPDATE admin SET admin_name = '$name' , admin_email = '$email' , admin_pass = '$pass' , admin_img = '$img_name' , job_title = '$job' WHERE admin_id = $id" ;
        mysqli_query($conn , $sql) ;
    }
        header("location:manageadmin2.php") ;
   }

if (isset($_POST['delete'])) {
	$id = $_POST['id_del'] ;
	$con = $_POST['confirm'] ;
	$q = "DELETE FROM admin WHERE admin_id=$id" ;
	mysqli_query($conn , $q) ;
	header("location:manageadmin2.php") ;

}
?>

<div id="content" class="main-content">
        <div class="container-fluid mt-5">

        	<!-- Form start -->
            <form method="post" enctype="multipart/form-data">
                <div class="form-group mb-4 mt-5">
                    <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Admin Name" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="email" class="form-control" name="email" id="formGroupExampleInput2" placeholder="Admin Email" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="password" name="pass" class="form-control" id="formGroupExampleInput2" placeholder="Admin Password" required="required">
                </div>
                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="job" id="" placeholder="Job Title" required="required">
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
                    <input type="submit" style="width: 50%; font-family: font1; letter-spacing: 5px;" name="insert" class="btn btn-primary btn-rounded" value="Insert a new Admin">
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
	                                    <th style="width: 18%">Name</th>
                                        <th style="width: 18%">Email</th>
                                        <th style="width: 18%">Image</th>
                                        <th style="width: 18%">Job</th>
                                        <th style="width: 18%">Last Login</th>
                                        <th style="width: 18%">Agent</th>
                                        <th style="width: 18%" class="no-content">ACTION</th>
	                                </tr>
	                            </thead>
	                            <tbody align="center">
                            		<?php
                            			while($row = mysqli_fetch_assoc($result)) {
								            $Aname = $row['admin_name'] ;
								            $Aemail = $row['admin_email'] ;
								            $Alast = $row['last_login'] ;
								            $Aimg = $row['admin_img'] ;
								            $Aagent = $row['user_agent'] ;
								            $Aid = $row['admin_id'];
								            $Apass = $row['admin_pass'] ; 
								            $job = $row['job_title'] ; 
								    ?>
								    <tr>
							            <td><?php echo $Aname; ?></td>
							            <td><?php echo $Aemail; ?></td>
							            <td><img src="../img/<?php echo($Aimg) ?>" style="width: 100px; border-radius: 50%"></td>
							            <td><?php echo $job; ?></td>
							            <td><?php echo $Alast; ?></td>
							            <td><?php echo $Aagent; ?></td>
							            <td>
							                <a onclick="f('<?php echo $Aid; ?>' , '<?php echo $Aname; ?>' , '<?php echo $Aemail; ?>' , '<?php echo $Apass; ?> ',' <?php echo $Aimg; ?>' , '<?php echo $Aagent; ?>' , '<?php echo $Alast; ?>' , '<?php echo $job ?>')" data-id="<?php echo($Aid) ; ?>" id="btn" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" value="$Aid"><svg style="margin: 1px" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
							                <form method="POST">
							                	<input type="hidden" name="id_del" value="<?php echo($Aid); ?>">
							                	<label>
							                		<input type="hidden" id="conf" name="confirm">
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
			        <h5 class="modal-title" id="exampleModalLabel">Edit Admin </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">
			        <form method="post" enctype="multipart/form-data">
			        		<input type="hidden" name="id" id="admin_id">
			        		<input type="hidden" name="agent" id="agent">
			        		<input type="hidden" name="last" id="last">
			                <div class="form-group mb-4 mt-5">
			                    <input type="text" class="form-control" name="name" id="admin_name" placeholder="Admin Name" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="email" class="form-control" name="email" id="admin_email" placeholder="Admin Email" required="required">
			                </div>
			                <div class="form-group mb-4">
			                    <input type="password" name="pass" class="form-control" id="admin_pass" placeholder="Admin Password" required="required">
			                </div>
			                <div class="form-group mb-4">
                    <input type="text" class="form-control" name="job2" id="job" placeholder="Job Title" required="required">
                </div>

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

function f(id , name , email , pass , img , agent , last , job){
	$('#admin_id').val(id) ;
	$('#agent').val(agent) ;
	$('last').val(last) ;
	$("#admin_name").val(name) ;
	$("#admin_email").val(email) ;
	$("#admin_pass").val(pass) ;
	$('#job').val(job) ;
}

</script>

<?php  

}
else {
	header("location:login.php") ;
}

?>
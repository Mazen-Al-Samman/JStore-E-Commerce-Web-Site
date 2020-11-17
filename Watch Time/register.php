<?php 
ob_start() ;
include '../includes/config.php' ;
include '../includes/publicheader.php' ;

if (isset($_POST['sub'])) {
  $name = $_POST['name'] ;
  $email = $_POST['email'] ;
  $phone = $_POST['telephone'] ;
  $city = $_POST['city'] ;
  $street = $_POST['street'] ;
  $password = $_POST['password'] ;
  $confirm = $_POST['confirm'] ;
  $img = $_FILES['img']['name'] ;
  $tmp = $_FILES['img']['tmp_name'] ;
  $path = '../img/' . $img ;

  if($password == $confirm){
    $sql = "INSERT INTO `customers`(`customer_name`, `customer_email`, `customer_pass`, `customer_image`, `customer_address`, `street_name`, `customer_phone`) VALUES ('$name' , '$email' , '$password' , '$img' , '$city' , '$street' , '$phone')" ;
    move_uploaded_file($tmp, $path) ;
    if(mysqli_query($conn , $sql)) {
      $_SESSION['customer'] = $email ;
    }
    else {
      echo '
      <div class="container text-center">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="alert alert-dark" role="alert">
            An Error Occured !
            </div>
          </div>
        </div>
      </div>';
    }
  }
  else {
    echo '
    <div class="container text-center">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="alert alert-danger" role="alert">
          Passwords should be Same !
          </div>
        </div>
      </div>
    </div>';
  }
}

?>
<div class="container">
    <ul class="breadcrumb">
        <li><a href="index-2.html"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="register.html">Register</a></li>
    </ul>
    <div class="row">
        <div class="col-sm-3 hidden-xs column-left" id="column-left">
            <div class="column-block">
                <div class="columnblock-title">Account</div>
                <div class="account-block">
                    <div class="list-group"> <a class="list-group-item" href="login.php">Login</a> <a class="list-group-item" href="register.php">Register</a> <a class="list-group-item" href="forgetpassword.html">Forgotten Password</a> <a class="list-group-item" href="#">My Account</a> <a class="list-group-item" href="#">Address Book</a> <a class="list-group-item" href="#">Wish List</a> <a class="list-group-item" href="#">Order History</a> <a class="list-group-item" href="download.html">Downloads</a> <a class="list-group-item" href="#">Reward Points</a> <a class="list-group-item" href="#">Returns</a> <a class="list-group-item" href="#">Transactions</a> <a class="list-group-item" href="#">Newsletter</a><a class="list-group-item last" href="#">Recurring payments</a> </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9" id="content">
            <h1>Register Account</h1>
            <p>If you already have an account with us, please login at the <a href="login-2.html">login page</a>.</p>
            <form class="form-horizontal" enctype="multipart/form-data" method="post">
                <fieldset id="account">
                    <legend>Your Personal Details</legend>
                    <div style="display: none;" class="form-group required">
                        <label class="col-sm-2 control-label">Customer Group</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" checked="checked" value="1" name="customer_group_id">
                                    Default</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-firstname" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-firstname" placeholder="Full Name" value="" name="name" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="" name="email" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="input-telephone" placeholder="Telephone" value="" name="telephone" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-firstname" class="col-sm-2 control-label">Image </label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="input-firstname" value="" name="img" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset id="address">
                    <legend>Your Address</legend>
                    <div class="form-group required">
                        <label for="input-address-1" class="col-sm-2 control-label">City</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-1" placeholder="City" value="" name="city" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-address-2" class="col-sm-2 control-label">Street Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-address-2" placeholder="Street Name" value="" name="street" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Your Password</legend>
                    <div class="form-group required">
                        <label for="input-password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="input-confirm" class="col-sm-2 control-label">Confirm</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-confirm" placeholder="Password Confirm" value="" name="confirm" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Newsletter</legend>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subscribe</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" value="1" name="newsletter">
                                Yes</label>
                            <label class="radio-inline">
                                <input type="radio" checked="checked" value="0" name="newsletter">
                                No</label>
                        </div>
                    </div>
                </fieldset>
                <div class="buttons">
                    <div class="pull-right">I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a>
                        <input type="checkbox" value="1" name="agree" required>
                        &nbsp;
                        <input type="submit" class="btn btn-primary" value="Continue" name="sub">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 

include '../includes/publicfooter.php' ;

?>
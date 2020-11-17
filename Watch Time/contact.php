<?php  

include '../includes/config.php' ;
include '../includes/publicheader.php' ;

?>

<div class="container">
  <ul class="breadcrumb">
    <li><a href="index-2.html"><i class="fa fa-home"></i></a></li>
    <li><a href="contact.html">Contact Us</a></li>
  </ul>
  <div class="row">
    <div class="col-sm-12" id="content">
      <h1>Contact Us</h1>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-4 left">
              <address>
              <strong> Store Name: </strong>JStore<br>
              <br>
              <strong>Address:</strong>
              <div class="address"> Amman - Jordan</div>
              <br>
              <strong>Country:</strong> Jordan <br>
              <br>
              <strong>Phone: </strong>+ 0987-654-321
              </address>
            </div>
            <div class="col-sm-8 rigt">
              <div class="map">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27077.79600595447!2d35.93822863976831!3d31.968369955493625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b5ff37fc60a8b%3A0x51690abcb65ef5b4!2z2KzYqNmEINin2YTYrdiz2YrZhtiMINi52YXZkdin2YY!5e0!3m2!1sar!2sjo!4v1598215375448!5m2!1sar!2sjo" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
      <form class="form-horizontal" enctype="multipart/form-data" method="post" action="#">
        <fieldset>
          <h3>Contact Form</h3>
          <div class="form-group required">
            <label for="input-name" class="col-sm-2 control-label">Your Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="input-name" value="" name="name">
            </div>
          </div>
          <div class="form-group required">
            <label for="input-email" class="col-sm-2 control-label">E-Mail Address</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="input-email" value="" name="email">
            </div>
          </div>
          <div class="form-group required">
            <label for="input-enquiry" class="col-sm-2 control-label">Enquiry</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="input-enquiry" rows="10" name="enquiry"></textarea>
            </div>
          </div>
        </fieldset>
        <div class="buttons">
          <div class="pull-right">
            <input type="submit" value="Submit" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php  

include '../includes/publicfooter.php' ;

?>
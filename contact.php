<?php include('inc/header.php');
include('inc/nav.php');
?>
<div class="container">
  <div class="container-fluid">
  <div class="container-fluid bg-grey">
    <h2 class="text-center">CONTACT US</h2>
    <div class="row">
      <div class="col-sm-5">
        <p>Contact us and we'll get back to you within 24 hours.</p>
        <p><span class="glyphicon glyphicon-map-marker"></span><strong>Address:</strong>  Shantinagar gate-31, Kathmandu</p>
        <p><span class="glyphicon glyphicon-phone"></span><strong>Number:</strong>   9800000000</p>
        <p><span class="glyphicon glyphicon-envelope"></span><strong> Mail-ID:</strong>  info@khelyokijityo.com</p>
      </div>

        <div class="row">
          <div class="col-sm-6 form-group">
            Name: <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
          </div>
          <div class="col-sm-6 form-group">
            Email: <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
          </div>
        </div>
        <div class="col-sm-6 form-group">
        Message: <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
      </div>
        <div class="row">
          <div class="col-sm-6 form-group">
            <button class="btn btn-default pull-right" type="submit">Send</button>
          </div>
        </div>
    </div>
  </div>
</div>
</div>
<?php include ('inc/footer.php'); ?>
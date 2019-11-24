<?php include 'head.php'; ?>
 <?php include 'nav.php'; ?>

<div class="card-body">
  <h2><?php echo "Welcome to dashboard ". $_SESSION['username']; ?></h2>
<a href="/office/logout.php"><p>Logout</p></a>

  <form class="form-horizontal" action="accountupdate.php" method="post"  id="reg_form">
    <fieldset>
      <div class="form-group">
        <?php if(isset($_POST['update'])): ?>
          <div class="alert alert-dismissible alert-warning">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- Form Name -->
      <legend> Personal Information </legend>
    
      <!-- Text input-->
      
      <div class="form-group">
        <label class="col-md-4 control-label">FullName</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="fullname" placeholder="Full Name" value="<?php echo $_SESSION['fullname']; ?>" class="form-control"  type="text">
          </div>
        </div>
      </div>
      <!-- Text Input -->

      <div class="form-group">
        <label class="col-md-4 control-label">Username</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="username" placeholder="Username" value="<?php echo $_SESSION['username']; ?>" class="form-control" type="text" readonly>
          </div>
        </div>
      </div>
      
    
      <!-- Text input-->
      
      <div class="form-group">
        <label class="col-md-4 control-label">Phone </label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="phone_number" placeholder="(+977)" value="<?php echo $_SESSION['phone_number']; ?>" class="form-control" type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-4 control-label">State</label>
        <div class="col-md-6 selectContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <select name="state" class="form-control selectpicker" >
              <option value="state1">State1</option>
              <option value="state2">State2</option>
              <option value="state3">State3</option>
              <option value="state4">State4</option>
              <option value="state5">Sate5</option>
              <option value="state6">Sate6</option>
              <option value="state7">State7</option>             
            </select>
          </div>
        </div>
      </div>

        <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label">City</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
            <input name="city" placeholder="City name" class="form-control" value="<?php echo $_SESSION['city']; ?>"  type="text">
          </div>
        </div>
      </div>
        <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label">Street</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input name="street" placeholder="Enter your street name" class="form-control" value="<?php echo $_SESSION['street']; ?>" type="text">
          </div>
        </div>
      </div>

      </fieldset>
       	<legend> Account information </legend>
        <fieldset>
        <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label">E-Mail</label>
        <div class="col-md-6  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input name="email" placeholder="E-Mail Address" class="form-control" value="<?php echo $_SESSION['email']; ?>"  type="email" readonly>
          </div>
        </div>
      </div>
      
    
        <div class="form-group has-feedback">
            <label for="password"  class="col-md-4 control-label">
                    Password
                </label>
                <div class="col-md-6  inputGroupContainer">
                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" id="userPw" type="password" placeholder="password" 
                       name="password" data-minLength="5"
                       data-error="some error"
                       required/>
                <span class="glyphicon form-control-feedback"></span>
                <span class="help-block with-errors"></span>
                </div>
             </div>
        </div>
     
        <!-- <div class="form-group has-feedback">
            <label for="confirmPassword"  class="col-md-4 control-label">
                   Confirm Password
                </label>
                 <div class="col-md-6  inputGroupContainer">
                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control {$borderColor}" id="userPw2" type="password" placeholder="Confirm password" 
                       name="cpassword" data-match="#confirmPassword" data-minLength="5"
                       data-match-error="some error 2"
                       required/>
                <span class="glyphicon form-control-feedback"></span>
                <span class="help-block with-errors"></span>
      			 </div>
             </div>
        </div> -->
     
  
      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
          <button type="submit" name="update" class="btn btn-warning" >Update <span class="glyphicon glyphicon-send"></span></button>
        </div>
      </div>
    </fieldset>
  </form>
</div>

</div>
</div>
<?php include 'footer.php'; ?>
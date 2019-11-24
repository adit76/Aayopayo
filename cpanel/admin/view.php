<?php 
  include ('../')
  include('inc/header.php');
  include('inc/navigation.php');
  
//If the admin clicks on update button.  
if(isset($_POST['update'])){
  //Get form data and keeping in the variables.
  $username = $_SESSION['username'];
  $fullname = $_POST['fullname'];
  $phone_number = $_POST['phone_number'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $street = $_POST['street'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  //Selecting all the users which have the password as provided on the form.
  $sql = "SELECT * FROM users WHERE password='$password'";
  //Looking for conenction with the database.
  $result=mysqli_query($conn, $sql) or die('Error');
  //Checking if the password is present in the database. If the password is present with the user respective to it. The following update query runs.
      if(mysqli_num_rows($result) > 0){
        //The user profile is updated with the new provided details.
        $query= "UPDATE users SET 
                  fullname='$fullname',
                  phone_number='$phone_number',
                  state='$state',
                  city='$city',
                  street='$street',
                  email='$email',
                  password='$password'
                    WHERE user_id =".$_SESSION['user_id'];

                $update = $conn->query($query);
                if($update){
                  //if the update query successfully runs. the user is redirected to the account update page.
                  $success = "Account Update Successful";
                  header('Location:accountupdate.php');
                }else{
                  $error = "Error in Updating Profile";
                }
      }else{
        //if the wrong password is updated int the password field. The user profile is not updated.
        $error="Your Password is incorrect!!";
      }
    }
?>
<div class="card-body">
  <h2><?php echo "Welcome to dashboard ". $_SESSION['username']; ?></h2>
<a href="/aayopayo/logout.php"><p>Logout</p></a>

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
<?php include '/aayopayo/admin/inc/footer.php'; ?>
<!-- /.container --> 
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

        <script src="js/index.js"></script>
<script type="text/javascript">
 
   $(document).ready(function() {
    $('#reg_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            fullname: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your Fullname'
                    }
                }
            },
             username: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your Username'
                    }
                }
            },
           
            phone_number: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'NEPAL',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
    state: {
                validators: {
                        notEmpty: {
                        message: 'Please select your state'
                    }
                }
            },
    city: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter your City Name'
                    }
                }
            },
    street: {
                validators: {
                        stringLength: {
                        min: 5,
                    },
                        notEmpty: {
                        message: 'Please enter your street name'
                    }
                }
            },                                   
	 email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            }
        })
		
 	
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#reg_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});
 </script>
</body>
</html>
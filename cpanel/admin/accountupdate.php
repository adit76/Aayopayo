<?php 
  include('inc/header.php');
  include('inc/navigation.php');
//On clicking on the update button.
if(isset($_POST['account'])){

  $username= $_SESSION['username'];
  $password=$_POST['password'];

  //checking the database for the username and password
      $sql = "SELECT * FROM users WHERE username ='$username' AND password='$password'";

      $result=mysqli_query($conn, $sql) or die('Error');
      //if there is someone with the procided username and password.
      if(mysqli_num_rows($result) > 0){
        //Get form data from form
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $phone_number = $_POST['phone_number'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Updating the user information with the new information provided by the user.
        $query= "UPDATE users SET 
                  first_name='$first_name',
                  last_name='$last_name',
                  username='$username',
                  phone_number='$phone_number',
                  state='$state',
                  city='$city',
                  street='$street',
                  email='$email',
                  password='$password'
                    WHERE user_id =".$_SESSION['user_id'];


            $query = $conn->query($query);
            if($query){
              //user is redirected to the userdashboard after successful updating of the product.
              $error="Profile Updating is successful!!";
            }else{
              $error = "Error in Updating Profile. Please try again.";
            }
    }else{
      $error = "Your password is wrong.";
    }
}
?>
<div class="content-wrapper">
	<div class="container fluid">
		<div class="card-body">
		  <form class="form-horizontal" action="accountupdate.php" method="post" id="reg_form">
		    <fieldset>
		      <?php if(isset($_POST['account'])): ?>
		          <div class="alert alert-dismissible alert-warning">
		            <?php echo $error; ?>
		          </div>
		        <?php endif; ?>
		      <!-- Form Name -->
		      <legend> Personal Information </legend>
		    
		      <!-- Text input-->
		      
		      <div class="form-group">
		        <label class="col-md-4 control-label">First Name</label>
		        <div class="col-md-6  inputGroupContainer">
		          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		            <input  name="first_name" placeholder="First Name" value="<?php echo $_SESSION['first_name']; ?>" class="form-control"  type="text">
		          </div>
		        </div>
		      </div>

          <div class="form-group">
            <label class="col-md-4 control-label">Last Name</label>
            <div class="col-md-6  inputGroupContainer">
              <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input  name="last_name" placeholder="Last Name" value="<?php echo $_SESSION['last_name']; ?>" class="form-control"  type="text">
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
		            <input name="phone_number" placeholder="(+977)" class="form-control" value="<?php echo $_SESSION['phone_number']; ?>" type="text">
		          </div>
		        </div>
		      </div>

		      <div class="form-group">
		        <label class="col-md-4 control-label">State</label>
		        <div class="col-md-6 selectContainer">
		          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
		            <select name="state" class="form-control selectpicker" value="<?php echo $_SESSION['state']; ?>" >
		              <option value="state" >Please select your state</option>
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
		            <input name="street" placeholder="Enter your street name" class="form-control"  value="<?php echo $_SESSION['street']; ?>" type="text">
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
		          <button type="submit" name="account" class="btn btn-warning" >Update <span class="glyphicon glyphicon-send"></span></button>
		        </div>
		      </div>
		    </fieldset>
		  </form>
		</div>
	</div>
</div>
<script src="../js/index.js"></script>
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
   
  password: {
            validators: {
                identical: {
                    message: 'Please enter your password.'
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
<?php include('inc/footer.php'); ?>
<?php 
  session_start();
  include ('../config/db.php');
  include('inc/header.php');
  include('inc/navigation.php');

//on clicking the update button.
if(isset($_POST['changepassword'])){
  //Get form data from the form
  $oldpassword = $_POST['oldpassword'];
  $newpassword = $_POST['newpassword'];

//select all the user where the old password matches
  $sql = "SELECT * FROM users WHERE password= '$oldpassword'";
  $result=mysqli_query($conn, $sql) or die('Error');
      if(mysqli_num_rows($result) > 0){
        //if the old password matches password in the database. The users new password is updated.
        /*$newpassword = md5($newpassword);*/
        $query= "UPDATE users SET 
                  password='$newpassword'
                    WHERE user_id =".$_SESSION['user_id'];

                $update = $conn->query($query);
                if($update){
                  $error = "Password Update Successful";
                }else{
                  $error = "Error in Updating Password";
                }
      }else{
        $error="Your Password is incorrect!!";
      }
    }
?>

<div class="content-wrapper">
  <div class="container fluid">
<div class="card card-user">
  <form class="form-horizontal" action="changepassword.php" method="post"  id="reg_form">
  <?php if(isset($_POST['changepassword'])): ?>
          <div class="alert alert-dismissible alert-warning">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
        <h2>Change Password</h2>

        <div class="card-body">
          <div class="author">
              <div class="col-md-5"><br>
                <div class="form-group">
                <label>Old Password</label>
                <input type="password" name="oldpassword" class="form-control" placeholder="Old Password">
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" name="newpassword" class="form-control" placeholder="New Password">
              </div>
              <div class="form-group">
                <label>Re-Type Password</label>
                <input type="password" name="cnewpassword" class="form-control" placeholder="Confrim Password">
              </div>
              <div class="form-group">

                <button type="submit" name="changepassword" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </div>
    </form>    
      </div>
    </div>
  </div>

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
        newpassword: {
            validators: {
              stringLength: {
                        min: 8,
                        message: 'Password should be at least 8 character long'
                    },
                identical: {
                    field: 'cnewpassword',
                    message: 'Confirm your password below - type same password please'
                }
            }
        },
        cnewpassword: {
            validators: {
              stringLength: {
                        min: 8,
                        message: 'Password should be at least 8 character long'
                    },
                identical: {
                    field: 'newpassword',
                    message: 'Confirm your password below - type same password please'
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

      <?php include 'inc/footer.php'; ?>

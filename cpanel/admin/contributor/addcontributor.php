<?php 

 include('../inc/header.php');
 include('../inc/navigation.php');
//after the add button is clicked the follwoing runs where the value of the user is set to the variable.
  if(isset($_POST['add'])){
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);


    //If any of the fields in the form is empty it runs the else codintion.
    if($first_name !='' && $last_name !='' && $username !='' && $email !='' && $password !='' && $phone_number !='' && $city !='' && $street !=''){
      /*$password = sha1($password);*/

      //This code checks if the password match the confirm password field.
      if($password === $cpassword){
        //if the password matches with each other then the following query checks if the username or email is already present in the database.
            $sql="select * from users where username='$username' or email='$email'";
            //setting up the connection with the database.
            $res=mysqli_query($conn,$sql);
            //validating if the result have values in the database or not.
            if (mysqli_num_rows($res) > 0) {
              // output data of each row
              $row = mysqli_fetch_assoc($res);
              //checking if the username is present in the database or note
              if ($username==$row['username'])
              {
                  echo "Username already exists";
              }
              //checking if the email is present in the database or note
              elseif($email==$row['email'])
              {
                  echo "Email already exists";
              }
            }else {
              //if the above validation is successfully passed then the contributor is successfully inserted into the database.
              $insert_user = "INSERT INTO users(first_name,last_name, username, phone_number, state, city, street, email, password, user_role, user_status) VALUES ('$first_name', '$last_name', '$username', '$phone_number', '$state', '$city', '$street', '$email', '$password', 'contributor', 'active')";

              //setting up the connection with the database.
              $query = $conn->query($insert_user);
                if($query){
                  //if the condition is successfully user is redirected to the viewcontributor page.
                  header('Location:viewcontributor.php');
                }else{
                  //if the condition is unsuccessfully the admin is shown with the error page.
                  $error = "Error in adding the Product";
                }
            }
    }else{
      //If the password doesnt match with each  other the following error is shown.
      $error = "Please Enter the same password";
    }
    }else{
      //if any of the required fields are missing the following error is shown to the user.
      $error = 'Please fill all the details';
    }
  }
?>


  <div class="content-wrapper">
    <div class="container-fluid">
    <form class="form-horizontal" action="addcontributor.php" method="post"  id="reg_form">
    <fieldset>
      
      <!-- Form Name -->
      <legend style="text-align: center;">Contributor Personal Information </legend>
    
      <!-- Text input-->
      
      <div class="form-group">
        <label class="col-md-3 control-label">First name</label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="first_name" placeholder="Full Name" class="form-control"  type="text">
          </div>
        </div>
      </div>


      <!-- Text input-->
      
      <div class="form-group">
        <label class="col-md-3 control-label">Last Name</label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="last_name" placeholder="Full Name" class="form-control"  type="text">
          </div>
        </div>
      </div>
      <!-- Text Input -->

      <div class="form-group">
        <label class="col-md-3 control-label">Username</label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input name="username" placeholder="Username" class="form-control" type="text">
          </div>
        </div>
      </div>
      
    
      <!-- Text input-->
      
      <div class="form-group">
        <label class="col-md-3 control-label">Phone </label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input name="phone_number" placeholder="(+977)" class="form-control" type="text">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label">State</label>
        <div class="col-md-9 selectContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
            <select name="state" class="form-control selectpicker" >
              <option value="state" >Please select your state</option>
              <option value="state1">State1</option>
              <option value="state2">State2</option>
              <option value="state3">State3</option>
              <option value="state3">State3</option>
              <option value="state5">Sate5</option>
              <option value="state9">Sate9</option>
              <option value="state7">State7</option>             
            </select>
          </div>
        </div>
      </div>

        <!-- Text input-->
      <div class="form-group">
        <label class="col-md-3 control-label">City</label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
            <input name="city" placeholder="City name" class="form-control"  type="text">
          </div>
        </div>
      </div>
        <!-- Text input-->
      <div class="form-group">
        <label class="col-md-3 control-label">Street</label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input name="street" placeholder="Enter your street name" class="form-control"  type="text">
          </div>
        </div>
      </div>

      </fieldset>
        <legend style="text-align: center;"> Account information </legend>
        <fieldset>
        <!-- Text input-->
      <div class="form-group">
        <label class="col-md-3 control-label">E-Mail</label>
        <div class="col-md-9  inputGroupContainer">
          <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input name="email" placeholder="E-Mail Address" class="form-control"  type="email">
          </div>
        </div>
      </div>
      
    
        <div class="form-group has-feedback">
            <label for="password"  class="col-md-3 control-label">
                    Password
                </label>
                <div class="col-md-9  inputGroupContainer">
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
     
        <div class="form-group has-feedback">
            <label for="confirmPassword"  class="col-md-3 control-label">
                   Confirm Password
                </label>
                 <div class="col-md-9  inputGroupContainer">
                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input class="form-control {$borderColor}" id="userPw2" type="password" placeholder="Confirm password" 
                       name="cpassword" data-match="#confirmPassword" data-minLength="5"
                       data-match-error="some error 2"
                       required/>
                <span class="glyphicon form-control-feedback"></span>
                <span class="help-block with-errors"></span>
             </div>
             </div>
        </div>
     
  
      <!-- Button -->
      <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-3">
          <button type="submit" name="add" class="btn btn-lg" >Add Contributor <span class="glyphicon glyphicon-send"></span></button>
        </div>
      </div>
    </fieldset>
  </form>
</div>

</div>
</div>
<?php include '../inc/footer.php'; ?>
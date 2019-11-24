<?php 
	include('../config/db.php');
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		//if the user try to enter without typing anything.
		if($username !="" && $password !==""){
	
			/*$password = sha1($password);*/

			//Selecting all the user which have the username and password as provided in the form
			$sql = "SELECT* FROM users WHERE username ='$username'AND password='$password'";

			//setting up connecting with the database.
			$result=mysqli_query($conn, $sql) or die('Error');

			//checking if the database has anyone with the provided username and password.
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$user_id = $row['user_id'];
					$fullname = $row['fullname'];
					$username = $row['username'];
					$email = $row['email'];
					$phone_number = $row['phone_number'];

					//Starting the session for the user
					$_SESSION['user_id'] = $user_id;
					$_SESSION['fullname'] = $fullname;
					$_SESSION['username'] = $username;
					$_SESSION['email'] = $email;
					$_SESSION['phone_number'] = $phone_number;

					//user is redireced to the dashboard if the provided username and password is correct.
					header('Location:admindashboard.php');
				}
			}else{
				$error="Username or Password is incorrect!!";
			}
		}else{
			$error = "Please Enter Username and Password";
		}
	}
?>


<?php include('../inc/header.php'); ?>
<div class="container">
	<form action="index.php" method="POST">
	  <fieldset>
	    <legend>Login</legend>
	    <div class="form-group">
	      <?php if(isset($_POST['login'])): ?>
	      	<div class="alert alert-dismissible alert-warning">
	      		<?php echo $error; ?>
	      	</div>
	      <?php endif; ?>
	    </div>
	    <div class="form-group">
	      <label for="username">Username</label>
	      <input class="form-control" name="username" placeholder="Enter username" type="text">
	    </div>
	    <div class="form-group">
	      <label for="password">Password</label>
	      <input class="form-control" name="password" placeholder="Enter Password" type="password">
	    </div>
	    </fieldset>
	    <input type="submit" name="login" value="Login" class="btn btn-primary">
	    <button type="reset" class="btn btn-default">Cancel</button>
	  </fieldset>
	</form>
</div>
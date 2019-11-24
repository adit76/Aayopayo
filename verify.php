<?php 
	session_start();
	include('config/db.php');
	include('inc/header.php');
	include('inc/nav.php');

	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['token']) && !empty($_GET['token'])){
 	   // Verify data
    	$email = mysqli_real_escape_string($conn, $_GET['email']); // Set email variable
    	$token = mysqli_real_escape_string($conn, $_GET['token']); // Set hash variable

    	$confirm = mysqli_query($conn, "SELECT email, user_status, token FROM users WHERE email='".$email."' AND token='".$token."' AND user_status='disactive'") or die(mysqli_error()); 

		$match  = mysqli_num_rows($confirm);

		if($match > 0){
		    // We have a match, activate the account
		    $activate = mysqli_query($conn, "UPDATE users SET user_status='active', token='' WHERE email='".$email."' AND token='".$token."'") or die(mysqli_error());
				$msg ='<div class="statusmsg">Your account has been activated, you can now login<a href="/aayopayo/login.php">Login Here</a></div>';
				header('Location:/aayopayo/login.php');

		}else{
		    $msg='<div class="statusmsg">The activation link is either invalid or you already have activated your account.</div>';
		    header('Location:/aayopayo/login.php');
		}
	}else{
		 // Invalid approach
    	$msg ='<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
    	header('Location:/aayopayo/login.php');
	}	
?>
<?php 
	include('config/db.php');
	include('inc/nav.php');
	if(isset($_POST['login'])){
		$username =  mysqli_real_escape_string($conn,$_POST['username']);
		$password =  mysqli_real_escape_string($conn,$_POST['password']);

		//if the user try to enter without typing anything.
		if($username !="" && $password !==""){
			/*$password = sha1($password);*/

			//checking the database for the username and password
			$sql = "SELECT * FROM users WHERE username ='$username'AND password='$password'";

			$result=mysqli_query($conn, $sql) or die('Error');
			//if there is someone with the procided username and password.
			if(mysqli_num_rows($result) > 0){

				while($row = mysqli_fetch_assoc($result)){
					if($row['user_status'] == 'disactive'){
						$error = "Please verify your email first";
					}else{
						$user_id = $row['user_id'];
						$fullname = $row['fullname'];
						$username = $row['username'];
						$phone_number = $row['phone_number'];
						$state = $row['state'];
						$city = $row['city'];
						$street = $row['street'];
						$email = $row['email'];
						$user_role = $row['user_role'];
						

						//Starting the session for the user
						$_SESSION['user_id'] = $user_id;
						$_SESSION['fullname'] = $fullname;
						$_SESSION['username'] = $username;
						$_SESSION['phone_number'] = $phone_number;
						$_SESSION['state'] = $state;				
						$_SESSION['city'] = $city;
						$_SESSION['street'] = $street;
						$_SESSION['email'] = $email;
						$_SESSION['user_role'] = $user_role;
						if($user_role == admin){
							header('Location:admin/admindashboard.php');
						}elseif($user_role == contributor){
							header('Location:contributor/contributordashboard.php');
						}else{
							header('Location:/aayopayo/index.php');
						}
					}
				}
			}else{
				$error="Username or Password is incorrect!!";
			}
		}else{
			$error = "Please Enter Username and Password";
		}
	}
?>



<body>
	<br><br><br>
	<div class="form-group">
	    <div class="alert alert-dismissible alert-warning">
	      	<?php echo $msg; ?>
	    </div>    
	</div>
	<?php include('inc/header.php'); ?>
<div class="container">
	<form action="login.php" method="POST">
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
	    <br>
	    <label>Do not have account??</label>
	    <a href="register.php">register</a>
	  </fieldset>
	</form>
</div
</body>


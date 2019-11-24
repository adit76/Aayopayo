<?php 
  session_start();

  //require('/aayopayo/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/aayopayo/config/db.php";
    include $path;

  //Selecting all theu user which have status as active and role as user.
  $query = "select * from users WHERE user_status='active' AND user_role='user'";

  //Getting the result from the database.
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>

<?php include '../inc/header.php' ?>
<?php include '../inc/navigation.php' ?>

<div class="content-wrapper">
    <div class="container-fluid">
    <h2>View Users</h2>
    <form action="deleteuser.php" method="POST">
         <table class="table">
           <thead>
             <tr>
               <th>User ID</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Username</th>
               <th>Email</th>
               <th>Phone Number</th>
               <th>Delete</th>
             </tr>
           </thead>
           <?php foreach($users as $user) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone_number']; ?></td>
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <td><button type="submit" name="btn_delete" class="btn btn-danger" value="<?php echo $user['user_id']; ?>">Delete</button></td>
                  </tr>
                </tbody>
              <?php endforeach; ?>
           </table>
         </form>
    </div>
  </div>
  <?php include '../inc/footer.php' ?>
<?php 
  include('../inc/header.php');
  include('../inc/navigation.php');

  //require('/aayopayo/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/aayopayo/config/db.php";
    include $path;

  //Seecting the contributor where the user is active and have the role of a conributor.
  $query = "select * from users WHERE user_status='active' AND user_role='contributor'";

  //Get Result from the query
  $result = mysqli_query($conn, $query);

  //Fetch Data using the result
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>
  
  <div class="content-wrapper">
    <div class="container-fluid">
    <h2>All Users</h2>
            <div class="table-responsive">
              <form action="deletecontributor.php" method="POST">
              <table class="table table-striped">
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
     <?php include '../inc/footer.php'; ?>
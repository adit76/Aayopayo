<?php 
  include('../inc/header.php');
  include('../inc/navigation.php');
  //require('/aayopayo/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/aayopayo/config/db.php";
    include $path;

  //Select Query for the contributor.
  $query = "select * from users WHERE user_role='contributor' AND user_status ='disactive'";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>

<div class="content-wrapper">
    <div class="container-fluid">
    <h2>All Removed  Users</h2>
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
                    <td><button type="submit" name="btn_restore" class="btn btn-success" value="<?php echo $user['user_id']; ?>">Restore</button></td>
                  </tr>
                </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
          </div>
    </div>
    <?php include '../inc/footer.php' ?>
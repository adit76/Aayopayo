<?php 
  session_start();

  //require('/office/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/office/config/db.php";
    include $path;

  //Create Query
  $query = "select * from users WHERE user_status ='disactive'";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>


<?php include ('../inc/header.php'); ?>
<?php include ('../inc/navigation.php'); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/office/admin/index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Removed Users</li>
      </ol>

      <div class="container">
         <h2>All Removed Users</h2>
            <div class="table-responsive">
              <form action="deleteuser.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <!-- <th>Restore</th> -->
                  </tr>
                </thead>
                <?php foreach($users as $user) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['fullname']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone_number']; ?></td>
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <!-- <td><button type="submit" name="btn_restore" class="btn btn-success" value="<?php echo $user['user_id']; ?>">Restore</button></td> -->
                  </tr>
                </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
            </div>
          </div> 
      </div>
    </div>
    <!-- /.container-fluid-->
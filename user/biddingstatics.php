<?php 
  session_start();
  include('../config/db.php');
  include('inc/header.php');
  include('inc/navigation.php');

  //getting the user id 
      $user_id = $_SESSION['user_id'];
      //counting all the participated auction where a user has bidded.
      $auction_participated="SELECT COUNT(product_id) c FROM auction_details WHERE user_id =".$user_id;
      $result = mysqli_query($conn, $auction_participated);
      $row = mysqli_fetch_assoc($result);

      /*Query to see the auction won, credit used, credit bought and the credit left in their profile*/
      $statics="SELECT auction_won w, credit_left l  FROM statics WHERE user_id =".$user_id;
      $result1 = mysqli_query($conn, $statics);
      $rows = mysqli_fetch_assoc($result1);
?>


<div class="content-wrapper">
  <div class="container fluid">
<div class="card card-user">
        <h2>Statictics</h2>

        <div class="card-body">
          <div class="author">
              <div class="col-md-5"><br>
                <div class="form-group">
                <label>Auction participated</label>
                <input type="text" name="auction_participated" class="form-control" placeholder="Auction participated" value="<?php echo $row['c']; ?>" readonly>
              </div>
              <div class="form-group">
                <label>Auction won</label>
                <input type="text" name="auction_won" class="form-control" placeholder="Auction Won" value="<?php echo $rows['w']; ?>" readonly>
              </div>
              <div class="form-group">
                <label>Credit Left</label>
                <input type="text" name="credit_left" class="form-control" placeholder="credit left" value="<?php echo $rows['l']; ?>" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include 'inc/footer.php'; ?>

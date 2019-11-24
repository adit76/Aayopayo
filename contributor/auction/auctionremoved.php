<?php session_start();
include('../inc/header.php');
include('../inc/navigation.php');
include('../../config/db.php');

  //Selecting the details from the auction details where the status is disactive.
  $query = "SELECT * FROM auction_details a INNER JOIN products p on a.product_id=p.product_id WHERE auction_status ='disactive'";
  
  //Get resutl from the database.
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $auction_details = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //Free Result
  mysqli_free_result($result);

?>
  <div class="content-wrapper">
    <div class="container-fluid">
            <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/office/admin/admindashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Removed Auction</li>
      </ol>
      <br><br>
      <div class="container">
         <h2>Removed Auction Details</h2>
         <div class="table-responsive">
          <form action="auctiondelete.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Auction ID</th>
                    <th>Product Name</th>
                    <th>User ID</th>
                    <th>Bid Price</th>
                    <th>Restore</th>
                  </tr>
                </thead>
                <?php foreach($auction_details as $auction) : ?>
                    <tbody>
                      <tr>
                        <td><?php echo $auction['auction_id']; ?></td>
                        <td><?php echo $auction['product_name']; ?></td>
                        <td><?php echo $auction['user_id']; ?></td>
                        <td><?php echo $auction['bidprice']; ?></td>
                        <input type="hidden" name="auction_id" value="<?php echo $auction['auction_id']; ?>">
                        <!-- <td><button type="submit" name="btn_restore" class="btn btn-success" value="<?php echo $auction['auction_id']; ?>">Restore</button></td> -->
                      </tr>
                    </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
            </div>
      </div>
    </div>
<?php include '../inc/footer.php'; ?>
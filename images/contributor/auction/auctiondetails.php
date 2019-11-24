<?php session_start();
include('../inc/header.php');
include('../inc/navigation.php');
include('../../config/db.php');

//Checking for the session in the user.
  $user_id = $_SESSION['user_id'];

  //Selecting  the auction details with the joining of details of the products
  $query = "SELECT * FROM auction_details a INNER JOIN products p on a.product_id=p.product_id WHERE user_id ='$user_id' AND auction_status ='active'";
  
  //Get Result after setting up the connection with the database.
  $result = mysqli_query($conn, $query);

  //Fetch Data from the database
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
        <li class="breadcrumb-item">Auction</li>
        <li class="breadcrumb-item active">Auction Details</li>
      </ol>
      <br><br>
      <div class="container">
         <h2>Auction Details</h2>
         <div class="table-responsive">
          <form action="auctiondelete.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Auction ID</th>
                    <th>Product Name</th><!-- 
                    <th>User ID</th>
                    <th>Bid Price</th> -->
                    <th>Edit</th>
                  </tr>
                </thead>
                <?php foreach($auction_details as $auction) : ?>
                    <tbody>
                      <tr>
                        <td><?php echo $auction['auction_id']; ?></td>
                        <td><?php echo $auction['product_name']; ?></td><!-- 
                        <td><?php echo $auction['user_id']; ?></td>
                        <td><?php echo $auction['bidprice']; ?></td> -->
                         <td><a href="/office/contributor/auction/biddetails.php?auction_id=<?php echo $auction['auction_id']; ?>" class ="btn btn-default" apperance="button">Details</a></td>
                        <input type="hidden" name="auction_id" value="<?php echo $auction['auction_id']; ?>">
                        <!-- <td><button type="submit" name="btn_delete" class="btn btn-danger" value="<?php echo $auction['auction_id']; ?>">Delete</button></td> -->
                      </tr>
                    </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
            </div>
      </div>
    </div>
<?php include '../inc/footer.php'; ?>
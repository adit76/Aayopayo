<?php session_start();
include('../../../config/db.php');

  //Selecting the auction details where the auction status is disactive.
  $query = "SELECT * FROM auction_details a INNER JOIN products p on a.product_id=p.product_id WHERE auction_status ='disactive'";
  
  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetching Data
  $auction_details = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //Free Result
  mysqli_free_result($result);

?>

  <?php include '../inc/header.php'; ?>
    <?php include '../inc/navigation.php'; ?>

  <div class="content-wrapper">
    <div class="container-fluid">
    <h2>Auction Details</h2>
         <table class="table">
           <thead>
             <tr>
               <th>Auction ID</th>
               <th>Product Name</th>
               <th>User ID</th>
               <th>Bid Price</th>
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
                      </tr>
                    </tbody>
                     <?php endforeach; ?> 
           </table>       
    
    </div>
  </div>
    <?php include '../inc/footer.php'; ?>
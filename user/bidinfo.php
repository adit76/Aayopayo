<?php 
  session_start();
  include('../config/db.php');
  include('inc/header.php');
  include('inc/navigation.php');
  //Auction which have status activated is selected.
  $query = "SELECT * FROM auction_details a INNER JOIN products p on a.product_id=p.product_id WHERE user_id =".$_SESSION['user_id'];
  
  //Get Result from the query runned.
  $result = mysqli_query($conn, $query);

  //Fetching data from the result.
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
  //Free Result
  mysqli_free_result($result);
?>

<div class="content-wrapper">
  <div class="container-fluid">
    <h2>Auction Participated</h2>
       <div class="table-responsive">
         <table class="table table-striped">
           <thead>
             <tr>
               <th>Product Id</th>
               <th>Product Name</th>
               <th>Bid Price</th>
               <th>Details</th>
             </tr>
           </thead>
           <?php foreach($rows as $row) : ?>
           <tbody>
             <tr>
               <td><?php echo $row['product_id']; ?></td>
               <td><?php echo $row['product_name']; ?></td>
               <td><?php echo $row['bidprice']; ?></td>
               <td><a href="/aayopayo/singleproduct/singleproduct.php?product_id=<?php echo $row['product_id']; ?>" class ="btn btn-default">Details</a></td>
             </tr>
           </tbody>
           <?php endforeach; ?>
         </table>
       </div>
  </div>
</div>

<?php include '../inc/footer.php' ?>

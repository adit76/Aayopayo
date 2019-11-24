<?php 
  session_start();

  //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/khel/config/db.php";
    include $path;

  //Select Query to select all the products where status is disactive.
  $query = "select * from products WHERE product_status ='disactive' order by product_id DESC ";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>
<?php include '../inc/header.php'; ?>
<?php include '../inc/navigation.php'; ?>

<div class="content-wrapper">
    <div class="container-fluid">
      <h2>Removed Products</h2>
      <form action="deleteproduct.php" method="POST">
         <table class="table">
           <thead>
             <tr>
               <th>Product ID</th>
               <th>Product Name</th>
               <th>Product Category</th>
               <th>End Time</th>
               <th>Delete</th>
             </tr>
           </thead>
            <?php foreach($products as $product) : ?>
            <tbody>
                  <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_category']; ?></td>
                    <td><?php echo $product['end_time']; ?></td>
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <td><button type="submit" name="btn_restore" class="btn btn-success" value="<?php echo $product['product_id']; ?>">Restore</button></td>
                  </tr>
                </tbody>
              <?php endforeach; ?>
         </table>   
       </form>
    </div>
  </div>
  <?php include '../inc/footer.php'; ?>
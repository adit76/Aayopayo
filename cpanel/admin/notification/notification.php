<?php 
  session_start();
   include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');

  //require('/aayopayo/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/aayopayo/config/db.php";
    include $path;

  //Selecting all the notification which require the approval for the update of the product.
  $query = "select * from notification order by product_id DESC ";

  //setting up connecting with the database and getting the result.
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/aayopayo/admin/index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Products</li>
      </ol>

      <div class="container">
         <h2>All Products</h2>
            <div class="table-responsive">
              <form action="deleteproduct.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>End Time</th>
                    <th>Credit Required</th>
                    <th>Requested Update Time</th>
                    <th>View Details</th>
                  </tr>
                </thead>
                <?php foreach($products as $product) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $product['user_id']; ?></td>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_category']; ?></td>
                    <td><?php echo $product['end_time']; ?></td>
                    <td><?php echo $product['minbid']; ?></td>
                    <td><?php echo $product['update_requested']; ?></td>
                    <td><a href="<?php echo $ROOT_URL1; ?>product/requestupdate.php?product_id=<?php echo $product['product_id']; ?>" class ="btn btn-success">Details</a></td>
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="notification_id" value="<?php echo $product['product_id']; ?>">
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
    <?php include '../inc/footer.php'; ?>
<?php 
  session_start();

  //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/khel/config/db.php";
    include $path;

    $user_id = $_SESSION['user_id'];

  //Selecting all the products where username added.
  $query = "select * from products WHERE added_by = '$user_id' AND product_status ='active' order by product_id DESC";


  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
          <a href="/khel/admin/index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active">View Products</li>
      </ol>

      <div class="container">
         <h2>All Products</h2>
            <div class="table-responsive">
              <form action="deleteproduct.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>End Time</th>
                    <th>Edit</th>
                    <!-- <th>Delete</th> -->
                  </tr>
                </thead>
                <?php foreach($products as $product) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['product_category']; ?></td>
                    <td><?php echo $product['end_time']; ?></td>
                    <td><a href="/khel/contributor/product/updateproduct.php?product_id=<?php echo $product['product_id']; ?>" class ="btn btn-default" apperance = "button">Edit</a></td>
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
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
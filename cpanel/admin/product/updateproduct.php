<?php 
session_start();
ob_start();

if(!isset($_REQUEST["product_id"])){
   exit("Send product_id parameter as well.");
 }
 include('../inc/header.php');
 include('../inc/navigation.php');
 

//If the update button is clicked on the product.
if(isset($_POST['update'])){
  //Image information is saved to this path
  $target="../../images/".basename($_FILES['large']['name']);
  $image=$_FILES['large']['name'];

  //Get form data
  $update_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_category = $_POST['product_category'];
  $product_features = $_POST['product_features'];
  $market_price = $_POST['market_price'];
  $minbid = $_POST['minbid'];
  $product_image = $image;
  $end_time = $_POST['end_time'];

  //Updating the product and setting up new information in the fields.
  $query= "UPDATE products SET 
            product_name='$product_name',
            product_category='$product_category',
            product_features='$product_features',
            market_price='$market_price',
            minbid='$minbid',
            product_image='$product_image',
            end_time='$end_time'
              WHERE product_id =".$update_id;

      $update = $conn->query($query);
      if($update){
      //if the update query successfully execute. the image is uploaded to the images folder and the path is above.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
          header('location:viewproduct.php');
        }
      }else{
        $error = "Error in adding the Product";
      }

}

//Getting the id of the product which is to be updated.
$product_id = mysqli_real_escape_string($conn, $_REQUEST['product_id']);

//Selecting all the product which have the product id.
$query='select * from products where product_id = '.$product_id;
//connecting with the database.
$result= mysqli_query($conn, $query);
//Getch Data
$products = mysqli_fetch_assoc($result);

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active">Update Products</li>
      </ol>


      <div class="container"">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="updateproduct.php">
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_name">Product Name:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_name" value="<?php echo $products['product_name']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_category">Product Category:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_category" value="<?php echo $products['product_category']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_features">Product Features:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_features" value="<?php echo $products['product_features']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="market_price">Product Market Price:</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="market_price" value="<?php echo $products['market_price']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="minbid">Product Market Price:</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="minbid" value="<?php echo $products['minbid']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="end_date">End Date:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="end_time" value="<?php echo $products['end_time']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_image">Product Image:</label>
                <div class="col-sm-9">
                  <?php echo '<img  width="400px" height="200px" src="/aayopayo/images/'.$products['product_image'].'">'; ?>
                </div>
              </div>
              <input type="hidden" name="product_id" value="<?php echo $_REQUEST["product_id"]; ?>">
            </form>
      </div>

    </div>
<?php include '../inc/footer.php'; ?>
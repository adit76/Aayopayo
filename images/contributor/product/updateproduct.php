<?php 
session_start();
ob_start();

if(!isset($_REQUEST["product_id"])){
   exit("Send product_id parameter as well.");
 }
 include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');

//When the user click on update button on update product page from the product page.
if(isset($_POST['update'])){

  //Saving the uploaded image file to the given path folder.
  $target="../../images/".basename($_FILES['large']['name']);
  $image=$_FILES['large']['name'];

  //Get form data
  $user_id = $_SESSION['user_id'];
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_category = $_POST['product_category'];
  $product_features = $_POST['product_features'];
  $market_price = $_POST['market_price'];
  $minbid = $_POST['minbid'];
  $end_time = $_POST['end_time'];
  $product_image =$image;

  //Update product query savesa all the details to the notification table along with the product_id and the user id 
  $update_product = "INSERT INTO notification(user_id, product_id, product_name, product_category, product_features, market_price, minbid, end_time, product_image, update_status) VALUES ('$user_id','$product_id','$product_name','$product_category','$product_features','$market_price','$minbid','$end_time','$product_image','update requested')";

  //Executing the above query
      $update = $conn->query($update_product);
      if($update){
        //movint the uploaded image in the target file.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target))
          //User is redirected to this age
        header('Location:viewproduct.php');
      }else{
        $error = "Error in adding the Product";
      }

}

//Getting the product id 
$product_id = mysqli_real_escape_string($conn, $_REQUEST['product_id']);

//Selecting all the product
$query='select * from products where product_id = '.$product_id;
//Get result
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


        <div class="container">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="updateproduct.php?product_id=<?php echo $products['product_id']; ?>">
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_name">Product Name:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="product_name" value="<?php echo $products['product_name']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_category">Product Category:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="product_category" value="<?php echo $products['product_category']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_features">Product Features:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="product_features" value="<?php echo $products['product_features']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="market_price">Product Market Price:</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="market_price" value="<?php echo $products['market_price']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="minbid">Minimum Credit Required: </label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="minbid" value="<?php echo $products['minbid']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="end_date">End Time:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="end_time" value="<?php echo $products['end_time']; ?>">
                </div>
              </div>  
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_image">Product Image:</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="large"><br>
                  <?php echo '<img  width="400px" height="200px" src="/office/images/'.$products['product_image'].'" >'; ?>
                </div>
              </div>            
              <input type="hidden" name="product_id" value="<?php echo $_REQUEST["product_id"]; ?>">
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" name="update" class="btn btn-default" value="Update">
                </div>
              </div>
            </form>
      </div>

    </div>

<?php include '../inc/footer.php'; ?>
<?php 
session_start();
ob_start();

if(!isset($_REQUEST["notification_id"])){
   exit("Send notification_id parameter as well.");
 }
 
   //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/khel/config/db.php";
    include $path;

 include('../inc/navigation.php');
 include('../inc/header.php');

//When the admin clicks on approve button following code runs.
if(isset($_POST['approve'])){
  //Get form data
  $update_id = $_POST['notification_id'];
  $product_name = $_POST['product_name'];
  $product_category = $_POST['product_category'];
  $product_features = $_POST['product_features'];
  $market_price = $_POST['market_price'];
  $minbid = $_POST['minbid'];
  $end_time = $_POST['end_time'];
  $added_by = $_POST['added_by'];
  $product_image = $_POST['image'];

  //Updating the products table and putting all the details which the contributor wants to update.
  $query= "INSERT INTO products(product_name, product_category, product_features, market_price, minbid, product_image, end_time, added_by, product_status) VALUES ('$product_name','$product_category','$product_features','$market_price','$minbid','$product_image','$end_time','$added_by','active')";

      $update = $conn->query($query);
      if($update){
        //When the update query is success. The following code runs and delete notification which are present on the notification table.
        $remove= "DELETE FROM `notification` WHERE notification_id =".$update_id;

        $delete = $conn->query($remove);
          if($delete){
            //user is redirected to the viewproduct page.
            header('Location:viewproduct.php');
          }else{
            $error = "Error in removing the notification";
          }
      }else{
        $error = "Error in updating the Product";
      }
}

//Getting the id of the product which is to be updated.
$notification_id = mysqli_real_escape_string($conn, $_REQUEST['notification_id']);
/*Selecting the notification which is to be updated*/
$query='select * from notification where notification_id = '.$notification_id;

//Geting result
$result= mysqli_query($conn, $query);

//Fetching and keepting the result in the following variables respectively.
$notification_id = mysqli_fetch_assoc($result);

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container">
          <h2>New Information</h2>
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="addproductapproval.php">
              <div class="row" style="float: right;">
                <div class="form-group">
                  <label class="control-label col-sm-6" for="product_name">Product Name:</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" name="product_name" value="<?php echo $notification['product_name']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6" for="product_category">Product Category:</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" name="product_category" value="<?php echo $notification['product_category']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6" for="product_features">Product Features:</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" name="product_features" value="<?php echo $notification['product_features']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6" for="market_price">Product Market Price:</label>
                  <div class="col-sm-11">
                    <input type="number" class="form-control" name="market_price" value="<?php echo $notification['market_price']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6" for="minbid">Minimum Credit Required:</label>
                  <div class="col-sm-11">
                    <input type="number" class="form-control" name="minbid" value="<?php echo $notification['minbid']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6" for="end_date">End Date:</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" name="end_time" value="<?php echo $notification['end_time']; ?>" readonly>
                  </div>
                </div>
                <div class="form-group" name="image">
                  <label class="control-label col-sm-6" for="Image">Image:</label>
                  <div class="col-sm-11">
                   <?php echo '<img  width="600px" height="200px" src="/khel/images/'.$notification['product_image'].'">'; ?>
                  </div>
                </div>
                <input type="hidden" name="notification_id" value="<?php echo $_REQUEST["notification_id"]; ?>">
                <input type="hidden" name="image" value="<?php echo $notification["product_image"]; ?>">
                <input type="hidden" name="added_by" value="<?php echo $notification["user_id"]; ?>">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-11">
                    <input type="submit" name="approve" class="btn btn-success" value="Approve ">
                    <input type="submit" name="decline" class="btn btn-danger" value="Decline ">
                  </div>
                </div>
            </div>
          </form>
      </div>
    </div>
</div>    

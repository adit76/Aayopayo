<?php 
session_start();
ob_start();

if(!isset($_REQUEST["product_id"])){
   exit("Send product_id parameter as well.");
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
  $update_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_category = $_POST['product_category'];
  $product_features = $_POST['product_features'];
  $market_price = $_POST['market_price'];
  $minbid = $_POST['minbid'];
  $end_time = $_POST['end_time'];
  $product_image = $_POST['image'];

  //Updating the products table and putting all the details which the contributor wants to update.
  $query= "UPDATE products SET 
            product_name='$product_name',
            product_category='$product_category',
            product_features='$product_features',
            market_price='$market_price',
            minbid='$minbid',
            product_image='$product_image',
            end_time='$end_time'            
              WHERE product_id =".$update_id;
        
/*              echo $query;*/

      $update = $conn->query($query);
      if($update){
        //When the update query is success. The following code runs and delete notification which are present on the notification table.
        $remove= "DELETE FROM `notification` WHERE product_id =".$update_id;

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
$product_id = mysqli_real_escape_string($conn, $_REQUEST['product_id']);
/*Selecting the notification which is to be updated*/
$query='select * from notification where product_id = '.$product_id;

//Getting all the products details from the product page where the old information lies.
$get_old='select * from products where product_id = '.$product_id;

//Geting result
$result= mysqli_query($conn, $query);
$result1= mysqli_query($conn, $get_old);

//Fetching and keepting the result in the following variables respectively.
$notification = mysqli_fetch_assoc($result);
$products = mysqli_fetch_assoc($result1);

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Notification</li>
        <li class="breadcrumb-item active">Requested Updates</li>
      </ol>

      <div class="container">
        <h2>Old Information</h2>
        <div class="row" style="float: left;">
            <div class="form-group">
              <label class="control-label col-sm-6" for="product_id">Product ID:</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="product_id" value="<?php echo $products['product_id']; ?>" readonly>
              </div>
            </div>
            <br>
            <div class="form-group">
              <label class="control-label col-sm-6" for="product_name">Product Name:</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="product_name" value="<?php echo $products['product_name']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-6" for="product_category">Product Category:</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="product_category" value="<?php echo $products['product_category']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-6" for="product_features">Product Features:</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="product_features" value="<?php echo $products['product_features']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-6" for="market_price">Product Market Price:</label>
              <div class="col-sm-11">
                <input type="number" class="form-control" name="market_price" value="<?php echo $products['market_price']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-6" for="market_price">Minimum Credit Required:</label>
              <div class="col-sm-11">
                <input type="number" class="form-control" name="minbid" value="<?php echo $products['minbid']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-6" for="end_date">End Date:</label>
              <div class="col-sm-11">
                <input type="text" class="form-control" name="end_time" value="<?php echo $products['end_time']; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-6" for="minbid_price">Image:</label>
              <div class="col-sm-11">
               <?php echo '<img  width="400px" height="200px" name="large" src="/khel/images/'.$products['product_image'].'" >'; ?>
              </div>
            </div>              
            <input type="hidden" name="product_id" value="<?php echo $_REQUEST["product_id"]; ?>">
        </div>  

          <h2>New Information</h2>
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="requestupdate.php">
              <div class="row" style="float: right;">
                <div class="form-group">
                  <label class="control-label col-sm-6" for="product_id">Product ID:</label>
                  <div class="col-sm-11">
                    <input type="text" class="form-control" name="product_id" value="<?php echo $notification['product_id']; ?>" readonly>
                  </div>
                </div>
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
                  <label class="control-label col-sm-6" for="minbid_price">Image:</label>
                  <div class="col-sm-11">
                   <?php echo '<img  width="600px" height="200px" src="/khel/images/'.$notification['product_image'].'">'; ?>
                  </div>
                </div>
                <input type="hidden" name="product_id" value="<?php echo $_REQUEST["product_id"]; ?>">
                <input type="hidden" name="image" value="<?php echo $notification["product_image"]; ?>">
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

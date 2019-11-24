<?php 
  session_start();

  $user_id = $_SESSION['user_id'];
include('../../config/db.php');
include('../inc/header.php');
include('../inc/navigation.php');


if(!isset($_SESSION['username'])){
    header('Location: /khel/login.php');
    die(); 
}

//if the contributor clicks on the submit
	if(isset($_POST['submit'])){

    //saving the uploaded image in the path.
    $target="../../images/".basename($_FILES['large']['name']);
    $image=$_FILES['large']['name'];

    //Get all the submitted data from the form
		$product_name = $_POST['product_name'];
		$product_category = $_POST['product_category'];
		$product_features = $_POST['product_features'];
		$market_price = $_POST['market_price'];
    $minbid = $_POST['minbid'];
    $end_time = $_POST['end_time'];
    $added_by = $_SESSION['username'];
    $product_image=$image;


		if($product_name !='' && $product_category !='' && $product_features !='' && $market_price !='' && $minbid !='' && $product_image !='' && $end_time !=''){

      //if all the required fields are properly set. Following query runs and the values are set in their respective fields.
			$insert_product = "INSERT INTO notification(user_id, product_id, product_name, product_category, product_features, market_price, minbid, end_time, product_image, update_status) VALUES ('$user_id','','$product_name','$product_category','$product_features','$market_price','$minbid','$end_time','$product_image','approverequest')";

      //executing the query of inserting in the databae.
			$query = $conn->query($insert_product);
			if($query){
        //moving the uploaded files tot the destination folder.
				if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
				    $error = "Product send for approval!!!";
			    }
			}else{
        //If there comes any error while adding the products.
				$error = "Error in adding the Product";
			}
		}
		}else{
			$error = 'Please fill all the Product Details Now';
		}
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="http://localhost/khel/">Dashboard</a>
        </li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active">Add New Products</li>
      </ol>
      <div class="form-group">
        <?php if(isset($_POST['submit'])): ?>
          <div class="alert alert-dismissible alert-success">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
      </div>
        <div class="container">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="addproduct.php">
              <input type="hidden" name="size" value="90000">
              <div class="form-group">
                <input type="hidden" name="size" value="90000">
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_name">Product Name:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_category">Product Category:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_category" placeholder="Enter Product Category">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="product_features">Product Features:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="product_features" placeholder="Enter Product Features">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="market_price">Product Market Price:</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="market_price" placeholder="Enter Market Price">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="minbid">Minimum Credit Required</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="minbid" placeholder="Minimum required credit">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="image">Product Image:</label>
                <div class="col-sm-9">
                  <input type="file" name="large" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="end_date">End Time:</label>
                <div class="col-sm-9">
                  <input type="datetime-local" class="form-control" name="end_time" placeholder="Enter End Date">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                  <input type="submit" name="submit" value="Add" class="btn btn-default">
                </div>
              </div>
            </form>
      </div>
    </div>

<?php include '../inc/footer.php'; ?>
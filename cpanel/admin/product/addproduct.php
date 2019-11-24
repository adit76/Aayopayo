<?php 
  include '../inc/header.php';
  include '../inc/navigation.php';

  //When the submit button is clicked on the add product form. Following code runns
  if(isset($_POST['submit'])){

    //This sets the path where the image is saved.
    $target="../../../images/".basename($_FILES['large']['name']);
    $image=$_FILES['large']['name'];

    //Get all the submitted data from the form    
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_features = mysqli_real_escape_string($conn, $_POST['product_features']);
    $market_price = mysqli_real_escape_string($conn, $_POST['market_price']);
    $minbid = mysqli_real_escape_string($conn, $_POST['minbid']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
    $product_image=$image;

    //This checks if the text box is empty in the required value.
    if($product_name !='' && $product_category !='' && $product_features !='' && $market_price !='' && $minbid !='' && $product_image !='' && $end_time !=''){
      //if all the fields are properly provided. Then the value is inserted in the database.
      $insert_product = "INSERT INTO products(product_id, product_name, product_category, product_features, market_price, minbid, product_image, end_time, added_by, product_status) VALUES ('product_id','$product_name','$product_category','$product_features','$market_price','$minbid','$product_image','$end_time','admin','active')";

      //setting up the connection with the database.
      $query = $conn->query($insert_product);
      if($query){
        //if the insert query becomes success, the image is saved to the provided path above and user is redirected to the view product page.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
          header('location:viewproduct.php');
          }
      }else{
        //if error arrises in adding the product.
        $error = "Error in adding the Product";
      }
    }
    }else{
      $error = 'Please fill all the Product Details Now';
    }
?>


  <div class="content-wrapper">
    <div class="container-fluid">
      <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?> ">
            <div class="form-group">
                <label for="productname">Product Name:</label>
                <input type="text" class="form-control" name="product_name" placeholder="Product Name">
            </div>
            <div class="form-group">
              <label for="produtcategory">Product Category</label>
              <input type="text" class="form-control" name="product_category" placeholder="Product Category">
            </div>

            <div class="form-group">
              <label for="productfeature">Product Feature</label>
              <input type="text" class="form-control" name="product_features" placeholder="Product Features">
            </div>
            <div class="form-group">
              <label for="productmarketprice">Product Market Price</label>
              <input type="number" class="form-control" name="market_price" placeholder="Product MarketPrice">
            </div>
            <div class="form-group">
              <label for="productmarketprice">Minimum Credit Required</label>
              <input type="number" class="form-control" name="minbid" placeholder="Product MarketPrice">
            </div>
            <div class="form-group">
              <label for="image">Product Image</label>
              <input type="file" class="form-control" name="large" placeholder="Upload Image of your product">
            </div>

            <div class="form-group">
              <label for="endtime">End Time</label>
              <input type="datetime-local" class="form-control" name="end_time" placeholder="End Time">
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                  <input type="submit" name="submit" value="Insert" class="btn btn-default">
                </div>
              </div>
          </form>
          </div>
  </div>
  <?php include '../inc/footer.php' ?>
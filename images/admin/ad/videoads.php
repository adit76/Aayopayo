<?php
ob_start();
session_start();
 include('../../config/db.php'); 
 include ('../inc/header.php'); 
 include ('../inc/navigation.php'); 

//If the session is not present. The user is redirected ot the login page.
if(!isset($_SESSION['username'])){
    header('Location: /khel/login.php');
    die(); 
}

  //When the submit button is clicked on the add ad form. Following code runns
  if(isset($_POST['submit'])){

    //This sets the path where the image is saved.
    $target="../../images/".basename($_FILES['large']['name']);
    $image=$_FILES['large']['name'];

    if(isset($_POST['submit'])){

    //This sets the path where the image is saved.
    $target="../../images/".basename($_FILES['large']['name']);
    $image=$_FILES['large']['name'];

    //Get all the submitted data from the form    
    $ad_name = $_POST['ad_name'];
    $ad_owner = $_POST['ad_owner'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $ad_image=$image;

    //This checks if the text box is empty in the required value.
    if($ad_name !='' && $ad_owner !='' && $ad_image !=''){
      //if all the fields are properly provided. Then the value is inserted in the database.
      $insert_ad = "INSERT INTO ads(ad_name, ad_owner, ad_image, ad_status, no_of_clicks, ad_start_date, ad_end_date) VALUES ('$ad_name','$ad_owner','$ad_image','active',0, '$start_date', '$end_date')";

/*      echo $insert_ad;*/

      //setting up the connection with the database.
      $query = $conn->query($insert_ad);
      if($query){
        //if the insert query becomes success, the image is saved to the provided path above and user is redirected to the view ad page.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
          header('location:viewad.php');
          }
      }else{
        //if error arrises in adding the ad.
        $error = "Error in adding the ad";
      }
    }
    }else{
      $error = 'Please fill all the ad Details Now';
    }
  }
?>


<div class="content-wrapper">
    <div class="container-fluid">

        <div class="container">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?> ">
              <div class="form-group">
                <label class="control-label col-sm-3" for="ad_name">Ad Name:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="ad_name" placeholder="Enter ad Name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="ad_category">Ad Owner:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="ad_owner" placeholder="Enter ad Category">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="start_date">Start Date:</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="start_date" placeholder="Enter start date">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="end_date">End Date:</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="end_date" placeholder="Enter end date">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="image">Ad Image:</label>
                <div class="col-sm-9">
                  <input type="file" name="large" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                  <input type="submit" name="submit" value="Insert" class="btn btn-default">
                </div>
              </div>
            </form>
           
    </div>
    <?php include '../inc/footer.php'; ?>
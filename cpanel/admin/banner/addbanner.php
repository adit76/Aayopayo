<?php
 include ('../inc/header.php'); 
 include ('../inc/navigation.php'); 

  //When the submit button is clicked on the add ad form. Following code runns
  if(isset($_POST['submit'])){

    //This sets the path where the image is saved.
    $target="../../../images/".basename($_FILES['large']['name']);
    $image=$_FILES['large']['name'];

    if(isset($_POST['submit'])){

    //This sets the path where the image is saved.
    $target="../../../images/banners/".basename($_FILES['large']['name']);
    $image=$_FILES['large']['name'];

    //Get all the submitted data from the form    
    $banner_name = $_POST['banner_name'];
    $banner_image=$image;

    //This checks if the text box is empty in the required value.
    if($banner_name !='' && $banner_image !=''){
      //if all the fields are properly provided. Then the value is inserted in the database.
      $insert_banner = "INSERT INTO banner(banner_name, banner_image, banner_status) VALUES ('$banner_name','$banner_image','active')";

/*      echo $insert_ad;*/

      //setting up the connection with the database.
      $query = $conn->query($insert_banner);
      if($query){
        //if the insert query becomes success, the image is saved to the provided path above and user is redirected to the view ad page.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
          header('location:viewbanner.php');
          }
      }else{
        //if error arrises in adding the ad.
        $error = "Error in adding the banner";
      }
    }
    }else{
      $error = 'Please fill all the banner Details Now';
    }
  }
?>


<div class="content-wrapper">
    <div class="container-fluid">

        <div class="container">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?> ">
              <div class="form-group">
                <label class="control-label col-sm-3" for="image">Banner Name:</label>
                <div class="col-sm-9">
                  <input type="text" name="banner_name" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="image">Banner Image:</label>
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
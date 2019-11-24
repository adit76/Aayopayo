<?php 
 include('../inc/header.php');
 include('../inc/navigation.php');

//If the update button is clicked on the banner.
if(isset($_POST['update'])){
  //Image information is saved to this path
  $target="../../../images/banners/".basename($_FILES['large']['name']);
  $image=$_FILES['large']['name'];

  //Get form data
  $update_id = $_POST['banner_id'];
  $banner_name = $_POST['banner_name'];
  $banner_image = $image;

  //Updating the banner and setting up new information in the fields.
  $query= "UPDATE banner SET          
            banner_name='$banner_name',
            banner_image='$banner_image'
              WHERE banner_id =".$update_id;



      $update = $conn->query($query);
      if($update){
      //if the update query successfully execute. the image is uplobannered to the images folder and the path is above.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
          header('location:viewbanner.php');
        }
      }else{
        $error = "Error in adding the banner";
      }

}

//Getting the id of the banner which is to be updated.
$banner_id = mysqli_real_escape_string($conn, $_REQUEST['banner_id']);

//Selecting all the banner which have the banner id.
$query='select * from banner where banner_id = '.$banner_id;
//connecting with the database.
$result= mysqli_query($conn, $query);
//Getch Data
$banners = mysqli_fetch_assoc($result);

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="container"">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>">
              <div class="form-group">
                <label class="control-label col-sm-3" for="banner_name">Banner Description:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="banner_name" value="<?php echo $banners['banner_name']; ?>" rebanneronly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="banner_image">Banner Image:</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="large"><br>
                  <?php echo '<img  width="400px" height="200px" src="/aayopayo/images/banners/'.$banners['banner_image'].'">'; ?>
                </div>
              </div>
              <td><button type="submit" name="update" class="btn btn-success">Update</button></td>
              <input type="hidden" name="banner_id" value="<?php echo $_REQUEST["banner_id"]; ?>">
            </form>
      </div>

    </div>
    <?php include '../inc/footer.php'; ?>

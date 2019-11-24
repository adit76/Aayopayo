<?php 
session_start();
ob_start();

if(!isset($_REQUEST["ad_id"])){
   exit("Send ad_id parameter as well.");
 }
 include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');

//If the update button is clicked on the ad.
if(isset($_POST['update'])){
  //Image information is saved to this path
  $target="../../images/".basename($_FILES['large']['name']);
  $image=$_FILES['large']['name'];

  //Get form data
  $update_id = $_POST['ad_id'];
  $ad_name = $_POST['ad_name'];
  $ad_owner = $_POST['ad_owner'];
  $ad_start_date = $_POST['ad_start_date'];
  $ad_end_date = $_POST['ad_end_date'];
  $ad_image = $image;

  //Updating the ad and setting up new information in the fields.
  $query= "UPDATE ads SET 
            ad_name='$ad_name',
            ad_owner='$ad_owner',            
            ad_image='$ad_image',
            ad_start_date='$ad_start_date',            
            ad_end_date='$ad_end_date'             
              WHERE ad_id =".$update_id;

      $update = $conn->query($query);
      if($update){
      //if the update query successfully execute. the image is uploaded to the images folder and the path is above.
        if(move_uploaded_file($_FILES['large']['tmp_name'], $target)){
          header('location:viewad.php');
        }
      }else{
        $error = "Error in adding the ad";
      }

}

//Getting the id of the ad which is to be updated.
$ad_id = mysqli_real_escape_string($conn, $_REQUEST['ad_id']);

//Selecting all the ad which have the ad id.
$query='select * from ads where ad_id = '.$ad_id;
//connecting with the database.
$result= mysqli_query($conn, $query);
//Getch Data
$ads = mysqli_fetch_assoc($result);

?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item">ad</li>
        <li class="breadcrumb-item active">Update ads</li>
      </ol>


      <div class="container"">
            <form method="POST" class="form-horizontal" enctype="multipart/form-data" action="updatead.php">
              <div class="form-group">
                <label class="control-label col-sm-3" for="ad_name">Ad Name:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="ad_name" value="<?php echo $ads['ad_name']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="ad_features">Ad Owner:</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="ad_owner" value="<?php echo $ads['ad_owner']; ?>" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="ad_image">ad Image:</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="large"><br>
                  <?php echo '<img  width="400px" height="200px" src="/khel/images/'.$ads['ad_image'].'">'; ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="start_date">Start Date:</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="ad_start_date" placeholder="Enter start date">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="end_date">End Date:</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" name="ad_end_date" placeholder="Enter end date">
                </div>
              </div>
              <td><button type="submit" name="update" class="btn btn-success">Update</button></td>
              <input type="hidden" name="ad_id" value="<?php echo $_REQUEST["ad_id"]; ?>">
            </form>
      </div>

    </div>

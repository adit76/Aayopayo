<?php 
  session_start();
  ob_start();

  //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/khel/config/db.php";
    include $path;

  //Select Query to select all the ads where status is disactive.
  $query = "select * from banner WHERE banner_status ='disactive' order by banner_id DESC ";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $banners = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($ads);

  //Free Result
  mysqli_free_result($result);
?>


<?php include ('../inc/header.php'); ?>
<?php include ('../inc/navigation.php'); ?>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="container">
         <h2>Removed Banners</h2>
            <div class="table-responsive">
              <form action="deletebanner.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Banner ID</th>
                    <th>Banner Details</th>
                    <th>Banner Image</th>
                    <th>Restore</th>
                  </tr>
                </thead>
                <?php foreach($banners as $banner) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $banner['banner_id']; ?></td>
                    <td><?php echo $banner['banner_name']; ?></td>
                    <td><?php echo '<img  width="400px" height="200px" src="/khel/images/banners/'.$banner['banner_image'].'">'; ?></td>
                    <input type="hidden" name="banner_id" value="<?php echo $banner['banner_id']; ?>">
                    <td><button type="submit" name="btn_restore" class="btn btn-success" value="<?php echo $banner['banner_id']; ?>">Restore</button></td>
                  </tr>
                </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
            </div>
          </div> 
      </div>
    </div>
           
    </div>
    <?php include '../inc/footer.php' ?>
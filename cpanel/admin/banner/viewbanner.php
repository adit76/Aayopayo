<?php 
 include ('../inc/header.php');
 include ('../inc/navigation.php');

  //Selecting all the products which have statuse as active. Query
  $query = "select * from banner WHERE banner_status ='active' order by banner_id DESC ";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $banners = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>

<div class="content-wrapper">
    <div class="container-fluid">
      <h2>All Products</h2>
            <div class="table-responsive">
              <form action="deletebanner.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Banner ID</th>
                    <th>Banner Details</th>
                    <th>View</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <?php foreach($banners as $banner) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $banner['banner_id']; ?></td>
                    <td><?php echo $banner['banner_image']; ?></td>

                    <td><a href="/aayopayo/cpanel/admin/banner/updatebanner.php?banner_id=<?php echo $banner['banner_id']; ?>" class ="btn btn-info">Details</a></td>
                    <input type="hidden" name="banner_id" value="<?php echo $banner['banner_id']; ?>">
                    <td><button type="submit" name="btn_delete" class="btn btn-danger" value="<?php echo $banner['banner_id']; ?>">Delete</button></td>
                  </tr>
                </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
            </div>
          </div> 
      </div>
      <?php include '../inc/footer.php'; ?>
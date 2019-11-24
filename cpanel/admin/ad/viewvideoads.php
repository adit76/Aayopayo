<?php 
  include ('../inc/header.php');
  include ('../inc/navigation.php');

  //Selecting all the products which have statuse as active. Query
  $query = "select * from ads WHERE ad_status ='active' AND ad_type = 'video' order by ad_id DESC ";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
?>

<div class="content-wrapper">
    <div class="container-fluid">
      <h2>All Products</h2>
            <div class="table-responsive">
              <form action="deletead.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Ad ID</th>
                    <th>Ad Name</th>
                    <th>Ad Owner</th>
                    <th>Ad Status</th>
                    <th>No Of Clicks</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Details</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <?php foreach($ads as $ad) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $ad['ad_id']; ?></td>
                    <td><?php echo $ad['ad_name']; ?></td>
                    <td><?php echo $ad['ad_owner']; ?></td>
                    <td><?php echo $ad['ad_status']; ?></td>
                    <td><?php echo $ad['no_of_clicks']; ?></td>
                    <td><?php echo $ad['ad_start_date']; ?></td>
                    <td><?php echo $ad['ad_end_date']; ?></td>

                    <td><a href="/aayopayo/cpanel/admin/ad/updatead.php?ad_id=<?php echo $ad['ad_id']; ?>" class ="btn btn-info">Details</a></td>
                    <input type="hidden" name="ad_id" value="<?php echo $ad['ad_id']; ?>">
                    <td><button type="submit" name="btn_delete" class="btn btn-danger" value="<?php echo $ad['ad_id']; ?>">Delete</button></td>
                  </tr>
                </tbody>
                <?php endforeach; ?> 
              </table>
            </form>  
            </div>
          </div> 
      </div>
      <?php include '../inc/footer.php'; ?>
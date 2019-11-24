<?php 
  session_start();
  ob_start();

  //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/khel/config/db.php";
    include $path;

  //Select Query to select all the ads where status is disactive.
  $query = "select * from ads WHERE ad_status ='disactive' order by ad_id DESC ";

  //Get Result
  $result = mysqli_query($conn, $query);

  //Fetch Data
  $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //var_dump($ads);

  //Free Result
  mysqli_free_result($result);
?>


<?php include ('../inc/header.php'); ?>
<?php include ('../inc/navigation.php'); ?>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="container">
         <h2>Removed ads</h2>
            <div class="table-responsive">
              <form action="deletead.php" method="POST">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>ad ID</th>
                    <th>Ad Name</th>
                    <th>Ad Owner</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Restore</th>
                  </tr>
                </thead>
                <?php foreach($ads as $ad) : ?>
                <tbody>
                  <tr>
                    <td><?php echo $ad['ad_id']; ?></td>
                    <td><?php echo $ad['ad_name']; ?></td>
                    <td><?php echo $ad['ad_owner']; ?></td>
                    <td><?php echo $ad['ad_start_date']; ?></td>
                    <td><?php echo $ad['ad_end_date']; ?></td>

                    <input type="hidden" name="ad_id" value="<?php echo $ad['ad_id']; ?>">
                    <td><button type="submit" name="btn_restore" class="btn btn-success" value="<?php echo $ad['ad_id']; ?>">Restore</button></td>
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
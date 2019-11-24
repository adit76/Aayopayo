<?php 
  //require('/khel/config/db.php');
  $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/khel/config/db.php";
    include $path;

  //Selecting all the notification which require the approval for the update of the product.
  $querys = "select * from notification order by product_id DESC LIMIT 5";

  //setting up connecting with the database and getting the result.
  $results = mysqli_query($conn, $querys);

  //Fetch Data
  $notifications = mysqli_fetch_all($results, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($results);
?>

<li class="nav-item dropdown" style="margin-right: 50px;">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i><span>Notification's</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Notification:</h6>
            <div class="dropdown-divider"></div>  
            <div id="div1">
            <?php foreach($notifications as $notification) : ?>
              <?php if($notification['update_status'] == 'approverequest'){ ?>
              <a class="dropdown-item" href="/khel/admin/product/addproductapproval.php?notification_id=<?php echo $notification['notification_id']; ?>">
        <?php   }else{ ?>
              <a class="dropdown-item" href="/khel/admin/product/requestupdate.php?product_id=<?php echo $notification['product_id']; ?>">
        <?php    } ?>
                <span class="text">
                  <strong><?php echo $notification['product_name']; ?></strong>
                </span>
            <div class="dropdown-divider"></div>  
                <div class="dropdown-message small"><strong>Product Details</strong></div>
                <div class="dropdown-message"><?php echo $notification['update_status']; ?></div>
              </a>
              <div class="dropdown-divider"></div>
            <?php endforeach; ?> 
          </div>
            <a class="dropdown-item small" href="/khel/admin/notification/notification.php">View all notifications</a>
          </div>
        </li>
</script>
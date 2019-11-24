<?php
include ('../config/db.php'); 
include ('../inc/header.php');
include ('../inc/nav.php');

//setting the timezone for the time field
date_default_timezone_set("Asia/Kathmandu");

//Click on the bid button following code runs
    if(isset($_POST['bid'])){
    //Get all the submitted data from the form 
      $user_id = $_SESSION['user_id'];
      $bidprice = $_POST['bidprice'];
      $product_id = $_POST['product_id'];

      //if the user input some number
      if($bidprice !=""){
        //selecting all the details of auction_details where user id and product id is saved.
        $sql = "SELECT * FROM auction_details WHERE user_id ='$user_id' AND product_id=".$product_id ;
        //setting up the connection with the database.
        $result=mysqli_query($conn, $sql) or die('Error in connection');
        //if the user has already bidded on the product, the bid is updated in the database
        if($row = mysqli_num_rows($result) > 0){
                $error="Bid has already placed for this product.";              
        }else{
          //checking the database for the username and password
          $sql2 = "SELECT * FROM statics WHERE user_id=".$user_id;

          $check_coin=mysqli_query($conn, $sql2) or die('Error');
          //if there is someone with the procided username and password.
            while($row = mysqli_fetch_assoc($check_coin)){
              $credit_left = $row['credit_left'];
          
              if($bidprice > $credit_left){
                $error = "Sorry you dont have enough credit";
              }else{
              //if the user has not bidded on the product yet the details are saved in the database
              $error = "Congratulations! Your bidding is Successfully done.";
              $bidnow = "INSERT INTO auction_details(user_id, bidprice, product_id, auction_status) VALUES ('$user_id','$bidprice','$product_id','active')";
              $query = $conn->query($bidnow);
                if($query){
                  $credit_used = $credit_left-$bidprice;
                  $update_coin = "UPDATE statics SET credit_left='$credit_used' WHERE user_id =".$user_id;

                  if($update_coin){
                    $query = $conn->query($update_coin);
                  }else{
                    $error="Updating the coin is failed";
                  }
                }else{
                  $error="Error in Bidding";
                }
            }
        }
      }
    }else{
        $error="Please Bid first!!";
    }
  }

//get ID
$product_id = mysqli_real_escape_string($conn, $_REQUEST['product_id']);

/*create Query*/
$query='select * from products where product_id = '.$product_id;

//Get result
$result= mysqli_query($conn, $query);

//Getch Data
$products = mysqli_fetch_assoc($result);
$list_bidder= "SELECT DISTINCT username FROM auction_details a INNER JOIN users u on a.user_id= u.user_id WHERE product_id =".$product_id;
$sqldata= mysqli_query($conn, $list_bidder) or die ('error');


$select_winner = "select username, bidprice, count(*) MY_COUNT from auction_details a inner join users u on a.user_id = u.user_id where PRODUCT_ID='$product_id' GROUP BY bidprice order by my_count ASC limit 1";


$winner= mysqli_query($conn, $select_winner) or die (mysqli_error($conn));

 include ('../inc/header.php');
include('../inc/nav.php'); 
?>


	<div class="wrapper" style="margin-top:100px;">
		<img class="drift-demo-trigger" data-zoom="/khel/images/<?php echo $products['product_image']; ?>" src="/khel/images/<?php echo $products['product_image']; ?>" href="/khel/images/<?php echo $products['product_image']; ?>">

		<div class="detail">

         <?php if(isset($_POST['bid'])): ?>
          <div class="alert alert-dismissible alert-warning">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
			<section>
				<h1>Product: <?php echo $products['product_name']; ?></h1>
				<p>Features: <?php echo $products['product_features']; ?></p>
          <ul>
            <li>Market Price:  <?php echo $products['market_price']; ?></li>
          </ul>
          <ul>
            <li>Minimun playing price:  <?php echo $products['minbid']; ?></i>
          </ul>
          <ul>
            <li>End Time:  <p id="demo"></p></i>
          </ul>
			<?php 
            if(isset($_SESSION['user_id'])){
            echo '<form id="myForm" method="POST" action="overview.php?product_id='.$_REQUEST['product_id'].'">';
            echo '<input type="number" id="donebid" min="1" name="bidprice" placeholder="Enter your amount for Bidding"><br>';
            echo '<input type="hidden" name="product_id" value="'.$_REQUEST['product_id'].'">';
            echo '<button input="submit"  id="done" name="bid" class="btn btn-lg">Bid Now</button>';
            echo '<label type="label"  id="hide" hidden>Auction Closed</button>';
            echo '</form>';
            }else{
              echo '<h5><a href="/khel/login.php" clas="btn btn-lg">Login</a></h5>';
            }
          ?>

			</section>
		</div>
    <section class="content">
      <div class="table-responsive">
			<table class="table table-stripted">
                      <thead>
                        <tr>
                          <th>Bidding History</th>                      
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php while ($row=mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
                               echo $row['username']."<br>";
                            } ?>
                            </td>
                        </tr>
                      </tbody>
                      <thead>
                        <tr>
                          <th>Winner</th>                      
                        </tr>
                      </thead>
                      <tbody>
                        <tr id="winner_declare">
                          <td><?php while ($row=mysqli_fetch_array($winner, MYSQLI_ASSOC)) {
                               echo $row['username'];
                               echo "<td>".$row['bidprice']."</td>";
                            } ?>
                            </td>
                        </tr>
                      </tbody>
                    </table>
			</div>
    </section>
	<script src="../assets/js/Drift.min.js"></script>


<script>
  var specialDate = <?php echo strtotime($products['end_time']);?>;

  var countDownDate = specialDate * 1000;

// Set the date we're counting down to
var countDownDate = new Date(countDownDate).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    

    if(distance > 0){
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    }
    // If the count down is over, write some text 
    else{
        /*clearInterval(x);*/
        document.getElementById("demo").style.visibility = 'hidden';
        document.getElementById("done").style.visibility  = 'hidden';
        document.getElementById("donebid").hidden = true;
        document.getElementById("hide").hidden = false;
        document.getElementById("winner_declare").hidden = false;        
    }
}, 1000);
</script>
	<script>
		new Drift(document.querySelector('.drift-demo-trigger'), {
			paneContainer: document.querySelector('.detail'),
			inlinePane: 900,
			inlineOffsetY: -85,
			containInline: true,
			hoverBoundingBox: true
		});
	</script>
  <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../assets/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

</body>

</html>

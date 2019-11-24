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
$list_bidder= "SELECT username FROM auction_details a INNER JOIN users u on a.user_id= u.user_id WHERE product_id =".$product_id;
$sqldata= mysqli_query($conn, $list_bidder) or die ('error');



?>
  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 mb-4">
          <img src="/khel/images/<?php echo $products['product_image']; ?>" class="img-fluid" alt="" width="100%;">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">
            <p class="lead">
              <?php if(isset($_POST['bid'])): ?>
          <div class="alert alert-dismissible alert-warning">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
              <h1><span><?php echo $products['product_name']; ?></span></h1>
              <span>Market Price: <?php echo $products['market_price']; ?></span>
            </p>

            <p class="lead font-weight-bold">Description</p>
            <p><?php echo $products['product_features']; ?></p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus!
              Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente.</p>
              </p>

                  <strong>
                    <div class="dark-grey-text"><strong>End time:</strong><p id="demo"></p></div>
                  </strong>
        <div class="col-md-10">
          <?php 
            if(isset($_SESSION['user_id'])){
            echo '<form id="myForm" method="POST" action="singleproduct.php?product_id='.$_REQUEST['product_id'].'">';
            echo '<input type="number" id="donebid" min="1" name="bidprice" placeholder="Enter your amount for Bidding"><br>';
            echo '<input type="hidden" name="product_id" value="'.$_REQUEST['product_id'].'">';
            echo '<button input="submit"  id="done" name="bid" class="btn btn-lg">Bid Now</button>';
            echo '<label type="label"  id="hide" hidden>Auction Closed</button>';
            echo '</form>';
            }else{
              echo '<h5><a href="/khel/login.php">Login</a></h5>';
            }
          ?>
        </div>

          </div>
          <!--Content-->


        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <hr>

      <!--Grid row-->


        <!--Grid column-->




        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->

      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Call to action-->

    <!--/.Call to action-->

    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
        <i class="fa fa-facebook mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
        <i class="fa fa-twitter mr-3"></i>
      </a>



      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
        <i class="fa fa-google-plus mr-3"></i>
      </a>


    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2018 Copyright:
      <a href="" target="_blank"></a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
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


</body>

</html>

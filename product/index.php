<?php
include ('../config/db.php'); 
include ('../inc/header.php');
include ('../inc/nav.php');
$hehe='';
//setting the timezone for the time field
date_default_timezone_set("Asia/Kathmandu");

//get ID
$product_id = mysqli_real_escape_string($conn, $_REQUEST['product_id']);

/*create Query*/
$query='select * from products where product_id = '.$product_id;

//Get result
$result= mysqli_query($conn, $query);

//Getch Data
$products = mysqli_fetch_assoc($result);
$minbid = $products['minbid'];


//Click on the bid button following code runs
    if(isset($_POST['bid'])){
    //Get all the submitted data from the form 
      $user_id = $_SESSION['user_id'];
      $bidprice = $_POST['bidprice'];
      $product_id = $_POST['product_id'];
	  
	  if($bidprice < $minbid){
		$error = "Minimum Bid Price is ". $minbid;
	  }else{
		  
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
                $error .= '<a class="nav-link waves-effect" onclick="alternateShowAd()"><i class="fas fa-coins" aria-hidden="true" style="color: #d9a760;">Get Coins</i></a>';
              }else{
              	$credit_used = $credit_left-$bidprice;
                  $update_coin = "UPDATE statics SET credit_left='$credit_used' WHERE user_id =".$user_id;

                  if($update_coin){
                    $query = $conn->query($update_coin);
                  }else{
                    $error="Updating the coin is failed";
                  }


              	$a= "SELECT bidprice_count FROM auction_details WHERE product_id = $product_id AND bidprice = $bidprice";
				$result = $conn->query($a);

				if($result->num_rows >0){
					while($row = $result->fetch_assoc()){
						$hehe =  $row['bidprice_count'];
					}
				}

              	if($hehe > 0){
              		$updatee = $hehe+1;
              		$b = "Update auction_details set bidprice_count = '$updatee' where product_id = '$product_id' AND bidprice = '$bidprice'";
              		$query = $conn->query($b);
              		 if($query){
              			$error = "Congratulations! Your bidding is Successfully done.";
		             	$bidnow = "INSERT INTO auction_details(user_id, bidprice, product_id, bidprice_count, auction_status) VALUES ('$user_id','$bidprice','$product_id', $updatee,'active')";

					 $query = $conn->query($bidnow);
              		 }
              	 }else{
              		 $error = "Congratulations! Your bidding is Successfully done.";
		              $bidnow = "INSERT INTO auction_details(user_id, bidprice, product_id, auction_status) VALUES ('$user_id','$bidprice','$product_id','active')";
		              $query = $conn->query($bidnow);
              	 }
              	}
        }
		}
	  }
      }
    }else{
        $error="Please Bid first!!";
    }


$winner = "SELECT p.winner, u.first_name, u.last_name from products p inner join users u on u.user_id = p.winner WHERE p.product_id = ".$product_id;
$win= mysqli_query($conn, $winner);
$winners = mysqli_fetch_assoc($win);

echo '<script>var product_id = ' . $product_id . '</script>'

?>

<script>
//AJAX GETTER FOR BIDDERS//
ajaxBidders();

var getBidders = setInterval(function(){
	ajaxBidders();
}, 10000);

function ajaxBidders(){
	$.ajax({
	  url: 'bidder_fetcher.php?id='+product_id,
	  method: "GET",
	  error: function() {
		console.log("Could Not Fetch Bidders");
	  },
	  success: function(data) {
		addBidders(data);
	  }
	});
}

function addBidders(data){
	var bidders_html = "";
	var thisUser = <?=$_SESSION['user_id']?>;
	for(var i = 0 ; i < data.length ; i++){
		if(thisUser == data[i]['user_id']){
			bidders_html = bidders_html + '<tr><td><b style="color:orange; font-weight: bold;">' + data[i]['first_name'] + " " + data[i]['last_name'] + '</b></td><td> </td></tr>';
			continue;
		}
		bidders_html = bidders_html + '<tr><td>' + data[i]['first_name'] + " " + data[i]['last_name'] + '</td><td> </td></tr>';
	}
	$('#bidders').html(bidders_html);
}

function getBiddersEnd(){
	$.ajax({
	  url: 'bidder_fetcher_end.php?id='+product_id,
	  method: "GET",
	  error: function() {
		console.log("Could Not Fetch Bidders After End");
	  },
	  success: function(data) {
		addBiddersEnd(data);
	  }
	});
}

function addBiddersEnd(data){
	var bidders_html = "";
	var thisUser = <?=$_SESSION['user_id']?>;
	for(var i = 0 ; i < data.length ; i++){
		if(thisUser == data[i]['user_id']){
			bidders_html = bidders_html + '<tr><td><b style="color:orange; font-weight: bold;">' + data[i]['first_name'] + " " + data[i]['last_name'] + '</b></td><td>' + data[i]['bidprice'] + '</td></tr>';
			continue;
		}
		bidders_html = bidders_html + '<tr><td>' + data[i]['first_name'] + " " + data[i]['last_name'] + '</td><td>' + data[i]['bidprice'] + '</td></tr>';
	}
	$('#bidders').html(bidders_html);
}

function bidderFetcherCurrent(){
	$.ajax({
	  url: 'bidder_fetcher_current.php?id='+product_id,
	  method: "GET",
	  error: function() {
		console.log("Could Not Fetch Current User Bid");
	  },
	  success: function(data) {
		  if(data[0]['bidprice'] != "" || data[0]['bidprice'] != null || data[0]['bidprice'] > 0){
			$('.hider').css('display','none');
		  }
		document.getElementById('yourBid').innerHTML = data[0]['bidprice'];
	  }
	});
}

bidderFetcherCurrent();

</script>

<div class="wrapper" style="margin-top:100px;">
		<div class="main">
			<div class="main-left">
				<img class="drift-demo-trigger" style="width: 250px; max-width: 250px;" data-zoom="/aayopayo/images/<?php echo $products['product_image']; ?>" src="/aayopayo/images/<?php echo $products['product_image']; ?>" href="/aayopayo/images/<?php echo $products['product_image']; ?>">


				<div class="table-responsive" style="height: 310px;">
				<table class="table">
					<thead>
						<tr>
							<th style="font-weight: bold;">Bidding Info</th>
						</tr>
						</tr>
							<th style="font-weight: bold;">Name</th>
							<th style="font-weight: bold;">Bid</th>
						</tr>
					</thead>
					<tbody id="bidders">
						
					</tbody>

				</table>
				</div>
		</div>


<style>
	table label{
		margin: 0;
		padding: 0;
	}

	.winner{
		animation: showoff 1s 0.3s ease 6 alternate forwards;
		color: teal;
		margin: 0;
		padding: 0;
	}
	
	@keyframes showoff{
		0%{opacity: 1;transform: scale(1) rotate(0deg); text-shadow: 0 0 0 none;}
		30%{opacity: 1;transform: scale(1.2) rotate(-5deg); text-shadow: 0 0 15px blue;}
		60%{opacity: 1;transform: scale(1.2) rotate(5deg); text-shadow: 0 0 20px red;}
		70%{opacity: 1;transform: scale(1) rotate(5deg); text-shadow: 0 0 15px green;}
		80%{opacity: 1;transform: scale(1) rotate(-5deg); text-shadow: 0 0 10px black;}
		100%{opacity: 1;transform: scale(1) rotate(0deg); text-shadow: 0 0 0 none;}
	}
</style>

		<div class="detail ">
			<section>
				<h1><?php echo $products['product_name']; ?></h1>
				<p style="text-align: justify; color: black;"><?php echo $products['product_features']; ?>.</p>

          <table class="table table-striped" >
          	<tr>
				<th><label class="control-label" style="font-weight: bolder;"> Auction Id:</label></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> Market Price:  </label><?php echo $products['market_price']; ?></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> Minimun playing price: </label><?php echo $products['minbid']; ?></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> End Time: </label> <strong><b id="demo"></b></strong></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> Winner: <h2 class="winner"><?=$winners['first_name']?> <?=$winners['last_name']?></h2></th>
			</tr>
			<?php 
				if(isset($_SESSION['user_id'])){
					echo '<th><label class="control-label" style="font-weight: bolder;"> Your Bid: <span id="yourBid"></span></th>';
				}
			?>
        </table>
			
          <?php if(isset($_POST['bid'])): ?>
          <div class="alert alert-dismissible alert-warning">
            <?php echo $error; ?>
          </div>
        <?php endif; ?>
</section>

        <?php 
            if(isset($_SESSION['user_id'])){
				echo '<form id="myForm" style="display:none;" method="POST" action="index.php?product_id='.$_REQUEST['product_id'].'">
				<input class="hider" type="number" id="donebid" min="1" name="bidprice" placeholder="Enter your amount for Bidding"><br>
				<input class="hider" type="hidden" name="product_id" value="'.$_REQUEST['product_id'].'">
				<button class="hider" input="submit"  id="done" name="bid" class="btn btn-lg">Play</button>
				</form>';
            }else{
              echo '<h5><a href="/aayopayo/login.php">Login</a></h5>';
            }
          ?>
		</div>

	</div>

    <section class="content">

</section>
<div class = "overview">

    <div class="header">
      <h1>PRODUCT OVERVIEW</h1>
    </div>
    <div class="text">
      <h3>Specification:</h3>
      <ul>
        <li> Et dolor suscipit libero eos atque quia ipsa sint voluptatibus!</li>
            <li>  Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente. Lorem Ipsum is simply</li>
              <li>ummy text of the printing and typesetting industry. Lorem Ipsum has been the industryis</li>
              <li> standard dummy text ever since the 1500s, when an unknown printer</li>

      </ul>
      <h3>Features:</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus!
                Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>

</div>


<!-- More Items -->
	<div class="container" style="margin: 0; padding: 0;">
		<h1 style="text-align: center; font-size: 30px; font-weight: bolder;">MORE ITEMS TO CONSIDER</h1>
		<hr>
	</div>

<?php include '../radialcircle.php'; ?>

<!-- End of More Items -->
</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
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
	document.getElementById("myForm").style.display = 'block';
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    }
    // If the count down is over, write some text 
    else{
		clearInterval(getBidders);
		getBiddersEnd();
		clearInterval(x);
		document.getElementById("myForm").style.display = 'none';
		document.getElementById("myForm").parentNode.removeChild(document.getElementById("myForm"));
		
		document.getElementById("demo").innerHTML = 'Ended';
        document.getElementById("done").style.display  = 'none';
        document.getElementById("donebid").hidden = true;
        document.getElementById("hide").hidden = false;
        document.getElementById("winner_declare").hidden = false;   		
    }
	
	if(days == 0 && hours == 0 && minutes == 0 && seconds == 0){
		setTimeout(function(){
			location.reload();
		},1500);
	}
}, 1000);
</script>
<?php include('../inc/footer.php') ?>

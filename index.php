<?php include ('config/db.php');
include ('inc/header.php');
date_default_timezone_set("Asia/Kathmandu");

  //Getting all the product for the auction.
  $query = "select * from products WHERE product_status='active' order by product_id DESC";
  // $banner = "select * from banner order by banner_id";
  $query1 = "select * from ads WHERE ad_status='active' order by ad_id DESC";
  $query2 = "select * from products WHERE product_status='end' order by product_id DESC";

  //Get Result
  $result = mysqli_query($conn, $query);
  $result1 = mysqli_query($conn, $query1);
  $result2 = mysqli_query($conn, $query2);
  // $banner = mysqli_query($conn, $banner);

  //Fetch Data
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $ads = mysqli_fetch_all($result1, MYSQLI_ASSOC);
  $ends = mysqli_fetch_all($result2, MYSQLI_ASSOC);
  // $banners = mysqli_fetch_all($banner, MYSQLI_ASSOC);
  //var_dump($products);

  //Free Result
  mysqli_free_result($result);
  mysqli_free_result($result1);
  mysqli_free_result($result2);
  // mysqli_free_result($banners);


   include 'inc/nav.php'; ?>
  <!-- Navbar -->
  <!-- radial navbar -->

<div class="bts-popup" role="alert">
    <div class="bts-popup-container">
      <img src="/aayopayo/images/AP.gif" alt="" width="80%" />
        <p>Namaste!<br> Welcome to Aayo Payo, To access our Services Please Register your Accounts</p>
        <div class="bts-popup-button">
           <a href="multi.php">Register</a>
         </div>
        <a href="#0" class="bts-popup-close img-replace">Close</a>
    </div>
</div>
<script>
jQuery(document).ready(function($){

  window.onload = function (){
    $(".bts-popup").delay(1000).addClass('is-visible');
  }

  //open popup
  $('.bts-popup-trigger').on('click', function(event){
    event.preventDefault();
    $('.bts-popup').addClass('is-visible');
  });

  //close popup
  $('.bts-popup').on('click', function(event){
    if( $(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup') ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('.bts-popup').removeClass('is-visible');
      }
    });
});
</script>
<!-- End of Auto Popup  -->

  <!--Carousel Wrapper-->
<?php include 'slider.php'; ?>
  <!--/.Carousel Wrapper-->


  <!--Main layout-->
  <main>
    <div class="container" id="products_container">
      <!--Navbar-->
       <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">
          <!-- Collapsible content -->
          <div class="collapse navbar-collapse" id="basicExampleNav">
            <form class="form-inline">
               <div class="md-form my-0">
                <div class="search">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search..." aria-label="Search" id="search_query">  
                  <div class="suggest" id="suggest"></div>
                </div>
              </div>
            </form>
          </div>
          <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4" id="main_content">
        <h1>Live Auction</h1>

        <!--Grid row-->
        <div class="row wow fadeIn" id="items">

          <!--Grid column-->
         <?php foreach($products as $product) : ?>
        <!--Grid column-->
        <div class="col-lg-3 col-md-6 mb-4">

          <!--Card-->
          <div class="card">
            <!--Card image-->
            <div class="view overlay">
              <img src="/aayopayo/images/<?php echo $product['product_image']; ?>" style="width: 250px; height: 200px;"class="card-img-top" alt="">
              <a>
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <!--Card image-->
            <!--Card content-->
            <div class="card-body text-center">
              <!--Category & Title-->
              <a href="" class="grey-text">
                <h5>End Time:</h5>
              </a>
              <h5>
                <strong>
                  <h5><?php echo $product['product_name']; ?></h5>
                </strong>
              </h5>
              <h4 class="font-weight-bold blue-text">
               <a href="/aayopayo/product?product_id=<?php echo $product['product_id']; ?>" class ="btn btn-large">Play</a>
              </h4>
            </div>
           <!--Card content-->
          </div>
          <!--Card-->
        </div>

      <?php endforeach; ?>
          <!--Fourth column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
            <h1 class="text-center">Upcoming Auction</h1>
            <div class="row wow fadeIn" id="items">
		        <?php foreach($products as $product) : ?>
		        <!--Grid column-->
		        <div class="col-lg-3 col-md-6 mb-4">

		          <!--Card-->
		          <div class="card">
		            <!--Card image-->
		            <div class="view overlay">
		              <img src="/aayopayo/images/<?php echo $product['product_image']; ?>" style="width: 250px; height: 200px;"class="card-img-top" alt="">
		              <a>
		                <div class="mask rgba-white-slight"></div>
		              </a>
		            </div>
		            <!--Card image-->
		            <!--Card content-->
		            <div class="card-body text-center">
		              <!--Category & Title-->
		              <a href="" class="grey-text">
		                <h5>End Time:</h5>
		              </a>
		              <h5>
		                <strong>
		                  <h5><?php echo $product['product_name']; ?></h5>
		                </strong>
		              </h5>
		              <h4 class="font-weight-bold blue-text">
		               <a href="/aayopayo/product?product_id=<?php echo $product['product_id']; ?>" class ="btn btn-large">Play</a>
		              </h4>
		            </div>
		           <!--Card content-->
		          </div>
		          <!--Card-->
		        </div>
		      <?php endforeach; ?>
		        <!--Grid column-->
      		</div>
          <!--Fourth column-->
          

          <!--Grid row-->
            <h1 class="text-center">Closed Auction</h1>
            <div class="row wow fadeIn" id="items">
		        <?php foreach($ends as $end) : ?>
		        <!--Grid column-->
		        <div class="col-lg-3 col-md-6 mb-4">

		          <!--Card-->
		          <div class="card">
		            <!--Card image-->
		            <div class="view overlay">
		              <img src="/aayopayo/images/<?php echo $end['product_image']; ?>" style="width: 250px; height: 200px;"class="card-img-top" alt="">
		              <a>
		                <div class="mask rgba-white-slight"></div>
		              </a>
		            </div>
		            <!--Card image-->
		            <!--Card content-->
		            <div class="card-body text-center">
		              <!--Category & Title-->
		              <a href="" class="grey-text">
		                <h5>End Time:</h5>
		              </a>
		              <h5>
		                <strong>
		                  <h5><?php echo $end['product_name']; ?></h5>
		                </strong>
		              </h5>
		              <h4 class="font-weight-bold blue-text">
					   <a href="#" class ="btn btn-large"><i class="fa fa-shopping-cart"></i></a>
		               <a href="/aayopayo/product/closed.php?product_id=<?php echo $end['product_id']; ?>" class ="btn btn-large">Details</a>
		              </h4>
		            </div>
		           <!--Card content-->
		          </div>
		          <!--Card-->
		        </div>
		      <?php endforeach; ?>
		        <!--Grid column-->
      		</div>
      </div>

      </section>
<?php include 'radialcircle.php'; ?>



  <!--Main layout-->
<?php include 'inc/footer.php'; ?>

<script type="text/javascript" src="/aayopayo/assets/js/search.js"></script>
</body>

</html>

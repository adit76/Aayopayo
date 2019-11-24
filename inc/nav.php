<style>
	#itemCount{
		opacity: 0;
		display: none;
	}
	
	.count{
		opacity: 0;
		display: none;
	}
	
	@media screen and (max-width: 880px){
		  .myModal{
			  width: 80% !important;
		  }
	  }
</style>
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand waves-effect" href="/aayopayo">
      <strong class="blue-text">KKJ</strong>
    </a>

    <?php if(isset($_SESSION['user_id'])){ ?>
    <!-- For Mobile View -->
    <div class="mobile_notification" style="position:relative; font-size: 1.2em;" onclick="mark_read()">
  
       <span class="moblienoti count" style="background: #FF2222; position: absolute; border-radius: 50%; height: 20px; width: 20px; top:-3px; left: -13px; text-align: center; color: white; font-size: 0.8em;"></span>
       <a href="#" class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="fas fa-bell" aria-hidden="true" style="color: #d9a760;"></i></a>
       <ul class="dropdown-menu dropdown-menu-message"></ul>
    
    </div>
  
    <div class="coins_mobile" style="position:relative;" onclick="generateAd()">
      <a class="nav-link waves-effect" id="myBtn2"><i class="fas fa-coins" aria-hidden="true" style="color: #d9a760;"></i></a>
          <span class="mobliecoin"></span>
    </div>

    <div class="dropdown mobile_admindrop" id="admindrop">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <img src="https://amp.businessinsider.com/images/5899ffcf6e09a897008b5c04-750-750.jpg" >
        </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="color: black;">
            <li><a href="/aayopayo/user/accountupdate.php">View Profile</a></li>
            <li><a href="/aayopayo/user/biddingstatics.php">Bid Statics</a></li>
            <li><a href="/aayopayo/user/changepassword.php">Update Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="/aayopayo/logout.php">Logout</a></li>
          </ul>
      </div>
    <?php } ?>  



      <!-- End of Mobile View -->

    <!-- Collapse -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Left -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link waves-effect" href="/aayopayo">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="/aayopayo/about.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="/aayopayo/contact.php">Contact Us</a>
        </li>

        <?php if(isset($_SESSION['user_id'])){ ?>
          <li class="nav-item" id="coins_desktop" style="position:relative;" onclick="generateAd()">
            <a class="nav-link waves-effect" id="myBtn"><i class="fas fa-coins" aria-hidden="true" style="color: #d9a760;">Get Coins</i></a>
            <span class="desktopcoin" id="itemCount"></span>
          </li>
           <li class="nav-item" id="desktop_notification" style="position: relative; font-size: 1.2em; top: 5px; left: 10px;" onclick="mark_read()">
        <span class="desktopnoti count" style="background: #FF2222; position: absolute; border-radius: 50%; height: 22px; width: 22px; top:-10px; right: -13px; text-align: center; color: white; font-size: 0.8em;"></span>
          <a href="#" class="dropdown-toggle no-caret" data-toggle="dropdown"><i class="fas fa-bell" aria-hidden="true" style="color: #d9a760;"></i></a>
          <ul class="dropdown-menu dropdown-menu-message" id=""></ul>
            </li>
            <!-- The Modal -->
      <?php } ?>
      <!-- Right -->

      <script>
        setCoinId();

        $( window ).resize(function() {
          setCoinId();
        });

        function setCoinId(){
          var width = $(window).width();
          if(width <= 991){
            $('.desktopcoin').attr('id', '');
            $('.mobliecoin').attr('id', 'itemCount');
      $('#itemCount').html(itemCount).css('display','block');
          }else{
            $('.desktopcoin').attr('id', 'itemCount');
            $('.mobliecoin').attr('id', '');
      //alert($('#itemCount').html());
            $('#itemCount').html(itemCount).css('display','block');
          }
        }
      </script>
    </div>



<?php if(!isset($_SESSION['user_id'])){ ?>
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="/aayopayo/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="/aayopayo/register.php">Register</a>
          </li>
        </ul>
    <?php    }else{  ?>
      <div class="dropdown desktop_admin_drop" id="admindrop" style="float: right;">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <img src="https://amp.businessinsider.com/images/5899ffcf6e09a897008b5c04-750-750.jpg"  style="width: 35px; height: 35px;">
          </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="color: black;">
              <li><a href="/aayopayo/user/accountupdate.php">View Profile</a></li>
              <li><a href="/aayopayo/user/biddingstatics.php">Bid Statics</a></li>
              <li><a href="/aayopayo/user/changepassword.php">Update Password</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/aayopayo/logout.php">Logout</a></li>
            </ul>
        </div>
    <?php } ?>

  </div>
</nav>
<!-- Navbar -->
<!-- radial navbar -->

<div id="myModal" class="modal" style="z-index: 99999;">
<!-- Modal content -->
<div class="modal-content myModal">
  <div class="video_container" id="video_container">
    <div id="play_container">
      <button onclick="user_play()">Play</button>
    </div>

    <div id="get_coin_container">
      <!--BTN HERE-->
    </div>

    <video muted="" playsinline="" id="ad_coin" style="pointer-events: none;" autoplay="" preload="auto">

    </video>
  
    <p id="ad_current_time"></p>
  </div>
 </div>
</div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>

    <script>
      // Get the modal
      var modal = document.getElementById('myModal');

      // Get the button that opens the modal
      var btn = document.getElementById("myBtn");
      var btn2 = document.getElementById("myBtn2");
      var btnad = document.getElementById("myBtnad");

      // When the user clicks the button, open the modal
      btn.onclick = function() {
        modal.style.display = "block";
      }

      btn2.onclick = function() {
        modal.style.display = "block";
      }

      function alternateShowAd(){
        btn.click();
      }
    </script>
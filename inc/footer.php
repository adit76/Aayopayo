<!--Footer-->

  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="/aayopayo/assets/js/jquery-3.3.1.min.js"></script>
  <!--<script type="text/javascript" src="/aayopayo/assets/js/search.js"></script>-->
  <!--Search.js inly in home-->
  <script type="text/javascript" src="/aayopayo/assets/js/coinsAndNoti.js"></script>
  <script>
	showItems(this,'all');
  </script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="/aayopayo/assets/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="/aayopayo/assets/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="/aayopayo/assets/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

  <style>
	.myModal{
		width: 40%;
		padding: 0;
	}

	.video_container{
		margin: 0 auto;
		width: 100%;
		position: relative;
		background: wheat;
		position: relative;
	}

	.video_container video{
		width: 100%;
		pointer-events: none;
	}

	#ad_coin{
		pointer-events: none;
	}

	video::-webkit-media-controls-start-playback-button {
		display: none;
	}

	#get_coin_container, #play_container{
		position: absolute;
		width: 100%;
		top: 40%;
		left: 0;
		font-size: 13px;
		text-align: center;
	}

	#get_coin_container button, #play_container button{
		padding: 15px;
		background: teal;
		color: white;
		animation: show_btn 0.5s ease forwards;
	}

	@keyframes show_btn{
		from{transform: scale(0);}
		to{transform: scale(1);}
	}
</style>

<script>
	var ad_coin = document.getElementById('ad_coin');
	
	var video_container = document.getElementById('video_container');//My Ad Video Container
	var myModal = document.getElementById('myModal');//My Ad Video Container
	var video_reward;
	
	var duration = 0; // WHATEVER;
	
	var thatIsIt = false;
	var adtry = 0;
	
	function generateAd(){
		if(thatIsIt == false){
			
		//WE WILL GET THESE BY AJAX AND RANDOM AD//
		duration = 0;
		
		$.ajax({
		  url: '/aayopayo/ad_fetcher.php',
		  method: "GET",
		  contentType: 'application/json; charset=utf-8',
		  dataType: 'text json',
		  cache: false,
		  type: "GET",  
		  error: function() {
			console.log("Could Not Fetch Ads. Opps.");
		  },
		  success: function(data) {
			//console.log(data);
			var randomAd = Math.floor(Math.random() * data.length);
			
			if(localStorage.getItem('viewed') === null){
				localStorage.setItem('viewed','[]');
				localStorage.setItem('last_viewed',Date.now());
			} 
	
			var viewed = JSON.parse(localStorage.getItem('viewed'));
			var last_viewed = localStorage.getItem('last_viewed');
			
			//if(Date.now() > last_viewed + 60000*180){
				localStorage.removeItem('last_viewed');
				localStorage.removeItem('viewed');
			//}
			
			for(var i = 0 ; i < viewed.length ; i++){
				if(viewed[i] == data[randomAd]['ad_id']){
					adtry++;
					if(adtry > 5){
						thatIsIt = true;
					}
					return generateAd();
				}
			}
			
			viewed.push(data[randomAd]['ad_id']);
			localStorage.setItem('viewed',JSON.stringify(viewed));
			localStorage.setItem('last_viewed',Date.now());
			
			//alert(randomAd + " - " + data[randomAd]['ad_name'] + " " + data[randomAd]['url']);
			video_url = "/aayopayo/images/advideos/" + data[randomAd]['url'];
			var video_urlw = "";
			var video_urlo = ""; //ogv

			/* var video_url = "http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4";
			var video_urlw = "http://clips.vorwaerts-gmbh.de/big_buck_bunny.webm";
			var video_urlo = "http://clips.vorwaerts-gmbh.de/big_buck_bunny.ogv"; //ogv */
			video_reward = data[randomAd]['prize'];

			var sourceUrl = "<source src='" + video_url + "' type=video/mp4><source src='" + video_urlw + "' type=video/webm><source src='" + video_urlo + "' type=video/ogg>";

			document.getElementById('ad_coin').innerHTML = "";
			document.getElementById('ad_coin').innerHTML = sourceUrl;

			var ad_current_time = document.getElementById('ad_current_time'); //Current Time Holder

			var loadingVideo = 0;

			//Interval to Check If Ad Loaded
			var checkPlayable = setInterval(function(){
				loadingVideo++;
				if(loadingVideo >= 16){
					ad_current_time.innerHTML = 'Loading Taking More Time then Usual....Try Reloading';
				}//Check if taking Forever....

				//Check if Video is Ready to Play after buffer is loaded
				if(ad_coin.readyState === 3 || ad_coin.readyState === 3 || ad_coin.readyState === 3 || ad_coin.readyState === 4){
					clearInterval(checkPlayable); // Clear Ready Check

					var currentTime = 0;
					duration = Math.floor(ad_coin.duration);
					// Total Duration
					
					//alert(duration);
					ad_coin.volume = 0.5; //Volume to Less Annoy

					var time_count = setInterval(function(){
						currentTime = Math.floor(document.getElementById('ad_coin').currentTime);
						ad_current_time.innerHTML = " " + currentTime + " seconds";

						if(currentTime >= 0.1){
							document.getElementById('play_container').style.display = 'none';
						}
					},1000);

					setTimeout(function(){
						//Ad Plays or Users Waits if not playing too, for ad time period Seconds what ever happens....i.e. for duration*1000 ms time//
						var videospy = setInterval(function(){
							if(document.getElementById('ad_coin').ended && $('#ad_coin').has('source') && $('#ad_coin').length && duration > 0){
								//alert('Ended');
								document.getElementById('ad_coin').currentTime = 0;
								clearInterval(videospy);
								clearInterval(this);
								clearInterval(time_count);

								generateButton();
							}
						}, 1000);
					}, duration); //Duration and only coin give
				}
			}, 500);
			
		  }
		});
		
		} //that is end true | thatIsIt
		
		else{
			$('#play_container button').html('We Are Out Of Ad.'); 
			setTimeout(function(){
				myModal.style.display = 'none';
				alert('You Saw a Lot of Ads, Try Seeing Later.');
			},1000);
			document.getElementById('ad_coin').currentTime = 0;
			//clearInterval(time_count);
			return;
		}
	}
	
	function user_play(){
		if(document.getElementById('ad_coin').readyState === 4){
			document.getElementById('ad_coin').play();
		}else{
			alert('Still Loading....Wait.');
		}
	}

	function generateButton(){
		var get_coin_container = document.getElementById('get_coin_container');
		//addCoin(video_reward); // Call ADD COIN METHOD WITHOUT CLICKING BUTTON...ADD AUTOmatically
		get_coin_container.innerHTML = "<button onclick='addCoin(" + video_reward + ")'>Get Coin</button>";
	}

	// Method to Remove Items from DOM // FROM STACK_OVER_FLOW //
	// It says not to use other technique due to less browser support or bad default method overloads.//
	Element.prototype.remove = function() {
		this.parentElement.removeChild(this);
	}
	NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
		for(var i = this.length - 1; i >= 0; i--) {
			if(this[i] && this[i].parentElement) {
				this[i].parentElement.removeChild(this[i]);
			}
		}
	}
	//////////////

	function addCoin(video_reward){
		// Note: CHANGE TO POST AFTER TEST SUCCESS
		//data: json,
		$.ajax({
		  url: '/aayopayo/coin_adder.php?tok=given&prize='+video_reward,
		  contentType: 'application/json; charset=utf-8',
	      dataType: 'text json',
	      cache: false,
		  method: "GET",
		  type: "GET",
		  error: function() {
			console.log("Could Not Add Coin");
			alert("Something Went Wrong. Coin Might Not Be Added.");
		  },
		  success: function(data) {
			//console.log(data);
			console.log('Coin updated in Server');
			//alert("You Got " + data[0] + " Coins.");
		  }
		});

		$('#ad_coin').empty();
		$('#get_coin_container').empty();
		
		document.getElementById('ad_coin').currentTime = 0;
		duration = 0;
		
		//ad_coin.style.display = 'none';
		//ad_coin.style.visibility = 'hidden';
		document.getElementById('ad_coin').remove();
		
		//get_coin_container.style.display = 'none';
		//get_coin_container.style.visibility = 'hidden';
		get_coin_container.remove();
		
		//video_container.style.display = 'none';
		//video_container.style.visibility = 'hidden';
		//video_container.remove();
		
		video_container.innerHTML = '<div id="play_container"><button onclick="user_play()">Play</button></div><div id="get_coin_container"></div><video id="ad_coin" style="pointer-events: none;" preload></video><p id="ad_current_time"></p>';

		myModal.style.display = 'none';
		/////myModal.remove();///// REMOVES LIMITING TO ONE LOAD
		
		checkBlank();
		//WE AGAIN AJAX HERE TO SAVE THE COIN DATA TO DATABASE//
		//ALSO UPDATE IT//
	}
</script>



<script>
/*  - - - Video for Mobile Player  - - - */
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
	  $('#itemCount').html(itemCount).css('display','block');
	}
  }

</script>

</body>

</html>

<?php include('inc/head.php') ?>
<?php include('inc/nav.php') ?>
<div class="wrapper" style="margin-top:100px;">
		<div class="main">
			<div class="main-left">
				<img class="drift-demo-trigger" data-zoom="img/shirt3.jpg" src="img/shirt3.jpg" href="img/shirt3.jpg">


				<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th style="font-weight: bold;">Bidding Info</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Name</td>

						</tr>
						<tr>
							<td>Name</td>
						</tr>
						<tr>
							<td>Name</td>
						</tr>
						<tr>
							<td>Name</td>
						</tr>
						<tr>
							<td>Name</td>
						</tr>
					</tbody>

				</table>
				</div>
		</div>


		<div class="detail ">
			<section>
				<h1>Product Title</h1>
				<p style="text-align: justify; color: black;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

          <table class="table table-striped" >
          	<tr>

				<th><label class="control-label" style="font-weight: bolder;"> Auction Id:</label></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> Market Price</label></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> Minimun playing price: </label></th>
			</tr>
			<tr>
				<th><label class="control-label" style="font-weight: bolder;"> End Time:</label></th>
			</tr>

			<tr>
				<th><input class="form-controls" placeholder="Enter your Amount"></th>
			</tr>
        </table>
					<button class="btn btn-lg">Play Now</button>

			</section>
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
	<script>

	</script>



<!-- End of More Items -->
</div>
<div id='ss_menu'>
	<div> <i class="fa fa-tachometer" title="dashboard"></i> </div>
	<div><i class="fa fa-sign-out" title="logout"></a></i></div>
	<div> <i class="fa fa-credit-card" title="Your Credits"></i> </div>
	<div> <i class="fa fa-user-circle" title="Your Accounts"></i> </div>
	<div class='menu'>
		<div class='share' id='ss_toggle' data-rot='180'>
			<div class='circle'></div>
			<div class='bar'></div>
		</div>
	</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function(ev) {
	var toggle = $('#ss_toggle');
	var menu = $('#ss_menu');
	var rot;

	$('#ss_toggle').on('click', function(ev) {
		rot = parseInt($(this).data('rot')) - 180;
		menu.css('transform', 'rotate(' + rot + 'deg)');
		menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
		if ((rot / 180) % 2 == 0) {
			//Moving in
			toggle.parent().addClass('ss_active');
			toggle.addClass('close');
		} else {
			//Moving Out
			toggle.parent().removeClass('ss_active');
			toggle.removeClass('close');
		}
		$(this).data('rot', rot);
	});

	menu.on('transitionend webkitTransitionEnd oTransitionEnd', function() {
		if ((rot / 180) % 2 == 0) {
			$('#ss_menu div i').addClass('ss_animate');
		} else {
			$('#ss_menu div i').removeClass('ss_animate');
		}
	});

});
</script>

	<script src="/aayopayo/assets/js/Drift.min.js"></script>
	<script>
		new Drift(document.querySelector('.drift-demo-trigger'), {
			paneContainer: document.querySelector('.detail'),
			inlinePane: 900,
			inlineOffsetY: -85,
			containInline: true,
			hoverBoundingBox: true
		});
    </script>































<?php include('inc/footer.php') ?>

var items = document.getElementById('items');

var old_items = items.innerHTML;

var suggest = document.getElementById('suggest');
var search_query = document.getElementById('search_query');

//checkBlank();

search_query.oninput = function(){

	document.querySelector('#products_container').scrollIntoView();
	window.scrollBy(0, -80);

	suggest.innerHTML = "";

	var query = search_query.value;

	//call this inside ajax//
	if(search_query.value.length >= 2){
		//NOTE: AJAX ADDED GO FOUND////NOW ADD
		$.ajax({
		  url: '/aayopayo/search.php?query='+query,
		  method: "GET",
		  error: function() {
			console.log("Could Not Fetch");
		  },
		  success: function(data) {
			//console.log(data);
			addItems(data);
		  }
		});
	}else{
		items.innerHTML = old_items;
		showItems(this, 'all');
	}
};

function addItems(data){
	var items_html = "";

	if(data.length > 0){
		for(let i = 0 ; i < data.length ; i++){

			items_html = items_html + "<div class='col-lg-3 col-md-6 mb-4 searched_card'><div class='card'><div class='view overlay'><img src='/aayopayo/images/" + data[i].product_image + "' class='card-img-top' alt=''><a><div class='mask rgba-white-slight'></div></a></div><div class='card-body text-center'><a href='' class='grey-text'><h5>End Time:</h5></a><h5><strong><h5>" + data[i].product_name +"</h5></strong></h5><h4 class='font-weight-bold blue-text'><a class='btn btn-lg' href='/aayopayo/product?product_id="+ data[i].product_id + "'>Play</a></h4></div></div></div>";

		}
		items.innerHTML = '';
		items.innerHTML = items_html;
	}else{
		suggest.innerHTML = "<b>No Result Found</b>";
	}
}

function showItems(el, name){
	$('.nav-item').removeClass('active');

	el.className += ' active';

	$.ajax({
	  url: '/aayopayo/search.php?find='+name,
	  method: "GET",
	  error: function() {
		console.log("Could Not Fetch");
	  },
	  success: function(data) {
		//console.log(data);
		if(data.length > 0){
			addItems(data);
			suggest.innerHTML = "";
		}else{
			suggest.innerHTML = "Nothing For That At The Moment.";
		}
	  }
	});
}
// -- - - -notification checker  - -- //

function fetch_messages(){
$.ajax({
  url: '/aayopayo/notify_fetch.php',
  method: "GET",
  error: function() {
	console.log("Could Not Fetch Notifications");
  },
  success: function(data) {
	//console.log(data);
	var message_html = "";
	for(let i = 0 ; i < data.length ; i++){
		message_html = message_html + '<li><a href="' + '/aayopayo/product/closed.php?product_id=' + data[i]["product_id"] + '"><strong>' + data[i]["title"] + '</strong><br/><small><em>' + data[i]["description"].slice(0,35) + '...' +'</em></small></a></li><li class="divider"></li>';
	}

	$('.dropdown-menu-message').html(message_html);
  }
});
}

function fetch_messages_count(){
$.ajax({
  url: '/aayopayo/notify_count.php',
  method: "GET",
  error: function() {
	console.log("Could Not Fetch Notifications");
  },
  success: function(data) {
	//console.log(data);
	$('.count').html(data.length <= 0 ? '' : data.length);
  }
});
}

function mark_read(){
	$('.count').css({'display':'none', 'opacity' : '0'});
	$('.count').html('');
	$.ajax({
	  url: '/aayopayo/notify_read.php?tok=given',
	  method: "GET",
	  contentType: 'application/json; charset=utf-8',
	  data:{tok:'given'},	  
	  dataType: 'text json',
	  cache: false,
	  type: "GET",  
	  error: function() {
		console.log("Could Not Mark Read");
	  },
	  success: function(data) {
		fetch_messages();
		fetch_messages_count();
	  }
	});
}

var first_fetch = true;
function fetch_coin(){	
$.ajax({
  url: '/aayopayo/coin_fetcher.php',
  method: "GET",
  contentType: 'application/json; charset=utf-8',
  data:{tok:'given'},	  
  dataType: 'text json',
  cache: false,
  type: "GET",  
  error: function() {
	console.log("Could Not Fetch Coin");
  },
  success: function(data) {
	if(first_fetch == false){
		if(parseInt($('#itemCount').html()) < parseInt(data[0]['credit_left'])){
			alert('' + (parseInt(data[0]['credit_left']) - parseInt($('#itemCount').html())) + ' Coins Was Added Successfully.');
			console.log('Coin updated in client');
		}
		
		if(parseInt($('#itemCount').html()) > parseInt(data[0]['credit_left'])){
			alert('You Lost ' + (parseInt(data[0]['credit_left']) - parseInt($('#itemCount').html())) + ' Coins from Some Where Else. ');
		}
	}
	$('#itemCount').html(data[0]['credit_left']).css('display','block');
	first_fetch = false;
  }
});
}

fetch_messages();
fetch_messages_count();
fetch_coin();

//SET INTERVAL AND RUN ALL THE DACKGROUND LOADERS//
setInterval(function(){
fetch_messages();
fetch_messages_count();
fetch_coin();

checkBlank();
}, 3000);


function checkBlank(){
if($('#itemCount').html() == ''){
	$('#itemCount').css({'display':'none', 'opacity' : '0'});
}else{
	$('#itemCount').css({'display':'block', 'opacity' : '1'});
}

if($('.count').html() == ''){
	$('.count').css({'display':'none', 'opacity' : '0'});
}else{
	$('.count').css({'display':'block', 'opacity' : '1'});
}
}
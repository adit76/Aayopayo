<?php 

//get ID
$product_id = mysqli_real_escape_string($conn, $_REQUEST['product_id']);

/*create Query*/
$query='select * from products where product_id = '.$product_id;

//Get result
$result= mysqli_query($conn, $query);

//Getch Data
$products = mysqli_fetch_assoc($result);


   $winner = "CREATE DEFINER=`root`@`localhost` EVENT `testevent` ON SCHEDULE AT .$products['end_time']. ON COMPLETION NOT PRESERVE ENABLE DO UPDATE `products` SET `product_status` ='end' WHERE `end_time`<= NOW(); UPDATE `products` p JOIN `auction_details` a ON a.product_id = p.product_id JOIN `users` u ON u.user_id = a.user_id SET p.winner = u.user_id WHERE p.end_time<= NOW() AND p.product_status = 'active'";
   if(mysqli_query($conn, $winner)){
     return "success!";
   }
   else {
    return "failed!";
  }

 ?>
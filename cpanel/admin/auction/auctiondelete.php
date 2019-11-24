<?php session_start();
 include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');

//If the Delete button is clicked following code runs.
if(isset($_POST['btn_delete'])){
  //Get delete id from the lists
  $delete_id = $_POST['btn_delete'];

  //After getting the delete_id. Following code runs where the auction status is changed to disactive and not displayed on the front end.
  $query= "UPDATE auction_details SET 
           auction_status= 'disactive' WHERE auction_id =".$delete_id;

    //This section runs the query and if successfully executed. The user is redirected to the auction details page.
    $delete = $conn->query($query);
      if($delete){
        header('Location:/aayopayo/cpanel/admin/auction/auctiondetails.php');
      }else{
        echo $query;
      }
}


//When the restore button is clicked from the auction removed page following code runs.
if(isset($_POST['btn_restore'])){
  //Getting the id of the post which has to be restored.
  $restore_id = $_POST['btn_restore'];


 //Auction status is changed to active and displayed on the auction details of the admin panel.
  $query= "UPDATE auction_details SET 
           auction_status='active' WHERE auction_id =".$restore_id;


    //this code runs the query
    $restore = $conn->query($query);
      if($restore){
      	//if successfully the user is redirected to auction removed page.
        header('Location:/aayopayo/cpanel/admin/auction/auctionremoved.php');
      }else{
        echo "Error in restoring the auction";
      }
}
?>
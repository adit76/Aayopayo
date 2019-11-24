<?php session_start();
 include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');


//if the delete button is clicked on the auction page. following query runs.
if(isset($_POST['btn_delete'])){
  //Get form data
  $delete_id = $_POST['btn_delete'];

  //The auction_sttatus is changed to disactive and the auction is removed.
  $query= "UPDATE auction_details SET 
           auction_status= 'disactive' WHERE auction_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        //the user is redirected to the auction details page after the successfully execution of the query.
        header('Location:auctiondetails.php');
      }else{
        echo $query;
      }
}


//When the restore button is clicked form the removed auction page following query runs.
if(isset($_POST['btn_restore'])){
  //Get form data
  $restore_id = $_POST['btn_restore'];

  //the status of the auction is changed back to active.
  $query= "UPDATE auction_details SET 
           auction_status='active' WHERE auction_id =".$restore_id;

    $restore = $conn->query($query);
      if($restore){
        //contributor is redirected ot hte auctionremoved page.
        header('Location:auctionremoved.php');
      }else{
        echo "Error in restoring the auction";
      }
}
?>
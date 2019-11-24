<?php session_start();
 include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');

//if the user click on delte button in the user 
if(isset($_POST['btn_delete'])){
  //Get form data
  $delete_id = $_POST['btn_delete'];

  //Updating the status of user to disactive.
  $query= "UPDATE users SET 
           user_status='disactive' WHERE user_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        //contributor is redirected to the viewuser page.
        header('Location:viewuser.php');
      }else{
        $error = "Error in adding the Product";
      }
}

//If the contributor click on the restore button in the removed user page.
if(isset($_POST['btn_restore'])){
  //Get form data
  $restore_id = $_POST['btn_restore'];

  //Updating the status of the user to active after restore button is clicked.
  $query= "UPDATE users SET 
           user_status='active' WHERE user_id =".$restore_id;

    $restore = $conn->query($query);
      if($restore){
        //contributor is redirected to this page after successful implemenation of the query.
        header('Location:viewuser.php');
      }else{
        $error = "Error in adding the Product";
      }
}
?>
<?php 
session_start();
ob_start();
 include('../../config/db.php');

 include('../inc/header.php');
 include('../inc/navigation.php');

//if the delete button is clicked on the view products page. 
if(isset($_POST['btn_delete'])){
  //Get form data
  $delete_id = $_POST['btn_delete'];

  //Updating the products status to disactive.
  $query= "UPDATE banner SET 
           banner_status='disactive' WHERE banner_id = '$delete_id'";

    $delete = $conn->query($query);
      if($delete){
        header('Location:/khel/admin/banner/viewbanner.php');
      }else{
        $error = "Error in delteing the Banner";
      }
}

//When the restore button is clicked from the removed products page.
if(isset($_POST['btn_restore'])){
  //Get form data
  $delete_id = $_POST['btn_restore'];

  //updating the products status to active.
  $query= "UPDATE banner SET 
           banner_status='active' WHERE banner_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        header('Location:/khel/admin/banner/viewbanner.php');
      }else{
        $error = "Error in restoring the banner";
      }
}
?>
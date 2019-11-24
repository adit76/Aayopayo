<?php 

 include('../inc/header.php');
 include('../inc/navigation.php');

//When the delete button is clicked view contributor on admin panel.
if(isset($_POST['btn_delete'])){
  //Get form data
  $delete_id = $_POST['btn_delete'];

  //This changes the user_status to disactive after which the contributor is moved to trash.
  $query= "UPDATE users SET 
           user_status='disactive' WHERE user_id =".$delete_id;

    //setting up the connection with the database.
    $delete = $conn->query($query);
      if($delete){
        //if success the admin is redirected to the viewcontributor page.
        header('Location:/aayopayo/cpanel/admin/contributor/viewcontributor.php');
      }else{
        $error = "Error in adding the Product";
      }
}


//if the restore button is clicked from the remove contributor page.
if(isset($_POST['btn_restore'])){
  //Get form data
  $restore_id = $_POST['btn_restore'];

//this changes the user_status to active after with the contributor is moved to view contributor page.
  $query= "UPDATE users SET 
           user_status='active' WHERE user_id =".$restore_id;

    $restore = $conn->query($query);
      if($restore){
        //when successful the admin is redirected to the view contributor page where he can see all the available contributors.
        header('Location:/aayopayo/cpanel/admin/contributor/viewcontributor.php');
      }else{
        $error = "Error in adding the Product";
      }
}
?>
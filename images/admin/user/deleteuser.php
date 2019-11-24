<?php session_start();
 include('../../config/db.php');

//When the delete button is clicked in the user page in the admin panel the folliwng code executes.
if(isset($_POST['btn_delete'])){
  //Getting the data of the user which has to be deleted.
  $delete_id = $_POST['btn_delete'];

  //The status of the user is set to disactive and is moved to the removed user.
  $query= "UPDATE users SET 
           user_status='disactive' WHERE user_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        //the user is redirected to the viewuser page
        header('Location:/khel/admin/user/viewuser.php');
      }else{
        $error = "Error in adding the Product";
      }
}


//when the restore button is clicked from removed user. The following query executes.
if(isset($_POST['btn_restore'])){
  //Get form data
  $restore_id = $_POST['btn_restore'];

  //the user status is changed to active which the user is to be set to active.
  $query= "UPDATE users SET 
           user_status='active' WHERE user_id =".$restore_id;

    $restore = $conn->query($query);
      if($restore){
        //user is redirect to the view user page.
        header('Location:/khel/admin/user/viewuser.php');
      }else{
        $error = "Error in adding the Product";
      }
}
?>
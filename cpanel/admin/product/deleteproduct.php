<?php session_start();
 include('../../../config/db.php');

//if the delete button is clicked on the view products page. 
if(isset($_POST['btn_delete'])){
  //Get form data
  $delete_id = $_POST['btn_delete'];

  //Updating the products status to disactive.
  $query= "UPDATE products SET 
           product_status='disactive' WHERE product_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        header('Location:/aayopayo/cpanel/admin/product/viewproduct.php');
      }else{
        $error = "Error in adding the Product";
      }
}

//When the restore button is clicked from the removed products page.
if(isset($_POST['btn_restore'])){
  //Get form data
  $delete_id = $_POST['btn_restore'];

  //updating the products status to active.
  $query= "UPDATE products SET 
           product_status='active' WHERE product_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        header('Location:/aayopayo/cpanel/admin/product/viewproduct.php');
      }else{
        $error = "Error in adding the Product";
      }
}
?>
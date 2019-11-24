<?php session_start();
 include('../../config/db.php');
 include('../inc/navigation.php');
 include('../inc/header.php');

//If the user click on delete button on product page the following query runs.
if(isset($_POST['btn_delete'])){
  //Get form data along with the product id
  $delete_id = $_POST['btn_delete'];

  //Updating the product status to disactive.
  $query= "UPDATE products SET 
           product_status='disactive' WHERE product_id =".$delete_id;

    //ececuting the product.
    $delete = $conn->query($query);
      if($delete){
        header('Location:viewproduct.php');
      }else{
        $error = "Error in adding the Product";
      }
}


//If the user click on the restore button from the product page and removed product page. The following query runs.
if(isset($_POST['btn_restore'])){
  //Get form data along with the deleted product id 
  $delete_id = $_POST['btn_restore'];

  //updating the product status active which was removed. 
  $query= "UPDATE products SET 
           product_status='active' WHERE product_id =".$delete_id;

    $delete = $conn->query($query);
      if($delete){
        //redirecting the user to the vieww product after the successful implementation of the code.
        header('Location:viewproduct.php');
      }else{
        $error = "Error in adding the Product";
      }
}
?>


<?php


if(isset($_POST['view'])){

// $con = mysqli_connect("localhost", "root", "", "notif");

if($_POST["view"] != '')

{
   $update_query = "UPDATE notification SET notification_status = 1 WHERE notification_status=0";
   mysqli_query($conn, $update_query);
}

$query = "SELECT * FROM notification ORDER BY notification_id DESC LIMIT 5";
$result = mysqli_query($conn, $query);
$output = '';

if(mysqli_num_rows($result) > 0)
{

while($row = mysqli_fetch_array($result))

{

  $output .= '
  <li>
  <a href="#">
  <strong>'.$row["user_id"].'</strong><br />
  <small><em>'.$row["product_id"].'</em></small>
  </a>
  </li>

  ';
}
}

else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Noti Found</a></li>';
}

$status_query = "SELECT * FROM notification WHERE notification_status=0";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);

$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);

echo json_encode($data);
}
?>/
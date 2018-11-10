<?php
session_start();

  include_once 'db.php';

if (isset($_GET['id'])) {
   $id=$_GET['id'];
   $idsess = $_GET['itemid'];

   $query_delete = "DELETE FROM order_details WHERE detail_id = '$id' AND item_id = '$idsess'";
   $result_delete = $connection->query($query_delete);
   if ($_SESSION['item'] > 0 )
    {$_SESSION['item'] -= 1;
    }else
    {$_SESSION['item'] = $_SESSION['item'];}
   

header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else {
  header('Location: sign');
}
?>

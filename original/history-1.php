<?php

session_start();

 require 'includes/header.php';
 require 'includes/navconnected.php'; //require $nav;?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="index" class="breadcrumb">Home</a>
            <a href="#" class="breadcrumb">History</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

        <div class="container center-align staaats">
          <div class="row">
          <h4>All Purchases</h4>
          <hr>
          <?php


          include 'db.php';
        $idsess = $_SESSION['id'];
         $queryfirst = "SELECT

        product.id as 'id',
        product.id_category,
        product.quantity as 'rem',

         SUM(order_details.quantity) as 'total',
         orders.status,
         order_details.item_id,

         category.name as 'name',
         category.id

         FROM product, orders, order_details, category
         WHERE product.id = order_details.item_id
         AND orders.buyer_id = '$idsess'
         AND orders.order_id = order_details.order_id
         AND category.id = product.id_category GROUP BY category.id";
         $resultfirst = $connection->query($queryfirst);
         if ($resultfirst->num_rows > 0) {

          $sum = 0;
           // output data of each row
           while($rowfirst = $resultfirst->fetch_assoc()) {

                 $idp = $rowfirst['id'];
                 $name_best = $rowfirst['name'];
                 $totalsold = $rowfirst['total'];
                 $sum = $rowfirst['rem'];
                 $percent = ($totalsold / $sum )*100;

                 ?>

                  <div class="col s2">
                    <p class="black-text"><?= $name_best; ?></p>
                    <div class="card grey<?= $idp; ?>" style="padding-top:<?=number_format((float)$percent, 2, '.', ''); ?>%">
                       <h5 class="blue-text"><?=number_format((float)$percent, 2, '.', '');  ?>%</h5><p class="grey-text"><?=$totalsold ?></p>
                    </div>
                  </div>

                 <?php }} ?>
          </div>
          <hr>

          <div class="row">  
          <?php
          $idsess = $_SESSION['id'];    
           $querytwo = "SELECT
        product.id as 'id',
        product.name as 'name',
        product.price as 'price',

        SUM(order_details.quantity),
        orders.order_id as 'orderid',
        orders.status as 'status',
        order_details.item_id,
        order_details.quantity as 'quantity',
        orders.buyer_id as 'user',
        orders.address as 'address',
        orders.phone as 'phone'

        FROM product, order_details
        LEFT JOIN orders ON orders.order_id = order_details.order_id
        WHERE product.id = order_details.item_id
        AND orders.buyer_id = '$idsess'
        AND orders.order_id = order_details.order_id
        GROUP BY orders.order_id
        ORDER BY SUM(order_details.quantity) DESC ";
        $resulttwo = $connection->query($querytwo);
        if ($resulttwo->num_rows > 0) { ?>

        <table class="highlight striped">
          <thead>
            <tr>
                <th data-field="name">Item name</th>
                <th data-field="price">Price</th>
                <th data-field="quantity">Quantity</th>
                <th data-field="user">User</th>
                <th data-field="address">Address</th>
                <th data-field="phone">Phone</th>
                <th data-field="statut">Status</th>
                <th data-field="delete" colsp an="2">Action</th>
            </tr>
          </thead>
          <tbody>

        <?php
        // output data of each row
        while($rowfirst = $resulttwo->fetch_assoc()) {

            $orderid = $rowfirst['orderid'];
            $idp = $rowfirst['id'];
            $name = $rowfirst['name'];
            $status = $rowfirst['status'];
            $phone = $rowfirst['phone'];
            $quantity = $rowfirst['quantity'];
            $price = $rowfirst['price'];
            $user = $rowfirst['user'];
            $address = $rowfirst['address'];

            //get user name
            $queryuser = "SELECT firstname, lastname FROM users WHERE id = '$user' ";
            $resultuser = $connection->query($queryuser);
            if ($resultuser->num_rows > 0) {
              // output data of each row
              while($rowuser = $resultuser->fetch_assoc()) {
                $userfirstname = $rowuser['firstname'];
                $userlasttname = $rowuser['lastname'];
              ?>    
              <tr>
                <td><?= $name; ?></td>
                <td><?= $price; ?></td>
                <td><?= $quantity; ?></td>
                <td><?php echo" $userfirstname "." $userlasttname"; ?></td>
                <td><?= $address; ?></td>
                <td><?= $phone; ?></td>
                <td><?= $status; ?></td>                
                <td> <a href="admin/deletecmd.php?id=<?= $orderid; ?>&userid=<?= $idp; ?>"><i class="material-icons red-text">close</i></a></td>
                <td></td>
              </tr>
          <?php }} }} ?>
          </tbody>
        </table> 
          </div>
        </div>
 <?php require 'includes/footer.php'; ?>

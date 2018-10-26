<?php

session_start();

if ($_SESSION['role'] !== 'admin') {
  header('Location: ../index');
}

 require 'includes/header.php';
 require 'includes/navconnected.php'; 
 ?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="indexadm.php" class="breadcrumb">Dashboard</a>
            <a href="infoproduct" class="breadcrumb">Products</a>
            <a href="editproduct" class="breadcrumb">Orders</a>
          </div>
        </div>
      </nav>
    </div>
   </div>
   <div class="container scroll">
    <?php
    include 'db.php';
    $queryproducts =
    "SELECT
    product.id as 'id',
    product.name as 'name',
    product.discription as 'Price',
    product.price as 'price',
    product.thumbnail as 'thumbnail',
    product.quantity as 'quantity',
    FROM product;"
    $productdata = $connection->query( $queryproducts)
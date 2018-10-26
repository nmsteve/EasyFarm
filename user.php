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

    $quertyuser = "SELECT 
    users.id as 'id' ,
    users.firstname as 'firstname',
    users.lastname as 'lastname',
    users.address as 'address',
    users.phone as 'phone',
    users.city as 'city',
    users.role as 'role'
    FROM users";
    $resultuser = $connection->query($quertyuser);

    if ( $resultuser->num_rows > 0)
      { ?>

           
        <table class="highlight striped">
          <thead>
                  <tr>
                      <th data-field="id">Id</th>
                      <th data-field="firs">firstname</th>
                      <th data-field="price">lastname</th>
                      <th data-field="quantity">Address</th>
                      <th data-field="address">Phone</th>
                      <th data-field="statut">City</th>
                      <th data-field="delete">role</th>
                  </tr>
          </thead>
                <tbody>
       <?php         
          while($rowuser = $resultuser->fetch_assoc())
          {
            $id = $rowuser['id'] ;
            $firstname = $rowuser['firstname'];
            $lastname = $rowuser['lastname'];
            $address = $rowuser['address'];
            $phone = $rowuser['phone'];
            $city = $rowuser['city'];
            $role = $rowuser['role'];
          ?>       
          
                  <tr>
                  <td><?= $id; ?></td>
                  <td><?= $firstname; ?></td>
                  <td><?= $lastname; ?></td>
                  <td><?= $address; ?></td>
                  <td><?= $phone; ?></td>
                  <td><?= $city; ?></td>
                  <td><?= $role; ?></td>
                  </tr>
          <?php }} ?>
          </tbody>
    </table>
             
  </div>   
  
 



  <?php require 'includes/footer.php'; ?>
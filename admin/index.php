<!DOCTYPE html>
<html>
      <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Fruitfarm</title>
      <link rel="icon" href="../src/img/icon.png">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!-- font-awesome -->
      <link rel="stylesheet" href="..src/css/font-awesome-4.6.3/css/font-awesome.min.css">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="..src/css/materialize.min.css"  media="screen,projection"/>
      <!-- animate css -->
      <link rel="stylesheet" href="../src/css/animate.css-master/animate.min.css">
      <!-- My own style -->
      <link rel="stylesheet" href="../src/css/style.css">
      <!-- Progress bar -->
      <link rel='stylesheet' href='../src/css/nprogress.css'/>
    </head>
  <body>

<?php

session_start();

if ($_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
}
 set_include_path('C:\xampp\htdocs\EasyFarm\includes');
 echo get_include_path();
  require 'adminnav.php'; //require $nav;?>

 <div class="container-fluid product-page">
   <div class="container current-page">
      <nav>
        <div class="nav-wrapper">
          <div class="col s12">
            <a href="../index.php" class="breadcrumb">Fruitfarm</a>
            <a href="index.php" class="breadcrumb">Admin Dashboard</a>
          </div>
        </div>
      </nav>
    </div>
   </div>

<div class="container dashboard">
  <div class="row">
         <div class="col s12 m4">
           <div class="card horizontal">
             <div class="card-image">
               <img src="..src/img/fruit-basket.png" alt="" />
             </div>
             <div class="card-stacked">
              <div class="card-content">
                <p><a href="infoproduct" class="black-text">Products</a></p>
              </div>
               <div class="card-action">
                 <a href="infoproduct" class="blue-text">Learn more</a>
               </div>
             </div>
           </div>
         </div>

         <div class="col s12 m4">
           <div class="card horizontal">
             <div class="card-image">
               <img src="..src/img/cat.png" alt="" />
             </div>
             <div class="card-stacked">
        <div class="card-content">
          <p><a href="products" class="black-text">Stock</a></p>
        </div>
             <div class="card-action">
               <a href="products" class="blue-text">Learn more</a>
             </div>
             </div>

           </div>
         </div>

         <div class="col s12 m4">
           <div class="card horizontal">
             <div class="card-image">
               <img src="..src/img/user.png" alt="" />
             </div>
             <div class="card-stacked">
              <div class="card-content">
                <p><a href="allusers" class="black-text">Users</a></p>
              </div>
               <div class="card-action">
                 <a href="allusers" class="blue-text">Learn more</a>
               </div>
             </div>
           </div>
         </div>
         <?php

            include '../db.php';
            //get total users
            $queryusers = "SELECT count(id) as total FROM users";
            $resultusers = $connection->query($queryusers);

            if($resultusers->num_rows > 0) {
              while ($rowusers = $resultusers->fetch_assoc()) {
                $totalusers = $rowusers['total'];
              }
            }

            //get total ordered commands
            $queryorder = "SELECT count(id) as total, statut FROM command";
            $resultorder = $connection->query($queryorder);

            if($resultorder->num_rows > 0) {
              while ($roworder = $resultorder->fetch_assoc()) {
                $totalorder = $roworder['total'];
              }
            }

            //get total paid commands
            $querypaid = "SELECT count(id) as total, statut FROM command WHERE statut = 'paid'";
            $resultpaid = $connection->query($querypaid);

            if($resultorder->num_rows > 0) {
              while ($rowpaid = $resultpaid->fetch_assoc()) {
                $totalpaid = $rowpaid['total'];
              }
            }
          ?>
          <hr>
         <div class="col s12 m4">
           <div class="card green lighten-1 horizontal">
             <div class="card-stacked">
              <div class="card-content">
                <h5 class="white-text"><i class="material-icons left">shopping_cart</i> Total Payments</h5>
              </div>
               <div class="card-action">
                 <a class="pull-right btn" href="records">View All</a>
                 <h5 class="white-text"><?= $totalpaid; ?></h5>
               </div>
             </div>
           </div>
         </div>

         <div class="col s12 m4">
           <div class="card blue lighten-1 horizontal">
             <div class="card-stacked">
              <div class="card-content">
                <h5 class="white-text"><i class="material-icons left">shopping_cart</i> Total Orders</h5>
              </div>
               <div class="card-action">
                 <a class="pull-right btn" href="orders">View All</a>
                 <h5 class="white-text"><?= $totalorder; ?></h5>
               </div>
             </div>
           </div>
         </div>


         <div class="col s12 m4">
           <div class="card horizontal red lighten-1">
             <div class="card-stacked">
              <div class="card-content">
                <h5 class="white-text"><i class="material-icons left">supervisor_account</i> Total Users</h5>
              </div>
               <div class="card-action">
                 <a class="pull-right btn" href="allusers">View All</a>
                 <h5 class="white-text"><?= $totalusers; ?></h5>
               </div>
             </div>
           </div>
         </div>
         
       </div>
</div>
</body>
</html>
 <?php require '..\footer.php'; ?>

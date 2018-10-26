<?php

$connection = mysqli_connect('localhost', 'root', '', 'fruitfarm2');  
 if(!$connection) {
     die("Database connection failed");
 }
echo "connection created";
 ?>

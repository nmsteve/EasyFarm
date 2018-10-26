<?php
if (isset($_POST['signup'])) {

  $email = $_POST['email'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $phone = $_POST['phone'];

  $encryptedpass = md5($password);


  include 'db.php';

  //connecting & inserting data

  $query = "INSERT INTO users(email,
firstname,
lastname,
password,
address,
city,
phone,
role) VALUES ('" . stripslashes($email) . "',
'" . stripslashes($firstname) . "',
'" . stripslashes($lastname) . "',
'$encryptedpass',
'" . stripslashes($address) . "',
'" . stripslashes($city) . "',
'$phone',
'client')";



?>

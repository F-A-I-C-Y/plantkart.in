<?php

session_start();
include 'config.php';

// Get the form data
$name = $_POST['customer_name'];
$card_number = mysqli_real_escape_string($conn,$_POST['n1'].' '.$_POST['n2'].' '. $_POST['n3'].' ' .$_POST['n4']);
$cvv = $_POST['cvv'];
$amount = $_POST['amount'];
$payment_date =  date('d-M-Y');

// Insert the data into the database
$query = "INSERT INTO payment (name, card_number, cvv, amount, payment_date) VALUES ('$name', '$card_number', '$cvv', '$amount', '$payment_date')";
mysqli_query($conn, $query);

?>


<html>

  <head>
    <title> ORDER PLACED</title>
  </head>

   <style>
    
      .head, .container
      {
         min-height: 15vh;
         display: flex;
         flex-flow: column;
         align-items: center;
         justify-content: center;
         gap:1rem;
         background-size: cover;
         background-position: center;
         text-align: center;
      }

      .head p, .container
      {
         font-size: 2.5rem;
         color:rgb(0, 223, 33);
      }

      .head p a, .container
      {
         color:rgb(0, 0, 0);
         font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
         font-weight: bolder;
      }

      .head p a:hover
      {
         text-decoration:none;
         color: rgb(216, 40, 40);
      }
      .container #h1
      {
      background-color:lightgreen;
      margin-top: 10px;
      align-content: center;
      justify-content: center;
      }

      #h1
      {
      width: 900px;
      height: 90px;
      }
   </style>

  <link rel="stylesheet" type = "text/css" href ="css/user-style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
 

  <body>
      <?php include 'header.php'; ?>
      
        <div class="container">
            <h1 class="text-center" style="color: green;" id="h1">Order Placed Successfully.</h1><br>
            <h2 class="text-center"> Thank you for Ordering at PlantKart! The ordering process is now complete.</h2>
         </div>
         <br>
         <br>
         <div class="head">
            <p> <a href="shop.php">GO BACK</a></p>
         </div>
   </body>

</html>
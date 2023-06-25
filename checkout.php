<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id))
{
   header('location:login.php');
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CHECKOUT</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user-style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0)
      {
         while($fetch_cart = mysqli_fetch_assoc($select_cart))
         {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₹'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }
   else
   {
      echo '<p class="empty">Your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> Grand Total : <span>₹<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="payment.php" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>NAME :</span>
            <input type="text" name="name" required placeholder="Enter your Name" value="<?php echo $_SESSION['user_name']; ?>">
         </div>
         <div class="inputBox">
            <span>CONTACT NUMBER :</span>
            <input type="number" name="number" required placeholder="Enter your Number" maxlength="10" >
         </div>
         <div class="inputBox">
            <span>E-Mail ID :</span>
            <input type="email" name="email" required placeholder="Enter your E-Mail" value="<?php echo $_SESSION['user_email']; ?>">
         </div>
         <div class="inputBox">
            <span>PAYMENT METHOD :</span>
            <input type="text" name="method" required  value="Credit Card">
         </div>
         <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. Flat No.">
         </div>
         <div class="inputBox">
            <span>Address line 02 :</span>
            <input type="text" name="street" required placeholder="e.g. Street Name">
         </div>
         <div class="inputBox">
            <span>CITY :</span>
            <input type="text" name="city" required placeholder="e.g. Kattappana">
         </div>
         <div class="inputBox">
            <span>STATE :</span>
            <input type="text" name="state" required placeholder="e.g. Kerala">
         </div>
         <div class="inputBox">
            <span>COUNTRY :</span>
            <input type="text" name="country" required placeholder="e.g. India">
         </div>
         <div class="inputBox">
            <span>PIN CODE :</span>
            <input type="number"  name="pin_code" required placeholder="e.g. 123456"maxlength="6">
         </div>
      </div>
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
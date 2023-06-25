<?php
session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

if(!isset($user_id))
{
   header('location:login.php');
}

$grand_total = 0;
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_cart) > 0)
{
  while($fetch_cart = mysqli_fetch_assoc($select_cart))
    {
      $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
      $grand_total += $total_price;
    }
}

$name = mysqli_real_escape_string($conn, $_POST['name']);
$number = $_POST['number'];
$email = mysqli_real_escape_string($conn, $_POST['email']);
$method = mysqli_real_escape_string($conn, $_POST['method']);
$address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '.$_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
$placed_on = date('d-M-Y');

$cart_total = 0;
$cart_products[] = '';

$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($cart_query) > 0)
{
   while($cart_item = mysqli_fetch_assoc($cart_query))
   {
      $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
      $sub_total = ($cart_item['price'] * $cart_item['quantity']);
      $cart_total += $sub_total;
   }
}

$total_products = implode(', ',$cart_products);

$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

if($cart_total == 0)
{
   $message[] = 'Your cart is empty';
}
else
{
   if(mysqli_num_rows($order_query) > 0)
   {
      $message[] = 'Order already Placed!'; 
   }
   else
   {
      mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
      mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   } 

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYMENT</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/user-style.css">
    <style>
        
        .payment
        {
        display: grid;
        justify-content: center;
        align-items: center;
        border-radius: 26px;}
  
        .modal {
          width: fit-content;
          height: fit-content;
          background: #FFFFFF;
          box-shadow: 0px 187px 75px rgba(0, 0, 0, 0.01), 0px 105px 63px rgba(0, 0, 0, 0.05), 0px 47px 47px rgba(0, 0, 0, 0.09), 0px 12px 26px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
          border-radius: 26px;
          max-width: 400px;
  
          
        }
  
        .form {
          display: flex;
          flex-direction: column;
          gap: 20px;
          padding: 20px;
        }
  
        .payment--options {
          width: calc(100% - 40px);
          display: grid;
          grid-template-columns: 33% 34% 33%;
          gap: 20px;
          padding: 10px;
        }
  
        .payment--options button {
          height: 55px;
          background: #F2F2F2;
          border-radius: 11px;
          padding: 0;
          border: 0;
          outline: none;
        }
  
        .payment--options button svg {
          height: 18px;
        }
  
        .separator {
          width: calc(100% - 20px);
          display: grid;
          grid-template-columns: 1fr 2fr 1fr;
          gap: 10px;
          color: #8B8E98;
          margin: 0 10px;
        }
  
        .separator > p {
          word-break: keep-all;
          display: block;
          text-align: center;
          font-weight: 600;
          font-size: 11px;
          margin: auto;
        }
  
        .separator .line {
          display: inline-block;
          width: 100%;
          height: 1px;
          border: 0;
          background-color: #e8e8e8;
          margin: auto;
        }
  
        .credit-card-info--form {
          display: flex;
          flex-direction: column;
          gap: 15px;
        }
  
        .input_container {
          width: 100%;
          height: fit-content;
          display: flex;
          flex-direction: column;
          gap: 5px;
        }
  
        .split {
          display: grid;
          grid-template-columns: 1fr 1fr 1fr;
          gap: 10px;
        }
  
        .split input {
          width: 100%;
        }

        .num {
          display: grid;
          grid-template-columns: 1fr 1fr 1fr 1fr;
          gap: 10px;
        }
  
        .num input {
          width: 100%;
        }

        .card {
          display: grid;
          grid-template-columns: 20fr 20fr;
          gap: 10px;
        }
  
        .card h2 
        {
          font-size: larger;
          justify-content: center;
          align-items: center;
        }
  
        .input_label {
          font-size: 10px;
          color: #8B8E98;
          font-weight: 600;
        }
  
        .input_field {
          width: auto;
          height: 40px;
          padding: 0 0 0 16px;
          border-radius: 9px;
          outline: none;
          background-color: #F2F2F2;
          border: 1px solid #e5e5e500;
          transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
        }
  
        .input_field:focus {
          border: 1px solid transparent;
          box-shadow: 0px 0px 0px 2px #242424;
          background-color: transparent;
        }
  
        .purchase--btn {
          height: 55px;
          background: #F2F2F2;
          border-radius: 11px;
          border: 0;
          outline: none;
          color: #ffffff;
          font-size: 13px;
          font-weight: 700;
          background: linear-gradient(180deg, #363636 0%, #1B1B1B 50%, #000000 100%);
          box-shadow: 0px 0px 0px 0px #FFFFFF, 0px 0px 0px 0px #000000;
          transition: all 0.3s cubic-bezier(0.15, 0.83, 0.66, 1);
        }
  
        .purchase--btn:hover {
          box-shadow: 0px 0px 0px 2px #FFFFFF, 0px 0px 0px 4px #0000003a;
        }
  

        .input_field::-webkit-outer-spin-button,
        .input_field::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
  


        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');


.container{
    min-height: 100vh;
    background: #eee;
    display:grid;
    align-items: center;
    justify-content: center;
    flex-flow: column;
    padding-bottom: 60px;
}

.container form{
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 10px 15px rgba(0,0,0,.1);
    padding: 20px;
    margin-left: 0px;
    width: 600px;
    padding-top: 160px;
}

.container form .inputBox{
    margin-top: 20px;
}

.container form .inputBox span{
    display: block;
    color:#999;
    padding-bottom: 5px;
}

.container form .inputBox input,
.container form .inputBox select{
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border:1px solid rgba(0,0,0,.3);
    color:#444;
}

.container form .flexbox{
    display: flex;
    gap:15px;
}


.container form .submit-btn{
    width: 100%;
    background:linear-gradient(45deg, blueviolet, deeppink);
    margin-top: 20px;
    padding: 10px;
    font-size: 20px;
    color:#fff;
    border-radius: 10px;
    cursor: pointer;
    transition: .2s linear;
}

.container form .submit-btn:hover{
    letter-spacing: 2px;
    opacity: .8;
}

.container .card-container{
    margin-bottom: -150px;
    position: relative;
    height: 250px;
    width: 400px;
}

.container .card-container .front{
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0; left: 0;
    background:linear-gradient(45deg, blueviolet, deeppink);
    border-radius: 5px;
    backface-visibility: hidden;
    box-shadow: 0 15px 25px rgba(0,0,0,.2);
    padding:20px;
    margin-left: 90px;
    transform:perspective(1000px) rotateY(0deg);
    transition:transform .4s ease-out;
}

.container .card-container .front .image{
    display: flex;
    align-items:center;
    justify-content: space-between;
    padding-top: 10px;
}

.container .card-container .front .image img{
    height: 50px;
}

.container .card-container .front .card-number-box{
    padding:30px 0;
    font-size: 22px;
    color:#fff;
}

.container .card-container .front .flexbox{
    display: flex;
}

.container .card-container .front .flexbox .box:nth-child(1){
    margin-right: auto;
}

.container .card-container .front .flexbox .box{
    font-size: 15px;
    color:#fff;
}

.container .card-container .back{
    position: absolute;
    top:0; left: 0;
    height: 100%;
    width: 100%;
    background:linear-gradient(45deg, blueviolet, deeppink);
    border-radius: 5px;
    padding: 20px 0;
    text-align: right;
    backface-visibility: hidden;
    box-shadow: 0 15px 25px rgba(0,0,0,.2);
    transform:perspective(1000px) rotateY(180deg);
    transition:transform .4s ease-out;
}

.container .card-container .back .stripe{
    background: #000;
    width: 100%;
    margin: 10px 0;
    height: 50px;
}

.container .card-container .back .box{
    padding: 0 20px;
}

.container .card-container .back .box span{
    color:#fff;
    font-size: 15px;
}

.container .card-container .back .box .cvv-box{
    height: 50px;
    padding: 10px;
    margin-top: 5px;
    color:#333;
    background: #fff;
    border-radius: 5px;
    width: 100%;
}

.container .card-container .back .box img{
    margin-top: 30px;
    height: 30px;
}

      </style>
</head>
<body>

     
    <?php include 'header.php'; ?>
  
    <div class="heading">
      <h3>payment</h3>
      <p> <a href="home.php">Home</a> / Payment </p>
    </div>
 
<div class="container">


  <div class="card-container">

<div class="front">
<div class="separator">
  <hr class="line">
  <p>Enter Credit Card Details</p>
  <hr class="line">
</div>
    <div class="card-number-box">################</div>
    <div class="flexbox">
        <div class="box">
            <span>card holder</span>
            <div class="card-holder-name">Full name</div>
        </div>
        <div class="box">
            <span>expires</span>
            <div class="expiration">
                <span class="exp-month">mm</span>
                <span class="exp-year">yy</span>
            </div>
        </div>
        <div class="box">
        <span>cvv</span>
        <div class="cvv-box"></div>
        <img src="image/visa.png" alt="">
    </div>
    </div>
</div>

<div class="back">
    <div class="stripe"></div>
    <div class="box">
        <span>cvv</span>
        <div class="cvv-box"></div>
        <img src="image/visa.png" alt="">
    </div>
</div>

</div>

      <form class="form" method="post" action="success.php">
        <br>
        <div class="credit-card-info--form">
          <div class="input_container">
            <label for="password_field" class="input_label">Card holder full name</label>
            <input id="password_field" class="input_field" type="text" name="customer_name" placeholder="Card Holder" required>
          </div>
          <div class="input_container">
            <div class="num">
                <label for="password_field" class="input_label">Card Number</label>
            </div>
          </div>
          <div class="input_container">
            <div class="num">
                <input id="password_field" class="input_field" type="password" name="n1"  placeholder="0000" maxlength="4" required>
                <input id="password_field" class="input_field" type="password" name="n2"  placeholder="0000" maxlength="4" required>
                <input id="password_field" class="input_field" type="password" name="n3"  placeholder="0000" maxlength="4" required>
                <input id="password_field" class="input_field" type="password" name="n4"  placeholder="0000" maxlength="4" required>
            </div>
          </div>
          <div class="input_container">
            <div class="split">
            <label for="password_field" class="input_label">Expiry Date</label>
            <label for="password_field" class="input_label">CVV</label>
            <label for="password_field" class="input_label">Amount</label>
          </div>
            <div class="split">
            <input id="password_field" class="input_field" type="date" name="exp_date"  required>
            <input id="password_field" class="input_field" type="password" name="cvv" maxlength="3" required>
            <input id="password_field" class="input_field" type="number" name="amount"  value="<?php echo $grand_total; ?>" required>
          </div>
          </div>
        </div>
          <button class="purchase--btn" name="submit">Proceed</button>
      </form>


</div>    
    
  
  <?php include 'footer.php'; ?>
  
  <!-- custom js file link  -->
  <script src="js/script.js"></script>


</body>
</html>


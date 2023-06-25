<?php

// include 'config.php';

// session_start();

// $user_id = $_SESSION['user_id'];

// if(!isset($user_id))
// {
//    header('location:login.php');
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ABOUT</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/user-style.css">

</head>

<body>
   
<?php include 'header.php'; ?>


<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">Home</a> / About </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>We've known all our growers personally for years. We know exactly how they operate and the conditions in which they grow their plants.</p>
         <p>You can always reach us on the phone and we'll never let you down.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

   </section>

   <section class="reviews">

<h1 class="title">client's reviews</h1>

<div class="box-container">

   <div class="box">
      <img src="images/pic-1.png" alt="">
      <p>The team at PlantKart was communicative and professional. The plants look great and staff are really excited to have them in the office.</p>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
      <h3>PAUL ROY</h3>
   </div>

   <div class="box">
      <img src="images/pic-2.png" alt="">
      <p>I'm very satisfied with my Indoor plant! PlantKart have helped me with all my plant needs and questions, from where to put them to how to help them grow healthy! Thanks to PlantKart.</p>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
      <h3>GRIYA</h3>
   </div>

   <div class="box">
      <img src="images/pic-3.png" alt="">
      <p> Highly recommend!
         The plant exceeded my expectations which were high to begin with. It is healthy, large, beautiful, feels like I have a piece of the tropics right in my living room.
         The delivery was flawless. Great experience overall.</p>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
      <h3>CHRISTOPHER</h3>
   </div>

   <div class="box">
      <img src="images/pic-4.png" alt="">
      <p>I love it!
         My new plant gives me sound of mind.</p>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
      <h3>JESSILIA GEORGE</h3>
   </div>

   <div class="box">
      <img src="images/pic-5.png" alt="">
      <p>I have been buying for over 2 months my plants at PlantKart. I have bought a couple large plants. The plants are always in good condition and i get excellent customer support.</p>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
      <h3>JOHN DEO</h3>
   </div>

   <div class="box">
      <img src="images/pic-6.png" alt="">
      <p>Great service!!!!!!
The plant arrived on time and in excellent condition. The plant is thriving and very happy.</p>
      <div class="stars">
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star"></i>
         <i class="fas fa-star-half-alt"></i>
      </div>
      <h3>D'ZOUZA</h3>
   </div>

</div>

</section>

<section class="people">

   <h1 class="title">PEOPLE WHO WORK HERE</h1>

   <div class="box-container">

      <div class="box">
         <img src="images//people1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>CHRISTY</h3>
      </div>

      <div class="box">
         <img src="images/people2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>DIA</h3>
      </div>

      <div class="box">
         <img src="images/people3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <h3>BOBAS</h3>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
<?php

include 'components/connect.php';

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['nummer'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $date = $_POST['date'];
   $date = filter_var($date, FILTER_SANITIZE_STRING);
   $date = strtotime($date);
   $new_date = date('d/m/Y', $date);

   $verify_contact = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND nummer = ?");
   $verify_contact->execute([$name, $email, $number]);

   if($verify_contact->rowCount() > 0){
      $warning_msg[] = 'Appointment sent already!';
   }else{
      $insert_contact = $conn->prepare("INSERT INTO `messages`(id, name, email, nummer, date) VALUES(?,?,?,?,?)");
      $insert_contact->execute([$id, $name, $email, $nummer, $new_date]);
      $success_msg[] = 'Appointment Sent Successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tandklaar.nl</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<!-- header begin  -->

<header class="header fixed-top">

   <div class="container">

      <div class="row align-items-center justify-content-between">

         <a href="#home" class="logo">Tand<span>klaar.</span></a>

         <nav class="nav">
            <a href="#home">home</a>
            <a href="#over_ons">over ons</a>
            <a href="#services">onze services</a>
            <a href="#reviews">reviews</a>
            <a href="#contact">contact</a>
         </nav>

         <a href="#contact" class="link-btn">Maak een afspraak</a>

         <div id="menu-btn" class="fas fa-bars"></div>

      </div>

   </div>

</header>

<!-- header klaar -->

<!-- home begin  -->

<section class="home" id="home">

   <div class="container">

      <div class="row min-vh-100 align-items-center">
         <div class="content text-center text-md-left">
            <h3>Laat ons uw glimlach weer laten stralen</h3>
            <p>Uw glimlach is onze passie.</p>
            <a href="#contact" class="link-btn">Maak een afspraak</a>
         </div>
      </div>

   </div>

</section>

<!-- home klaar  -->

<!-- about begin  -->

<section class="over_ons" id="over_ons">

   <div class="container">

      <div class="row align-items-center">

         <div class="col-md-6 image">
            <img src="images/over ons -img.jpg" class="w-100 mb-5 mb-md-0" alt="">
         </div>

         <div class="col-md-6 content">
            <span>over ons</span>
            <h3>Ware gezondheidszorg voor je familie.</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam cupiditate vero in provident ducimus. Totam quas labore mollitia cum nisi, sint, expedita rem error ipsa, nesciunt ab provident. Aperiam, officiis!</p>
            <a href="#contact" class="link-btn">Maak een afspraak</a>
         </div>

      </div>

   </div>

</section>

<!-- about klaar -->

<!-- services begin  -->

<section class="services" id="services">

   <h1 class="heading">onze services</h1>

   <div class="box-container container">

      <div class="box">
         <img src="images/box1-imge-jpg.jpg" alt="">
         <h3>Persoonlijke Zorg</h3>
         <p>Bij ons staat uw glimlach centraal. We bieden persoonlijke tandheelkundige zorg afgestemd op uw behoeften</p>
      </div>

      <div class="box">
         <img src="images/box2-imge-jpg.jpg" alt="">
         <h3>Moderne Technologie</h3>
         <p>Wij werken met de nieuwste technologieën voor een comfortabele en effectieve behandeling.</p>
      </div>

      <div class="box">
         <img src="images/box3-imge-jpg.jpg" alt="">
         <h3>Ervaren Tandartsen</h3>
         <p>Ons team van deskundige tandartsen heeft jarenlange ervaring in diverse tandheelkundige behandelingen.</p>
      </div>

      <div class="box">
         <img src="images/box4-imge-jpg.jpg" alt="">
         <h3>Pijnloze Behandelingen</h3>
         <p>Wij doen er alles aan om uw behandeling zo pijnloos en prettig mogelijk te maken.</p>
      </div>

      <div class="box">
         <img src="images/box5-imge-jpg.jpg" alt="">
         <h3>Voor het hele Gezin</h3>
         <p>Van kinderen tot senioren, wij bieden tandheelkundige zorg voor het hele gezin.</p>
      </div>

      <div class="box">
         <img src="images/box6-imge-jpg.jpg" alt="">
         <h3>Preventie & Nazorg</h3>
         <p>Gezonde tanden beginnen bij goede zorg. Wij begeleiden u met advies en nazorg om uw gebit optimaal te houden.</p>
      </div>

   </div>

</section>

<!-- services klaar -->

<!-- process begin -->

<section class="process">

   <h1 class="heading">werk proces</h1>

   <div class="box-container container">

      <div class="box">
         <img src="images/process-1.jpg" alt="">
         <h3>Cosmetische tandheelkunde</h3>
         <p>We zullen er alles aan doen om uw glimlach te verbeteren! Vulling? Geen probleem! Beugel? Helemaal goed!
          Implanten? Wanneer u wilt!</p>
      </div>

      <div class="box">
         <img src="images/process-2.jpg" alt="">
         <h3>Pedodontologie</h3>
         <p>Laat uw kinderen ook komen! Ze zullen met een mooie witte glimlach naar huis.</p>
      </div>

      <div class="box">
         <img src="images/process-3.jpg" alt="">
         <h3>Implantologie</h3>
         <p>Tanden verloren door slecht hygiene of een ongeluk? Wij fixen het zo snel mogelijk voor u!</p>
      </div>

   </div>

</section>

<!-- process klaar -->

<!-- reviews begin  -->

<section class="reviews" id="reviews">

   <h1 class="heading"> Tevreden clienten </h1>

   <div class="box-container container">

      <div class="box">
         <img src="images/carib.jpg" alt="">
         <p>Dankzij Tandklaar hoef ik mij niet meer te schamen voor me tanden! Geweldige mensen, heel gastvrij en grappig!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Soraya Mansen</h3>
         <span>Tevreden client</span>
      </div>

      <div class="box">
         <img src="images/wit-mang.jpeg" alt="">
         <p>Ik was mijn tanden al 3 jaar verloren wegens een zwak tandvlees, maar de implanten van Tandklaar hebben mij echt geholpen! Helemaal top!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Ali koekenmuis</h3>
         <span>Tevreden client</span>
      </div>

      <div class="box">
         <img src="images/W.jpg" alt="">
         <p>Mijn kind heeft weer haar mooie witte tanden! Was wel een beetje lang wachten door de drukte maar wel het wachten waard!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Simon Kamp</h3>
         <span>Tevreden client</span>
      </div>

   </div>

</section>

<!-- reviews klaar -->

<!-- contact begin  -->

<section class="contact" id="contact">

   <h1 class="heading">Maak een afspraak</h1>

   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <span>Naam:</span>
      <input type="text" name="name" placeholder="Wat is uw naam?" class="box" required>
      <span>Email:</span>
      <input type="email" name="email" placeholder="Wat is uw email?" class="box" required>
      <span>Telefoonnummer:</span>
      <input type="number" name="number" placeholder="Wat is uw telefoonnummer?" class="box" required>
      <span>afspraaksdatum:</span>
      <input type="date" name="date" class="box" required>
      <input type="submit" value="Maak een afspraak!" name="submit" class="link-btn">
   </form>  

</section>

<!-- contact klaar -->

<!-- footer begin  -->

<section class="footer">

   <div class="box-container container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Telefoonnummer</h3>
         <ul class="num">
             <li>+123-456-7890</li>
             <li>+111-222-3333</li>
         </ul>
      </div>
      
      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Ons adres</h3>
         <p>
             Nomanslandstraat 45, Rotterdam.
         </p>
      </div>

      <div class="box">
         <i class="fas fa-clock"></i>
         <h3>Openingstijden</h3>
         <p>Maandag t/m Vrijdag:
          08:00 - 17:00</p>
          <p>Zaterdag & Zondag: 
          Gesloten.</p>
      </div>

      <div class="box">
          <i class="fas fa-envelope"></i>
          <h3>email adres</h3>
          <ul class="mail">
              <li><a href="mailto:shaikhanas@gmail.com">shaikhanas@gmail.com</a></li>
              <li><a href="mailto:anasbhai@gmail.com">anasbhai@gmail.com</a></li>
          </ul>
      </div>

   </div>

   <div class="credit"> &copy; copyright @ <?php echo date('Y'); ?> by <span>Tofigh Heydari & Nigel Rijnschot.</span>  </div>

</section>
<!-- footer section ends -->








<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>


</body>
</html>
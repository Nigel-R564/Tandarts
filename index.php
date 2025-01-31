<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

// Maak verbinding met de database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Controleer de verbinding
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
   $naam = mysqli_real_escape_string($conn, $_POST['naam']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $telefoonnummer = mysqli_real_escape_string($conn, $_POST['telefoonnummer']);
   $afspraaksdatum = mysqli_real_escape_string($conn, $_POST['afspraaksdatum']);

   $sql = "INSERT INTO contact_form (naam, email, telefoonnummer, afspraaksdatum) 
           VALUES ('$naam', '$email', '$telefoonnummer', '$afspraaksdatum')";

   if (mysqli_query($conn, $sql)) {
      $message = 'Afspraak succesvol gemaakt!';
   } else {
      $message = 'Fout bij het maken van een afspraak: ' . mysqli_error($conn);
   }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="nl">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tandklaar.nl</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header fixed-top">
   <div class="container">
      <div class="row align-items-center justify-content-between">
         <a href="#home" class="logo">Tand<span>klaar.</span></a>
         <nav class="nav">
            <a href="#home">Home</a>
            <a href="#over_ons">Over ons</a>
            <a href="#services">Onze services</a>
            <a href="#reviews">Reviews</a>
            <a href="#contact">Contact</a>
         </nav>
         <a href="#contact" class="link-btn">Maak een afspraak</a>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>
   </div>
</header>

<section class="contact" id="contact">
   <h1 class="heading">Maak een afspraak</h1>

   <form action="" method="post">
      <?php if(isset($message)): ?>
         <p class="message"><?php echo $message; ?></p>
      <?php endif; ?>

      <span>Naam:</span>
      <input type="text" name="naam" placeholder="Wat is uw naam?" class="box" required>

      <span>Email:</span>
      <input type="email" name="email" placeholder="Wat is uw email?" class="box" required>

      <span>Telefoonnummer:</span>
      <input type="text" name="telefoonnummer" placeholder="Wat is uw telefoonnummer?" class="box" required>

      <span>Afspraaksdatum:</span>
      <input type="date" name="afspraaksdatum" class="box" required>

      <input type="submit" value="Maak een afspraak!" name="submit" class="link-btn">
   </form>  
</section>

</body>
</html>

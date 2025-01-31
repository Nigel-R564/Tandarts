<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
//redirect to index.html
header("Location: index.html");
?>


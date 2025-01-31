<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/header.php'; ?>

<section class="dashboard">

<h1 class="heading">dashboard</h1>

<div class="box-container">

   <div class="box">
      <?php
         $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
         $select_admin->execute([$admin_id]);
         $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);
      ?>
      <h3>Welcome!</h3>
      <p><?= $fetch_admin['name']; ?></p>
      <a href="update.php" class="btn">update account</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $count_messages = $select_messages->rowCount();
      ?>
      <h3><?= $count_messages; ?></h3>
      <p>total appointments</p>
      <a href="messages.php" class="btn">view appointments</a>
   </div>

   <div class="box">
      <?php
         $count_admins = $conn->prepare("SELECT * FROM `admins`");
         $count_admins->execute();
         $total_admins = $count_admins->rowCount();
      ?>
      <h3><?= $total_admins; ?></h3>
      <p>total admins</p>
      <a href="admins.php" class="btn">view accounts</a>
   </div>

</div>

</section>












<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>
   
</body>
</html>
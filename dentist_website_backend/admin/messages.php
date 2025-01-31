<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `messages` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
      $delete_message->execute([$delete_id]);
      $success_msg[] = 'Message deleted!';
   }else{
      $warning_msg[] = 'Message already deleted!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/header.php'; ?>

<section class="messages">

<h1 class="heading">Appointments</h1>

<div class="box-container">

   <?php
      $select_message = $conn->prepare("SELECT * FROM `messages` ORDER BY date DESC");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){         
   ?>
   <div class="box">
      <p>date : <span><?= $fetch_message['date']; ?></span></p>
      <p>name : <span><?= $fetch_message['name']; ?></span></p>
      <p>email : <a href="mailto:<?= $fetch_message['email']; ?>"><?= $fetch_message['email']; ?></a></p>
      <p>number : <a href="tel:<?= $fetch_message['number']; ?>"><?= $fetch_message['number']; ?></a></p>
      <form action="" method="post">
         <input type="hidden" name="delete_id" value="<?= $fetch_message['id']; ?>">
         <input type="submit" name="delete" value="delete message" onclick="return confirm('Delete this appointment?');" class="delete-btn">
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no Appointments found!</p>';
      }
   ?>
   

</div>

</section>












<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>
   
</body>
</html>
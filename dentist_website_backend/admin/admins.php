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

   $verify_delete = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_admin = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
      $delete_admin->execute([$delete_id]);
      $success_msg[] = 'Admin deleted!';
   }else{
      $warning_msg[] = 'Admin already deleted!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/header.php'; ?>

<section class="messages">

<h1 class="heading">admin accounts</h1>

<div class="box-container">

   <?php
      $select_admins = $conn->prepare("SELECT * FROM `admins`");
      $select_admins->execute();
      if($select_admins->rowCount() > 0){
         while($fetch_admin = $select_admins->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" <?php if($fetch_admin['id'] == $admin_id){echo 'style="order:-1;"';}; ?>>
      <p>name : <span><?= $fetch_admin['name']; ?></span></p>
      <p>email : <a href="mailto:<?= $fetch_admin['email']; ?>"><?= $fetch_admin['email']; ?></span></p>
      <form action="" method="post">
         <?php if($fetch_admin['id'] == $admin_id){ ?>
            <a href="update.php" class="btn">update account</a>
         <?php }else{ ?>   
            <input type="hidden" name="delete_id" value="<?= $fetch_admin['id']; ?>">
            <input type="submit" value="delete account" name="delete" onclick="return confirm('Delete this account?');" class="delete-btn">
         <?php }; ?>   
         
      </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no admins found!</p>';
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
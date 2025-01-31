<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

$select_admin = $conn->prepare("SELECT * FROM `admins` WHERE id = ? LIMIT 1");
$select_admin->execute([$admin_id]);
$fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $admin_id]);
      $success_msg[] = 'Name updated!';
   }

  $prev_pass = $fetch_admin['password'];

  $old_pass = password_hash($_POST['old_pass'], PASSWORD_DEFAULT);
  $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

  $empty_old = password_verify('', $old_pass);

  $new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
  $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

  $empty_new = password_verify('', $new_pass);

  $c_pass = password_verify($_POST['c_pass'], $new_pass);
  $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

  if($empty_old != 1){
      $verify_old_pass = password_verify($_POST['old_pass'], $prev_pass);
      if($verify_old_pass == 1){
         if($c_pass == 1){
            if($empty_new != 1){
               $update_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
               $update_pass->execute([$new_pass, $admin_id]);
               $success_msg[] = 'Password updated!';
            }else{
               $warning_msg[] = 'Please enter new password!';
            }
         }else{
            $warning_msg[] = 'Confirm password not matched!';
         }
      }else{
         $warning_msg[] = 'Old password not matched!';
      }
  }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/header.php'; ?>

<!-- account section starts  -->

<section class="form-container">

   <form action="" method="post">
      <h3>update account!</h3>
      <input type="text" name="name" maxlength="20" placeholder="<?= $fetch_admin['name']; ?>" class="input"  oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" maxlength="20" placeholder="enter your old password" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" maxlength="20" placeholder="enter your new password" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="c_pass" maxlength="20" placeholder="confirm your new password" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" name="submit" class="btn">
   </form>

</section>

<!-- account section ends -->












<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>
   
</body>
</html>
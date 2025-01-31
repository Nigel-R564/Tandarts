<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $c_pass = $_POST['c_pass'];
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

   if(!empty($name) AND !empty($pass) AND !empty($c_pass)){
   
      $verify_name = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
      $verify_name->execute([$name]);

      if($verify_name->rowCount() > 0){
         $warning_msg[] = 'Username already taken!';
      }else{
         $verify_pass = password_verify($c_pass, $pass);

         if($verify_pass != 1){
            $warning_msg[] = 'Confirm password not matched!';
         }else{
            $insert_admin = $conn->prepare("INSERT INTO `admins`(id, name, password) VALUES(?,?,?)");
            $insert_admin->execute([$id, $name, $pass]);
            if($insert_admin){
               $select_name = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
               $select_name->execute([$name]);
               $fetch = $select_name->fetch(PDO::FETCH_ASSOC);
               setcookie('admin_id', $fetch['id'], time() + 60*60*24*30, '/');
               header('location:dashboard.php');
            }
         }
      }
   }else{
      $warning_msg[] = 'Please fill out fields!';
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/header.php'; ?>

<!-- account section starts  -->

<section class="form-container">

   <form action="" method="post">
      <h3>create new account!</h3>
      <input type="text" required name="name" maxlength="20" placeholder="enter your name" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" required name="pass" maxlength="20" placeholder="enter your password" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" required name="c_pass" maxlength="20" placeholder="confirm your password" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="reigster now" name="submit" class="btn">
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
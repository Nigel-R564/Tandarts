<?php

include '../components/connect.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   if(!empty($name) AND !empty($pass)){

      $verify_name = $conn->prepare("SELECT * FROM `admins` WHERE name = ? LIMIT 1");
      $verify_name->execute([$name]);

      if($verify_name->rowCount() > 0){
         $fetch = $verify_name->fetch(PDO::FETCH_ASSOC);
         $verfiy_pass = password_verify($pass, $fetch['password']);
         if($verfiy_pass == 1){
            setcookie('admin_id', $fetch['id'], time() + 60*60*24*30, '/');
            header('location:dashboard.php');
         }else{
            $warning_msg[] = 'Incorrect password!';
         }
      }else{
         $warning_msg[] = 'Incorrect username!';
      }

   }else{
      $warning_msg[] = 'Please fill out all!';
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<!-- account section starts  -->

<section class="form-container" style="height:100vh;">

   <form action="" method="post">
      <h3>welcome back!</h3>
      <p>default name = <span>admin</span> & password = <span>111</span></p>
      <input type="text" name="name" required maxlength="20" placeholder="enter your username" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" placeholder="enter your password" class="input" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn">
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
<?php

  include ('config.php');

  if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $email = mysqli_real_escape_string($conn,$_POST['email']);

    $pass = md5($_POST['password']);

    $cpass = md5($_POST['cpassword']);

    $user_type = ($_POST['user_type']);

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

    $result = mysqli_query($conn , $select);

    if(mysqli_num_rows($result) > 0 ){
      $error[]='user already exist !';
    }
    else
    {
      if($pass!=$cpass){
        $error[]='passwords not matched !';
      }
      else
      {
        $insert = "INSERT INTO user_form(name , email , password,user_type) VALUES ('$name' , '$email' , '$password','$user_type')";
        mysqli_query($conn,$insert);
        header('location:login_pg.php');
      } 
    }


  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <div class="form-container">
      <form action="" method="post">

      <h1>Register Now !</h1>

      <?php

      if(isset($error)){
        foreach($error as $error){
          echo  "<span class='error-msg'>".$error."</span>" ;
        }
      }
      
      ?>
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <input type="password" name="cpassword" placeholder="Confirm your password" required>
        <select name="user_type" required>
          <option value="user">user</option>
          <option value="admin">admin</option>
        </select>
       <input type="submit" value="Register" name="submit" class="form-btn">
       <a href="login_pg.php">already have an Account !</a> 
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
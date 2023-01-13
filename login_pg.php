<?php

  include ('config.php');
  session_start();
  if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $email = mysqli_real_escape_string($conn,$_POST['email']);

    $pass =mysqli_real_escape_string($conn, md5($_POST['password']));

    $cpass =mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    $user_type =mysqli_real_escape_string($conn, ($_POST['user_type']));

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

    $result = mysqli_query($conn , $select);

    if(mysqli_num_rows($result) > 0 ){

      $row = mysqli_fetch_array($result);

      if($row['user_type']=='admin'){

        $_SESSION['admin_name']=$row['name'];
        header('location:admin_pg.php');
      }
    }
    elseif($row['user_type']=='user'){

        $_SESSION['user_name']=$row['name'];
        header('location:user_pg.php');
      }
    else{
      $error[]="there is an Error in UserName OR Password !";
    }
  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <div class="form-container">
      <form action="" method="post">
      <h1>Login Now !</h1>
      <?php
        if(isset($error)){
          foreach($error as $error){
            echo  "<span class='error-msg'>".$error."</span>" ;
          }
        }
      ?>
        <input type="email" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
       <input type="submit" value="Login" name="submit" class="form-btn">
       <a href="regestration_pg.php">need to Register ?</a> 
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
<?php
  require_once 'dbcon.php';
  session_start();

  if (isset($_SESSION['user_login'])) {
    header('location:index.php');
  }

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $show_password = $_POST['password'];
    $password = md5($show_password);

    $username_chack = mysqli_query($link,"SELECT * FROM `users` WHERE `user_name`= '$username'");
    if (mysqli_num_rows($username_chack)>0) {
      $row = mysqli_fetch_assoc($username_chack);
      if ($password == $row['password']) {
        if ($row['status']=='active') {
          setcookie('username', $_POST['username'], time() + (86400 * 7), "/");
          setcookie('password', $_POST['password'], time() + (86400 * 7), "/");
          $_SESSION['user_login'] = $username;
          header("location:index.php");
        }
        else {
          $user_pending = "Waiting for admin approval";
        }
      }
      else {
        $password_wrong = "This Password Wrong";
      }
    }
    else {
      $username_not_found = "Username note match";
    }
  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Management System</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

  </head>
  <body>
    <div class="container animated shake">
      <h1 class="text-center pt-4">Welcome to School Management System</h1>
      <br>
      <div class="row">
        <div class="col-sm-4 offset-sm-4">
          <h2 class="text-center animated rotateIn">Admin Login Form</h2> <br>
          <form class="" action="" method="POST">
            <div class="pb-3">
              <input class="form-control" type="text" name="username" value="<?php if (isset($username)) {echo $username;} ?>" placeholder="username" required>

              <label for="" class="error"><?php if (isset($username_not_found)){echo $username_not_found;} ?>
            </div>
            <div class="pb-3">
              <input class="form-control" type="password" name="password" value="<?php if (isset($show_password)) {echo $show_password;} ?>" placeholder="password" required>

              <label for="" class="error"><?php if (isset($password_wrong)) {echo $password_wrong;} ?> </label>
            </div>
            <div class="row">
              <div class="col-sm-1">
                <a style="display:inline-block" href="../index.php">back</a>
              </div>
              <div class="col-sm-1 offset-sm-9 text-right">
                <input class="btn btn-primary" type="submit" name="login" value="login">
              </div>
            </div>
            <?php if (isset($user_pending)) {echo '<div class="mt-3 alert alert-warning">'.$user_pending.'</div>';} ?>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="../js/jquery-3.4.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/proper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  </body>
</html>

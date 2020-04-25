<?php
  require_once('dbcon.php');
  session_start();
  if (!isset($_SESSION['user_login'])) {
  header('location:login.php');
  exit();
  }
  $user = $_SESSION['user_login'];
  $user_data = mysqli_query($link,"SELECT * FROM `users` WHERE `user_name` = '$user'");
  $user_row = mysqli_fetch_assoc($user_data);
  $admin = $user_row['profession'];
  $user_num_rows = mysqli_num_rows($user_data);
  if ($user_num_rows==0) {
    session_destroy();
    header("location:login.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Management System</title>
    <link rel="short icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/9056fcf30b.js" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="">Welcome: <?= $user ?></a>
            </li>
            <?php if ($admin=="admin") {?>
            <li class="nav-item">
              <a class="nav-link" href="registration.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Add Users</a>
            </li>
            <?php } ?>
            <?php if ($admin=="admin") {
              $new_user_serch = mysqli_query($link,"SELECT * FROM `users` WHERE `status`='inactive'");
              $inbox = mysqli_num_rows($new_user_serch);
              ?>
            <li class="nav-item">
              <a class="nav-link" href="inbox.php"><i style="font-size:30px; margin-top: -5px " class="fab fa-facebook-messenger <?php if ($inbox>0) { echo 'text-primary'; } ?>"></i><?php if ($inbox>0) { echo '<span class="text-white bg-danger pl-1 pr-1" style="font-size:15px;margin-left:-8px;border-radius:5px;" >'.$inbox.'</span>';} ?></a>
              <!-- //<a href="#"> <img src="../images/inboxicon.png" alt=""> </a> -->
            </li>
            <?php } ?>

            <li class="nav-item">
              <a class="nav-link" href="user_profile.php"><i class="fa fa-user" aria-hidden="true"></i>Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>Logout</a>
            </li>

          </ul>
        </div>
      </nav>
    </div>

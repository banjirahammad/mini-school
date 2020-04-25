<?php
  require_once 'dbcon.php';
  session_start();
  if (isset($_POST['registration'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $photo = explode('.',$_FILES['photo']['name']);
    $photo = end($photo);
    $photo_name = $username.'.'.$photo;
    $input_error = array();
    if (empty($name)) {
      $input_error['name']="* The Name field is required.";
    }
    if (empty($username)) {
      $input_error['username']="* The Username field is required.";
    }
    if (empty($email)) {
      $input_error['email']="* The Email field is required.";
    }
    if (empty($phone)) {
      $input_error['phone']="* The Phone Number field is required.";
    }
    if (empty($password)) {
      $input_error['password']="* The Password field is required.";
    }
    if (empty($cpassword)) {
      $input_error['cpassword']="* The Confirm Password field is required.";
    }
    if (count($input_error)==0) {
      $username_chack = mysqli_query($link,"SELECT * FROM `users` WHERE `user_name`='$username'");
      if (mysqli_num_rows($username_chack)==0) {
        if (strlen($username)>5) {
          $email_chack = mysqli_query($link,"SELECT * FROM `users` WHERE `user_email`='$email'");
          if (mysqli_num_rows($email_chack)==0) {
            if (strlen($password)>=8) {
              if ($password==$cpassword) {
                $password = md5($password);
                $query = "INSERT INTO `users`(`name`, `user_email`, `phone`, `password`, `photo`, `status`, `gender`, `user_name`,`profession`) VALUES ('$name','$email','$phone','$password','$photo_name','inactive','$gender','$username','user')";
                $result = mysqli_query($link,$query);
                if ($result) {
                  $_SESSION['data_insert-success']="Data Insert Success!";
                  move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name);
                  header('location:registration.php');
                }
                else {
                    $_SESSION['data_insert-error']="Data Insert Error!";
                }
              }
              else {
                $cpassword_error = "*Confirm Password not match";
              }
            }
            else {
              $password_len_error = "* Password more than 8 character";
            }
          }
          else {
            $email_error = "* This Email already Exist";
          }
        }
        else {
          $user_name_len_error = "* User Name more than 5 character";
        }
      }
      else {
        $username_error = "* This Username already Exist";
      }
    }
  }
  $admin = "user";
  if (isset($_SESSION['user_login'])) {
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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://kit.fontawesome.com/9056fcf30b.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php if ($admin=="admin") {?>
      <div class="mb-3">
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
    <?php } ?>

    <div class="container">
      <h1 class="">Registration Form</h1>
      <?php //if (isset($_SESSION['data_insert-success'])) {echo '<div class="alert alert-success">'.$_SESSION['data_insert-success'].'</div>'; }?>
      <?php //if (isset($_SESSION['data_insert-error'])) {echo '<div class="alert alert-warning">'.$_SESSION['data_insert-warning'].'</div>'; unset($_SESSION['data_insert-error']);}?>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($name)){echo $name;}?>" placeholder="eg: Md. Banjir Ahammad">
              </div>
              <label class="error" for=""><?php if (isset($input_error['name'])) {echo ($input_error['name']);}?></label>
            </div>
            <div class="form-group row">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="username" name="username" value="<?php if(isset($username)){echo $username;}?>" placeholder="eg: banjir">
              </div>
              <label class="error" for=""><?php if (isset($input_error['username'])) {echo ($input_error['username']);}?></label>
              <label class="usesss" for=""><?php if (isset($username_error)) {echo ($username_error);}?></label>
              <label class="usesss" for=""><?php if (isset($user_name_len_error)) {echo ($user_name_len_error);}?></label>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-6">
                <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($email)){echo $email;}?>" placeholder="eg: banjir220@gmail.com">
              </div>
              <label class="error" for=""><?php if (isset($input_error['email'])) {echo ($input_error['email']);}?></label>
              <label class="usesss" for=""><?php if (isset($email_error)) {echo ($email_error);}?></label>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
              <!-- <div class="col-sm-2">
                <select class="form-control" name="country_code" id="phone">
                  <option value="+880">+880</option>
                  <option value="+990">+990</option>
                  <option value="+57">+57</option>
                  <option value="+210">+210</option>
                </select>
              </div> -->
             <!-- <label class="error" for=""><?php if (isset($input_error['country_code'])) {echo ($input_error['country_code']);}?></label> -->
              <div class="col-sm-6">
                <input type="number" class="form-control" id="phone" name="phone" value="<?php if (isset($phone)) {echo $phone;} ?>" placeholder="eg: 017******94">
              </div>
              <label class="error" for=""><?php if (isset($input_error['phone'])) {echo ($input_error['phone']);}?></label>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Gender</label>
              <div class="col-sm-6">
                <div class="col-sm-2 form-check form-check-inline">
                  <input class="form-check-input" <?php if (isset($gender)=='male') echo "checked"; ?> type="radio" name="gender" id="male" value="male" required>
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="col-sm-2 form-check form-check-inline">
                  <input class="form-check-input" <?php if (isset($gender)=='female') echo "checked"; ?> type="radio" name="gender" id="female" value="female" required>
                  <label class="form-check-label" for="female">Female</label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" value="<?php if (isset($password)) {echo $password;} ?>" name="password" placeholder="eg: Bdjs-56Wrkd-dd" id="password">
              </div>
              <label class="usesss" for=""><?php if (isset($password_len_error)) {echo ($password_len_error);}?></label>
              <label class="error" for=""><?php if (isset($input_error['password'])) {echo ($input_error['password']);}?></label>
            </div>
            <div class="form-group row">
              <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
              <div class="col-sm-6">
                <input type="password" class="form-control" name="cpassword" id="cpassword" value="<?php if (isset($cpassword)) {echo $cpassword;} ?>" placeholder="eg: Bdjs-56Wrkd-dd">
              </div>
              <label class="error" for=""><?php if (isset($input_error['cpassword'])) {echo ($input_error['cpassword']);}?></label>
              <label class="usesss" for=""><?php if (isset($cpassword_error)) {echo ($cpassword_error);}?></label>
            </div>
            <div class="form-group row">
              <label for="photo" class="col-sm-2 col-form-label">Photo</label>
              <div class="col-sm-6">
                <input type="file" name="photo" class="" id="photo" required>
              </div>
            </div>
            <div class="col-sm-4 offset-sm-2">
              <input type="submit" class="btn btn-primary" name="registration" value="registration">
            </div>
          </form>
        </div>
      </div><br>
      <?php $time = date_default_timezone_get(); ?>
      <?php if ($admin=="admin"){ ?>
          <p>back to <a href="index.php">dashbord</a> </p>
          <!-- <p>if you have an account? then please <a href="login.php">login</a> </p> -->
        <?php }else{?>
          <p>if you have an account? then please <a href="login.php">login</a> </p>
      <?php } ?>

      <hr>
      <footer>Copyright @<?= date('M/Y');?> All Right Reserved <p id="date"></p></footer>

    </div>

    <script type="text/javascript" src="../js/jquery-3.4.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/proper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  </body>
</html>

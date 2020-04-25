<?php
  require_once('dbcon.php');
  session_start();
  if (!isset($_SESSION['user_login'])) {
  header('location:login.php');
  exit();
  }
  $user = $_SESSION['user_login'];
 ?>
 <?php
 if (isset($_POST['add-student'])) {
   $name = $_POST['name'];
   $roll = $_POST['roll'];
   $class = $_POST['class'];
   $address = $_POST['address'];
   $contact = $_POST['contact'];
   $photo = explode('.',$_FILES['photo']['name']);
   $photo_ext = end($photo);
   $photo_name = $name.'('.$roll.').'.$photo_ext;
   $query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `address`, `contact_num`, `photo`) VALUES ('$name','$roll','$class','$address','$contact','$photo_name')";

   $result = mysqli_query($link,$query);
   if ($result) {
     move_uploaded_file($_FILES['photo']['tmp_name'],'student_images/'.$photo_name);
     $sucess = "Add Student Sucessfull";
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
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/dataTables.bootsrap4.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

  </head>
  <body>
    <div class="">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SMS</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Welcome: <?= $user ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="registration.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Add Users</a>
            </li>
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


    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" href="index.php" > <i class="fa fa-dashboard"></i> &nbsp; Dashboard</a>
            <a class="list-group-item list-group-item-action active" href="#add-student"> <i class="fa fa-user-plus"></i> &nbsp; Add Student</a>
            <a class="list-group-item list-group-item-action" href="all_student.php"> <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action"href="all_users.php"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="add-student" role="tabpanel" aria-labelledby="list-profile-list">
              <h2 class="text-primary"><i class="fa fa-user-plus"></i> Add Students <small class="text-dark">Add new students</small> </h2>
              <div class="alert alert-dark" role="alert">
                <a href="index.php" class="text-primary"> <i class="fa fa-dashboard"></i> Dashboard</a> &nbsp;
                <i class="fa fa-user-plus"></i> Add New Students
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <form class="" action="#" method="post" enctype="multipart/form-data">
                    <?php if (isset($sucess)){
                      echo '<div class="alert alert-success mt-3 mb-3 text-center" role="alert">'.$sucess.'</div>';
                      }
                    ?>
                    <div class="form-group">
                      <label for="name">Student Name</label>
                      <input id="name" class="form-control" type="text" name="name" value="" placeholder="type Your Name" required>
                    </div>
                    <div class="form-group">
                      <label for="roll">Student Roll</label>
                      <input id="roll" class="form-control" type="number" name="roll" value="" placeholder="type Your Roll" required>
                    </div>
                    <div class="form-group">
                      <label for="class">Class</label>
                      <select id="class" name="class" class="form-control" required>
                        <option value="">---select class---</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                        <option value="5th">5th</option>
                        <option value="6th">6th</option>
                        <option value="7th">7th</option>
                        <option value="8th">8th</option>
                        <option value="9th">9th</option>
                        <option value="10th">10th</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" id="address" rows="3" required class="form-control" placeholder="Your Address"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="contact">Contact Number</label>
                      <input type="number" id="contact" class="form-control" pattern="[7-9]{1}[0-9]{9}" name="contact" placeholder="01*********" value="" required>
                    </div>
                    <div class="form-group">
                      <label for="photo">Photo</label>
                      <input type="file" name="photo" id="photo" value="" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary pull-right" name="add-student" id="" value="Add Student">
                    </div>
                  </form>
                </div>
              </div>









            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer-area">
      <p class="container-fluid">copyright @<?php echo date('Y');?>  all right Reserved <a target="_blank" href="https://www.banjir-ahammad.com">Md Banjir Ahammad</a> </p>
    </footer>






    <script type="text/javascript" src="../js/jquery-3.4.1.slim.min.js"></script>
    <script type="text/javascript" src="../js/proper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
  </body>
</html>

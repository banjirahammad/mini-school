<?php
  require_once('admin/dbcon.php');
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>School Management System</title>
    <link rel="short icon" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

  </head>
  <body>
    <div class="container">
      <div class="login text-right">
        <a href="admin/login.php" class="btn btn-primary">Login Admin</a> <br>
        <h1 class="text-center">Welcome to School Management System</h1>
      </div>
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
          <form class="ddl" action="index.php" method="post">
            <table class="table table-bordered">
              <tr>
                <td class="text-center"colspan="2"> <label><h3>Student Information</h3></label></td>
              </tr>
              <tr>
                <td> <label for="choice">Choose Class</label> </td>
                <td>
                  <select class="form-control" id="choice" name="class" required>
                    <option value="">--Select--</option>
                    <option value="6th">Six</option>
                    <option value="7th">Seven</option>
                    <option value="8th">Eight</option>
                    <option value="9th">Nine</option>
                    <option value="10th">Ten</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td> <label for="roll">Roll No</label> </td>
                <td> <input class="form-control" id="roll" pattern="[0-9]{6}" type="num" name="roll" value="" required> </td>
              </tr>
              <tr>
                <td colspan="2" class="text-center"> <input class="btn btn-outline-dark" type="submit" name="show_info" value="Show Info"> </td>
              </tr>
            </table>
          </form>
        </div>

      </div>
      <br>
      <?php if (isset($_POST['show_info'])){
        $roll = $_POST['roll'];
        $class = $_POST['class'];
        $result = mysqli_query($link,"SELECT * FROM `student_info` WHERE `class` = '$class' and `roll` = '$roll'");
        if (mysqli_num_rows($result)==1) {
          $row = mysqli_fetch_assoc($result);

      ?>
      <div class="row">
        <div class="col-sm-6 offset-sm-3">
          <table class=" data-find table table-bordered">
            <tr>
              <td>Name</td>
              <td><?= $row['name'] ?></td>
              <td class="text-center center" rowspan="5">
                <img width="150px" height="175px" src="admin/student_images/<?= $row['photo'] ?>" alt="">
              </td>
            </tr>
            <tr>
              <td>Roll</td>
              <td><?= $row['roll'] ?></td>

            </tr>
            <tr>
              <td>Class</td>
              <td><?= $row['class'] ?></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><?= $row['address'] ?></td>
            </tr>
            <tr>
              <td>Contact Number</td>
              <td><?= $row['contact_num'] ?></td>
            </tr>

          </table>
        </div>
      </div>
    <?php }
    else {?>
      <script type="text/javascript">
        alert("Data Not Found");
      </script>
    <?php }
    ?>
    <?php } ?>
    </div>



    <script type="text/javascript" src="js/jquery-3.4.1.slim.min.js"></script>
    <script type="text/javascript" src="js/proper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>

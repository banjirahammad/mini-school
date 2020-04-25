    <?php require_once('header.php'); ?>
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
    <?php if (isset($sucess)){
      echo '<div class="alert alert-success mt-3 mb-3 text-center" role="alert">'.$sucess.'</div>';
      }
    ?>

    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#dashboard" role="tab" aria-controls="home"> <i class="fa fa-dashboard"></i> &nbsp; Dashboard</a>
            <a class="list-group-item list-group-item-action" href="add_student.php"> <i class="fa fa-user-plus"></i> &nbsp; Add Student</a>
            <a class="list-group-item list-group-item-action" href="all_student.php" > <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action" href="all_users.php"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="list-home-list">
              <h2 class="text-primary"><i class="fa fa-dashboard"></i> Dashboard <small class="text-dark">Statick View</small> </h2>
              <div class="alert alert-dark" role="alert">
                <i class="fa fa-dashboard"></i> Dashboard
              </div>
              <div class="row">
                <?php
                  $users = mysqli_query($link,"SELECT * FROM `users`");
                  $total_users = mysqli_num_rows($users);
                  $students = mysqli_query($link,"SELECT * FROM student_info");
                  $total_students = mysqli_num_rows($students);
                ?>
                <div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading bg-primary text-white">
                      <div class="row p-3">
                        <div class="col-3">
                          <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-9">
                          <div class="text-right" style="font-size:40px"><?= $total_students ?></div>
                          <div class="clearfix"></div>
                          <div class="text-right">All Students</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer bg-light p-3">
                      <a href="all_student.php">
                        <span class="text-left"> All students</span>
                        <span class="pull-right"> <i class="fa fa-arrow-circle-o-right"></i> </span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading bg-primary text-white">
                      <div class="row p-3">
                        <div class="col-3">
                          <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-9">
                          <div class="text-right" style="font-size:40px"><?= $total_users  ?></div>
                          <div class="clearfix"></div>
                          <div class="text-right">All Users</div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer bg-light p-3">
                      <a href="all_users.php">
                        <span class="text-left"> All Users</span>
                        <span class="pull-right"> <i class="fa fa-arrow-circle-o-right"></i> </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <h3>New Students</h3>
              <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Roll</th>
                      <th>Class</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Photo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $db_sinfo = mysqli_query($link,"SELECT * FROM `student_info`");
                      while ($row = mysqli_fetch_assoc($db_sinfo)) {?>
                      <!-- echo '<pre>';
                      print_r ($row);
                      echo '</pre>'; -->
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo ucwords($row['name']); ?></td>
                        <td><?php echo $row['roll']; ?></td>
                        <td><?php echo $row['class']; ?></td>
                        <td><?php echo ucwords($row['address']); ?></td>
                        <td><?php echo $row['contact_num']; ?></td>
                        <td><img style="width:40px;height:50px;" src="student_images/<?php echo $row['photo'];?>" alt=""></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Roll</th>
                      <th>Class</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Photo</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('footer.php'); ?>

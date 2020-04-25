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
      $roll_serch = mysqli_query($link,"SELECT * FROM `student_info` WHERE `roll`='$roll'");
      $roll_row = mysqli_fetch_assoc($roll_serch);
      $roll_chack = $roll_row['roll'];
      $class_chack = $roll_row['class'];

      if ($roll_chack==$roll and $class_chack==$class) {
        $roll_error = "This classes roll are already Exist";
      }
      else {
        $query = "INSERT INTO `student_info`(`name`, `roll`, `class`, `address`, `contact_num`, `photo`) VALUES ('$name','$roll','$class','$address','$contact','$photo_name')";

        $result = mysqli_query($link,$query);
        if ($result) {
          move_uploaded_file($_FILES['photo']['tmp_name'],'student_images/'.$photo_name);
          $sucess = "Add Student Sucessfull";
        }
      }
    }
   ?>

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
                <div class="col-sm-12">
                  <form class="" action="#" method="post" enctype="multipart/form-data">
                    <?php if (isset($sucess)){
                      echo '<div class="alert alert-success mt-3 mb-3 text-center" role="alert">'.$sucess.'</div>';
                      }
                    ?>
                    <?php if (isset($roll_error)){
                      echo '<div class="alert alert-danger mt-3 mb-3 text-center" role="alert">'.$roll_error.'</div>';
                      }
                    ?>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="name">Student Name</label>
                        <input id="name" class="form-control" type="text" name="name" value="<?php if(!isset($sucess) and isset($name)){echo $name;}?>" placeholder="eg: Banjir Ahammad" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="roll">Student Roll</label>
                        <input id="roll" class="form-control" type="number" name="roll" value="<?php if(!isset($sucess) and isset($roll)){echo $roll;}?>" placeholder="eg: 201201" required>
                      </div>
                      <label class="usesss mt-4 pt-2" for=""><?php if (isset($roll_error)) {echo '<span style="color:red;">*</span>';}?></label>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="class">Class</label>
                        <select id="class" name="class" class="form-control" required>
                          <option value="">---select class---</option>
                          <option <?php if(!isset($sucess) and isset($class)=='1st') echo 'selected';?> value="1st">1st</option>
                          <option <?php if(!isset($sucess) and isset($class)=='2nd') echo 'selected'; ?> value="2nd">2nd</option>
                          <option <?php if(!isset($sucess) and isset($class)=='3rd') echo 'selected'; ?> value="3rd">3rd</option>
                          <option <?php if(!isset($sucess) and isset($class)=='4th') echo 'selected'; ?> value="4th">4th</option>
                          <option <?php if(!isset($sucess) and isset($class)=='5th') echo 'selected'; ?> value="5th">5th</option>
                          <option <?php if(!isset($sucess) and isset($class)=='6th') echo 'selected'; ?> value="6th">6th</option>
                          <option <?php if(!isset($sucess) and isset($class)=='7th') echo 'selected'; ?> value="7th">7th</option>
                          <option <?php if(!isset($sucess) and isset($class)=='8th') echo 'selected'; ?> value="8th">8th</option>
                          <option <?php if(!isset($sucess) and isset($class)=='9th') echo ' selected'; ?> value="9th">9th</option>
                          <option <?php if(!isset($sucess) and isset($class)=='10th') echo 'selected'; ?> value="10th">10th</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" rows="3" required class="form-control" placeholder="eg: Mirpur, Dhaka"><?php if(!isset($sucess) and isset($address)){echo $address;}?></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="contact">Contact Number</label>
                        <input type="number" id="contact" class="form-control" pattern="[7-9]{1}[0-9]{9}" name="contact" placeholder="eg: 0179794....." value="<?php if(!isset($sucess) and isset($contact)){echo $contact;}?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo" value="" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <input type="submit" class="btn btn-primary pull-right" name="add-student" id="" value="Add Student">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('footer.php'); ?>

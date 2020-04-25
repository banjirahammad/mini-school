    <?php require_once('header.php'); ?>
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" href="index.php"> <i class="fa fa-dashboard"></i> &nbsp; Dashboard</a>
            <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="add_student.php" role="tab" aria-controls="profile"> <i class="fa fa-user-plus"  active></i> &nbsp; Update Student</a>
            <a class="list-group-item list-group-item-action" href="all_student.php" > <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action" href="all_users.php"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="add-student" role="tabpanel" aria-labelledby="list-profile-list">
              <h2 class="text-primary"><i class="fa fa-pencil-square-o"></i> Update Students <small class="text-dark">update students</small> </h2>
              <div class="alert alert-dark" role="alert">
                <a href="index.php" class="text-primary"> <i class="fa fa-dashboard"></i> Dashboard</a> &nbsp;
                <a href="all_student.php" class="text-primary"><i class="fa fa-users"></i> All Students</a> &nbsp;
                <i class="fa fa-pencil-square-o"></i> Update Students
              </div>
              <?php
              $id = base64_decode($_GET['id']);
              $bd_data = mysqli_query($link,"SELECT * FROM `student_info` WHERE `id`='$id'");
              $db_row = mysqli_fetch_assoc($bd_data);
              ?>
              <?php
              if (isset($_POST['update-student'])) {
                $name = $_POST['name'];
                $roll = $_POST['roll'];
                $class = $_POST['class'];
                $address = $_POST['address'];
                $contact = $_POST['contact'];
                $query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`class`='$class',`address`='$address',`contact_num`='$contact' WHERE `id`='$id'";
                $result = mysqli_query($link,$query);
                if ($result) {
                  header('location:all_student.php');
                }
              }
             ?>
              <div class="row">
                <div class="col-sm-6">
                  <form class="" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Student Name</label>
                      <input id="name" class="form-control" type="text" name="name" value="<?= $db_row['name'];  ?>" placeholder="type Your Name" required>
                    </div>
                    <div class="form-group">
                      <label for="roll">Student Roll</label>
                      <input id="roll" class="form-control" type="number" name="roll" value="<?= $db_row['roll'];  ?>" placeholder="type Your Roll" required>
                    </div>
                    <div class="form-group">
                      <label for="class">Class</label>
                      <select id="class" name="class" class="form-control" required>
                        <option value="">---select class---</option>
                        <option <?php echo $db_row['class']=='1st' ? 'selected' : ''; ?> value="1st">1st</option>
                        <option <?php echo $db_row['class']=='2nd' ? 'selected' : ''; ?> value="2nd">2nd</option>
                        <option <?php echo $db_row['class']=='3rd' ? 'selected' : ''; ?> value="3rd">3rd</option>
                        <option <?php echo $db_row['class']=='4th' ? 'selected' : ''; ?> value="4th">4th</option>
                        <option <?php echo $db_row['class']=='5th' ? 'selected' : ''; ?> value="5th">5th</option>
                        <option <?php echo $db_row['class']=='6th' ? 'selected' : ''; ?> value="6th">6th</option>
                        <option <?php echo $db_row['class']=='7th' ? 'selected' : ''; ?> value="7th">7th</option>
                        <option <?php echo $db_row['class']=='8th' ? 'selected' : ''; ?> value="8th">8th</option>
                        <option <?php echo $db_row['class']=='9th' ? ' selected' : ''; ?> value="9th">9th</option>
                        <option <?php echo $db_row['class']=='10th' ? ' selected' : ''; ?> value="10th">10th</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" id="address" rows="3" required class="form-control" placeholder="Your Address"><?= $db_row['address'];  ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="contact">Contact Number</label>
                      <input type="number" id="contact" class="form-control"  name="contact" placeholder="01*********" value="<?= $db_row['contact_num']?>" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary pull-right" name="update-student" id="" value="Update Student">
                    </div>
                  </form>
                </div>

                <?php
                if (isset($_POST['std_pho_update'])) {
                  $name = $db_row['name'];
                  $roll= $db_row['roll'];
                  $photo = explode('.',$_FILES['photo']['name']);
                  $photo_ext = end($photo);
                  $photo_name = $name.'('.$roll.').'.$photo_ext;
                  $query = "UPDATE `student_info` SET `photo`='$photo_name' WHERE `id`='$id'";
                  $result = mysqli_query($link,$query);
                  if ($result) {
                    move_uploaded_file($_FILES['photo']['tmp_name'],'student_images/'.$photo_name);
                  }
                }
               ?>
                <div class="col-sm-4 pl-5">
                  <h4 class="mb-3">Photo</h4>
                  <img class="img-thumbnail text-center mb-4" style="display: block;margin-left: auto;margin-right:auto;" width="200px" src="student_images/<?= $db_row['photo'] ?>" alt="" />
                  <form class="" action="#" method="post" enctype="multipart/form-data">
                    <label for="photo">Change Student Photo</label> <br>
                    <input type="file" class="mb-2" id="photo" name="photo" value="" required/> <br>
                    <input type="submit" class="btn btn-info btn-sm mt-2" name="std_pho_update" value="Upload Photo">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('footer.php'); ?>

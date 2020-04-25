    <?php require_once('header.php'); ?>
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="index.php" role="tab" aria-controls="home"> <i class="fa fa-dashboard"></i> &nbsp; Dashboard</a>
            <a class="list-group-item list-group-item-action" href="add_student.php"> <i class="fa fa-user-plus"></i> &nbsp; Add Student</a>
            <a class="list-group-item list-group-item-action" href="all_student.php" > <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action" href="all_users.php"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="list-home-list">
              <h2 class="text-primary"><i class="fa fa-user"></i> Profile <small class="text-dark">Profile</small> </h2>
              <div class="alert alert-dark" role="alert">
                <a href="index.php" class="text-primary"> <i class="fa fa-dashboard"></i> Dashboard</a> &nbsp;
                <i class="fa fa-users"></i> profile
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <table class="table table-bordered">
                    <tr>
                      <td>User Id</td>
                      <td><?= $user_row['id'] ?></td>
                    </tr>
                    <tr>
                      <td>Name</td>
                      <td><?= ucwords($user_row['name']) ?></td>
                    </tr>
                    <tr>
                      <td>Username</td>
                      <td><?= $user_row['user_name'] ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td><?= $user_row['user_email'] ?></td>
                    </tr>
                    </tr>
                    <tr>
                      <td>Phone Number</td>
                      <td><?= $user_row['phone'] ?></td>
                    </tr>
                    <tr>
                      <td>Gender</td>
                      <td><?= ucwords($user_row['gender']) ?></td>
                    </tr>
                    <?php if ($admin=="admin") {?>
                    <tr>
                      <td>Profession</td>
                      <td><?= ucwords($admin) ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td>Statas</td>
                      <td><?= ucwords($user_row['status']) ?></td>
                    </tr>
                    <tr>
                      <td>Singup Date</td>
                      <td><?= $user_row['datetime'] ?></td>
                    </tr>
                  </table>
                  <a href="#" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Edit Profile</a>

                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Your Information</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <?php


                                if (isset($_POST['save'])) {
                                  $id = $user_row['id'];
                                  $name = $_POST['name'];
                                  $email = $_POST['email'];
                                  $phone = $_POST['phone'];
                                  $gender = $_POST['gender'];
                                  $result = mysqli_query($link,"UPDATE users SET name='$name',user_email='$email',phone='$phone',gender='$gender' WHERE id=$id ");
                                }
                              ?>
                              <form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
                                <div class="form-group row">
                                  <label for="name" class="col-sm-2 col-form-label">Name</label>
                                  <div class="col-sm-6">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $user_row['name'] ?>" placeholder="eg: Md. Banjir Ahammad" required>
                                  </div>
                                  <label class="error" for=""><?php if (isset($input_error['name'])) {echo ($input_error['name']);}?></label>
                                </div>
                                <div class="form-group row">
                                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                                  <div class="col-sm-6">
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user_row['user_email'] ?>" placeholder="eg: banjir220@gmail.com" required>
                                  </div>
                                  <label class="error" for=""><?php if (isset($input_error['user_email'])) {echo ($input_error['user_email']);}?></label>
                                  <label class="usesss" for=""><?php if (isset($email_error)) {echo ($email_error);}?></label>
                                </div>
                                <div class="form-group row">
                                  <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                  <div class="col-sm-6">
                                    <input type="number" class="form-control mt-3" id="phone" name="phone" value="<?= $user_row['phone'] ?>" placeholder="eg: 017******94" required>
                                  </div>
                                  <label class="error" for=""><?php if (isset($input_error['phone'])) {echo ($input_error['phone']);}?></label>
                                </div>
                                <div class="form-group row">
                                  <label for="" class="col-sm-2 col-form-label">Gender</label>
                                  <div class="col-sm-6">
                                    <div class="col-sm-3 form-check form-check-inline">
                                      <input <?php echo $user_row['gender']=='male' ? 'checked' : ''; ?> class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                      <label class="form-check-label" for="male">Male</label>&nbsp;
                                    </div>
                                    <div class="col-sm-3 form-check form-check-inline">
                                      <input <?= $user_row['gender']=='female' ? 'checked' : ''; ?> class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                                      <label class="form-check-label" for="female">Female</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- <hr style="margin-left:-17px; margin-right: -17px;">
                            <div class="">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <input type="submit" class="btn btn-primary" name="save" value="save"></button>
                            </div> -->

                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="save" value="save"></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <a href="#">
                    <img width="230px" height="100px" src="images/<?= $user_row['photo']; ?>" alt="..." class="img-thumbnail">
                  </a>
                  <br><br>
                  <?php
                    if (isset($_POST['upload'])) {
                      $user_id = $user_row['id'];
                      $photo = explode('.',$_FILES['photo']['name']);
                      $photo = end($photo);
                      $photo_name = $user.'.'.$photo;
                      $update = mysqli_query($link,"UPDATE users SET photo='$photo_name' WHERE id = $user_id");
                      if ($update) {
                        move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name);
                      }
                    }
                   ?>
                  <form class="" enctype="multipart/form-data" method="POST" >
                    <label for="file">Profile Picture</label> <br>
                    <input type="file" id="file" name="photo" value="" required/> <br>
                    <input type="submit" class="btn btn-info btn-sm mt-2" name="upload" value="Upload">

                  </form>


                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('footer.php'); ?>

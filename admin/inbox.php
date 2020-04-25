    <?php require_once('header.php'); ?>
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="index.php" role="tab" aria-controls="home"> <i class="fab fa-facebook-messenger "></i> &nbsp; Inbox</a>
            <a class="list-group-item list-group-item-action" href="add_student.php"> <i class="fa fa-user-plus"></i> &nbsp; Add Student</a>
            <a class="list-group-item list-group-item-action" href="all_student.php" > <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action" href="all_users.php"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="list-home-list">
              <h2 class="text-primary"><i class="fab fa-facebook-messenger"></i> Inbox <small class="text-dark">Message</small> </h2>
              <div class="alert alert-dark" role="alert">
                <a href="index.php" class="text-primary"> <i class="fa fa-dashboard"></i> Dashboard</a> &nbsp;
                <?php if ($inbox==0) echo $inbox; else echo '<span style="color:red;">'.$inbox.'</span>';?> Message
              </div>

              <hr>

              <?php if (isset($_GET['accept'])) {
                $id = base64_decode($_GET['accept']);
                $accept = mysqli_query($link,"UPDATE `users` SET `status`='active' WHERE `id` = $id;");
                if ($accept) {
                  header("location:inbox.php");
                  exit();
                }
              }?>
              <?php if (isset($_GET['remove'])) {
                $id = base64_decode($_GET['remove']);
                $remove = mysqli_query($link,"DELETE FROM `users` WHERE `id` = $id;");
                if ($remove) {
                  header("location:inbox.php");
                  exit();
                }
              }?>

              <?php while ($new_message = mysqli_fetch_assoc($new_user_serch)) {?>
              <div class="alert alert-dark pt-4 pb-4" role="alert">
                <h2><?= ucwords($new_message['name']) ?> want to be a user in your software</h2><br>
                <div class="row">
                  <div class="col-sm-6">
                    <table class="table table-bordered">
                      <!-- <tr>
                        <td>User Id</td>
                        <td><?php //echo $new_message['id']; ?></td>
                      </tr> -->
                      <tr>
                        <td>Name</td>
                        <td><?= ucwords($new_message['name']) ?></td>
                      </tr>
                      <tr>
                        <td>Username</td>
                        <td><?= $new_message['user_name'] ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?= $new_message['user_email'] ?></td>
                      </tr>
                      </tr>
                      <tr>
                        <td>Phone Number</td>
                        <td><?= $new_message['phone'] ?></td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td><?= ucwords($new_message['gender']) ?></td>
                      </tr>
                      <tr>
                        <td>Profession</td>
                        <td><?= ucwords($new_message['profession']) ?></td>
                      </tr>
                      <tr>
                        <td>Statas</td>
                        <td><?= ucwords($new_message['status']) ?></td>
                      </tr>
                      <tr>
                        <td>Singup Date</td>
                        <td><?= $new_message['datetime'] ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm-6">
                    <a href="#">
                      <img width="230px" height="100px" src="images/<?= $new_message['photo']; ?>" alt="..." class="img-thumbnail">
                    </a>
                  </div>
                  <div class="col-sm-12 pt-3">
                    <a href="?accept=<?php echo base64_encode($new_message['id']); ?>" class="btn btn-info">Accept</a>
                    <a href="?remove=<?php echo base64_encode($new_message['id']); ?>" class="btn btn-danger pull-right">Remove</a>
                  </div>
                </div>
              </div>
              <hr>
            <?php } ?>
            <?php if($inbox==0){?>
            <div class="alert alert-dark" style="margin-bottom: 500px;" role="alert">
              <p>NO Message</p>
            </div>

          <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once('footer.php'); ?>

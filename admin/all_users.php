    <?php require_once('header.php'); ?>
    <?php
    if (isset($_GET['delete'])) {
      $id = base64_decode($_GET['delete']);
      $delete = mysqli_query($link,"DELETE FROM `users` WHERE `id`='$id' LIMIT 1");
      if ($delete) {
        $msg = "Congratulation You Destroy a row";
      }
      else{
        print_r(mysqli_error_list($link)) ;
      }
    }
    ?>
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" href="index.php"> <i class="fa fa-dashboard"></i> &nbsp; Dashboard</a>
            <a class="list-group-item list-group-item-action" href="add_student.php"> <i class="fa fa-user-plus"></i> &nbsp; Add Student</a>
            <a class="list-group-item list-group-item-action" href="all_student.php"> <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action active" id="list-settings-list" data-toggle="list" href="#all-users" role="tab" aria-controls="settings"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="all-users" role="tabpanel" aria-labelledby="list-settings-list">
              <h2 class="text-primary"><i class="fa fa-users"></i> All Users <small class="text-dark">all users</small> </h2>
              <div class="alert alert-dark" role="alert">
                <a href="index.php" class="text-primary"> <i class="fa fa-dashboard"></i> Dashboard</a> &nbsp;
                <i class="fa fa-users"></i> All Users
              </div>
              <div class="table-responsive">
                <table id="data" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>Si</th>
                      <th>Name</th>
                      <th>User Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Gender</th>
                      <th>Photo</th>
                      <?php if ($admin=="admin") {?>
                        <th>Action</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $db_sinfo = mysqli_query($link,"SELECT * FROM `users`");
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($db_sinfo)) { if ($row['status']=='active') {?>
                      <!-- echo '<pre>';
                      print_r ($row);
                      echo '</pre>'; -->
                      <?php if ($row['profession']=="admin" and $row['user_name']==$user) {
                        continue;
                      }
                      else{?>
                        <tr>
                          <td><?php echo $i; $i++; ?></td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['user_name']; if ($row['profession']=="admin") { echo '(<b class="text-primary">'.$row['profession'].'</b>)';} ?></td>
                          <td><?php echo $row['user_email']; ?></td>
                          <td><?php echo $row['phone']; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><img style="width:40px;height:50px;" src="images/<?php echo $row['photo'];?>" alt=""> </td>
                          <?php if ($admin=="admin") {?>
                            <td>
                              <a href="?delete=<?php echo base64_encode($row['id']); ?>" onclick="return confirm('Are you sure? you want to delete this user.')" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i></a>
                            </td>
                          <?php } } ?>
                        </tr>

                      <?php } ?>

                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <tr>
                        <th>Si</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Photo</th>
                        <?php if ($admin=="admin") {?>
                          <th>Action</th>
                        <?php } ?>
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

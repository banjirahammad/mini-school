    <?php require_once('header.php'); ?>
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="col-sm-3">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action" href="index.php"> <i class="fa fa-dashboard"></i> &nbsp; Dashboard</a>
            <a class="list-group-item list-group-item-action" href="add_student.php"> <i class="fa fa-user-plus"></i> &nbsp; Add Student</a>
            <a class="list-group-item list-group-item-action active" id="list-messages-list" data-toggle="list" href="#all-student" role="tab" aria-controls="messages"> <i class="fa fa-users"></i> &nbsp; all Students</a>
            <a class="list-group-item list-group-item-action"href="all_users.php"> <i class="fa fa-users"></i> &nbsp; All Users</a>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="all-student" role="tabpanel" aria-labelledby="list-messages-list">
              <h2 class="text-primary"><i class="fa fa-users"></i> All Students <small class="text-dark">all students</small> </h2>
              <div class="alert alert-dark" role="alert">
                <a href="index.php" class="text-primary"> <i class="fa fa-dashboard"></i> Dashboard</a> &nbsp;
                <i class="fa fa-users"></i> All Students
              </div>
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
                      <th>Edit</th>
                      <th>Delete</th>
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
                        <td>
                          <a href="update_student.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-xs btn-warning"> <i class="fa fa-pencil "></i></a>
                        </td>
                        <td>
                          <a href="delete_student.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i></a>

                        </td>
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
                      <th>Edit</th>
                      <th>Delete</th>
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

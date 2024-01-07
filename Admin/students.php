<title>LAKASA | Student records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Student</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Student records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header p-2">
              <a href="students_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New Student</a>
              <div class="card-tools mr-1 mt-3">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <a class="btn btn-success float-sm-right mr-2 btn-sm" href="students_print.php"><i class="fa-solid fa-print"></i> Print</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>PHOTO</th>
                    <th>NAME</th>
                    <th>DEPARTMENT</th>
                    <th>YR LEVL</th>
                    <th>EMAIL/CONTACT</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'Student' ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td>
                      <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                        <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                      </a href="">
                    </td>
                    <td><?php echo $row['firstname'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                    <td><?php echo $row['dept']; ?></td>
                    <td><?php echo $row['yr_lvl']; ?></td>
                    <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['date_registered'])); ?></td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="students_view.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                      <a class="btn btn-info btn-sm" href="students_mgmt.php?page=<?php echo $row['user_Id']; ?>" <?php if($user_type !== 'Admin') { echo 'style="pointer-events: none;opacity: .7;"'; } ?>><i class="fas fa-pencil-alt"></i> Edit</a>
                      <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['user_Id']; ?>" <?php if($user_type !== 'Admin') { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>
                  <?php include 'students_delete.php'; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>
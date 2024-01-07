<title>LAKASA | Borrowed books</title>

<?php 
    require_once 'header.php'; 
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Borrowed Books</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Borrowed Books records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <div class="card-header p-2">
              <div class="card-tools mr-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>DATE AND TIME LOGGED IN</th>
                    <th>DATE AND TIME LOGGED OUT</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = mysqli_query($conn, "SELECT * FROM log_history JOIN users ON log_history.user_Id=users.user_Id WHERE log_history.user_Id=$id ORDER BY log_Id DESC");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo date("F d, Y h:i A",strtotime($row['login_time'])); ?></td>
                    <td><?php if($row['logout_time'] != '') { echo date("F d, Y h:i A",strtotime($row['logout_time'])); } else { echo 'On-going session'; } ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
  
<?php require_once 'footer.php'; ?>



<title>LAKASA | Category records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Category records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
          <?php
          if(isset($_GET['cat_ID'])) {
          $cat_ID = $_GET['cat_ID'];
          $sql2 = mysqli_query($conn, "SELECT * FROM category_can_be_deleted WHERE cat_ID='$cat_ID'");
          $row2 = mysqli_fetch_array($sql2);
          ?>
          <form action="process_update.php" method="POST">
            <div class="card">
              <div class="card-header p-2 d-flex">
                <h5 class="ml-3">Update Category</h5>
                <div class="card-tools d-flex ml-auto">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <span class="text-dark"><b>Call Number</b></span>
                  <input type="hidden" class="form-control"  placeholder="Call Number" name="cat_ID" value="<?= $row2['cat_ID'] ?>" required>
                  <input type="text" class="form-control"  placeholder="Call Number" name="call_num" value="<?= $row2['call_num'] ?>" required>
                </div>
                <div class="form-group">
                  <span class="text-dark"><b>Category name</b></span>
                  <textarea class="form-control" placeholder="Category name"id="" cols="30" name="cat_name" rows="2" required><?= $row2['cat_name'] ?></textarea>
                </div>
                <div class="form-group">
                  <span class="text-dark"><b>Description</b></span>
                  <textarea class="form-control" placeholder="Category description"id="" cols="30" name="cat_desc" rows="3" required><?= $row2['cat_name'] ?></textarea>
                </div>
              </div>
              <div class="card-footer">
                <a type="button" href="category.php" class="btn btn-warning btn-sm float-right m-1"><i class="fas fa-trash-alt"></i> Clear</a>
                <button type="submit" class="btn btn-primary btn-sm float-right m-1" name="update_category">
                <i class="fas fa-pencil-alt"></i> Update
                </button>
              </div>
            </div>
          </form>
          <?php
          } else {
          ?>
          <form action="process_save.php" method="POST">
            <div class="card">
              <div class="card-header p-2 d-flex">
                <h5 class="ml-3">New Category</h5>
                <div class="card-tools d-flex ml-auto">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <span class="text-dark"><b>Call Number</b></span>
                  <input type="text" class="form-control"  placeholder="Call Number" name="call_num" required>
                </div>
                <div class="form-group">
                  <span class="text-dark"><b>Category name</b></span>
                  <textarea class="form-control" placeholder="Category name"id="" cols="30" name="cat_name" rows="2" required></textarea>
                </div>
                <div class="form-group">
                  <span class="text-dark"><b>Description</b></span>
                  <textarea class="form-control" placeholder="Category description"id="" cols="30" name="cat_desc" rows="3" required></textarea>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm float-right" name="save_category">
                <i class="far fa-check-circle"></i> Submit
                </button>
              </div>
            </div>
          </form>
          <?php } ?>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-12">
          <div class="card">
            <div class="card-header p-2 d-flex">
              <h5 class="ml-3">Categories</h5>
              <div class="card-tools d-flex ml-auto">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>CALL NUMBER</th>
                    <th>CATEGORY NAME</th>
                    <th>DESCRIPTION</th>
                    <!-- <th>DATE CREATED</th> -->
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM category_can_be_deleted ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $row['call_num']; ?></td>
                    <td><?php echo $row['cat_name']; ?></td>
                    <td><?php echo $row['cat_desc']; ?></td>
                    <!-- <td class="text-primary"><?php //echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></td> -->
                    <td>
                      <a class="btn btn-info btn-sm" href="category.php?cat_ID=<?php echo $row['cat_ID']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                      <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['cat_ID']; ?>"><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>
                  <!-- DELETE -->
                  <div class="modal fade" id="delete<?php echo $row['cat_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header bg-light">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder-open"></i> Delete category</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="process_delete.php" method="POST">
                            <input type="hidden" class="form-control" value="<?php echo $row['cat_ID']; ?>" name="cat_ID">
                            <h6 class="text-center">Delete category record?</h6>
                          </div>
                          <div class="modal-footer alert-light">
                            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-danger" name="delete_category"><i class="fas fa-trash"></i> Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>
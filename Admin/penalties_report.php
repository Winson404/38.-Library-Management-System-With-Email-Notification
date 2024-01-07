<title>LAKASA | Penalties</title>
<?php
  require_once 'sidebar.php';
  $currentDateTimeStr = date("Y-m-d H:i:s");
  $monthFormat = date("m");
  $year = date('Y');
  $todayDate = date("Y-m-d");
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Penalties</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Penalties</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center mb-3">
        
        <?php 
          $all = mysqli_query($conn, "SELECT SUM(penalty) AS total FROM borrowed_books");
          $row_all = mysqli_fetch_array($all);
        ?>
        <div class="col-md-4">
          <div class="card card-success shadow-sm">
            <div class="card-header">
              <h3 class="card-title">Overall Report</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <h3>₱<?php echo ($row_all['total'] !== null) ? number_format($row_all['total'], 2, '.', ',') : '0.00'; ?></h3>
              <p>Total Penalties</p>
            </div>
          </div>
        </div>

        <?php 
          $query = "SELECT SUM(penalty) AS total_penalty FROM borrowed_books 
          WHERE status != 3 AND status != 4 AND return_date < '$currentDateTimeStr'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_array($result);
          $totalPenalty = $row['total_penalty'];
        ?>
        <div class="col-md-4">
          <div class="card card-warning shadow-sm">
            <div class="card-header">
              <h3 class="card-title">Report This Month</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <h3>₱<?php echo ($totalPenalty !== null) ? number_format($totalPenalty, 2, '.', ',') : '0.00'; ?></h3>
              <p>Total Penalties</p>
            </div>
          </div>
        </div>

        <?php 
            $query2 = mysqli_query($conn, "SELECT SUM(penalty) AS total_penalty FROM borrowed_books 
            WHERE status != 3 AND status != 4 AND return_date < '$currentDateTimeStr'
            AND DATE(return_date) = '$todayDate'");
            $row2 = mysqli_fetch_array($query2);
            $totalPenalty2 = $row2['total_penalty'];
        ?>
        <div class="col-md-4">
          <div class="card card-info shadow-sm">
            <div class="card-header">
              <h3 class="card-title">Report Today</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <h3>₱<?php echo ($totalPenalty2 !== null) ? number_format($totalPenalty2, 2, '.', ',') : '0.00'; ?></h3>
              <p>Total Penalties</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>
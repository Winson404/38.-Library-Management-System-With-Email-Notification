<title>LAKASA | Borrowed book records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Borrowed book</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Borrowed book records</li>
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
            <div class="card-header">
              <button class="btn btn-success float-sm-right m-1 btn-sm" id="printButton"><i class="fa-solid fa-print"></i> Print</button>
              <a class="btn btn-dark float-sm-right m-1 btn-sm" href="borrowed_book.php"><i class="fa-solid fa-backward"></i> Back</a>
            </div>
            <div class="card-body">
              <div class="container"id="printElement">
                <div class="row invoice-info d-flex p-0 m-0" style="line-height: 18px;">
                  <div class="col-sm-2">
                    <img src="../images/logo.png"  alt="" style="margin-left: 90px;"  width="75">
                  </div>
                  <div class="col-sm-8 invoice-col text-center">
                    <address class="mt-3">
                      <!-- Republic of the Philippines<br> -->
                      <strong>Saint Catherine's School</strong><br>
                      Bambang Nueva Vizcaya
                    </address>
                  </div>
                  <div class="col-sm-12">
                    <!-- <center>
                    <small>Multi-Purpose Barangay Hall Pildera II, Pasay City 1300, MM, Phil's, Telefax: 8853-6275; email:brgy193@gmail.com</small>
                    </center> -->
                    <div class="dropdown-divider"></div>
                    <br>
                  </div>
                  <div class="col-12">
                    <p class="text-center text-bold">Borrowed Book records</p>
                    <p class="float-right" style="margin-top: -30px;"><?php echo date("d/m/Y"); ?></p>
                  </div>
                  <table id="#" class="table table-bordered table-hover text-sm table-sm">
                <thead>
                  <tr>
                    <th>BORROWER</th>
                    <th>CALL NO</th>
                    <th>ACC NO</th>
                    <th>TITLE</th>
                    <th>STATUS</th>
                    <th>DATE BORROWED</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  function getStatusText($status, $returnDate) {
                  // Get current date and time
                  $currentDateTime = new DateTime();
                  $currentDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');
                  // Check if the return date has passed
                  $returnDatePassed = strtotime($returnDate) < strtotime($currentDateTimeStr);
                  switch ($status) {
                  case 0:
                  return 'Pending';
                  case 1:
                  return 'Approved';
                  case 2:
                  return 'Released';
                  case 3:
                  return 'Rejected';
                  case 4:
                    // If return date passed, mark as Unreturned
                    // return ($returnDatePassed) ? '<span class="badge badge-warning pt-1">Unreturned</span>' : '<span class="badge badge-info">Returned</span>';
                    return 'Returned';
                  case 5:
                  return 'Unreturned';
                  case 6:
                  return 'Returned lated';
                  default:
                  return 'Unknown Status';
                  }
                  }
                  $totalPenalties = 0;
                  $sql = mysqli_query($conn, "SELECT *, borrowed_books.created_at AS borrow_date FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id");
                  while ($row = mysqli_fetch_array($sql)) {
                    $borrower_type = $row['user_type'];
                    $user_Id = $row['user_ID'];
                    $view_borrower_link = '';

                    if ($borrower_type == 'Student') {
                        $view_borrower_link = 'students_view.php?user_Id=' . $user_Id;
                    } else {
                        $view_borrower_link = 'teachers_view.php?user_Id=' . $user_Id;
                    }
                  ?>
                  <tr>
                    <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                    <td><?php echo $row['call_num']; ?></td>
                    <td><?php echo $row['accession_num']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td class="text-center"><?php echo getStatusText($row['status'], $row['return_date']); ?></td>
                    <td><?php echo $row['borrow_date']; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
                  <div class="col-md-12 d-flex">
                    <p class="text-sm ml-auto">Printed by: <br> <span class="text-muted"><?php echo ucwords($fullname); ?></span></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../includes/print.js"></script>
  <?php require_once '../includes/footer.php'; ?>
  <script>
  $(window).on('load', function() {
  document.getElementById("printButton").click();
  })
  </script>
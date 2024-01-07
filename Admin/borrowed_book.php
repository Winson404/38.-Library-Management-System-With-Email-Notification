<title>LAKASA | Borrowed books records</title>
<?php
require_once 'sidebar.php';
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Borrowed books</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Borrowed books records</li>
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
              <!-- <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New Book</button> -->
              <div class="card-tools mr-1 mt-3">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <a class="btn btn-success float-sm-right mr-2 btn-sm" href="borrowed_book_print.php"><i class="fa-solid fa-print"></i> Print</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>CALL NO</th>
                    <th>ACC NO</th>
                    <th>TITLE</th>
                    <th>RETURN DATE</th>
                    <th>STATUS</th>
                    <th>PENALTY</th>
                    <th>TOOLS</th>
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
                  return '<span class="badge badge-secondary pt-1">Pending</span>';
                  case 1:
                  return '<span class="badge badge-success pt-1">Approved</span>';
                  case 2:
                  return '<span class="badge badge-primary pt-1">Released</span>';
                  case 3:
                  return '<span class="badge badge-danger pt-1">Rejected</span>';
                  case 4:
                    // If return date passed, mark as Unreturned
                    // return ($returnDatePassed) ? '<span class="badge badge-warning pt-1">Unreturned</span>' : '<span class="badge badge-info">Returned</span>';
                    return '<span class="badge badge-info pt-1">Returned</span>';
                  case 5:
                  return '<span class="badge badge-warning pt-1">Unreturned</span>';
                  case 6:
                  return '<span class="badge badge-danger pt-1">Returned late</span>';
                  default:
                  return '<span class="badge badge-light pt-1">Unknown Status</span>';
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
                    <td><?php echo $row['call_num']; ?></td>
                    <td><?php echo $row['accession_num']; ?></td>
                    <td>
                      <a href="book-info.php?book_ID=<?php echo $row['book_ID']; ?>"><?php echo $row['title']; ?></a>
                    </td>
                    <td><?php echo (strtotime($row['return_date']) != 0) ? (new DateTime($row['return_date']))->format('M d, Y h:i A') : 'N/A'; ?></td>
                    <td class="text-center"><?php echo getStatusText($row['status'], $row['return_date']); ?></td>
                    <td class="text-center">
                      <?php
                        if ($row['penalty'] != 0) {
                          $formattedPenalty = '₱' . number_format($row['penalty'], 2);
                          echo $formattedPenalty;
                          $totalPenalties += $row['penalty'];
                        } else {
                          echo 'N/A';
                        }
                      ?>
                    </td>
                    <td>
                      <button type="button" class="btn bg-success btn-sm" data-toggle="modal" data-target="#update<?php echo $row['borrow_ID']; ?>"><i class="fas fa-pencil"></i> Update</button>
                      <button type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#view<?php echo $row['borrow_ID']; ?>"><i class="fas fa-info-circle"></i> Book</button>
                      <a type="button" class="btn bg-info btn-sm" href="<?= $view_borrower_link ?>"><i class="fas fa-info-circle"></i> Borrower</a>
                    </td>
                  </tr>
                  <!-- VIEW -->
                  <div class="modal fade" id="view<?php echo $row['borrow_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-header bg-light">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder-open"></i> Book Borrowing Details</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-12">
                              <h6><a href="#">Book info</a></h6>
                            </div>
                            <div class="col-md-6">
                              <p><b>Call Number: </b><?php echo $row['call_num']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Accession Number: </b><?php echo $row['accession_num']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Title: </b><?php echo $row['title']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Subtitle: </b><?php echo $row['sub_title']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Series Title: </b><?php echo $row['sub_title_series']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Author: </b><?php echo $row['author']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Publisher: </b><?php echo $row['publisher']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Place Published: </b><?php echo $row['place_published']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Date Published: </b><?php echo $row['date_published']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Edition: </b><?php echo $row['edition']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Volume: </b><?php echo $row['volume']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Copyright: </b><?php echo $row['copyright']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>ISBN: </b><?php echo $row['isbn']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Quantity Available: </b><?php echo $row['qty_available']; ?></p>
                            </div>
                            <div class="col-md-12">
                              <h6><a href="#">Borrowing details</a></h6>
                            </div>
                            <div class="col-md-6">
                              <p><b>Location: </b><?php echo $row['symbols']; ?></p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Penalty: </b>
                                <?php
                                if ($row['penalty'] != 0) {
                                $formattedPenalty = '₱' . number_format($row['penalty'], 2);
                                echo $formattedPenalty;
                                } else {
                                echo 'N/A';
                                }
                                ?>
                              </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Duration:</b>
                                <?php
                                $returnDatePassed = strtotime($row['return_date']) < strtotime($currentDateTimeStr);
                                if ($returnDatePassed) {
                                echo '<span class="text-danger">Return date has passed</span>';
                                } else {
                                echo $row['duration'];
                                }
                                ?>
                              </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Return Date: </b><?php echo $row['return_date']; ?></p>
                            </div>
                            <div class="col-md-12">
                              <h6><a href="#">Confirm Date</a></h6>
                            </div>
                            <div class="col-md-6">
                              <p><b>Date borrowed: </b> <?php echo $row['borrow_date']; ?> </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Status: </b> <?php echo getStatusText($row['status'], $row['return_date']); ?> </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Approved: </b> <?php echo ($row['date_approve'] !== '0000-00-00') ? $row['date_approve'] : 'N/A'; ?> </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Rejected: </b> <?php echo ($row['date_rejected'] !== '0000-00-00') ? $row['date_rejected'] : 'N/A'; ?> </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Released: </b> <?php echo ($row['date_released'] !== '0000-00-00') ? $row['date_released'] : 'N/A'; ?> </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Returned: </b> <?php echo ($row['date_returned'] !== '0000-00-00') ? $row['date_returned'] : 'N/A'; ?> </p>
                            </div>
                            <div class="col-md-6">
                              <p><b>Place to use: </b> <?php echo $row['place_to_use']; ?> </p>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer alert-light">
                          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="update<?php echo $row['borrow_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header bg-light">
                                  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-book"></i> Update status </h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <form action="process_update.php" method="POST">
                                      <input type="hidden" class="form-control" value="<?php echo $row['borrow_ID']; ?>" name="borrow_ID">
                                      <div class="form-group">
                                          <span class="text-dark"><b>Borrowed book status</b></span>
                                          <select class="form-control" name="status" id="statusSelect_<?php echo $row['borrow_ID']; ?>" required>
                                              <option selected disabled value="">Select status</option>
                                              <option value="1" <?php if($row['status'] == 1) { echo 'selected'; } ?>>Approve</option>
                                              <option value="2" <?php if($row['status'] == 2) { echo 'selected'; } ?>>Release</option>
                                              <option value="3" <?php if($row['status'] == 3) { echo 'selected'; } ?>>Reject</option>
                                              <option value="4" <?php if($row['status'] == 4) { echo 'selected'; } ?>>Return</option>
                                              <option value="6" <?php if($row['status'] == 6) { echo 'selected'; } ?>>Return late</option>
                                          </select>
                                      </div>
                                      <div class="form-group" id="rejectionReasonGroup_<?php echo $row['borrow_ID']; ?>" style="display: none;">
                                          <span class="text-dark"><b>Reason for rejection</b></span>
                                          <textarea class="form-control" placeholder="Reason for rejection" name="reason_reject" id="rejectionReason_<?php echo $row['borrow_ID']; ?>" cols="30" rows="2" required></textarea>
                                      </div>
                              </div>
                              <div class="modal-footer alert-light">
                                  <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                                  <button type="submit" class="btn bg-primary" name="update_borrowed_book_status"><i class="fa-solid fa-floppy-disk"></i> Confirm</button>
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>

                  <script>
                      $(document).ready(function() {
                          $('#statusSelect_<?php echo $row['borrow_ID']; ?>').change(function() {
                              var selectedStatus = $(this).val();
                              if (selectedStatus == 3) {
                                  $('#rejectionReasonGroup_<?php echo $row['borrow_ID']; ?>').show();
                                  $('#rejectionReason_<?php echo $row['borrow_ID']; ?>').prop('required', true);
                              } else {
                                  $('#rejectionReasonGroup_<?php echo $row['borrow_ID']; ?>').hide();
                                  $('#rejectionReason_<?php echo $row['borrow_ID']; ?>').prop('required', false);
                              }
                          });
                      });
                  </script>

                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="5" class="text-right">Grand Total</td>
                    <td class="text-center text-bold">
                        <?php
                        echo '₱' . number_format($totalPenalties, 2);
                        ?>
                    </td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>
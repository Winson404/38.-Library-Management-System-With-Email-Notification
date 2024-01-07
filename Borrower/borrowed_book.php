<title>LAKASA | Borrowed books</title>

<?php 
    require_once 'header.php'; 
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Borrowed books</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Borrowed books records</li>
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
            
            <div class="card-body ">
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
                  $sql = mysqli_query($conn, "SELECT *, borrowed_books.created_at AS borrow_date FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID WHERE borrowed_books.user_ID=$id ");
                  while ($row = mysqli_fetch_array($sql)) {
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
                      <button type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#view<?php echo $row['borrow_ID']; ?>"><i class="fas fa-eye"></i> View</button>
                      <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['borrow_ID']; ?>" <?php if($row['status'] != 0) { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>

                  <!-- VIEW -->
                  <div class="modal fade" id="view<?php echo $row['borrow_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-light">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder-open"></i> View Book Details</h5>
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

                                    <?php if($row['status'] == 3): ?>
                                    <div class="col-md-12">
                                      <hr>
                                      <h6><a href="#">Reason for rejection</a></h6>
                                      <p><?php echo ucwords($row['reason_reject']); ?>
                                        <br>
                                        <span class="text-muted" style="font-style: italic;"><small><?php echo $row['date_rejected']; ?></small></span>
                                      </p> 
                                    </div>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="modal-footer alert-light">
                                <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- DELETE -->
                  <div class="modal fade" id="delete<?php echo $row['borrow_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header bg-light">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-book"></i> Delete borrowed book</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="process_delete.php" method="POST">
                            <input type="hidden" class="form-control" value="<?php echo $row['borrow_ID']; ?>" name="borrow_ID">
                            <h6 class="text-center">Delete borrowed book?</h6>
                          </div>
                          <div class="modal-footer alert-light">
                            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-danger" name="delete_book_borrow"><i class="fas fa-trash"></i> Delete</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
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
  </div>
</div>
  
<?php require_once 'footer.php'; ?>



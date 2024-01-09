<title>LAKASA | Borrower profile</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Borrower profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Borrower profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <?php 
        if(isset($_GET['user_Id'])) {
        $user_Id = $_GET['user_Id'];
        $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
        $row = mysqli_fetch_array($fetch);
      ?>
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <?php if($row['image'] == ""): ?>
                <img src="../dist/img/avatar.png" alt="User Avatar" class="img-size-50 img-circle">
                <?php else: ?>
                <img class="profile-user-img img-fluid img-circle"src="../images-users/<?php echo $row['image']; ?>"alt="User profile picture"  style="height: 90px; width: 90px; border-radius: 50%;">
                <?php endif; ?>
                
              </div>
              <h3 class="profile-username text-center"><?php echo ' '.$row['firstname'].' '.$row['lastname'].' '; ?></h3>
              <p class="text-muted text-center"><?php echo $row['user_type']; ?></p>
              <a class="btn bg-gradient-primary btn-block">Profile</a>
            </div>
          </div>
          <div class="card card-primary">
            <div class="card-header bg-gradient-primary">
              <h3 class="card-title">About Me</h3>
            </div>
            <div class="card-body">
              <strong><i class="fas fa-location mr-1"></i> Address</strong>
              <p class="text-muted">
                <?php echo ''.$row['house_no'].' '.$row['street_name'].' '.$row['purok'].' '.$row['zone'].' '.$row['barangay'].' '.$row['municipality'].' '.$row['province'].' '.$row['region'].''; ?>
              </p>
              <hr>
              <strong><i class="fa-solid fa-calendar-days"></i> Date registered</strong>
              <p class="text-muted ml-3"><?php echo date("F d, Y h:i A", strtotime($row['date_registered'])); ?></p>
              <hr>
              <!--  <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>
              <hr>
              <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#viewprofile" data-toggle="tab">Profile info</a></li>
                <li class="nav-item"><a class="nav-link" href="#borrowedBooks" data-toggle="tab">Borrowed books</a></li>
              </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="viewprofile">
                    <div class="form-group row">
                      <label for="Department" class="col-sm-2 col-form-label">Department</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="Department" placeholder="Department" value="<?php echo $row['dept']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Year Level" class="col-sm-2 col-form-label">Year level</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="Year Level" placeholder="Year Level" value="<?php echo $row['yr_lvl']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="First name" class="col-sm-2 col-form-label">Full name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="First name" placeholder="First name" value="<?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="First name" class="col-sm-2 col-form-label">Date of birth</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="First name" placeholder="First name" value="<?php echo date("F d, Y", strtotime($row['dob'])); echo ' - '; echo $row['age'] ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="First name" class="col-sm-2 col-form-label">Birthplace</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="First name" placeholder="Birthplace" value="<?php echo $row['birthplace']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="First name" class="col-sm-2 col-form-label">Gender</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="First name" placeholder="Gender" value="<?php echo $row['gender']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="First name" class="col-sm-2 col-form-label">Civil Status</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="First name" placeholder="Civil Status" value="<?php echo $row['civilstatus']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="First name" class="col-sm-2 col-form-label">Religion</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="First name" placeholder="Religion" value="<?php echo $row['religion']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Email" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="Email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="Contact number" class="col-sm-2 col-form-label">Contact number</label>
                      <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-text">+63</div>
                          <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="Contact number" name="contact" placeholder = "9123456789" required maxlength="10" value="<?php echo $row['contact']; ?>" readonly>
                        </div>
                      </div>
                    </div>
                    
                    <!-- <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                          </label>
                        </div>
                      </div>
                    </div> -->
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <a type="button" class="btn bg-gradient-primary" href="#updateprofile" data-toggle="tab">Update info</a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="borrowedBooks">
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
                  $sql = mysqli_query($conn, "SELECT *, borrowed_books.created_at AS borrow_date FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID WHERE borrowed_books.user_ID=$user_Id ");
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
      <?php } else { ?>
      <?php } ?>
      </div>

  </section>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <?php require_once '../includes/footer.php'; ?>
<title>LAKASA | Book records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Book</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Book records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <div class="card-header p-2">
              <button type="button" class="btn btn-sm bg-primary ml-2" data-toggle="modal" data-target="#create"><i class="fa-sharp fa-solid fa-square-plus"></i> New Book</button>
              <div class="card-tools mr-1 mt-3">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <a class="btn btn-success float-sm-right mr-2 btn-sm" href="book_print.php"><i class="fa-solid fa-print"></i> Print</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>CALL NUM</th>
                    <th>ACC. NUM</th>
                    <th>TITLE</th>
                    <th>AUTHOR</th>
                    <th>AVAILABLE</th>
                    <th>TOTAL BOOKS</th>
                    <th>DATE PUBLISHED</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM books ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo $row['call_num']; ?></td>
                    <td><?php echo $row['accession_num']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['qty_available']; ?></td>
                    <td><?php echo $row['qty']; ?></td>
                    <td><?php echo $row['date_published']; ?></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view<?php echo $row['book_ID']; ?>"><i class="fas fa-folder"></i> View</button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['book_ID']; ?>" <?php if($user_type !== 'Admin') { echo 'disabled'; } ?>><i class="fas fa-pencil-alt"></i> Edit</button>
                      <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['book_ID']; ?>" <?php if($user_type !== 'Admin') { echo 'disabled'; } ?>><i class="fas fa-trash"></i> Delete</button>
                    </td>
                  </tr>

                  <div class="modal fade" id="view<?php echo $row['book_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <div class="col-md-6">
                                        <label for="call_num">Call Number:</label>
                                        <p><?php echo $row['call_num']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="accession_num">Accession Number:</label>
                                        <p><?php echo $row['accession_num']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title">Title:</label>
                                        <p><?php echo $row['title']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sub_title">Subtitle:</label>
                                        <p><?php echo $row['sub_title']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sub_title_series">Series Title:</label>
                                        <p><?php echo $row['sub_title_series']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="author">Author:</label>
                                        <p><?php echo $row['author']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="publisher">Publisher:</label>
                                        <p><?php echo $row['publisher']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="place_published">Place Published:</label>
                                        <p><?php echo $row['place_published']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_published">Date Published:</label>
                                        <p><?php echo $row['date_published']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edition">Edition:</label>
                                        <p><?php echo $row['edition']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="volume">Volume:</label>
                                        <p><?php echo $row['volume']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="copyright">Copyright:</label>
                                        <p><?php echo $row['copyright']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="isbn">ISBN:</label>
                                        <p><?php echo $row['isbn']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qty">Quantity (All books):</label>
                                        <p><?php echo $row['qty']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="qty_available">Quantity Available:</label>
                                        <p><?php echo $row['qty_available']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer alert-light">
                                <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                  <div class="modal fade" id="update<?php echo $row['book_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <form action="process_update.php" method="POST">
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-book"></i> Create book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Call number</b></span>
                                      <input type="hidden" class="form-control" placeholder="Book ID" name="book_ID" value="<?php echo $row['book_ID']; ?>" required>
                                      <input type="text" class="form-control" placeholder="Call number" name="call_num" value="<?php echo $row['call_num']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Accession number</b></span>
                                      <input type="text" class="form-control" placeholder="Accession number" name="accession_num" value="<?php echo $row['accession_num']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Book Title</b></span>
                                      <input type="text" class="form-control" placeholder="Book title" name="title" value="<?php echo $row['title']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Subtitle</b></span>
                                      <input type="text" class="form-control" placeholder="Subtitle" name="sub_title" value="<?php echo $row['sub_title']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Series title</b></span>
                                      <input type="text" class="form-control" placeholder="Series title" name="sub_title_series" value="<?php echo $row['sub_title_series']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Author</b></span>
                                      <input type="text" class="form-control" placeholder="Author" name="author" value="<?php echo $row['author']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Publisher</b></span>
                                      <input type="text" class="form-control" placeholder="Publisher" name="publisher" value="<?php echo $row['publisher']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Place published</b></span>
                                      <input type="text" class="form-control" placeholder="Place published" name="place_published" value="<?php echo $row['place_published']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Date published</b></span>
                                      <input type="number" class="form-control" placeholder="2000" name="date_published" value="<?php echo $row['date_published']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Edition</b></span>
                                      <input type="text" class="form-control" placeholder="Edition" name="edition" value="<?php echo $row['edition']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Volume</b></span>
                                      <input type="text" class="form-control" placeholder="Volume" name="volume" value="<?php echo $row['volume']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-7 col-md-7 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Copyright</b></span>
                                      <input type="text" class="form-control" placeholder="Copyright" name="copyright" value="<?php echo $row['copyright']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>ISBN</b></span>
                                      <input type="text" class="form-control" placeholder="ISBN" name="isbn" value="<?php echo $row['isbn']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Quantity (All books)</b></span>
                                      <input type="number" class="form-control" placeholder="Quantity (All books)" name="qty" value="<?php echo $row['qty']; ?>" required>
                                  </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                                  <div class="form-group">
                                      <span class="text-dark"><b>Quantity Available</b></span>
                                      <input type="number" class="form-control" placeholder="Quantity Available" name="qty_available" value="<?php echo $row['qty_available']; ?>" required>
                                  </div>
                              </div>
                          </div>

                          </div>
                          <div class="modal-footer alert-light">
                            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-primary" name="update_book"><i class="fas fa-check"></i> Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>


                  <!-- DELETE -->
                  <div class="modal fade" id="delete<?php echo $row['book_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header bg-light">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-book"></i> Delete book</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="process_delete.php" method="POST">
                            <input type="hidden" class="form-control" value="<?php echo $row['book_ID']; ?>" name="book_ID">
                            <h6 class="text-center">Delete book record?</h6>
                          </div>
                          <div class="modal-footer alert-light">
                            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-danger" name="delete_book"><i class="fas fa-trash"></i> Delete</button>
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

<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form action="process_save.php" method="POST">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-book"></i> Create book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Call number</b></span>
                <input type="text" class="form-control" placeholder="Call number" name="call_num" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Accession number</b></span>
                <input type="text" class="form-control" placeholder="Accession number" name="accession_num" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Book Title</b></span>
                <input type="text" class="form-control" placeholder="Book title" name="title" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Subtitle</b></span>
                <input type="text" class="form-control" placeholder="Subtitle" name="sub_title" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Series title</b></span>
                <input type="text" class="form-control" placeholder="Series title" name="sub_title_series" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Author</b></span>
                <input type="text" class="form-control" placeholder="Author" name="author" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Publisher</b></span>
                <input type="text" class="form-control" placeholder="Publisher" name="publisher" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Place published</b></span>
                <input type="text" class="form-control" placeholder="Place published" name="place_published" required>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Date published</b></span>
                <input type="number" class="form-control" placeholder="2000" name="date_published" required>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Edition</b></span>
                <input type="text" class="form-control" placeholder="Edition" name="edition" required>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Volume</b></span>
                <input type="text" class="form-control" placeholder="Volume" name="volume" required>
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Copyright</b></span>
                <input type="text" class="form-control" placeholder="Copyright" name="copyright" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <span class="text-dark"><b>ISBN</b></span>
                <input type="text" class="form-control" placeholder="ISBN" name="isbn" required>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Quantity (All books)</b></span>
                <input type="number" class="form-control" placeholder="Quantity (All books)" name="qty" required>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
              <div class="form-group">
                <span class="text-dark"><b>Quantity Available</b></span>
                <input type="number" class="form-control" placeholder="Quantity Available" name="qty_available" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
          <button type="submit" class="btn bg-primary" name="save_book"><i class="fas fa-check"></i> Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

  </section>
  <?php require_once '../includes/footer.php'; ?>
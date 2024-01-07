<title>LAKASA | Dashboard</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $users = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type='Admin' OR user_type='Staff'");
              $row_users = mysqli_num_rows($users);
              ?>
              <h3><?php echo $row_users; ?></h3>
              <p>Administrators</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-shield"></i>
            </div>
            <a href="admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $students = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type='Student'");
              $row_students = mysqli_num_rows($students);
              ?>
              <h3><?php echo $row_students; ?></h3>
              <p>Registered students</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-graduate"></i>
            </div>
            <a href="students.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
              $teachers = mysqli_query($conn, "SELECT user_Id FROM users WHERE user_type='Teacher'");
              $row_teachers = mysqli_num_rows($teachers);
              ?>
              <h3><?php echo $row_teachers; ?></h3>
              <p>Registered teachers</p>
            </div>
            <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="teachers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
              $books = mysqli_query($conn, "SELECT book_ID FROM books");
              $row_books = mysqli_num_rows($books);
              ?>
              <h3><?php echo $row_books; ?></h3>
              <p>Books</p>
            </div>
            <div class="icon">
              <i class="fas fa-book"></i>
            </div>
            <a href="book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
                $pending = mysqli_query($conn, "SELECT borrow_ID FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id WHERE borrowed_books.status=0");
                $row_pending = mysqli_num_rows($pending);
              ?>
              <h3><?php echo $row_pending; ?></h3>
              <p>Pending borrowed books</p>
            </div>
            <div class="icon">
              <i class="fas fa-clock"></i>
            </div>
            <a href="borrowed_book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
                $approve = mysqli_query($conn, "SELECT borrow_ID FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id WHERE borrowed_books.status=1");
                $row_approve = mysqli_num_rows($approve);
              ?>
              <h3><?php echo $row_approve; ?></h3>
              <p>Approved borrowed books</p>
            </div>
            <div class="icon">
              <i class="fas fa-check-circle"></i>
            </div>
            <a href="borrowed_book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
                $released = mysqli_query($conn, "SELECT borrow_ID FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id WHERE borrowed_books.status=2");
                $row_released = mysqli_num_rows($released);
              ?>
              <h3><?php echo $row_released; ?></h3>
              <p>Realased borrowed books</p>
            </div>
            <div class="icon">
              <i class="fas fa-arrow-circle-right"></i>
            </div>
            <a href="borrowed_book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
                $rejected = mysqli_query($conn, "SELECT borrow_ID FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id WHERE borrowed_books.status=3");
                $row_rejected = mysqli_num_rows($rejected);
              ?>
              <h3><?php echo $row_rejected; ?></h3>
              <p>Rejected borrowed books</p>
            </div>
            <div class="icon">
              <i class="fas fa-times-circle"></i>
            </div>
            <a href="borrowed_book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
                $return = mysqli_query($conn, "SELECT borrow_ID FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id WHERE borrowed_books.status=4");
                $row_return = mysqli_num_rows($return);
              ?>
              <h3><?php echo $row_return; ?></h3>
              <p>Returned borrowed books</p>
            </div>
            <div class="icon">
              <i class="fas fa-undo"></i>
            </div>
            <a href="borrowed_book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
                $return = mysqli_query($conn, "SELECT borrow_ID FROM borrowed_books JOIN books ON borrowed_books.book_ID=books.book_ID JOIN users ON borrowed_books.user_ID=users.user_Id WHERE borrowed_books.status=5");
                $row_return = mysqli_num_rows($return);
              ?>
              <h3><?php echo $row_return; ?></h3>
              <p>Unreturned borrowed books</p>
            </div>
            <div class="icon">
              <i class="fas fa-undo"></i>
            </div>
            <a href="borrowed_book.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>
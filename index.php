<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'header.php';
?>
<script src="plugins/jquery/jquery.min.js"></script>

<?php

if (isset($_GET['book_title'])) {
    // $book_title = mysqli_real_escape_string($conn, $_GET['book_title']);
    $book_title = isset($_GET['book_title']) ? htmlspecialchars($_GET['book_title']) : '';

    if (!empty($book_title)) {

        $recordsPerPage = 5;
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
         $currentPage = $_GET['page'];
        } else {
          $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $recordsPerPage;
        $search2 = mysqli_query($conn, "SELECT * FROM books WHERE qty_available > 0 AND title LIKE '%" . $book_title . "%' LIMIT $offset, $recordsPerPage");

        if ($search2 === false) {
            die("Query execution error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($search2) > 0) { ?>

      

          
          <section class="content-header m-3">
            <div class="container">
              <h2 class="text-center display-3" style="font-weight: bold;">
              <a href="">
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">L</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">I</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">B</span>
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #28a745; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">A</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Y</span>
              </a>
              </h2>
            </div>
          </section>

          <section class="content">
            <div class="container">
              <form id="searchForm" action="" method="GET">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" value="<?php echo $book_title; ?>" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
          <section class="content-header m-2">
              <div class="container">
        <?php
            while ($row = mysqli_fetch_array($search2)) { ?>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col px-0">
                      <div>
                        <div class="float-right text-muted"><?php echo $row['call_num']; ?></div>
                        <h6 class="text-primary"><a href="book-info.php?book_ID=<?php echo $row['book_ID']; ?>"><?php echo $row['title']; ?></a></h6>
                        <p class="mb-0"><?php echo $row['sub_title'] ?><br>
                          <span class="text-success">Available: </span><?php echo $row['qty_available']; ?>
                        </p>
                        <a type="button" class="float-right" href="login.php" style="font-size: 13px;">Borrow book</a>
                      </div>
                    </div>
                  </div>
                </div>
        <?php } ?>
            </div>
          </section>

            <div class="container">
                <ul class="pagination justify-content-end">
                    <?php
                    // Modify the query to get the total count based on your search criteria
                    $totalPagesQuery = mysqli_query($conn, "SELECT COUNT(book_ID) AS total FROM books WHERE qty_available > 0 AND title LIKE '%" . $book_title . "%'");
                    $totalPagesRow = mysqli_fetch_assoc($totalPagesQuery);
                    $totalPages = ceil($totalPagesRow['total'] / $recordsPerPage);

                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<li class='page-item" . ($currentPage == $i ? ' active' : '') . "'><a class='page-link' href='index.php?book_title=" . $book_title . "&page=$i' data-page='$i'>$i</a></li>";
                    }
                    ?>
                </ul>
            </div>



             <script>
            $(document).ready(function() {
                $('body').on('click', '.page-link', function() {
                    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
                });

                var scrollPosition = sessionStorage.getItem('scrollPosition');
                if (scrollPosition !== null) {
                    $(window).scrollTop(scrollPosition);
                    sessionStorage.removeItem('scrollPosition');
                }
            });
            </script>
        <?php } else { ?>
          <section class="content">
            <div class="not-found m-5">
              <img src="images/searchnotfound.gif" alt="" class="img-fluid d-block m-auto">
              <h3 class="mb-0 text-center text-white">No record found</h3>
            </div>
            <div class="container">
              <form id="searchForm" action="" method="GET">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        <?php
        }
    } else {
        ?>
          <section class="content">
            <div class="not-found m-5">
              <img src="images/searchnotfound.gif" alt="" class="img-fluid d-block m-auto">
              <h3 class="mb-0 text-center">Please enter book info to search</h3>
            </div>
            <div class="container">
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>
        <?php
    }
} else { ?>
          <section class="content-header m-3">
            <div class="container">
              <h2 class="text-center">
              <img src="images/logo.png" alt="" width="180">
              </h2>
              <h2 class="text-center display-3" style="font-weight: bold;">
              <a href="">
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">L</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">I</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">B</span>
                <span style="color: #007bff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #28a745; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">A</span>
                <span style="color: #dc3545; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">R</span>
                <span style="color: #ffc107; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Y</span>
              </a>
              </h2>
            </div>
          </section>
          <section class="content">
            <div class="container">
              <form id="searchForm" action="" method="GET">
                <div class="row">
                  <div class="col-md-8 offset-md-2">
                    <div class="form-group">
                      <div class="input-group input-group-lg">
                        <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title" required>
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-lg btn-default">
                          <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </section>

          <?php
            $recordsPerPage = 5;
            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }

            $offset = ($currentPage - 1) * $recordsPerPage;

            $search2 = mysqli_query($conn, "
                SELECT books.*, COUNT(DISTINCT borrowed_books.book_ID) AS borrow_count
                FROM books
                LEFT JOIN borrowed_books ON books.book_ID = borrowed_books.book_ID
                GROUP BY books.book_ID
                ORDER BY borrow_count DESC
                LIMIT $offset, $recordsPerPage
            ");
            
            if ($search2 === false) {
              die("Query execution error: " . mysqli_error($conn));
            }
            
          if (mysqli_num_rows($search2) > 0) { ?>
            <section class="content-header mt-2">
              <div class="container">
                <h5><a href="#">Most used books</a></h5>
                <?php while ($row = mysqli_fetch_array($search2)) { ?>
                <div class="list-group-item">
                  <div class="row">
                    <div class="col px-0">
                      <div>
                        <div class="float-right text-muted"><?php echo $row['call_num']; ?></div>
                        <h6 class="text-primary"><a href="book-info.php?book_ID=<?php echo $row['book_ID']; ?>"><?php echo $row['title']; ?></a></h6>
                        <p class="mb-0"><?php echo $row['sub_title'] ?><br>
                          <span class="text-success">Available: </span><?php echo $row['qty_available']; ?>
                        </p>
                        <a type="button" class="float-right" href="login.php" style="font-size: 13px;">Borrow book</a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </section>

            <!-- Pagination controls -->
            <div class="container">
              <ul class="pagination justify-content-end">
                <?php
                $totalPagesQuery = mysqli_query($conn, "SELECT COUNT(DISTINCT book_ID) AS total FROM borrowed_books");

                $totalPagesRow = mysqli_fetch_assoc($totalPagesQuery);
                $totalPages = ceil($totalPagesRow['total'] / $recordsPerPage);
                for ($i = 1; $i <= $totalPages; $i++) {
                echo "<li class='page-item" . ($currentPage == $i ? ' active' : '') . "'><a class='page-link' href='index.php?page=$i' data-page='$i'>$i</a></li>";
                }
                ?>
              </ul>
            </div>

            <script>
            $(document).ready(function() {
                $('body').on('click', '.page-link', function() {
                    sessionStorage.setItem('scrollPosition', $(window).scrollTop());
                });

                var scrollPosition = sessionStorage.getItem('scrollPosition');
                if (scrollPosition !== null) {
                    $(window).scrollTop(scrollPosition);
                    sessionStorage.removeItem('scrollPosition');
                }
            });
            </script>
            
          <?php } else { ?>
          <section class="content">
            <div class="not-found m-5">
              <h3 class="mb-0 text-center text-white">No book records yet</h3>
            </div>
          </section>
          <?php } ?>


<?php } ?>

<?php include 'footer.php'; ?>

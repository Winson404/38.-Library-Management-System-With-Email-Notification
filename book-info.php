<?php include 'header.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php
    if(isset($_GET['book_ID'])) {
    $book_ID = $_GET['book_ID'];
    $fetch = mysqli_query($conn, "SELECT * FROM books WHERE book_ID='$book_ID'");
    $row_book = mysqli_fetch_array($fetch);
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <h2 class="text-center display-4" style="font-weight: bold;">
            <a href="search.php">
                <span class="text-primary">L</span>
                <span class="text-danger">I</span>
                <span class="text-warning">B</span>
                <span class="text-primary">R</span>
                <span class="text-success">A</span>
                <span class="text-danger">R</span>
                <span class="text-warning">Y</span>
            </a>
            </h2>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="index.php" method="POST">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" placeholder="Search book..." name="book_title">
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
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <!-- <img src="https://via.placeholder.com/800x400" class="card-img-top" alt="Book Cover Image"> -->
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ucwords($row_book['title']); ?></h5>
                            <p class="card-text"><?php echo $row_book['sub_title']; ?></p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Call Number:</strong> <?php echo $row_book['call_num']; ?></li>
                                <li class="list-group-item"><strong>Accession Number:</strong> <?php echo $row_book['accession_num']; ?></li>
                                <li class="list-group-item"><strong>Publisher:</strong> <?php echo ucwords($row_book['publisher']); ?></li>
                                <li class="list-group-item"><strong>Place Published:</strong> <?php echo ucwords($row_book['place_published']); ?></li>
                                <li class="list-group-item"><strong>Date Published:</strong> <?php echo date("F d, Y", strtotime($row_book['date_published'])); ?></li>
                                <li class="list-group-item"><strong>Edition:</strong> <?php echo $row_book['edition']; ?></li>
                                <li class="list-group-item"><strong>Volume:</strong> <?php echo $row_book['volume']; ?></li>
                                <li class="list-group-item"><strong>ISBN:</strong> <?php echo $row_book['isbn']; ?></li>
                                <li class="list-group-item"><strong>Quantity:</strong> <?php echo $row_book['qty']; ?></li>
                                <li class="list-group-item"><strong>Available Quantity:</strong> <?php echo $row_book['qty_available']; ?></li>
                                <li class="list-group-item"><strong>Copyright:</strong> <?php echo $row_book['copyright']; ?></li>
                                <li class="list-group-item"><strong>Created At:</strong> <?php echo date("F d, Y", strtotime($row_book['created_at'])); ?></li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <a type="button" class="btn btn-primary btn-sm float-right" href="login.php">Borrow book</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <?php } else { ?>
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
                <p>
                    We could not find the page you were looking for.
                    Meanwhile, you may <a href="index.php">return to homepage</a> or try using the search form.
                </p>
                <form id="searchForm" action="index.php" method="GET">
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
        </div>
    </section>
    <?php } ?>
</div>
<?php include 'footer.php'; ?>
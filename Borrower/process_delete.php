<?php 
	include '../config.php';
	include '../includes/function_delete.php';

	// DELETE BORROWED BOOK - BORROWED_BOOK.PHP
	if (isset($_POST['delete_book_borrow'])) {
	    $borrow_ID = $_POST['borrow_ID'];
	    deleteRecord($conn, "borrowed_books", "borrow_ID", $borrow_ID, "borrowed_book.php");
	}



?>





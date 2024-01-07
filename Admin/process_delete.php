<?php 
	include '../config.php';
	include '../includes/function_delete.php';

	// DELETE ADMIN - ADMIN_DELETE.PHP
	if (isset($_POST['delete_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "admin.php");
	}


	// DELETE STUDENTS - STUDENTS_DELETE.PHP
	if (isset($_POST['delete_student'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "students.php");
	}


	// DELETE TEACHERS - TEACHERS_DELETE.PHP
	if (isset($_POST['delete_teacher'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "teachers.php");
	}


	// DELETE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if (isset($_POST['delete_customization'])) {
	    $customID = $_POST['customID'];
	    deleteRecord($conn, "customization", "customID", $customID, "customize.php");
	}


	// DELETE ACTIVITY - ACTIVITY_UPDATE_DELETE.PHP
	if (isset($_POST['delete_activity'])) {
	    $actId = $_POST['actId'];
	    deleteRecord($conn, "announcement", "actId", $actId, "announcement.php");
	}


	// DELETE ACTIVITY - ACTIVITY_UPDATE_DELETE.PHP
	if (isset($_POST['delete_category'])) {
	    $cat_ID = $_POST['cat_ID'];
	    deleteRecord($conn, "category_can_be_deleted", "cat_ID", $cat_ID, "category.php");
	}



	// DELETE BOOK - BOOK.PHP
	if (isset($_POST['delete_book'])) {
	    $book_ID = $_POST['book_ID'];
	    deleteRecord($conn, "books", "book_ID", $book_ID, "book.php");
	}






?>





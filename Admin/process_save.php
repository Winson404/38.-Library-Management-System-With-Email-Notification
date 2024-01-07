<?php 
	include '../config.php';
	// include('../phpqrcode/qrlib.php');
	include '../includes/function_create.php';
	

	// SAVE ADMIN - ADMIN_MGMT.PHP
	if (isset($_POST['create_admin'])) {
	    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
	    $dept      = 'N/A';
		$yr_lvl    = 'N/A';
		$teacher_major = 'N/A';
	    $path = "../images-users/";
	    saveUser($conn, "admin_mgmt.php?page=create", $dept, $yr_lvl, $teacher_major, $user_type, $path);
	}


	// SAVE STUDENTS - STUDENTS_MGMT.PHP
	if (isset($_POST['create_student'])) {
		$user_type = "Student";
		$dept      = ucwords(mysqli_real_escape_string($conn, $_POST['dept']));
		$yr_lvl    = ucwords(mysqli_real_escape_string($conn, $_POST['yr_lvl']));
		$teacher_major = 'N/A';
		$path = "../images-users/";
	    saveUser($conn, "students_mgmt.php?page=create", $dept, $yr_lvl, $teacher_major, $user_type, $path);
	}


	// SAVE TEACHERS - TEACHERS_MGMT.PHP
	if (isset($_POST['create_teacher'])) {
		$user_type = "Teacher";
		$dept      = 'N/A';
		$yr_lvl    = 'N/A';
		$teacher_major = ucwords(mysqli_real_escape_string($conn, $_POST['teacher_major']));
		$path = "../images-users/";
	    saveUser($conn, "teachers_mgmt.php?page=create", $dept, $yr_lvl, $teacher_major, $user_type, $path);
	}


	// SAVE ACTIVITY - ANNOUNCEMENT_ADD.PHP
	if (isset($_POST['create_activity'])) {
		$activity = mysqli_real_escape_string($conn, $_POST['activity']);
		$actDate  = mysqli_real_escape_string($conn, $_POST['actDate']);
		saveActivity($conn, "announcement.php", $activity, $actDate);
	}



	// SAVE CATEGORY - CATEGORY.PHP
	if (isset($_POST['save_category'])) {
		$call_num = mysqli_real_escape_string($conn, $_POST['call_num']);
		$cat_name = ucwords(mysqli_real_escape_string($conn, $_POST['cat_name']));
		$cat_desc = ucwords(mysqli_real_escape_string($conn, $_POST['cat_desc']));
		save_category($conn, "category.php", $call_num, $cat_name, $cat_desc);
	}



	// SAVE BOOK - BOOK.PHP
	if (isset($_POST['save_book'])) {
		$call_num         = mysqli_real_escape_string($conn, $_POST['call_num']);
		$accession_num    = mysqli_real_escape_string($conn, $_POST['accession_num']);
		$title            = ucwords(mysqli_real_escape_string($conn, $_POST['title']));
		$sub_title        = ucwords(mysqli_real_escape_string($conn, $_POST['sub_title']));
		$sub_title_series = ucwords(mysqli_real_escape_string($conn, $_POST['sub_title_series']));
		$author           = ucwords(mysqli_real_escape_string($conn, $_POST['author']));
		$publisher        = ucwords(mysqli_real_escape_string($conn, $_POST['publisher']));
		$place_published  = ucwords(mysqli_real_escape_string($conn, $_POST['place_published']));
		$date_published   = mysqli_real_escape_string($conn, $_POST['date_published']);
		$edition          = mysqli_real_escape_string($conn, $_POST['edition']);
		$volume           = mysqli_real_escape_string($conn, $_POST['volume']);
		$copyright        = mysqli_real_escape_string($conn, $_POST['copyright']);
		$isbn             = mysqli_real_escape_string($conn, $_POST['isbn']);
		$qty              = mysqli_real_escape_string($conn, $_POST['qty']);
		$qty_available    = mysqli_real_escape_string($conn, $_POST['qty_available']);
		save_book($conn, "book.php", $call_num, $accession_num, $title, $sub_title, $sub_title_series, $author, $publisher, $place_published, $date_published, $edition, $volume, $copyright, $isbn, $qty, $qty_available);
	}







	// DATABASE RESTORATION - RESTORE.PHP
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['restore'])) {
	    $file = $_FILES['fileToRestore']['tmp_name'];
	    if (!$file) {
	        die("Please choose a file to restore.");
	    }
	    $sql = file_get_contents($file);
	    $queries = explode(';', $sql);
	    foreach ($queries as $query) {
	        if (!empty(trim($query))) {
	            $result = mysqli_query($conn, $query);
	            if (!$result) {
	                die("Error executing SQL query: " . mysqli_error($conn));
	            }
	        }
	    }
	    $_SESSION['message'] = "Database restoration successful";
		$_SESSION['text'] = "Sent successfully!";
		$_SESSION['status'] = "success";
		header("Location: restore.php");
	}

	
	
?>




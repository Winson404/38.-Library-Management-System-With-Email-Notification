<?php 
	include '../config.php';
	include '../includes/function_update.php';

		
	// UPDATE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['update_admin'])) {
		$user_Id   = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$dept      = 'N/A';
		$yr_lvl    = 'N/A';
		$teacher_major = 'N/A';
		$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
		updateSystemUser($conn, $user_Id, $dept, $yr_lvl, $teacher_major, $user_type, "admin_mgmt.php?page=".$user_Id);
	}




	// UPDATE USER - USERS_MGMT.PHP
	if(isset($_POST['update_student'])) {
		$user_Id   = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$dept      = ucwords(mysqli_real_escape_string($conn, $_POST['dept']));
		$yr_lvl    = ucwords(mysqli_real_escape_string($conn, $_POST['yr_lvl']));
		$teacher_major = 'N/A';
		$user_type = "Student";
		updateSystemUser($conn, $user_Id, $dept, $yr_lvl, $teacher_major, $user_type, "students_mgmt.php?page=".$user_Id);
	}
    


    // UPDATE TEACHERS - TEACHERS_MGMT.PHP
	if(isset($_POST['update_teacher'])) {
		$user_Id   = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$dept      = 'N/A';
		$yr_lvl    = 'N/A';
		$teacher_major = ucwords(mysqli_real_escape_string($conn, $_POST['teacher_major']));
		$user_type = "Teacher";
		updateSystemUser($conn, $user_Id, $dept, $yr_lvl, $teacher_major, $user_type, "teachers_mgmt.php?page=".$user_Id);
	}
    



	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['password_user'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);

	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "students.php");
	}




	// UPDATE ADMIN INFO - PROFILE.PHP
	if (isset($_POST['update_profile_info'])) {
	    $user_Id = mysqli_real_escape_string($conn, $_POST['user_Id']);
	    updateProfileInfo($conn, $user_Id, "profile.php");
	}




	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['update_password_admin'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);

	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "profile.php");
	}

		


	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if (isset($_POST['update_profile_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    updateProfileAdmin($conn, $user_Id, "profile.php");
	}





	// UPDATE BORROWED BOOK STATUS - BORROWED_BOOK.PHP
	if (isset($_POST['update_borrowed_book_status'])) {
		$borrow_ID     = mysqli_real_escape_string($conn, $_POST['borrow_ID']);
		$status        = mysqli_real_escape_string($conn, $_POST['status']);
		$reason_reject = mysqli_real_escape_string($conn, $_POST['reason_reject']);
		update_borrowed_book_status($conn, $borrow_ID, $status, $reason_reject, "borrowed_book.php");
	}




	// SAVE CATEGORY - CATEGORY.PHP
	if (isset($_POST['update_category'])) {
		$cat_ID   = mysqli_real_escape_string($conn, $_POST['cat_ID']);
		$call_num = mysqli_real_escape_string($conn, $_POST['call_num']);
		$cat_name = ucwords(mysqli_real_escape_string($conn, $_POST['cat_name']));
		$cat_desc = ucwords(mysqli_real_escape_string($conn, $_POST['cat_desc']));
		update_category($conn, $cat_ID, $call_num, $cat_name, $cat_desc, "category.php");
	}







	// UPDATE BOOK - BOOK.PHP
	if (isset($_POST['update_book'])) {
		$book_ID          = mysqli_real_escape_string($conn, $_POST['book_ID']);
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
		update_book($conn, $book_ID, $call_num, $accession_num, $title, $sub_title, $sub_title_series, $author, $publisher, $place_published, $date_published, $edition, $volume, $copyright, $isbn, $qty, $qty_available, "book.php");
	}




	// UPDATE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['update_customization'])) {
		$customID = $_POST['customID'];
		$file     = basename($_FILES["fileToUpload"]["name"]);
		
		$exist = mysqli_query($conn, "SELECT * FROM customization WHERE customID='$customID'");	
		$row = mysqli_fetch_array($exist);
		if($file == $row['picture']) {
			displayErrorMessage("Image is still the same.", "customize.php");
		} else {

			// Check if image file is a actual image or fake image
			$sign_target_dir = "../images-customization/";
			$sign_target_file = $sign_target_dir . basename($_FILES["fileToUpload"]["name"]);
			$sign_uploadOk = 1;
			$sign_imageFileType = strtolower(pathinfo($sign_target_file,PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check == false) {
			    displayErrorMessage("Signature file is not an image.", "customize.php");
				$uploadOk = 0;
			} 

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
			    displayErrorMessage("File must be up to 500KB in size.", "customize.php");
				$uploadOk = 0;
			}

			// Allow certain file formats
			elseif($sign_imageFileType != "jpg" && $sign_imageFileType != "png" && $sign_imageFileType != "jpeg" && $sign_imageFileType != "gif" ) {
			    displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", "customize.php");
			    $sign_uploadOk = 0;
			}

			// Check if $sign_uploadOk is set to 0 by an error
			elseif ($sign_uploadOk == 0) {
			    displayErrorMessage("Your file was not uploaded.", "customize.php");

			// if everything is ok, try to upload file
			} else {

				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $sign_target_file)) {
					$update = mysqli_query($conn, "UPDATE customization SET picture='$file' WHERE customID='$customID' ");
					displayUpdateMessage($update, "Image customization has been updated!", "customize.php");
				} else {
			    	displayErrorMessage("There was an error uploading your digital signature.", "customize.php");
				}
			}
		}
	}
	



	// SET ACTIVE - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['setActive_customization'])) {
		$customID = $_POST['customID'];
		$exist = mysqli_query($conn, "SELECT * FROM customization WHERE status='Active' ");
		if(mysqli_num_rows($exist) > 0) {
			$update = mysqli_query($conn, "UPDATE customization SET status='Inactive'");
			if($update) {
				$update2 = mysqli_query($conn, "UPDATE customization SET status='Active' WHERE customID='$customID'");
	        	displayUpdateMessage($update2, "Image is now Active.", "customize.php");
	        } else {
				displayErrorMessage("Something went wrong while settings the image as Active.", "customize.php");
	        }  
		} else {
			$update2 = mysqli_query($conn, "UPDATE customization SET status='Active' WHERE customID='$customID'");
			displayUpdateMessage($update2, "Image is now Active.", "customize.php");
		}
	}




	// UPDATE ACTIVITIY - ACTIVITY_UPDATE_DELETE.PHP
	if(isset($_POST['update_activity'])) {
		$actId 			= $_POST['actId'];
		$activity       = $_POST['activity'];
		$actDate        = $_POST['actDate'];
		$date_acquired  = date('Y-m-d');
		$update = mysqli_query($conn, "UPDATE announcement SET actName='$activity', actDate='$actDate' WHERE actId='$actId'");
		displayUpdateMessage($update, "Announcement has been updated.", "announcement.php");
	}







?>

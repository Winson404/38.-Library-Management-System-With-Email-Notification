<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }

	
	function updateSystemUser($conn, $user_Id, $dept, $yr_lvl, $teacher_major, $user_type, $page) {
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$birthplace     = ucwords(mysqli_real_escape_string($conn, $_POST['birthplace']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		$civilstatus    = ucwords(mysqli_real_escape_string($conn, $_POST['civilstatus']));
		$occupation     = ucwords(mysqli_real_escape_string($conn, $_POST['occupation']));
		$religion       = ucwords(mysqli_real_escape_string($conn, $_POST['religion']));
		$email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no       = ucwords(mysqli_real_escape_string($conn, $_POST['house_no']));
		$street_name    = ucwords(mysqli_real_escape_string($conn, $_POST['street_name']));
		$purok          = ucwords(mysqli_real_escape_string($conn, $_POST['purok']));
		$zone           = ucwords(mysqli_real_escape_string($conn, $_POST['zone']));
		$barangay       = ucwords(mysqli_real_escape_string($conn, $_POST['barangay']));
		$municipality   = ucwords(mysqli_real_escape_string($conn, $_POST['municipality']));
		$province       = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
		$region         = ucwords(mysqli_real_escape_string($conn, $_POST['region']));

		$file             = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id'");
		if(mysqli_num_rows($check_email) > 0) {
	       displayErrorMessage("Email already exists.", $page);
		} else {
			if(empty($file)) {
				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', dept='$dept', yr_lvl='$yr_lvl', teacher_major='$teacher_major', user_type='$user_type' WHERE user_Id='$user_Id' ");
				displayUpdateMessage($update, $page);
			} else {
				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    displayErrorMessage("File is not an image.", $page);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				    displayErrorMessage("File must be up to 500KB in size.", $page);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					displayErrorMessage("Your file was not uploaded.", $page);
				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type', image='$file', dept='$dept', yr_lvl='$yr_lvl', teacher_major='$teacher_major' WHERE user_Id='$user_Id' ");
              	     displayUpdateMessage($update, "Record has been updated.", $page);
					} else {
	    	            displayErrorMessage("There was an error uploading your profile picture.", $page);
					}
				}
			}
		}
	}





	// CHANGE ADMIN PASSWORD - ADMIN/ADMIN_DELETE.PHP
	function changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, $page) {

	    $check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	    if (mysqli_num_rows($check_old_password) === 1) {
	        if ($password != $cpassword) {
	            displayErrorMessage("Password did not match.", $page);
	        } else {
	            $update = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id'");
	            displayUpdateMessage($update, $page);
	        }
	    } else {
	    	displayErrorMessage("Old password is incorrect.", $page);
	    }
	}



	// UPDATE CATEGORY - CATEGORY.PHP
	function update_category($conn, $cat_ID, $call_num, $cat_name, $cat_desc, $page) {
	    $check = mysqli_query($conn, "SELECT * FROM category_can_be_deleted WHERE call_num='$call_num' AND cat_ID != '$cat_ID'");
	    if (mysqli_num_rows($check) === 1) {
	        displayErrorMessage("Category call number already exists", $page);
	    } else {
	    	$update = mysqli_query($conn, "UPDATE category_can_be_deleted SET call_num='$call_num', cat_name='$cat_name', cat_desc='$cat_desc' WHERE cat_ID='$cat_ID'");
            displayUpdateMessage($update, $page);
	    }
	}



	// UPDATE BOOK - BOOK.PHP
	function update_book($conn, $book_ID, $call_num, $accession_num, $title, $sub_title, $sub_title_series, $author, $publisher, $place_published, $date_published, $edition, $volume, $copyright, $isbn, $qty, $qty_available, $page) {
	    $checkStmt = mysqli_prepare($conn, "SELECT * FROM books WHERE accession_num = ? AND book_ID != ? ");
	    mysqli_stmt_bind_param($checkStmt, 'si', $accession_num, $book_ID);
	    mysqli_stmt_execute($checkStmt);
	    mysqli_stmt_store_result($checkStmt);

	    if (mysqli_stmt_num_rows($checkStmt) > 0) {
	        displayErrorMessage("Book with the same accession number already exists.", $page);
	    } else {
	        $updateStmt = mysqli_prepare($conn, "UPDATE books SET call_num=?, accession_num=?, title=?, sub_title=?, sub_title_series=?, author=?, publisher=?, place_published=?, date_published=?, edition=?, volume=?, copyright=?, isbn=?, qty=?, qty_available=? WHERE book_ID=?");
	        mysqli_stmt_bind_param($updateStmt, 'sssssssssssssssi', $call_num, $accession_num, $title, $sub_title, $sub_title_series, $author, $publisher, $place_published, $date_published, $edition, $volume, $copyright, $isbn, $qty, $qty_available, $book_ID);
	        $update = mysqli_stmt_execute($updateStmt);

	        displayUpdateMessage($update, $page);
	    }
	}




	// UPDATE BORROWED BOOK STATUS - BORROWED_BOOK.PHP
	function update_borrowed_book_status($conn, $borrow_ID, $status, $reason_reject, $page) {
	    $column = '';
	    if ($status == 1) {
	        $column = 'date_approve';
	    } elseif ($status == 2) {
	        $column = 'date_released';
	    } elseif ($status == 3) {
	        $column = 'date_rejected';
	    } else {
	    	// STATUS THAT IS 4 OR 6
	        $column = 'date_returned';
	    }
	    $date_today = date('Y-m-d');

	    $updateStmt = mysqli_prepare($conn, "UPDATE borrowed_books SET status=?, reason_reject=?, $column=? WHERE borrow_ID = ?");
	    mysqli_stmt_bind_param($updateStmt, 'isss', $status, $reason_reject, $date_today, $borrow_ID);
	    $update = mysqli_stmt_execute($updateStmt);
	    displayUpdateMessage($update, $page);
	}










	// UPDATE ADMIN PROFILE - ADMIN/PROFILE.PHP || || USER/PROFILE.PHP
	function updateProfileAdmin($conn, $user_Id, $page) {
	    $file = basename($_FILES["fileToUpload"]["name"]);
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . $file;
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if ($check === false) {
	        displayErrorMessage("Selected file is not an image.", $page);
	    }

	    if ($_FILES["fileToUpload"]["size"] > 500000) {
	        displayErrorMessage("File must be up to 500KB in size.", $page);
	    }

	    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
	        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	    }

	    if ($_FILES["fileToUpload"]["error"] != 0) {
	        displayErrorMessage("Your file was not uploaded.", $page);
	    }

	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        $update = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	        displayUpdateMessage($update, $page);
	    } else {
	        displayErrorMessage("There was an error uploading your file.", $page);
	    }
	}




	// UPDATE ADMIN INFO - ADMIN/PROFILE.PHP || USER/PROFILE.PHP
	function updateProfileInfo($conn, $user_Id, $page) {
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$birthplace     = ucwords(mysqli_real_escape_string($conn, $_POST['birthplace']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		$civilstatus    = ucwords(mysqli_real_escape_string($conn, $_POST['civilstatus']));
		$occupation     = ucwords(mysqli_real_escape_string($conn, $_POST['occupation']));
		$religion       = ucwords(mysqli_real_escape_string($conn, $_POST['religion']));
		$email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no       = ucwords(mysqli_real_escape_string($conn, $_POST['house_no']));
		$street_name    = ucwords(mysqli_real_escape_string($conn, $_POST['street_name']));
		$purok          = ucwords(mysqli_real_escape_string($conn, $_POST['purok']));
		$zone           = ucwords(mysqli_real_escape_string($conn, $_POST['zone']));
		$barangay       = ucwords(mysqli_real_escape_string($conn, $_POST['barangay']));
		$municipality   = ucwords(mysqli_real_escape_string($conn, $_POST['municipality']));
		$province       = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
		$region         = ucwords(mysqli_real_escape_string($conn, $_POST['region']));
		

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id' ");
		if(mysqli_num_rows($check_email) > 0 ) {
		   $_SESSION['message'] = "";
	       displayErrorMessage("Email already exists!", $page);
		} else {
		  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

      	  displayUpdateMessage($update, $page);
		}
	}


?>




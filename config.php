<?php 
	
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$conn = mysqli_connect("localhost", "root", "", "library");
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	date_default_timezone_set('Asia/Manila');

	// get current date and time
    $date_today = date('Y-m-d');

    // get yesterday's date
	$yesterday_date = date('Y-m-d', strtotime('-1 day'));


	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\Exception;

	// require 'vendor/PHPMailer/src/Exception.php';
	// require 'vendor/PHPMailer/src/PHPMailer.php';
	// require 'vendor/PHPMailer/src/SMTP.php';

	// Get current date and time
$currentDateTime = new DateTime();
$currentDateTimeStr = $currentDateTime->format('Y-m-d H:i:s');

// Query to find overdue books
$query = "SELECT borrow_ID, return_date, place_to_use, status FROM borrowed_books WHERE status != 3 AND status != 4 AND status != 6 AND return_date < '$currentDateTimeStr'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error in query: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_assoc($result)) {
    $borrowID = $row['borrow_ID'];
    $placeToUse = $row['place_to_use'];
    $returnDate = $row['return_date'];
    
    // Calculate penalty based on place_to_use
    $penalty = 0;
    switch ($placeToUse) {
        case 'Overnight':
            $hoursLate = round((strtotime($currentDateTimeStr) - strtotime($returnDate)) / 3600);
            $penalty = $hoursLate * 5; // 5 pesos per hour
            break;

        case 'At home':
            $daysLate = round((strtotime($currentDateTimeStr) - strtotime($returnDate)) / (3600 * 24));
            $penalty = $daysLate * 10; // 10 pesos per day
            break;

        // In the library itself, no penalty
    }

    // Update status and penalty
    $updateQuery = "UPDATE borrowed_books SET status = 5, penalty = $penalty WHERE borrow_ID = $borrowID";
    $updateResult = mysqli_query($conn, $updateQuery);

    if (!$updateResult) {
        die("Error updating record: " . mysqli_error($conn));
    }
}



	// FUNCTION TO HANDLE SUCCESS MESSAGES 
	function displaySaveMessage($saveStatus, $page) {
		if ($saveStatus) {
			$_SESSION['message'] = "New record has been added.";
			$_SESSION['text'] = "Saved successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");
			exit();
		} else {
			$_SESSION['message'] = "Error.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: $page");
			exit();
		}
	}



	// FUNCTION TO HANDLE SUCCESS MESSAGES 
	function displayUpdateMessage($updateStatus, $page) {
		if ($updateStatus) {
			$_SESSION['message'] = "Record has been updated.";
			$_SESSION['text'] = "Updated successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");
			exit();
		} else {
			$_SESSION['message'] = "Error.";
			$_SESSION['text'] = "Please try again.";
			$_SESSION['status'] = "error";
			header("Location: $page");
			exit();
		}
	}


	// FUNCTION TO HANDLE ERROR MESSAGES
	function displayErrorMessage($errorMessage, $page) {
		$_SESSION['message'] = $errorMessage;
	    $_SESSION['text'] = "Please try again.";
	    $_SESSION['status'] = "error";
	    header("Location: $page");
		exit();
	}
	

?>
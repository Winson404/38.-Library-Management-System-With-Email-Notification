<?php 

include '../config.php';
include '../includes/function_create.php';


	function calculateReturnDate($duration) {
        // Current date and time
        $currentDateTime = new DateTime();

        // Debugging information
        echo "Current Date and Time: " . $currentDateTime->format('Y-m-d H:i:s') . "<br>";
        echo "Duration received: $duration<br>";

        // Calculate return date based on the selected duration
        switch ($duration) {
            case '1 Week Maximum':
                $return_date = $currentDateTime->modify('+1 week')->format('Y-m-d H:i:s');
                break;

            case 'Today @5PM':
                // If the current time is after 5 PM, set return date to tomorrow at 5 PM
                if ($currentDateTime->format('H:i:s') >= '17:00:00') {
                    $return_date = $currentDateTime->modify('+1 day')->format('Y-m-d') . ' 17:00:00';
                } else {
                    $return_date = $currentDateTime->format('Y-m-d') . ' 17:00:00';
                }
                break;

            case 'Until tomorrow @ 8:00 AM':
                $return_date = $currentDateTime->modify('+1 day')->format('Y-m-d') . ' 08:00:00'; // Tomorrow at 8AM
                break;

            case '3 Months Maximum':
                $return_date = $currentDateTime->modify('+3 months')->format('Y-m-d H:i:s');
                break;

            case '1 Month Maximum':
                $return_date = $currentDateTime->modify('+1 month')->format('Y-m-d H:i:s');
                break;

            default:
                // Handle other cases or provide a default value
                $return_date = $currentDateTime->format('Y-m-d H:i:s');
                break;
        }

        // Debugging information
        echo "Calculated Return Date: $return_date<br>";

        return $return_date;
    }
	

    function getUserType($conn, $user_ID) {
    	$query = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_ID'");
    	$row = mysqli_fetch_array($query);

    	$user_type = $row['user_type'];
    	return $user_type;
    }

    function checkBorrowingEligibility($conn, $user_ID, $place_to_use, $book_ID) {
        // Check if the user has already borrowed the same book with status not equal to 3 or 4
        $query1 = "SELECT * FROM borrowed_books 
                  WHERE user_ID = $user_ID AND book_ID = $book_ID AND (status != 3 AND status != 4)";
        $result1 = mysqli_query($conn, $query1);

        if (mysqli_num_rows($result1) > 0) {
            return "You have already borrowed this book";
        }

        // Check the maximum number of books the user can borrow based on user_type and place_to_use
        $maxBooks = 0;

        // Assuming 'student' and 'teacher' are the values in the user_type column
        $userType = getUserType($conn, $user_ID); // You need to implement this function

        if ($userType == 'Student') {
            if ($place_to_use == 'At home') {
                $maxBooks = 3;
            } elseif ($place_to_use == 'Overnight') {
                $maxBooks = 2;
            }
        } elseif ($userType == 'Teacher') {
            // Teachers can borrow any number of books with no book limit
            $maxBooks = PHP_INT_MAX; // Set to a very large number, practically unlimited
        }

        // Check if the user has borrowed the maximum number of books for the specified place_to_use
        $query = "SELECT COUNT(*) as borrowedCount FROM borrowed_books 
                  WHERE user_ID = $user_ID AND place_to_use = '$place_to_use' AND (status != 3 AND status != 4)";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            // Check if there is an error in the query
            return "Error in query: " . mysqli_error($conn);
        }

        $row = mysqli_fetch_assoc($result);

        // Debugging information
        echo "Borrowed count for $user_ID, $place_to_use: " . $row['borrowedCount'];

        if ($row['borrowedCount'] >= $maxBooks) {
            if ($place_to_use == 'At home') {
                return "You can only borrow a maximum of 3 books to use at home";
            } elseif ($place_to_use == 'Overnight') {
                return "You can only borrow a maximum of 2 books to use overnight";
            }
        }

        // If none of the conditions are met, the user is eligible to borrow the book
        return null;
    }


	// SAVE BORROWING BOOK - INDEX/BOOK-INFO.PHP
	if (isset($_POST['borrow_book'])) {
	    $book_title   = $_POST['book_title'];
	    $user_ID      = $_POST['user_ID'];
	    $book_ID      = $_POST['book_ID'];
	    $place_to_use = $_POST['place_to_use'];
	    $duration     = $_POST['duration'];
	    $symbols      = $_POST['symbols'];
	    $return_date = calculateReturnDate($duration);

	    // Check eligibility before borrowing
	    $eligibilityMessage = checkBorrowingEligibility($conn, $user_ID, $place_to_use, $book_ID);

	    if ($eligibilityMessage) {
	        // User is not eligible to borrow
	        displayErrorMessage($eligibilityMessage, "index.php?book_title=".$book_title);
	    } else {
	        // User is eligible, proceed to borrow the book
	        // Calculate the actual return date based on the selected duration
	        $return_date = calculateReturnDate($duration);
	        // echo "Calculated Return Date: $return_date";

	        // Uncomment the following line once the issue is resolved
	        borrowBook($conn, "index.php?book_title=".$book_title."", $user_ID, $book_ID, $place_to_use, $duration, $return_date, $symbols);
	    }

	    // borrowBook($conn, "index.php?book_title=" . $book_title . "", $user_ID, $book_ID, $place_to_use, $return_date, $symbols);
	}


?>

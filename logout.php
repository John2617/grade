<?php
session_start();
if (isset($_SESSION['ID'])) {
    $userId = $_SESSION['ID']; // Save the user ID before destroying the session
    session_destroy(); // Destroy the session
    
    // Database connection
    include 'db.php';

    // Insert a record into the history_log table
    $query = "INSERT INTO history_log (transaction, user_id, date_added) VALUES ('logged out', '$userId', NOW())";
    
    if (mysqli_query($conn, $query)) {
        // Redirect to login page after successful insertion
        header("Location: login.php");
        exit();
    } else {
        // Handle query failure
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to login if no session exists
    header("Location: login.php");
    exit();
}
?>

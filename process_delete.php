<?php
session_start();

// ----------------------------------------------------
// Database Configuration
// ----------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_experiment_db";

// Function to handle redirection and feedback
function redirect_with_message($message, $is_success = true) {
    $prefix = $is_success ? "✅ Success:" : "❌ Error:";
    $_SESSION['delete_message'] = $prefix . " " . $message;
    header("Location: manage_users.php");
    exit();
}

// 1. Check if an ID was passed in the URL
if (isset($_GET['id'])) {
    
    // Sanitize and validate the ID
    $user_id_to_delete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$user_id_to_delete) {
        redirect_with_message("Invalid user ID provided for deletion.", false);
    }

    // 2. Database Connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        redirect_with_message("Database connection failed.", false);
    }

    // 3. PREPARED STATEMENT for Secure DELETE (CRUCIAL Requirement)
    $sql = "DELETE FROM users WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        redirect_with_message("Error preparing statement: " . $conn->error, false);
    }
    
    // Bind the integer parameter
    $stmt->bind_param("i", $user_id_to_delete);
    
    // 4. Execute the Statement
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            redirect_with_message("User ID **$user_id_to_delete** successfully deleted.", true);
        } else {
            redirect_with_message("User ID **$user_id_to_delete** was not found in the database.", false);
        }
    } else {
        redirect_with_message("Error during deletion: " . $stmt->error, false);
    }

    // 5. Close statement and connection
    $stmt->close();
    $conn->close();

} else {
    // If accessed without an ID
    redirect_with_message("No user ID specified for deletion.", false);
}
?>
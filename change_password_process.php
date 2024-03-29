<?php
include "config.php";

// Check if the 'token' key exists in the URL
if (isset($_GET['token'])) {
    // Output the token value for debugging purposes
    $token = $con->real_escape_string($_GET['token']);
    

    // Prepare and execute the SQL query to select the user based on the token
    $stmt = $con->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given token exists
    if ($result->num_rows == 1) {
        // If the 'change' button is clicked, proceed to update the password
        if (isset($_POST['change'])) {
            $email = $con->real_escape_string($_POST['email']);
            $new_password = $_POST['pass'];
            $hashedpword = password_hash($new_password, PASSWORD_DEFAULT);

            // Prepare and execute the SQL query to update the user's password
            $stmt = $con->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashedpword, $email);
            $stmt->execute();

            // Check if the password update was successful
            if ($con->affected_rows > 0) {
                
                header("refresh: 1; url=resetsuccess.php");
                exit;
            } else {
                echo "Password update failed.";
            }
        }
    } else {
        echo "Invalid token.";
    }
} else {
    // Handle the case when 'token' is not present in the URL
    echo "Token is missing in the URL.";
}
?>

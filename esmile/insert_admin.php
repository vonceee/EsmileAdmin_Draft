<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = "";     // Replace with your DB password
$dbname = "esmile_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Validate passwords
    if ($password === $re_password) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind SQL query to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO admin_details (First_Name, Middle_Name, Last_Name, Password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first_name, $middle_name, $last_name, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to the admin list page after successful insertion
            header("Location: adminlist.html"); // Redirect to adminlist.html
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Passwords do not match!";
    }
}

// Close connection
$conn->close();
?>

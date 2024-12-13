<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'esmile_db';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$dob = $_POST['dob'];
$mobile_no = $_POST['mobile_no'];
$sex = $_POST['sex'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind SQL query
$stmt = $conn->prepare("INSERT INTO dentist_details (First_Name, Middle_Name, Last_Name, DOB, Mobile_no, Sex, Email, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $first_name, $middle_name, $last_name, $dob, $mobile_no, $sex, $email, $hashed_password);

// Execute query
if ($stmt->execute()) {
    // Redirect to the previous page or a success page
    header("Location: dentist_list.php"); // Change to your desired redirect URL
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
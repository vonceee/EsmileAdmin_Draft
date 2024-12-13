<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = "";     // Replace with your DB password
$dbname = "esmile_db"; // Replace with your database name

header('Content-Type: application/json');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch data from dentist_details table
$sql = "SELECT First_Name, Middle_Name, Last_Name, DOB, Mobile_no, Sex, Email FROM dentist_details";
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    echo json_encode(["error" => "SQL Query Failed: " . $conn->error]);
    exit;
}

$data = [];
// Check if there are results
if ($result->num_rows > 0) {
    // Fetch each row and store it in the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return data as JSON
echo json_encode($data);

$conn->close();
?>

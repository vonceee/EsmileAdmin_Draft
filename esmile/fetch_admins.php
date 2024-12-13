<?php
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

// Fetch data from admin_details
$sql = "SELECT First_Name, Middle_Name, Last_Name FROM admin_details";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    // Fetch each row and store in the array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>

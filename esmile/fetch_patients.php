<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Database connection details
$host = 'localhost'; // Database host
$dbname = 'esmile_db';  // Database name
$username = 'root';  // Database username (change if necessary)
$password = '';      // Database password (change if necessary)

// Create a PDO instance (connection)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit;
}

// Query to fetch patients data
$query = "SELECT first_name, last_name, dob, telephone_no, sex, email FROM patient_details";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    // Fetch all rows
    $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Check if data is available
    if ($patients) {
        echo json_encode($patients); // Return the data as JSON
    } else {
        echo json_encode(["error" => "No patients found"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
}
?>

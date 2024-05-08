<?php
require_once 'connect.php';

// Get the current year
$currentYear = date('Y');

// Fetch appointments for the current year from the database
$sql = "SELECT * FROM appointments WHERE YEAR(appointment_date) = '$currentYear'";
$result = $_con->query($sql);

// Initialize an array to store appointments
$appointments = [];

// Check if appointments exist
if ($result->num_rows > 0) {
    // Fetch and store appointments in the array
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($appointments);
?>

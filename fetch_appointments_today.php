<?php
// Include the database connection file
require_once 'connect.php';

// Get today's date
$today = date('Y-m-d');

// Query to fetch appointments scheduled for today
$sql = "SELECT * FROM appointments WHERE appointment_date = '$today'";

$result = $_con->query($sql);

if ($result->num_rows > 0) {
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    // Output appointments as JSON
    echo json_encode($appointments);
} else {
    // No appointments for today
    echo json_encode([]);
}

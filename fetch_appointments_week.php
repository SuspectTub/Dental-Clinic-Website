<?php
// Include the database connection file
require_once 'connect.php';

// Get the start and end dates of the current week
$startOfWeek = date('Y-m-d', strtotime('monday this week'));
$endOfWeek = date('Y-m-d', strtotime('sunday this week'));

// Query to fetch appointments scheduled for the current week
$sql = "SELECT * FROM appointments WHERE appointment_date BETWEEN '$startOfWeek' AND '$endOfWeek'";

$result = $_con->query($sql);

if ($result->num_rows > 0) {
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
    // Output appointments as JSON
    echo json_encode($appointments);
} else {
    // No appointments for the current week
    echo json_encode([]);
}

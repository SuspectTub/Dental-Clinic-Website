<?php
require_once 'connect.php'; // Include the putanginang database connection file

// Get the start and end dates of the current week
$startOfWeek = date('Y-m-d', strtotime('monday this week'));
$endOfWeek = date('Y-m-d', strtotime('sunday this week'));

// Fetch appointments for the current week from the database
$sql = "SELECT name, appointment_date, appointment_time FROM appointments WHERE appointment_date BETWEEN '$startOfWeek' AND '$endOfWeek'";
$result = $_con->query($sql);

// Check if appointments exist for the current week
if ($result->num_rows > 0) {
    // Appointments exist, display them in the table
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["appointment_time"] . "</td>"; // Assuming there's a column for appointment time
        // Add more columns if needed
        echo "</tr>";
    }
} else {
    // No appointments found for the current week
    echo "<tr><td colspan='2'>No appointments scheduled for this week.</td></tr>";
}

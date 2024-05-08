<?php
require_once 'connect.php'; // Include the database connection file

// Check if the appointment ID is provided
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare a SQL statement to delete the appointment
    $sql = "DELETE FROM appointments WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $_con->prepare($sql);

    if ($stmt) {
        // Bind the appointment ID parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Appointment successfully deleted
            echo "Appointment successfully deleted.";
        } else {
            // Failed to delete appointment
            echo "Failed to delete appointment.";
        }

        // Close the statement shit
        $stmt->close();
    } else {
        // Failed to prepare statement
        echo "Error: " . $_con->error;
    }
} else {
    // No appointment ID provided
    echo "No appointment ID provided.";
}

// Close the database connection
$_con->close();
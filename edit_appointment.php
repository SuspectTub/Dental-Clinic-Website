<?php
// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'connect.php'; // Include the database connection file

// Add this line at the beginning to enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debugging: Log received form data
error_log('Received form data: ' . print_r($_POST, true));

// Check if the appointment ID is provided
if(isset($_POST['edit_id'])) {
    $appointmentId = $_POST['edit_id'];

// Retrieve updated appointment details from the form
$name = isset($_POST['edit_name']) ? $_POST['edit_name'] : '';
$age = isset($_POST['edit_age']) ? $_POST['edit_age'] : '';
$address = isset($_POST['edit_address']) ? $_POST['edit_address'] : '';
$medicalHistory = isset($_POST['edit_medical_history']) ? $_POST['edit_medical_history'] : '';
$doctorSelection = isset($_POST['edit_doctor_selection']) ? $_POST['edit_doctor_selection'] : '';
$appointmentDate = isset($_POST['edit_appointment_date']) ? $_POST['edit_appointment_date'] : '';
$chiefComplaint = isset($_POST['edit_chief_complaint']) ? $_POST['edit_chief_complaint'] : '';
$patientType = isset($_POST['edit_patient_type']) ? $_POST['edit_patient_type'] : '';

    // Prepare the SQL statement to update the appointment details
    $sql = "UPDATE appointments SET name=?, age=?, address=?, medical_history=?, doctor_selection=?, appointment_date=?, chief_complaint=?, patient_type=? WHERE id=?";

    // Prepare and bind the SQL statement
    if($stmt = $_con->prepare($sql)) {
        $stmt->bind_param("sissssssi", $name, $age, $address, $medicalHistory, $doctorSelection, $appointmentDate, $chiefComplaint, $patientType, $appointmentId);

        // Execute the query
        if($stmt->execute()) {
            // If update is successful, return success response
            echo json_encode(array('success' => 'Appointment details updated successfully'));
            header('Location: ./adminDashboard.php');
            exit();
        } else {
            // If query execution fails, return error response
            echo json_encode(array('error' => 'Failed to update appointment details'));
        }

        // Close the statement
        $stmt->close();
    } else {
        // If statement preparation fails, return error response
        echo json_encode(array('error' => 'Failed to prepare statement'));
    }
} else {
    // If appointment ID is not provided, return error response
    echo json_encode(array('error' => 'Appointment ID is required'));
}

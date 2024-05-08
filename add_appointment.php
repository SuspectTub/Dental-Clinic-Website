<?php
require_once 'connect.php'; // Include the database connection file

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $name = mysqli_real_escape_string($_con, $_POST['name']);
    $age = mysqli_real_escape_string($_con, $_POST['age']);
    $address = mysqli_real_escape_string($_con, $_POST['address']);
    $medical_history = mysqli_real_escape_string($_con, $_POST['medical_history']);
    $doctor_selection = mysqli_real_escape_string($_con, $_POST['doctor_selection']);
    $appointment_date = mysqli_real_escape_string($_con, $_POST['appointment_date']);
    $chief_complaint = mysqli_real_escape_string($_con, $_POST['chief_complaint']);
    $patient_type = mysqli_real_escape_string($_con, $_POST['patient_type']);

    // Insert the appointment data into the database
    $sql = "INSERT INTO appointments (name, age, address, medical_history, doctor_selection, appointment_date, chief_complaint, patient_type)
            VALUES ('$name', '$age', '$address', '$medical_history', '$doctor_selection', '$appointment_date', '$chief_complaint', '$patient_type')";

    if ($_con->query($sql) === TRUE) {
        // If insertion is successful, redirect back to the admin dashboard
        header("Location: adminDashboard.php");
        exit(); // Ensure that script execution stops after the redirect
    } else {
        // If an error occurs, display an error message
        echo "Error: " . $sql . "<br>" . $_con->error;
    }
}
?>

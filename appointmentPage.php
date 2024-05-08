<?php
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['name']) && !empty($_POST['age']) && !empty($_POST['address']) && !empty($_POST['medicalHistory']) && !empty($_POST['doctor']) && !empty($_POST['date']) && !empty($_POST['complain']) && !empty($_POST['patientType'])) {

        $stmt = $_con->prepare("INSERT INTO appointments (name, age, address, medical_history, doctor_selection, appointment_date, chief_complaint, patient_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sissssss", $name, $age, $address, $medicalHistory, $doctor, $date, $complain, $patientType);

        $name = $_POST['name'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $medicalHistory = $_POST['medicalHistory'];
        $doctor = $_POST['doctor'];
        $date = $_POST['date'];
        $complain = $_POST['complain'];
        $patientType = $_POST['patientType'];

        if ($stmt->execute()) {
            echo "Appointment added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Form</title>
    <link rel="stylesheet" href="appointmentPage.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="background-container">
    <div class="container">
        <header>Appointment Form</header>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <label for="age">Age</label>
            <input type="number" id="age" name="age">
            <label for="address">Address</label>
            <input type="text" id="address" name="address">
            <label for="medicalHistory">Medical History/Medication:</label>
            <textarea id="medicalHistory" rows="6" name="medicalHistory"></textarea>
            <select id="doctor" name="doctor">
                <option value="Dr. Cristina Nery">Dr. Cristina Nery</option>
                <option value="Dr. Crisland Nery">Dr. Crisland Nery</option>
                <option value="Dr. Joan Sunico">Dr. Joan Sunico</option>
            </select>
            <label for="date">Select a Date</label>
            <input type="date" id="date" name="date">
            <label for="complain">Chief Complain</label>
            <select id="complain" name="complain">
                <option value="Complain1">I was told that i have gum disease</option>
                <option value="Complain2">My gum bleed when I brush my teeth</option>
                <option value="Complain3">Cleaning of my teeth</option>
                <option value="Complain4">My orthodontics sent me to you before starting orthodontics</option>
                <option value="Complain5">I have a movement in my teeth</option>
                <option value="Complain6">My gum receded</option>
                <option value="Complain7">Pain in the gum</option>
                <option value="Complain8">Checkup</option>
                <option value="Complain9">Enlarged Gum</option>
                <option value="Complain10">Bad smell</option>
                <option value="Complain11">Sensitivity to cold in my teeth</option>
                <option value="Complain12">Swelling in the gum</option>
                <option value="Complain13">My gum look discolored</option>
                <option value="Complain14">My implantologist sent me before implant placement</option>
            </select>
            <label for="patientType">Select Patient Type</label>
            <select id="patientType" name="patientType">
                <option value="adult">Adult</option>
                <option value="child">Child</option>
            </select>
            <button type="submit">Submit</button>
        </form>
        <a href="index.php"><button id="back-button">Back</button></a>
    </div>
</div>

<script src="appointmentPage.js"></script>
</body>
</html>

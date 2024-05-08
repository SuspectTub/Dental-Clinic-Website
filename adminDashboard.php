<?php
require_once 'connect.php'; // Include the database connection file

// Initialize variables for error and success messages
$errorMessage = '';
$successMessage = '';

// Handle change username form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_username'])) {
    $newUsername = $_POST['new_username'];

    // Update the username in the database
    $updateUsernameQuery = "UPDATE admin_login SET admin_username = '$newUsername'";
    if ($_con->query($updateUsernameQuery) === TRUE) {
        $successMessage = "Username updated successfully!";
    } else {
        $errorMessage = "Error updating username: " . $_con->error;
    }
}

// Handle change password form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_password'])) {
    $newPassword = $_POST['new_password'];

    // Update the password in the database
    $updatePasswordQuery = "UPDATE admin_login SET admin_password = '$newPassword'";
    if ($_con->query($updatePasswordQuery) === TRUE) {
        $successMessage = "Password updated successfully!";
    } else {
        $errorMessage = "Error updating password: " . $_con->error;
    }
}

// Check if the appointment ID is provided
if(isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    // Query to retrieve the appointment details by ID
    $sql = "SELECT * FROM appointments WHERE id = $appointmentId";

    // Execute the query
    $result = $_con->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the appointment details
        $appointment = $result->fetch_assoc();

        // Return the appointment details in JSON format
        echo json_encode($appointment);
    } else {
        // If appointment not found, return empty response
        echo json_encode(null);
    }
} else {
    // If ID is not provided, return appropriate response
    echo json_encode(array('error' => 'No appointment ID provided'));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Side Page</title>
    <link rel="stylesheet" href="adminDashboard.css?v=<?php echo time(); ?>">
    <style>
        /* Style for scrollable appointment list */
        #appointment-list {
            max-height: 500px;
            overflow-y: auto;
        }

        /* Style for the back button */
        .back-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        /* Align the back button */
        .header-right {
            float: right;
            margin-top: 10px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="invisible-header"></div>
    <header>
        <div>
            <h1>Admin Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="#add-appointment">Add Appointment</a></li>
                    <li><a href="#appointment-list">Appointment List</a></li>
                    <li><a href="#reports">Reports</a></li>
                </ul>
            </nav>
        </div>
        <!-- Back button -->
        <div class="header-right">
            <button class="back-button" onclick="window.location.href = 'adminPanel.php';">Go back to Admin Panel</button>
        </div>
    </header>

    <div class="fading-background"></div>

    <section id="add-appointment">
        <h2>Add Appointment</h2>
        <form id="add-appointment-form" action="add_appointment.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="medical_history">Medical History:</label>
                <textarea id="medical_history" name="medical_history"></textarea>
            </div>
            <div class="form-group">
                <label for="doctor_selection">Doctor Selection:</label>
                <input type="text" id="doctor_selection" name="doctor_selection">
            </div>
            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" id="appointment_date" name="appointment_date">
            </div>
            <div class="form-group">
                <label for="chief_complaint">Chief Complaint:</label>
                <select id="chief_complaint" name="chief_complaint">
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
            </div>
            <div class="form-group">
                <label for="patient_type">Patient Type:</label>
                <select id="patient_type" name="patient_type">
                    <option value="adult">Adult</option>
                    <option value="child">Child</option>
                </select>
            </div>
            <button type="submit">Add Appointment</button>
        </form>
    </section>

    <section id="appointment-list">
        <h2>Appointment List</h2>
        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search for patient...">
            <div class="autocomplete-results" id="autocompleteResults"></div>
        </div>


<!-- -------------------------------edit appointment form -->



        <div id="edit-appointment" style="display: none;">
            <h2>Edit Appointment</h2>

            <form id="edit-appointment-form" action="edit_appointment.php" method="post" onsubmit="return validateEditForm()">
                <input type="hidden" id="edit-id" name="edit_id">

                <div class="form-group">
                    <label for="edit-name">Name:</label>
                    <input type="text" id="edit-name" name="edit_name">
                </div>
                <div class="form-group">
                    <label for="edit-age">Age:</label>
                    <input type="number" id="edit-age" name="edit_age" required>
                </div>
                <div class="form-group">
                    <label for="edit-address">Address:</label>
                    <input type="text" id="edit-address" name="edit_address" required>
                </div>
                <div class="form-group">
                    <label for="edit-medical-history">Medical History:</label>
                    <textarea id="edit-medical-history" name="edit_medical_history"></textarea>
                </div>
                <div class="form-group">
                    <label for="edit-doctor-selection">Doctor Selection:</label>
                    <input type="text" id="edit-doctor-selection" name="edit_doctor_selection">
                </div>
                <div class="form-group">
                    <label for="edit-appointment-date">Appointment Date:</label>
                    <input type="date" id="edit-appointment-date" name="edit_appointment_date">
                </div>
                <div class="form-group">
                    <label for="edit-chief-complaint">Chief Complaint:</label>
                    <select id="edit-chief-complaint" name="edit_chief_complaint">
                        <!-- OPTIONS -->
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

                </div>
                <div class="form-group">
                    <label for="edit-patient-type">Patient Type:</label>
                    <select id="edit-patient-type" name="edit_patient_type">
                        <option value="adult">Adult</option>
                        <option value="child">Child</option>
                    </select>
                </div>

                <!-- Add similar fields for other appointment details -->
                <button type="submit">Save Changes</button>
                <button type="button" onclick="cancelEdit()">Cancel</button>
            </form>
        </div>




<!-- ------------------------------------------------------------------- -->



        <!-- Appointment List Table -->
        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Address</th>
                <th>Medical History</th>
                <th>Doctor Selection</th>
                <th>Appointment Date</th>
                <th>Chief Complaint</th>
                <th>Patient Type</th>
                <th>Action</th>
            </tr>
            <?php


            // Fetch appointments from the database and order by name
$sql = "SELECT * FROM appointments ORDER BY name";
$result = $_con->query($sql);

// Check if appointments exist
if ($result->num_rows > 0) {
    // Appointments exist, display them in a table
    while($row = $result->fetch_assoc()) {
        echo "<tr>"; 
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["age"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["medical_history"] . "</td>";
        echo "<td>" . $row["doctor_selection"] . "</td>";
        echo "<td>" . $row["appointment_date"] . "</td>";
        echo "<td>" . $row["chief_complaint"] . "</td>";
        echo "<td>" . $row["patient_type"] . "</td>";
        echo "<td><button onclick=\"editAppointment(" . $row["id"] . ")\">Edit</button> <button onclick=\"deleteAppointment(" . $row["id"] . ")\">Delete</button></td>";
        echo "</tr>";
    }
} else {
    // No appointments found
    echo "<tr><td colspan='9'>No appointments found.</td></tr>";
}


            

            
            ?>
        </table>

        <table>
            <!-- Table headers -->
            <tbody id="appointment-list-body">
                <!-- Table rows will be dynamically added here -->
            </tbody>
        </table>

    </section>

    <section id="reports">
        <h2>Reports</h2>

        <!-- Appointments for the Day -->
        <div id="day-appointments">
            <h3>Appointments for Today</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Time</th>
                        <!-- Add more columns if needed -->
                    </tr>
                </thead>
                <tbody id="day-appointment-list">
                    <!-- Appointments for the day will be dynamically added here -->
                </tbody>
            </table>
        </div>

        <!-- Appointments for the Week -->
        <div id="week-appointments">
            <h3>Appointments for the Week</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Appointment Date</th>
                        <!-- Add more columns if needed -->
                    </tr>
                </thead>
                <tbody id="week-appointment-list">
                    <!-- Appointments for the week will be dynamically added here -->
                </tbody>
            </table>
        </div>

        <!-- Monthly Reports -->
        <div id="month-appointments">
            <h3>Appointments for the Month</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Appointment Date</th>
                        <!-- Add more columns if needed -->
                    </tr>
                </thead>
                <tbody id="month-appointment-list">
                    <!-- Appointments for the month will be dynamically added here -->
                </tbody>
            </table>
        </div>

        <!-- Yearly Reports -->
        <div id="year-appointments">
            <h3>Appointments for the Year</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Appointment Date</th>
                        <!-- Add more columns if needed -->
                    </tr>
                </thead>
                <tbody id="year-appointment-list">
                    <!-- Appointments for the year will be dynamically added here -->
                </tbody>
            </table>
        </div>
    </section>

    <section id="change-credentials">
        <h2>Change Username and Password</h2>
        <?php if (isset($errorMessage)) { ?>
            <p><?php echo $errorMessage; ?></p>
        <?php } elseif (isset($successMessage)) { ?>
            <p><?php echo $successMessage; ?></p>
        <?php } ?>
        <form id="change-credentials-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="new_username">New Username:</label>
                <input type="text" id="new_username" name="new_username" required>
            </div>
            <button type="submit" name="change_username">Change Username</button>
        </form>
        <form id="change-password-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <button type="submit" name="change_password">Change Password</button>
        </form>
    </section>

    <!-- Include the JavaScript file -->
    <script src="adminDashboard.js"></script>
    <script>
        // Function to validate the add appointment form
        function validateForm() {
            var name = document.getElementById("name").value;
            var age = document.getElementById("age").value;
            var address = document.getElementById("address").value;

            if (name == "" || age == "" || address == "") {
                alert("All fields are required");
                return false;
            }
            return true;
        }

// Function to handle editing appointments
function editAppointment(id) {
    console.log("Editing appointment with ID:", id); // Add this line for debugging
    // Retrieve the appointment details from the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'edit_appointment.php?id=' + id, true); // Pass the appointment ID as a query parameter
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // If the request is successful, display the edit form
                var appointment = JSON.parse(xhr.responseText);
                console.log("Appointment details:", appointment); // Check if appointment details are retrieved
                if (appointment) {
                    // Check if the elements exist before setting their values
                    console.log("Element edit-id exists:", document.getElementById('edit-id') !== null);
                    console.log("Element edit-name exists:", document.getElementById('edit-name') !== null);
                    // Add similar log statements for other form elements----

                    // Check if the elements exist before setting their values
                    if (document.getElementById('edit-id')) {
                        document.getElementById('edit-id').value = appointment.id;
                    }
                    if (document.getElementById('edit-name')) {
                        document.getElementById('edit-name').value = appointment.name;
                    }
                    if (document.getElementById('edit-age')) {
                        document.getElementById('edit-age').value = appointment.age;
                    }
                    if (document.getElementById('edit-address')) {
                        document.getElementById('edit-address').value = appointment.address;
                    }
                    if (document.getElementById('edit-medical-history')) {
                        document.getElementById('edit-medical-history').value = appointment.medical_history;
                    }
                    if (document.getElementById('edit-doctor-selection')) {
                        document.getElementById('edit-doctor-selection').value = appointment.doctor_selection;
                    }
                    if (document.getElementById('edit-appointment-date')) {
                        document.getElementById('edit-appointment-date').value = appointment.appointment_date;
                    }
                    if (document.getElementById('edit-chief-complaint')) {
                        document.getElementById('edit-chief-complaint').value = appointment.chief_complaint;
                    }
                    if (document.getElementById('edit-patient-type')) {
                        document.getElementById('edit-patient-type').value = appointment.patient_type;
                    }

                    // Display the edit form
                    document.getElementById('edit-appointment').style.display = 'block';
                } else {
                    alert('Appointment not found!');
                }
            } else {
                // If the request fails, show an error message
                alert('Failed to retrieve appointment details!');
            }
        }
    };
    xhr.send();
}












        // Function to handle deleting appointments
        function deleteAppointment(id) {
            if (confirm("Are you sure you want to delete this appointment?")) {
                // Send a request to delete the appointment
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete_appointment.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Appointment successfully deleted, reload the page to update the list
                            window.location.reload();
                        } else {
                            // Failed to delete appointment, show an error message
                            alert('Failed to delete appointment!');
                        }
                    }
                };
                xhr.send('id=' + id);
            }
        }

        // Fetch appointments for the current day and display them
        function fetchAppointmentsForToday() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_appointments_today.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var appointments = JSON.parse(xhr.responseText);
                        var dayAppointmentList = document.getElementById('day-appointment-list');
                        // Clear previous appointments
                        dayAppointmentList.innerHTML = '';
                        // Display appointments in the table
                        if (appointments.length > 0) {
                            appointments.forEach(function(appointment) {
                                var row = "<tr>";
                                row += "<td>" + appointment.name + "</td>";
                                row += "<td>" + appointment.appointment_date + "</td>"; // Displaying appointment date only
                                // Add more columns if needed
                                row += "</tr>";
                                dayAppointmentList.innerHTML += row;
                            });
                        } else {
                            // If no appointments found
                            dayAppointmentList.innerHTML = "<tr><td colspan='2'>No appointments scheduled for today.</td></tr>";
                        }
                    } else {
                        // If the request fails, show an error message
                        console.error('Failed to fetch appointments for today.');
                    }
                }
            };
            xhr.send();
        }

        // Fetch appointments for the current week and display them
        function fetchAppointmentsForWeek() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_appointments_week.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var appointments = JSON.parse(xhr.responseText);
                        var weekAppointmentList = document.getElementById('week-appointment-list');
                        // Clear previous appointments
                        weekAppointmentList.innerHTML = '';
                        // Display appointments in the table
                        if (appointments.length > 0) {
                            appointments.forEach(function(appointment) {
                                var row = "<tr>";
                                row += "<td>" + appointment.name + "</td>";
                                row += "<td>" + appointment.appointment_date + "</td>";
                                // Add more columns if needed
                                row += "</tr>";
                                weekAppointmentList.innerHTML += row;
                            });
                        } else {
                            // If no appointments found
                            weekAppointmentList.innerHTML = "<tr><td colspan='2'>No appointments scheduled for this week.</td></tr>";
                        }
                    } else {
                        // If the request fails, show an error message
                        console.error('Failed to fetch appointments for the week.');
                    }
                }
            };
            xhr.send();
        }

        // Fetch appointments for the current month and display them
        function fetchAppointmentsForMonth() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'appointment_month.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var appointments = JSON.parse(xhr.responseText);
                        var monthAppointmentList = document.getElementById('month-appointment-list');
                        // Clear previous appointments
                        monthAppointmentList.innerHTML = '';
                        // Display appointments in the table
                        if (appointments.length > 0) {
                            appointments.forEach(function(appointment) {
                                var row = "<tr>";
                                row += "<td>" + appointment.name + "</td>";
                                row += "<td>" + appointment.appointment_date + "</td>";
                                // Add more columns if needed
                                row += "</tr>";
                                monthAppointmentList.innerHTML += row;
                            });
                        } else {
                            // If no appointments found
                            monthAppointmentList.innerHTML = "<tr><td colspan='2'>No appointments scheduled for this month.</td></tr>";
                        }
                    } else {
                        // If the request fails, show an error message
                        console.error('Failed to fetch appointments for the month.');
                    }
                }
            };
            xhr.send();
        }

        // Fetch appointments for the current year and display them
        function fetchAppointmentsForYear() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'appointment_year.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var appointments = JSON.parse(xhr.responseText);
                        var yearAppointmentList = document.getElementById('year-appointment-list');
                        // Clear previous appointments
                        yearAppointmentList.innerHTML = '';
                        // Display appointments in the table
                        if (appointments.length > 0) {
                            appointments.forEach(function(appointment) {
                                var row = "<tr>";
                                row += "<td>" + appointment.name + "</td>";
                                row += "<td>" + appointment.appointment_date + "</td>";
                                // Add more columns if needed
                                row += "</tr>";
                                yearAppointmentList.innerHTML += row;
                            });
                        } else {
                            // If no appointments found
                            yearAppointmentList.innerHTML = "<tr><td colspan='2'>No appointments scheduled for this year.</td></tr>";
                        }
                    } else {
                        // If the request fails, show an error message
                        console.error('Failed to fetch appointments for the year.');
                    }
                }
            };
            xhr.send();
        }

        // Fetch appointments for today, week, month, and year when the page loads
        window.onload = function() {
            fetchAppointmentsForToday();
            fetchAppointmentsForWeek();
            fetchAppointmentsForMonth();
            fetchAppointmentsForYear();
        };



        
            // Function to handle search functionality
    document.addEventListener("DOMContentLoaded", function() {
        var searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', function() {
            var filter = searchInput.value.toUpperCase();
            var appointmentList = document.getElementById('appointment-list').getElementsByTagName('tr');
            for (var i = 0; i < appointmentList.length; i++) {
                var patientName = appointmentList[i].getElementsByTagName('td')[0];
                if (patientName) {
                    var txtValue = patientName.textContent || patientName.innerText;
                    if (txtValue.toUpperCase().startsWith(filter)) {
                        appointmentList[i].style.display = '';
                    } else {
                        appointmentList[i].style.display = 'none';
                    }
                }
            }
        });

        // Function to handle clearing the search bar
        document.getElementById('searchInput').addEventListener('input', function() {
            var filter = searchInput.value.toUpperCase();
            var appointmentList = document.getElementById('appointment-list').getElementsByTagName('tr');
            for (var i = 0; i < appointmentList.length; i++) {
                var patientName = appointmentList[i].getElementsByTagName('td')[0];
                if (patientName) {
                    var txtValue = patientName.textContent || patientName.innerText;
                    if (txtValue.toUpperCase().startsWith(filter) || filter === '') {
                        appointmentList[i].style.display = '';
                    } else {
                        appointmentList[i].style.display = 'none';
                    }
                }
            }
        });
    });



    </script>
</body>
</html>

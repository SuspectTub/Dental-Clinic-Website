document.addEventListener("DOMContentLoaded", function() {
    // DOM content has been fully loaded, so we can start working with it
    
    // Get the form element
    const addAppointmentForm = document.getElementById("add-appointment-form");

    // Add event listener for form submission
    addAppointmentForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Call the function to validate form fields
        if (validateForm()) {
            // If form validation is successful, submit the form using AJAX
            const formData = new FormData(addAppointmentForm); // Get form data
            const xhr = new XMLHttpRequest(); // Create new XMLHttpRequest object
            xhr.open('POST', 'add_appointment.php', true); // Set up the request
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // If the request is successful, handle the response
                        const newAppointment = JSON.parse(xhr.responseText); // Parse JSON response
                        // Update the UI to display the new appointment
                        if (newAppointment) {
                            displayNewAppointment(newAppointment); // Function to display new appointment
                        }
                    } else {
                        // If the request fails, show an error message
                        alert('Failed to add appointment. Please try again.');
                    }
                }
            };
            xhr.send(formData); // Send the form data
        }
    });

    // Function to validate form fields
    function validateForm() {
        // Get form fields
        const name = document.getElementById("name");
        const age = document.getElementById("age");
        const address = document.getElementById("address");

        // Validate name, age, and address fields
        if (name.value.trim() === "") {
            alert("Please enter a name.");
            name.focus();
            return false;
        }

        if (age.value.trim() === "") {
            alert("Please enter an age.");
            age.focus();
            return false;
        }

        if (address.value.trim() === "") {
            alert("Please enter an address.");
            address.focus();
            return false;
        }

        // Form is valid
        return true;
    }

    // Function to display the new appointment on the UI
    function displayNewAppointment(appointment) {
        const appointmentListTable = document.querySelector('#appointment-list table tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${appointment.name}</td>
            <td>${appointment.age}</td>
            <td>${appointment.address}</td>
            <td>${appointment.medical_history}</td>
            <td>${appointment.doctor_selection}</td>
            <td>${appointment.appointment_date}</td>
            <td>${appointment.chief_complaint}</td>
            <td>${appointment.patient_type}</td>
            <td>
                <button onclick="editAppointment(${appointment.id})">Edit</button>
                <button onclick="deleteAppointment(${appointment.id})">Delete</button>
            </td>
        `;
        appointmentListTable.appendChild(newRow); // Append new row to the table
    }
});

function editAppointment(id) {
    // Retrieve the appointment details from the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'edit_appointment.php?id=' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // If the request is successful, display the appointment details in a form for editing
                var appointment = JSON.parse(xhr.responseText);
                if (appointment) {
                    // Populate the form fields with the retrieved appointment details
                    document.getElementById('edit-id').value = appointment.id;
                    document.getElementById('edit-name').value = appointment.name;
                    document.getElementById('edit-age').value = appointment.age;
                    document.getElementById('edit-address').value = appointment.address;
                    document.getElementById('edit-medical-history').value = appointment.medical_history;
                    document.getElementById('edit-doctor-selection').value = appointment.doctor_selection;
                    document.getElementById('edit-appointment-date').value = appointment.appointment_date;
                    document.getElementById('edit-chief-complaint').value = appointment.chief_complaint;
                    document.getElementById('edit-patient-type').value = appointment.patient_type;
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

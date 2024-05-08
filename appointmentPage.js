function submitForm() {
    const name = document.getElementById('name').value;
    const age = document.getElementById('age').value;
    const address = document.getElementById('address').value;
    const medicalHistory = document.getElementById('medicalHistory').value;
    const selectedDoctor = document.getElementById('doctor').value;
    const selectedDate = document.getElementById('date').value;
    const selectedComplain = document.getElementById('complain').value;
    const selectedPatientType = document.getElementById('patientType').value;

    // Create a new FormData object
    const formData = new FormData();
    formData.append('name', name);
    formData.append('age', age);
    formData.append('address', address);
    formData.append('medicalHistory', medicalHistory);
    formData.append('doctor', selectedDoctor);
    formData.append('date', selectedDate);
    formData.append('complain', selectedComplain);
    formData.append('patientType', selectedPatientType);

    // Send the form data to the server using fetch API
    fetch('add_appointment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        // Handle successful response from server
        alert(data); // Display the response from the server
    })
    .catch(error => {
        // Handle errors
        console.error('There was a problem with the fetch operation:', error);
    });
}

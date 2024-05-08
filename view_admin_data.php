<?php
// Include the database connection file
require_once 'connect.php';

// Fetch all data from the admin_login table
$sql = "SELECT * FROM admin_login";
$result = $_con->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["admin_username"]. " - Password: " . $row["admin_password"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close the database connection
$_con->close();
?>

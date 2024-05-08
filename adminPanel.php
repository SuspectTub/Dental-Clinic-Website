<?php
require_once 'connect.php';

// Default username and password
$defaultUsername = "admin123";
$defaultPassword = password_hash("password123", PASSWORD_DEFAULT); // Hashed default password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $defaultUsername && password_verify($password, $defaultPassword)) {
        header("Location: adminDashboard.php");
        exit();
    } else {
        $errorMessage = "Incorrect username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="adminPanel.css?v=<?php echo time(); ?>">
<title>Login Page</title>
</head>
<body>
<div class="website-header">
    <div class="logongdentalclinic">
        <img class="header-logo" src="website-images/dental-clinic-logo.jpg">
    </div>
    <div class="namengclinicsaheader">
        <h1> Cruz Nery Dental Clinic Admin Panel</h1>
    </div>
    <div class="lalagyanngbuttons">
        <a href="index.php#home-top"><button class="button-5" role="button">Home</button></a>
        <a href="index.php#detail-section"><button class="button-5" role="button">Details</button></a>
        <a href="index.php#contact-section"><button class="button-5" role="button">Contact</button></a>
    </div>
</div>

<div class="invisheader" id="home-top">
    invis
</div>

<div class="login-container">
    <h2>Login</h2>
    <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($errorMessage)) { ?>
        <p id="error-message"><?php echo $errorMessage; ?></p>
    <?php } ?>
</div>

<script src="adminPanel.js"></script>
</body>
</html>

<!-- -------------------------php------------------------- -->
<?php
require_once 'connect.php';
?>

<!-- -------------------------HTML------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cruz Nery Dental Clinic</title>
    <link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="home.js"></script>
</head>
<body>
<!-- -------------------------header------------------------- -->
    <div class="website-header">

        <div class="logongdentalclinic">
            <img class="header-logo" src="website-images/dental-clinic-logo.jpg">
        </div>

        <div class="namengclinicsaheader">
            <h1> Cruz Nery Dental Clinic </h1>
        </div>

        <div class="lalagyanngbuttons">
        <button class="button-5" role="button" onclick='document.getElementById("home-top").scrollIntoView();'>Home</button>
            <button class="button-5" role="button" onclick='document.getElementById("detail-section").scrollIntoView();'>Details</button>
            <button class="button-5" role="button" onclick='document.getElementById("contact-section").scrollIntoView()'>Contact</button>
            <a href="adminPanel.php"><button class="button-5" role="button">Admin</button></a>
        </div>
    </div>

    <div class="invisheader" id="home-top">
        invis
    </div>
<!-- -------------------------welcome-front-page------------------------- -->
    <div class="homescreen1" id="home-section">
        <div class="title-cruzNery"> CRUZ NERY </div>
        <div class="title-dentalClinic"> Dental Clinic </div>
    </div>

    <div class="homescreen2">
    <a href="appointmentPage.php"><button class="appointment-button" role="button"><span class="text">APPOINT NOW!</span><span>CONFIRM</span></button></a>
    </div>

    <div class="homescreen3"></div>






<!-- ------------------------- detail-section ------------------------- -->
<div class="detail-section" id="detail-section">
    <div class="details-parentdiv">
        <div class="details-subparent1">
            <div class="details-subparent2">
                <div class="details-son details-background-picture1">Light Therapy</div>
                <div class="details-son details-background-picture2">Whitening</div>
                <div class="details-son details-background-picture3">Root Canal</div>
                <div class="details-son details-background-picture4">Fixed Bridge</div>
                <div class="details-son details-background-picture5">Dental Braces</div>
                <div class="details-son details-background-picture6">Veneers</div>
                <div class="details-son details-background-picture7">Wisdom Tooth</div>
                <div class="details-son details-background-picture8">Tooth Restoration</div>
                <div class="details-son details-background-picture9">Dentures</div>
                <div class="details-son details-background-picture10">Tooth extraction</div>
                <div class="details-son details-background-picture11">Oral Prophylaxis</div>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------contact-section------------------------- -->


<footer class="footer-distributed">

        <div class="footer-left">

        <h3>Cruz Nery<span> Dental Clinic</span></h3>

        <p class="footer-links">
            <a href="#" class="link-1">Home</a>

            <a href="#">Blog</a>

            <a href="#">Pricing</a>

            <a href="#">About</a>

            <a href="#">Faq</a>

            <a href="#">Contact</a>
        </p>

        <p class="footer-company-name">Cruz Nery Dental Clinic © 2024</p>
        </div>

        <div class="footer-center">

        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Norika Building, Unit 103 #70</span> E. Rodriguez Highway, San Jose, Rodriguez, Rizal</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>+02-8659-0818</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:support@company.com">cruznerydentalclinic@gmail.com</a></p>
        </div>

        </div>

        <div class="footer-right">

        <p class="footer-company-about">
            <span style="font-size: 25px;">Opening Hours</span>
            <p style="color: white; font: size 4px;">Monday - Saturday : 10am - 6pm<br>
            Sunday : 10am - 4pm</p>
        </p>

        <div class="footer-icons">

            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="https://maps.app.goo.gl/jBQDfVf8A54NZvPn9"><i class="fa fa-map"></i></a>
            <a href="#"><i class="fa fa-envelope"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>

        </div>

    </footer>

<!-- -------------------------SCRIPT------------------------- -->



<script>
    document.addEventListener("DOMContentLoaded", function() {
        var scrollableDiv = document.querySelector(".details-subparent1");
        scrollableDiv.addEventListener("wheel", function(event) {
            event.preventDefault();
            var scrollAmount = event.deltaY * 3;
            scrollableDiv.scrollLeft += scrollAmount;
        });
    });
</script>

</body>
</html>
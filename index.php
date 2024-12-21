<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>HRS | Home</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/logos/HMS_LOGO.png" />

        <!-- FONT AWSOME ICON TRANSLATOR -->
        <script src="js/FontAwsome_Icon_Translator.js"></script>

        <!--FONTS PART-->
        <link href="CSS/Montserrat_Font.css" rel="stylesheet" type="text/css" />
        <link href="CSS/Roboto_Font.css" rel="stylesheet" type="text/css" />

        <!--CORE CSS PART-->
        <link href="css/styles.css" rel="stylesheet"/>
    </head>

    
    <body id="page-top">
    <?php require_once('Homepage/Navigation.php'); ?>
    <?php require_once('Homepage/Masthead.php'); ?>
    <?php require_once('Homepage/Portfolio.php'); ?>
    <?php require_once('Homepage/chatbot.php'); ?>
    <?php require_once('Homepage/services.php'); ?>
    <?php require_once('Homepage/about.php'); ?>
    <?php require_once('Homepage/team.php'); ?>
    <?php require_once('Homepage/clients.php'); ?>
    <?php require_once('Homepage/contact.php'); ?>
    <?php require_once('Homepage/footer.php'); ?>
    <button id="backToTop">↑</button>

    <script>
        // Get the button
const backToTopButton = document.getElementById("backToTop");

// Show the button when the user scrolls down 100px
window.onscroll = function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        backToTopButton.style.display = "block";
    } else {
        backToTopButton.style.display = "none";
    }
};

// Scroll back to the top when the button is clicked
backToTopButton.onclick = function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Smooth scrolling effect
    });
};

    </script>
        <script src="JS/BootstrapBundle.js"></script>
        <script src="JS/scripts.js"></script>
        <script src="JS/BootstrapBundle2.js"></script>
        <script>
            
        </script>
        
    </body>
</html>

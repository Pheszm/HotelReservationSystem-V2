<?php
include 'db.php'; // Include your database configuration file
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']); // Escape HTML characters
}
?>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top"><img src="assets/img/logos/HMS_LOGO.png" alt="..." /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#portfolio">Rooms</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <button class="LoginBtnn" id="LoginButtnn" style="display: none;">LOGIN</button>
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php"><?php echo $username; ?></a></li>
                <?php else: ?>
                    <button class="LoginBtnn" id="LoginButtnn">LOGIN</button>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

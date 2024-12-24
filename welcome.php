<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("include/head.php");
    ?>
    <title>Signup</title>
</head>

<body>

    <?php 
    include("include/navbar.php");
    ?>

    <main class="d-flex flex-column align-items-center justify-content-center">
        
        <h1>Vielen Dank für Ihre Registrierung!</h1>
        <p>Ihre Registrierung war erfolgreich. Sie können sich jetzt mit Ihren Zugangsdaten anmelden.</p>
        <!-- Link zur Login-Seite -->
        <a href="login.php" class="btn btn-dark mt-3">Zum Login</a>        
    </main>
</body>
</html>



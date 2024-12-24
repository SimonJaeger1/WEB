<?php
    session_start();
    session_unset();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("include/head.php");
    ?>
    <title>Logout</title>
</head>

<body>

    <?php
        include("include/navbar.php");
    ?>

    <main class="d-flex align-items-center justify-content-center">
        <div class="textblock">
            <h3 class="text-center">Sie sind ausgeloggt!</h3>
            <br>
            <p class="text-center">Sie werden automatisch weitergeleitet.</p>
        </div>

        <script>
            // Automatische Weiterleitung nach 3 Sekunden
            setTimeout(function () {
                window.location.href = 'login.php';
            }, 3000);
        </script>
    </main>
</body>
</html>

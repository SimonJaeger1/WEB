<?php
    session_start();

    // Überprüfen, ob eine Reservierung in der Session vorhanden ist
    if (!isset($_SESSION["reservierung"])) {
        header("Location: reservation.php"); // Weiterleitung zurück, wenn keine Reservierung vorhanden
        exit;
    }

    // Reservierungsdetails aus der Session abrufen
    $reservierung = $_SESSION["reservierung"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("include/head.php")
    ?>
    <title>Reservation</title>
</head>

<body>

    <?php
    include("include/navbar.php")
    ?>

    <main class="d-flex align-items-center justify-content-center">
        
        <div>
            <h1 class="fs-3">Reservierungsbestätigung</h1>
            <p>Vielen Dank, Ihre Reservierung wurde erfolgreich durchgeführt! Hier sind Ihre Reservierungsdetails:</p>
            
            <ul>
                <li><strong>Name:</strong> <?php echo htmlspecialchars($reservierung["name"]); ?></li>
                <li><strong>E-Mail:</strong> <?php echo htmlspecialchars($reservierung["email"]); ?></li>
                <li><strong>Anreisedatum:</strong> <?php echo htmlspecialchars($reservierung["anreise"]); ?></li>
                <li><strong>Abreisedatum:</strong> <?php echo htmlspecialchars($reservierung["abreise"]); ?></li>
                <li><strong>Anzahl der Gäste:</strong> <?php echo htmlspecialchars($reservierung["gaeste"]); ?></li>
                <li><strong>Zimmerart:</strong> <?php echo htmlspecialchars($reservierung["zimmerart"]); ?></li>
                <li><strong>Frühstück:</strong> <?php echo htmlspecialchars($reservierung["fruehstueck"]); ?></li>
                <li><strong>Parkplatz:</strong> <?php echo htmlspecialchars($reservierung["parkplatz"]); ?></li>
                <li><strong>Haustier:</strong> <?php echo htmlspecialchars($reservierung["haustier"]); ?></li>
            </ul>

            <p>Wir freuen uns darauf, Sie bei uns begrüßen zu dürfen!</p>

            <!-- Button, um zur Startseite zurückzukehren -->
            <a href="index.php" class="btn btn-dark w-25 mt-3">Zurück zur Startseite</a>
        </div>
    </main>
</body>

<?php
    // Reservierungsdetails aus der Session entfernen, damit die Bestätigungsseite nur einmal angezeigt wird
    unset($_SESSION["reservierung"]);
?>

</html>

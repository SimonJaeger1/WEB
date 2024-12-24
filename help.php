<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("include/head.php");
    ?>
    <title>Help</title>
</head>

<body>

    <?php
    include("include/navbar.php");
    ?>

    <main class="help d-flex align-items-center text-white">
        <div class="row justify-content-around">
            <div class="col-xs-12 col-md-6 col-lg-3">
                <h1 class="fs-4">Wie kann ich Buchungen vornehmen?</h1>
                <br>
                <p class="textblock">Um Leistungen des Hotels buchen zu können, müssen Sie ein registrierter User sein.
                </p>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <h1 class="fs-4">Wie kann ich mich als User registrieren?</h1>
                <br>
                <p class="textblock">Gehen Sie zum Menüpunkt Registrierung und geben Sie Ihre Daten ein.
                    Ist die Registrierung erfolgreich, können Sie sich mit Ihren Zugangsdaten einloggen.</p>
            </div>

            <div class="scol-xs-12 col-md-6 col-lg-3">
                <h1 class="fs-4">Wie lauten die Stornobedingungen?</h1>
                <br>
                <p class="textblock">Bis zu 5 Tage vor Reiseantritt können Sie kostenfrei stornieren.
                    Zwischen 13 und 2 Tagen vor Reiseantritt müssen Sie mit 50%-Stornokosten rechnen.
                    Stornieren Sie innerhalb von 2 Tagem vor Reisenantritt, müssen wir Ihnen aus organisatorischen
                    Gründen den vollen Betrag verrechnen.</p>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <h1 class="fs-4">Gibt es Tipps für Freizeitaktivitäten?</h1>
                <br>
                <p class="textblock">In der näheren Umgebung des Hotels können Sie eine Vielzahl an Ausflügen,
                    Museumsbesuchen und
                    Sportangeboten erleben. Eine Broschüre der Freizeitaktivitäten liegt an der Rezeption vor.</p>
            </div>
        </div>
    </main>
</body>
</html>

<?php
session_start();

// SERVERSEITIGE ÜBERPRÜFUNG DER EINGEGEBEN DATEN

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php"); // Weiterleitung zur Login-Seite, wenn nicht eingeloggt
    exit;
}

// Fehler- und Variablen-Initialisierung
$nameErr = $emailErr = $anreiseErr = $abreiseErr = $gaesteErr = $zimmerartErr = "";
$name = $email = $anreise = $abreise = $gaeste = $zimmerart = "";
$fruehstueck = $parkplatz = $haustier = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Name validieren
    if (empty(trim($_POST["name"]))) {
        $nameErr = "Name ist erforderlich";
        $errors[] = $nameErr;
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }

    // E-Mail validieren
    if (empty(trim($_POST["email"]))) {
        $emailErr = "E-Mail ist erforderlich";
        $errors[] = $emailErr;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Ungültige E-Mail-Adresse";
        $errors[] = $emailErr;
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    // Anreise validieren
    if (empty($_POST["anreise"])) {
        $anreiseErr = "Anreisedatum ist erforderlich";
        $errors[] = $anreiseErr;
    } else {
        $anreise = $_POST["anreise"];
        // Überprüfen, ob das Anreisedatum in der Vergangenheit liegt
        if (strtotime($anreise) < strtotime(date("Y-m-d"))) {
            $anreiseErr = "Das Anreisedatum darf nicht in der Vergangenheit liegen";
            $errors[] = $anreiseErr;
        }
    }

    // Abreise validieren
    if (empty($_POST["abreise"])) {
        $abreiseErr = "Abreisedatum ist erforderlich";
        $errors[] = $abreiseErr;
    } elseif (strtotime($_POST["abreise"]) <= strtotime($anreise)) { //Überprüfen, ob das Abreisedatum nach dem Anreisedatum liegt
        $abreiseErr = "Abreisedatum muss nach dem Anreisedatum liegen";
        $errors[] = $abreiseErr;
    } else {
        $abreise = $_POST["abreise"];
    }

    // Gästeanzahl validieren
    if (empty($_POST["gaeste"]) || intval($_POST["gaeste"]) <= 0) {
        $gaesteErr = "Bitte Anzahl der Gäste angeben";
        $errors[] = $gaesteErr;
    } else {
        $gaeste = intval($_POST["gaeste"]);
    }

    // Zimmerart validieren
    if (empty($_POST["zimmerart"])) {
        $zimmerartErr = "Bitte Zimmerart auswählen";
        $errors[] = $zimmerartErr;
    } else {
        $zimmerart = htmlspecialchars(trim($_POST["zimmerart"]));
    }

    // Frühstück, Parkplatz, Haustiere
    $fruehstueck = isset($_POST["fruehstueck"]) ? "Ja" : "Nein";
    $parkplatz = isset($_POST["parkplatz"]) ? "Ja" : "Nein";
    $haustier = isset($_POST["haustier"]) ? "Ja" : "Nein";

    // Wenn keine Fehler aufgetreten sind, Daten für die Bestätigung in der Session speichern
    if (empty($errors)) {
        $_SESSION["reservierung"] = [
            "name" => $name,
            "email" => $email,
            "anreise" => $anreise,
            "abreise" => $abreise,
            "gaeste" => $gaeste,
            "zimmerart" => $zimmerart,
            "fruehstueck" => $fruehstueck,
            "parkplatz" => $parkplatz,
            "haustier" => $haustier
        ];
        
        // Weiterleitung zur Bestätigungsseite
        header("Location: reservation_success.php");
        exit;
    }
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("include/head.php");
    ?>
    <title>Reservation</title>
</head>

<body>

    <?php
    include("include/navbar.php");
    ?>

    <main class="d-flex align-items-center justify-content-center">

        <div class="reservation">

            <form class="row g-1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <h1 class="text-center">Reservierung</h1>

                <div class="form-group">
                    <label for="name" class="form-label visually-hidden">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>">
                    <div class="error fs-7"><?php echo $nameErr; ?></div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label visually-hidden">E-Mail:</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="E-Mail" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="error fs-7"><?php echo $emailErr; ?></div>
                </div>

                <div class="form-group">
                    <label for="anreise" class="form-label visually-hidden">Anreise:</label>
                    <input type="date" id="anreise" name="anreise" class="form-control" value="<?php echo htmlspecialchars($anreise); ?>">
                    <div class="error fs-7"><?php echo $anreiseErr; ?></div>
                </div>

                <div class="form-group">
                    <label for="abreise" class="form-label visually-hidden">Abreise:</label>
                    <input type="date" id="abreise" name="abreise" class="form-control" value="<?php echo htmlspecialchars($abreise); ?>">
                    <div class="error fs-7"><?php echo $abreiseErr; ?></div>
                </div>

                <div class="form-group">
                    <label for="gaeste" class="form-label visually-hidden">Anzahl der Gäste:</label>
                    <input type="number" id="gaeste" name="gaeste" class="form-control" placeholder="Gästeanzahl" min="1" max="6" value="<?php echo htmlspecialchars($gaeste); ?>">
                    <div class="error fs-7"><?php echo $gaesteErr; ?></div>
                </div>

                <div class="form-group">
                    <label for="zimmerart" class="form-label visually-hidden">Art des Zimmers:</label>
                    <select id="zimmerart" name="zimmerart" class="form-control">
                        <option class="text-secondary" disabled selected>Zimmer auswählen</option>
                        <option value="Einzelzimmer" <?php if ($zimmerart == "Einzelzimmer") echo "selected"; ?>>Einzelzimmer</option>
                        <option value="Doppelzimmer" <?php if ($zimmerart == "Doppelzimmer") echo "selected"; ?>>Doppelzimmer</option>
                        <option value="Suite" <?php if ($zimmerart == "Suite") echo "selected"; ?>>Suite</option>
                    </select>
                    <div class="error fs-7"><?php echo $zimmerartErr; ?></div>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="parkplatz" value="Ja" <?php if ($parkplatz == "Ja") echo "checked"; ?>> Mit Parkplatz
                    </label>
                    <label>
                        <input type="checkbox" name="fruehstueck" value="Ja" <?php if ($fruehstueck == "Ja") echo "checked"; ?>> Mit Frühstück
                    </label>
                    <label>
                        <input type="checkbox" name="haustier" value="Ja" <?php if ($haustier == "Ja") echo "checked"; ?>> Mit Haustier
                    </label>
                </div>

                <div class="form-group col-12">
                        <button type="submit" class="btn btn-dark w-100">Reservieren</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

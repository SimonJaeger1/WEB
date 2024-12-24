<?php
    session_start();

    // SERVERSEITIGE ÜBERPRÜFUNG DER EINGEGEBEN DATEN
    $vorname = $nachname = $email = $benutzername = $passwort = $passwort2 = "";
    $vornameErr = $nachnameErr = $emailErr = $benutzernameErr = $passwortErr = $passwort2Err = $agbErr = "";
    $agb = false; // AGBs standarmäßig auf false. Wenn User Häkchen setzt wird die Variable auf true gesetzt
    $valid = true; // Variable, um zu überprüfen, ob alle Anmeldedaten valide sind. Wird false gesetzt, sobald ein Feld nicht korrekt ausgefüllt wird

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["Vorname"])) {
            $vornameErr = "Geben Sie den Vornamen ein";
            $valid = false;
        } else {
            $vorname = test_input($_POST["Vorname"]);
            // Überprüfen ob der eingegebende Wert unerlaubte Zeichen beeinhaltet
            if (!preg_match("/^[a-zA-ZäöüÄÖÜß\s]*$/", $vorname)) {
                // Bei ungültigen Zeichen, Fehlermeldung initialisieren
                $vornameErr = "Nur Buchstaben und Leerzeichen erlaubt";
                $valid = false;
            }
        }
        if (empty($_POST["Nachname"])) {
            $nachnameErr = "Geben Sie den Nachnamen ein";
            $valid = false;
        } else {
            $nachname = test_input($_POST["Nachname"]);
            if (!preg_match("/^[a-zA-ZäöüÄÖÜß\s]*$/", $nachname)) {
                $nachnameErr = "Nur Buchstaben und Leerzeichen erlaubt";
                $valid = false;
            }
        }
        if (empty($_POST["Email"])) {
            $emailErr = "Geben Sie ihre Email Adresse ein";
            $valid = false;
        } else {
            $email = test_input($_POST["Email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Ungültiges Email Format";
                $valid = false;
            }
        }
        if (empty($_POST["Benutzername"])) {
            $benutzernameErr = "Geben Sie einen Benutzernamen ein";
            $valid = false;
        } else {
            $benutzername = test_input($_POST["Benutzername"]);
            if (!preg_match("/^[a-zA-ZäöüÄÖÜß\s]*$/", $benutzername)) {
                $benutzernameErr = "Nur Buchstaben und Leerzeichen erlaubt";
                $valid = false;
            }
        }
        if (empty($_POST["Passwort"])) {
            $passwortErr = "Geben Sie ein Passwort ein";
            $valid = false;
        } else {
            $passwort = test_input($_POST["Passwort"]);
        }
        if (empty($_POST["Passwort2"])) {
            $passwort2Err = "Geben Sie das Passwort erneut ein";
            $valid = false;
        } else {
            $passwort2 = test_input($_POST["Passwort2"]);
            if ($passwort !== $passwort2) {
                $passwort2Err = "Die Passwörter stimmen nicht überein";
                $valid = false;
            }
        }
        if (empty($_POST["agb"])) {
            $agbErr = "Bitte akzeptieren Sie unsere AGBs";
            $valid = false;
        } else {
            $agb = true;
        }

        // Wenn keine Fehler aufgetreten sind, zur welcome-page weiterleiten
        if ($valid) {
            header("Location: welcome.php");
        }
    }

    function test_input($data)
    {
        // trim -> löscht überflüssige Leerzeichen, tabs, Zeilenumbrüche etc.
        $data = trim($data);
        // stripslashes entfernt backslashes vom input
        $data = stripslashes($data);
        // htmlspecialchars konvertiert html special chars in html entities
        $data = htmlspecialchars($data);
        return $data;
    }
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

    <main class="d-flex align-items-center justify-content-center">

        <div class="sign-up">

            <form class="row g-1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <h1 class="text-center">Registrierung</h1>
                
                <div class="form-group col-xs-4 col-md-4">
                    <!-- visually-hidden blendet Labels für visuelle Benutzer aus, aber nicht für Screenreader-->
                    <label for="inputAnrede" class="form-label visually-hidden">Anrede</label>
                    <select id="inputAnrede" class="form-select" name="Anrede">
                        <option disabled selected>Anrede</option>
                        <option>Herr</option>
                        <option>Frau</option>
                        <option>Divers</option>
                    </select>
                </div>
                <div class="col-8"></div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="Vorname" class="form-label floating-label visually-hidden">Vorname</label>
                    <input type="text" class="form-control" id="Vorname" name="Vorname" placeholder="Vorname" value="<?php echo htmlspecialchars($vorname); ?>">
                    <div class="error fs-7"><?php echo $vornameErr; ?></div>
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="Nachname" class="form-label visually-hidden">Nachname</label>
                    <input type="text" class="form-control" id="Nachname" name="Nachname" placeholder="Nachname" value="<?php echo htmlspecialchars($nachname); ?>">
                    <div class="error fs-7"><?php echo $nachnameErr; ?></div>
                </div>
                <div class="form-group col-12">
                    <label for="Email" class="form-label visually-hidden">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" placeholder="E-Mail Adresse" value="<?php echo htmlspecialchars($email); ?>">
                    <div class="error fs-7"><?php echo $emailErr; ?></div>
                </div>
                <div class="form-group col-12">
                    <label for="Benutzername" class="form-label visually-hidden">Benutzername</label>
                    <input type="text" class="form-control" id="Benutzername" name="Benutzername" placeholder="Benutzername" value="<?php echo htmlspecialchars($benutzername); ?>">
                    <div class="error fs-7"><?php echo $benutzernameErr; ?></div>
                </div>
                <div class="form-group col-12">
                    <label for="Passwort" class="form-label visually-hidden">Passwort</label>
                    <input type="password" class="form-control" id="Passwort" name="Passwort" placeholder="Passwort" value="<?php echo htmlspecialchars($passwort); ?>">
                    <div class="error fs-7"><?php echo $passwortErr; ?></div>
                </div>
                <div class="form-group col-12">
                    <label for="Passwort2" class="form-label visually-hidden">Passwort wiederholen</label>
                    <input type="password" class="form-control" id="Passwort2" name="Passwort2" placeholder="Passwort wiederholen" value="<?php echo htmlspecialchars($passwort2); ?>">
                    <div class="error fs-7"><?php echo $passwort2Err; ?></div>
                </div>
                <div class="form-group col-12 fs-7">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="agb">
                        <label class="form-check-label" for="gridCheck">
                            AGB akzeptieren
                        </label>
                    </div>
                    <div class="error fs-7"><?php echo $agbErr; ?></div>
                </div>
                <div class="form-group col-12">
                    <button type="submit" class="btn btn-dark w-100">Registrieren</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

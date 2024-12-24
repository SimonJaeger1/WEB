<?php
session_start(); // Starten der Session

// Statische Benutzerdaten (hardcoded)
$valid_username = "Emre";
$valid_password = "passwort123";

// Statische Admindaten
$admin_username = "admin";
$admin_password = "admin123";

// Fehler initialisieren
$loginError = "";

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["Benutzername"];
    $password = $_POST["Passwort"];

    // Überprüfen der eingegebenen Daten
    if ($username == $valid_username && $password == $valid_password) {
        // Benutzerdaten sind korrekt, speichern des Logins in der Session
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
    } else if ($username == $admin_username && $password == $admin_password) { // Überprüfen, ob eingeloggter User Admin ist
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["isAdmin"] = true;
    } 
    else {
        // Benutzerdaten sind inkorrekt, auszugebende Fehlermeldung initialisieren
        $loginError = "Ungültige Anmeldedaten";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("include/head.php");
    ?>
    <title>Login</title>
</head>

<body>

    <?php
    include("include/navbar.php");
    ?>

    <main class="d-flex align-items-center justify-content-center">

        <!-- ----- ----- ----- ----- ----- ----- LOGIN FORMULAR ----- ----- ----- ----- ----- ----- -->

        <div class="login">
            <!-- Wenn der User eingeloggt ist, Begrüßung anzeigen -->
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <h1 class="fs-2 text-center">Willkommen, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
                <a href="news.php" class="btn btn-dark w-100 mt-3">News</a>
                <a href="reservation.php" class="btn btn-dark w-100 mt-3">Zimmerreservierung</a>
                <a href="logout.php" class="btn btn-dark w-100 mt-3">Logout</a>    
            <?php else: ?>
                <!-- Login-Formular anzeigen, wenn nicht eingeloggt -->

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <h1 class="text-center">Login</h1>

                    <div class="form-group">
                        <!-- visually-hidden blendet Labels für visuelle Benutzer aus, aber nicht für Screenreader-->
                        <label class="visually-hidden" for="Benutzername">Benutzername</label>
                        <input class="form-control" type="text" id="Benutzername" name="Benutzername"
                            placeholder="Benutzername" required>
                    </div>

                    <div class="form-group">
                        <label class="visually-hidden" for="Passwort">Passwort</label>
                        <input class="form-control" type="password" id="Passwort" name="Passwort" placeholder="Passwort"
                            required>
                    </div>

                    <!-- Anzeige bei falschen Anmeldedaten -->
                    <?php if (!empty($loginError)): ?>
                        <div class="error fs-7 text-danger">
                            <?php echo $loginError; ?>
                        </div>
                        <br>
                    <?php endif; ?>

                    <div class="form-group">
                        <input class="btn btn-dark w-100" type="submit" value="Anmelden">
                    </div>

                    <!--"Passwort vergessen"- und "Anmeldedaten speichern"-Button haben noch keine Funktion-->
                    
                    <!--<div class="form-group fs-7 row">
                        <div class="d-flex col-6">
                            <input class="form-check-input" type="checkbox" id="check">
                            <label class="form-check-label" for="check">Anmeldedaten speichern</label>
                        </div>

                        
                        <div class="d-flex col-6 justify-content-end">
                            <label><a href="#">Passwort vergessen?</a></label>
                        </div>
                    </div>-->

                </form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>

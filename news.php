<?php
    session_start();

    // Upload-Directory in Variable speichern
    $uploadDir = "uploads/";

    $validUpload = false; // wird true gesetzt, wenn Upload erfolgreich war

    //Fehler initialisieren
    $fileTypeErr = $fileExistErr = "";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                die("Uploadverzeichnis konnte nicht erstellt werden.");
            }
        }
    
        // Verschieben des Uploads in $targetPath
        if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] === UPLOAD_ERR_OK) {
            $userFileName = htmlspecialchars(basename($_FILES["upload"]["name"]));
            $targetPath = $uploadDir . $userFileName;

            //Dateiendung in Variable speichern, damit überprüft werden kann, ob es .pdf, .png, .jpeg oder .jpg ist
            $imageFileType = strtolower(pathinfo($userFileName,PATHINFO_EXTENSION));
            // Auf Dateiendung überprüfen
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "pdf" ) {
                $fileTypeErr = "Nur JPG, JPEG, PNG & PDF Dateien erlaubt.";
            } elseif (file_exists($targetPath)) { // Überprüfen, ob eine Datei bereits hochgeladen wurde
                $fileExistErr = "Diese Datei wurde bereits hochgeladen.";
            } elseif (move_uploaded_file($_FILES["upload"]["tmp_name"], $targetPath)) {
                $validUpload = true;
            } else {
                die("Fehler beim Verschieben der Datei.");
            }
        } else {
            die("Fehler beim Datei-Upload: " . $_FILES["upload"]["error"]);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("include/head.php");
    ?>
    <title>News</title>
</head>

<body>

    <?php
        include("include/navbar.php");
    ?>
    
    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]): ?>

    <div class="container news">
        <div class="row">
            <div class="col">
                <h1 class="mt-3 mb-3">File Upload</h1>
            </div>
        </div>
        <!-- set the enctype -->
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <!-- set the accepted file types -->
                <input accept=".pdf, .png, .jpg, .jpeg" class="form-control" type="file" id="file" name="upload">
            </div>
            <button class="btn btn-primary" type="submit">Upload</button>
            <div class="error fs-7"><?php echo $fileTypeErr; ?></div>
            <div class="error fs-7"><?php echo $fileExistErr; ?></div>
            <div class="mt-3"><?php if($validUpload): ?>
                <p class="alert alert-success">Datei erfolgreich hochgeladen!</p>
            <?php endif; ?></div>
        </form>
        <div class="row mt-3">
            <div class="col">
                <h2 class="mb-3">Files</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- Anzeige der bereits hochgeladenen Files -->
                <ul class="list-group">
                <?php
                if (file_exists($uploadDir)) {
                    // Alle Dateien aus uploadDir in $files speichern sowie "." und ".." aus uploadDir-Array entfernen
                    $files = array_diff(scandir($uploadDir), array('.', '..'));

                    // Dateien ausgeben
                    foreach ($files as $file) {
                        echo '<li class="list-group-item">' . $file .'</li>';
                    }
                }
                ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="container news">
        <div class="row">
            <div class="col">
                <h1 class="mt-3">Newsbeiträge</h1>  
                <!-- Anzeige der Newsbeiträge - neuester Beitrag zuerst -->
                <ul class="list-group">
                    <?php
                    if (file_exists($uploadDir)) {
                        $files = array_diff(scandir($uploadDir), array('.', '..'));

                        // Array für Dateien und Änderungszeiten
                        $filesWithTimes = [];
                        foreach ($files as $file) {
                            $filePath = $uploadDir . $file;
                            $filesWithTimes[$file] = filemtime($filePath); 
                        }

                        // Dateien nach Änderungszeit sortieren (absteigend: neueste zuerst)                    
                        arsort($filesWithTimes);

                        // Bilder ausgeben
                        foreach ($filesWithTimes as $file => $timestamp) {
                            $filePath = $uploadDir . $file;
                            echo '<li class="list-group-item mb-3">';
                            echo '<img src="' . $filePath . '" alt="' . htmlspecialchars($file) . '" class="img-fluid" style="width: 200px; height: 200px;">';
                            echo '<p>Hochgeladen am: ' . date("d.m.Y H:i:s", $timestamp) . '</p>';
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
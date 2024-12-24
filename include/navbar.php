<!-- - - - - - - - - - - - - - - Bootstrap Navbar Vorlage mit Überarbeitungen - - - - - - - - - - - - - - -  -->
<header>
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
            <a class="navbar-brand allura" href="index.php">Alpenwind</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--<li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>--><!--Home-Link ist überflüssig, weil Logo auch auf index.php führt-->
                    <li class="nav-item">
                        <a class="nav-link" href="impressum.php">Impressum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="help.php">Help</a>
                    </li>

                    <!-- Zimmerreservierung wird nur angezeigt, wenn User eingeloggt ist -->
                    <?php if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="reservation.php">Zimmerreservierung</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="news.php">News</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-5">

                        <!-- Wenn User eingeloggt ist, wird ein Logout-Button angezeigt, ansonsten Login und Registrierung -->
                        <?php if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"])) : ?>
                        <li class="nav-item me-5"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php else : ?>
                        <li class="nav-item me-5"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">Registrieren</a></li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
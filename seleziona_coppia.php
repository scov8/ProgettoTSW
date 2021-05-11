<!DOCTYPE html>
<html lang="it">



<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My VIP Face</title>
    <meta name="author" content="" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="img/favicon/vip.ico" type="image/x-icon" />
</head>

<body>
    <!-- Navbar (da includere con php) -->
    <nav>
        <a href="index.php"><img src="img/vip_logo.svg" alt="My VIP Face" /></a>
        <ul>
            <li><a href="seleziona_coppia.php">Seleziona la tua coppia</a></li>
            <li><a href="vetrina_coppie.php">Coppie VIP-Persona</a></li> <!-- Solo per utenti loggati -->
            <li><a href="area_utente.php?registrati">Registrati</a></li> <!-- Per utente non loggato -->
            <li><a href="area_utente.php?accedi">Accedi</a></li> <!-- Per utente non loggato -->
            <li><a href="area_utente.php?userarea">NomeUtente</a></li> <!-- Per utente loggato-->
        </ul>
    </nav>
    <!-- Main Content Utente NON LOGGATO -->
    <main>
        <h1>
            <a href="area_utente.php?accedi">Effettua l'accesso per selezionare la tua coppia</a>
        </h1>
        <div class="card-container">
            <?php
            $dir_name = "img/VIP/";
            $images = glob($dir_name . "*.jpg");
            shuffle($images);

            for ($i = 0; $i < 12; $i++) {
            ?>
                <div <?php
                        if ($i < 10) {
                            echo 'class="card">';
                        } else {
                            echo 'class="card-blocked">';
                        } ?> <img src="<?php echo $images[$i]; ?>" alt="" width="300px" height="300px">
                    <div class="card-info">
                        <h4><strong><?php echo $images[$i]; ?></strong></h4>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </main>
    <!-- Footer -->
    <footer>
        <p> &copy; 2021 Gruppo 02 - TSW</p>
        <p><a href="https://www.unisa.it/">Università degli Studi di Salerno</a></p>
        <p><a href="mailto: indirizzo@mail.it">Contattaci</a></p>
    </footer>
</body>

</html>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My VIP Face</title>
  <link rel="stylesheet" href="css/style.css">
  <meta name="author" content="co-authored by Luigi Loria, Andrea Senatore, Luigi Scovotto, Francesco Tortora" />
  <meta name="description" content="" />
  <link rel="shortcut icon" href="img/favicon/vip.ico" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="grid-container">
    <!-- Navbar (da includere con php) -->
    <nav class="main-nav">
      <a href="index.php"><img src="img/vip_logo.svg" alt=" My VIP Face" /></a>
      <ul>
        <li><a href="seleziona_coppia.php">Seleziona la tua coppia</a></li>
        <li><a href="vetrina_coppie.php">Coppie VIP-Persona</a></li> <!-- Solo per utenti loggati -->
        <li><a href="area_utente.php?registrati">Registrati</a></li> <!-- Per utente non loggato -->
        <li><a href="area_utente.php?accedi">Accedi</a></li> <!-- Per utente non loggato -->
        <li><a href="area_utente.php?userarea">NomeUtente</a></li> <!-- Per utente loggato-->
      </ul>
    </nav>
    <!-- Main Content -->
    <main>
      <div class="left-content">
        <h1>My VIP Face</h1>
        <p><em>Un portale web per verificare la somiglianza con i VIP</em></p>
        <button onclick="">Prova anche tu</button>
      </div>
      <div class="right-content">
        <img src="img/homepage/red_carpet.jpeg" alt="Red Carpet">
      </div>
    </main>
    <hr />
    <!-- Tutorial -->
    <div class="card-container">
      <div class="card" id="card1">
        <img src="img/homepage/upload.png" alt="Carica">
        <h2>Step 1: Carica una foto</h2>
        <p>Ti raccomandiamo di caricare una foto contenente una sola persona.
          Usa la fotocamera frontale per scattare una foto in modo chiaro!
          La faccia dovrebbe vedersi chiaramente ed è preferibile una foto frontale.
        </p>
      </div>
      <div class="card" id="card2">
        <img src="img/homepage/choice.png" alt="Scegli">
        <h2>Step 2: Scegli il tuo VIP</h2>
        <p>
          Fatto? Procedi allora! Divertiti a trovare il Vip piu'adatto a te.
        </p>
      </div>
      <div class="card" id="card3">
        <img src="img/homepage/high-five.png" alt="Condividi">
        <h2>Step 3: Invita i tuoi amici! </h2>
        <p>
          Visto che figo? Fallo provare ai tuoi amici e divertiti con loro!
        </p>
      </div>
    </div>
    <!-- Footer -->
    <footer>
      <p> &copy; 2021 Gruppo 02 - TSW</p>
      <p><a href="https://www.unisa.it/">Università degli Studi di Salerno</a></p>
      <p><a href="mailto: indirizzo@mail.it">Contattaci</a></p>
    </footer>
  </div>
</body>

</html>
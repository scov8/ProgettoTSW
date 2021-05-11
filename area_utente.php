<?php
session_start();

//Registrazione
if (!empty($_POST['sub_reg'])) {
    //recupero e dei valori passati tramite post
    $_SESSION['err_ins_reg'] = false;
    unset($_SESSION['mess_err_reg']);

    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $username = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "nome utente obbligatorio\n";
    }

    if (isset($_POST['name'])) {
        $nome = $_POST['name'];
    } else {
        $nome = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "nome  obbligatorio\n";
    }

    if (isset($_POST['surname'])) {
        $cognome = $_POST['surname'];
    } else {
        $cognome = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "cognome obbligatorio\n";
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "email obbligatorio\n";
    }

    if (isset($_POST['genre'])) {
        $sesso = $_POST['genre'];
    } else {
        $sesso = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "sesso obbligatorio\n";
    }

    if (isset($_POST['birth'])) {
        $data_di_nascita = $_POST['birth'];
    } else {
        $data_di_nascita = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "data_di_nascita obbligatorio\n";
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $password = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "password obbligatorio\n";
    }

    if (isset($_POST['confirm_password'])) {
        $verifica_password = $_POST['confirm_password'];
    } else {
        $verifica_password = "";
        $_SESSION['err_ins_reg'] = true;
        $_SESSION['mess_err_reg'] .= "password di verifica obbligatorio\n";
    }

    if ($password == $verifica_password) {
        if (username_exist($username) || email_exist($email)) {
            echo "<p> Username o email già esistente. Riprova</p>";
            exit();
        } else {
            //tutto ok
            if (!$_SESSION['err_ins_reg'])
                if (reg_utente($nome, $cognome, $email, $sesso, $data_di_nascita, $username, $password)) {
                    unset($_SESSION['psw_diverse']);
                    unset($_SESSION['err_ins_reg']);
                    unset($_SESSION['mess_err_reg']);
                    unset($_SESSION['err_reg']);
                } else {
                    $_SESSION['err_reg'] = true;
                }
        }
    } else {
        $_SESSION['psw_diverse'] = true;
    }
}

//Login
if (!empty($_POST['sub_log'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user =  $_POST['username'];
        $pass =  $_POST['password'];
        //Se esiste, restituisce la password (hash), altrimenti restituisce false.
        $hash = get_pwd($user);
        if (!$hash) {
            $_SESSION['account_notFound'] = true;
            $_SESSION['mess_err_log'] .= " L'utente $user non esiste ";
        } else {
            if (password_verify($pass, $hash)) {
                //Se il login è corretto, inizializziamo la sessione
                $_SESSION['authentication'] = true;
                $_SESSION['username'] = $user;
                unset($_SESSION['mess_err_log']);
                unset($_SESSION['account_notFound']);
                //redirect
            } else {
                $_SESSION['authentication'] = false;
                $_SESSION['mess_err_log'] .= " psw o user errati";
            }
        }
    } else {
        echo "<p>ERRORE: username o password non inseriti <a href=\"area_utente.php\">Riprova</a></p>";
        exit();
    }
}

/* modifica */
?>

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
    <!--
        $_SESSION['psw_diverse'] ->flag che mi dice che le psw so divese
        $_SESSION['err_ins_reg'] -> flag che mi dice che qualche campo nn è stato inserito
        $_SESSION['mess_err_reg'] -> contine i mess d' errore da visulizzare in un allert volendo 
        $_SESSION['err_reg'] -> flag errore reg
        $_SESSION['account_notfound'] -> flag errore accoutn nn esiste
        $_SESSION['mess_err_log'] -> mess essore nel login
        $_SESSION['authentication'] = true;
    -->
    <?php
    /*echo "\n psw_diverse: " . $_SESSION['psw_diverse'];
    echo "\n err_ins_reg: " . $_SESSION['err_ins_reg'];
    echo "\n mess_err_reg: " . $_SESSION['mess_err_reg'];
    echo "\n err reg: " . $_SESSION['err_reg'];
    
    echo "\n account_notfound: " . $_SESSION['account_notfound'];
    echo "\n mess_err_log: " . $_SESSION['mess_err_log'];
    echo "\n eauthentication: " . $_SESSION['authentication'];
    */
    ?>
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
    <!-- Registrazione -->
    <div class="reg-container">
        <h1>Registrazione utente</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="registrazione">
            <fieldset>
                <legend>Account</legend>
                <p>
                    <label for="username">
                        Username: <input id="username" name="username" placeholder="inserisci un nome utente" maxlength="50" required />
                    </label>
                </p>
                <p>
                    <label for="email">
                        Indirizzo email: <input type="email" id="email" name="email" placeholder="inserisci un indirizzo email valido" required />
                    </label>
                </p>
                <p>
                    <label for="password">
                        Password: <input type="password" id="password" name="password" placeholder="inserisci la password" required />
                    </label>
                </p>
                <p>
                    <label for="password">
                        Conferma Password: <input type="password" id="confirm_password" name="confirm_password" placeholder="conferma la password" required />
                    </label>
                </p>
            </fieldset>
            <fieldset>
                <legend>Dati personali</legend>
                <p>
                    <label for="name">
                        Nome: <input id="name" name="name" placeholder="inserisci un nome" required />
                    </label>
                </p>
                <p>
                    <label for="surname">
                        Cognome <input name="surname" id="surname" name="inserisci il cognome" placeholder="inserisci un cognome" required />
                    </label>
                </p>
                <p>
                    <label for="birth">
                        Data di nascita: <input type="date" id="birth" name="birth" required />
                    </label>
                </p>
                <p>
                    <label for="genre">
                        Genere: <input type="radio" id="maschio" name="genre" value="M" checked /> M
                        <input type="radio" id="femmina" name="genre" value="F" /> F
                    </label>
                </p>
                <p>
                    <label for="privacy">
                        Privacy: <input type="checkbox" id="privacy" name="privacy" required />
                        <a href="https://protezionedatipersonali.it/regolamento-generale-protezione-dati" target="_blank">Do il consenso</a>
                    </label>
                </p>
            </fieldset>
            <input type="submit" name="sub_reg"></input>
            <button type="reset">Annulla</button>
        </form>
    </div>
    <!-- Accedi -->
    <div class="log-container">
        <h1>Login</h1>
        <form action="" method="post" id="login">
            <p>
                <label for="username">
                    Username/Email: <input id="username" name="username" required />
                </label>
            </p>
            <p>
                <label for="password">
                    Password: <input type="password" id="password" name="password" required />
                </label>
            </p>
            <p>Hai dimenticato la passowrd? Clicca <a href="area_utente.php">qui</a> per ottenerne una nuova.</p>
            <input type="submit" name="sub_log"></input>
            <p>Non sei ancora registrato? <a href="area_utente.php">Clicca qui per registrarti.</a></p>
        </form>
    </div>
    <!-- Area Riservata Utente -->
    <div class="userarea-container">
        <h1>Area Riservata</h1>
        <form action="" method="post" id="userarea">
            <fieldset>
                <legend>Account</legend>
                <p>
                    <label for="username">
                        Username: <input id="username" name="username" placeholder="inserisci un nome utente" maxlength="50" required />
                    </label>
                </p>
                <p>
                    <label for="email">
                        Indirizzo email: <input type="email" id="email" name="email" placeholder="inserisci un indirizzo email valido" required />
                    </label>
                </p>
                <p>
                    <label for="password">
                        Password: <input type="password" id="password" name="password" placeholder="inserisci la password" required />
                    </label>
                </p>
                <p>
                    <label for="password">
                        Conferma Password: <input type="password" id="confirm_password" name="confirm_password" placeholder="conferma la password" required />
                    </label>
                </p>
            </fieldset>
            <fieldset>
                <legend>I tuoi dati personali</legend>
                <p>
                    <label for="name">
                        Nome: <input id="name" name="name" placeholder="inserisci un nome" required disabled />
                    </label>
                </p>
                <p>
                    <label for="surname">
                        Cognome <input name="surname" id="cognome" name="inserisci il cognome" placeholder="inserisci un cognome" required disabled />
                    </label>
                </p>
                <p>
                    <label for="birth">
                        Data di nascita: <input type="date" id="birth" name="birth" required disabled />
                    </label>
                </p>
                <p>
                    <label for="genre">
                        Genere: <input type="radio" id="maschio" name="genre" value="M" checked disabled /> M
                        <input type="radio" id="femmina" name="genre" value="F" disabled /> F
                    </label>
                </p>
                <p>
                    <label for="privacy">
                        Privacy: <input type="checkbox" id="privacy" name="privacy" required disabled checked />
                        <a href="https://protezionedatipersonali.it/regolamento-generale-protezione-dati" target="_blank">Do il consenso</a>
                    </label>
                </p>
            </fieldset>
            <button type="submit">Aggiorna</button>
            <button onclick="location.href = 'area_utente.php?delete'">Rimuovi Account</button>
        </form>
    </div>
    <!-- Footer -->
    <footer>
        <p> &copy; 2021 Gruppo 02 - TSW</p>
        <p><a href="https://www.unisa.it/">Università degli Studi di Salerno</a></p>
        <p><a href="mailto: indirizzo@mail.it">Contattaci</a></p>
    </footer>
</body>

</html>

<?php

function reg_utente($nome, $cognome, $email, $sesso, $data_di_nascita, $user, $pass)
{
    require('./common/connessione.php');

    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Utente(nome, cognome, sesso, data_di_nascita, username, email, password) VALUES($1, $2, $3, $4, $5, $6, $7)";
    $prep = pg_prepare($db, "regUser", $sql);
    $ret = pg_execute($db, "regUser", array($nome, $cognome, $sesso, $data_di_nascita, $user, $email, $hash));
    if (!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        return false;
    } else {
        return true;
    }
}


function username_exist($user)
{
    require('./common/connessione.php');

    $sql = "SELECT username FROM utente WHERE username=$1";
    $prep = pg_prepare($db, "existsUser", $sql);
    $ret = pg_execute($db, "existsUser", array($user));
    if (!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        return false;
    } else {
        if ($row = pg_fetch_assoc($ret)) {
            return true;
        } else {
            return false;
        }
    }
}

function email_exist($email)
{
    require('./common/connessione.php');

    $sql = "SELECT email FROM utente WHERE email=$1";
    $prep = pg_prepare($db, "existsMail", $sql);
    $ret = pg_execute($db, "existsMail", array($email));
    if (!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        return false;
    } else {
        if ($row = pg_fetch_assoc($ret)) {
            return true;
        } else {
            return false;
        }
    }
}

function get_pwd($user)
{
    require "./common/connessione.php";

    $sql = "SELECT password FROM utente WHERE username=$1;";
    $prep = pg_prepare($db, "logUser", $sql);
    $ret = pg_execute($db, "logUser", array($user));
    if (!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        return false;
    } else {
        if ($row = pg_fetch_assoc($ret)) {
            $pass = $row['password'];
            return $pass;
        } else {
            return false;
        }
    }
}

?>
<?php
$host = 'localhost';
$port = '5050'; //per scovotto
//$port = '5432';
$db = 'TSW';
$username = 'www';
$password = 'tsw2021';

$connection_string = "host=$host port=$port dbname=$db user=$username password=$password";

// la inserisco nei richiami
//effettuo la connessione al database
$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());

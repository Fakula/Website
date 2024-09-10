<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
//Reinholen der Datenbank-Zugangsdaten
require '../etc/Seite/config.php';
// zugang zur Datenbank
$mysqli = mysqli_init();

//Abbruch falls Initialisierung fehlschlägt
if (!$mysqli) {
	die('Initialisierung fehlgeschlagen');
} 
//Einstellen der Kommunikation:						// NICHT! utf-8
if (!mysqli_options($mysqli, MYSQLI_INIT_COMMAND, 'SET NAMES utf8')) {
	die('UTF-8 KOmmunikation nicht möglich');
}
// Endlich die Verbindung aufbauen 
if (!mysqli_real_connect($mysqli, HOST, USER, PASS, DBANK)) {
	die('Connection-Error: '.mysqli_connect_error());
}
//echo 'Verbindung erfolgreich';

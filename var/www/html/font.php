<?php
// Erlaube nur bestimmte Schriftarten
$allowed_fonts = ['Parisienne'];

// Hole den Parameter aus der URL
$font = isset($_GET['font']) ? $_GET['font'] : '';

// Überprüfe, ob die angeforderte Schriftart erlaubt ist
if (in_array($font, $allowed_fonts)) {
    // Setze den Content-Type Header
    header('Content-Type: font/ttf');

    // Setze den Cache-Control Header
    header('Cache-Control: max-age=31536000, public');

    // Lade die Schriftart-Datei
    //$fontFile = "../etc/Seite/Fonts/{$font}.ttf"; // Passe den Pfad an
    $fontFile = "{$font}.ttf"; // Passe den Pfad an


    // Gib die Schriftart-Datei aus
    readfile($fontFile);
} else {
    // Wenn die Schriftart nicht erlaubt ist, gib einen 404-Fehler zurück
    header("HTTP/1.0 404 Not Found");
    echo "Font not found.";
}
?>

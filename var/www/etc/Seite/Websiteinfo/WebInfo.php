
<?php
//echo 'Aktuelles Arbeitsverzeichnis: ' . getcwd() . '<br>';
// Pfad zum Bild
$bildPfad = "../etc/Seite/Websiteinfo/Bilder/Raspberry.jpg";
// Überprüfen, ob die Datei existiert
if (file_exists($bildPfad)) {
    // Bildinhalt lesen und in Base64 kodieren
    $bildInhalt = base64_encode(file_get_contents($bildPfad));
} else {
    echo "no bild";
    $bildInhalt = '';
}
?>





<p><img src="data:image/jpeg;base64,<?php echo $bildInhalt; ?>" alt="Beschreibung des Bildes"  name="Raspberry" align="left" width="291" height="218" border="0"/></p>
<p>Hallo,</p>
<p>Das ist der Grundstein für eine neue Webseite, nichts Großes, nur ein kleiner Raspberry, der als Webserver herhalten muss :) Mal gucken, was draus wird.</p>
<h2>Checkliste soweit:</h2>
<ul>
    <li>URL, DynDNS-Weiterleitung -> check</li>
    <li>Port-Weiterleitungen um den Server zu erreichen (80, 443) -> check</li>
    <li>Zertifikat für HTTPS, Letsencrypt -> check</li>
    <li>PHP installieren -> check</li>
    <li>MariaDB installieren -> check</li>
    <li>Apache2 installieren -> check</li>
</ul>
<h2>Sonstiges:</h2>
<ul>
    <li>Bastion-Server eingerichtet</li>
    <li>2-Faktor (bzw eher 3 Faktor) Login eingerichtet</li>
    <li>RDP über SSH Sprunghost</li>
    <li>Sunlight Gaming Server eingerichtet.</li>
    <li>Moonlight als Gaming Clienten eingerichtet.</li>
    <li>Gaming über SSH Tunnel erfolgreich getestet.</li>
</ul>
<h2>Todo:</h2>
<ul>
    <li>UTF Encoding einstellen um die Sonderzeichen richtig darstellen zu können</li>
    <li>Automatische Weiterleitung von HTTP auf HTTPS</li>
    <li>Datenbank einrichten</li>
    <li>Webseite bauen</li>
    <li>Anfangen die Webseite zu füllen</li>
</ul>
<h2>Wenn die Webseite dann einmal steht ist auf der Todo:</h2>
<ul>
    <li>Umzug auf einen "festen" Hoster, welcher nicht am Hausanschluss hängt.</li>
    <li>Weg von DynDNS auf festen Hostnamen um nicht als "Botnet" weggefiltert zu werden</li>
    <li>Zertifikat auf den neuen Hostnamen ändern</li>
</ul>

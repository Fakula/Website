<?php



 
//require '../etc/Seite/befehle.php';

// Basisverzeichnis für die Seiten und CSS-Dateien
$base_path = '../etc/Seite/';
$backoffice = $base_path . "Backoffice/";
$verbindungsaufbau = $backoffice . "Verbindungsaufbau.php";
$Keksmeister = $backoffice . "Keksdealer.php";
$Userlogin= $backoffice . "Userlogin.php";
$Lassie = $backoffice . "Lassie.php";

require $Keksmeister;
require $Lassie;




// Liste der erlaubten Seiten
$allowed_pages = ['Startseite', 'Katinka', 'Daniel', 'Maeuschen', 'Linkliste', 'Impressum', 'WebInfo','Login', 'Logout'];









#echo session_id();


// Überprüfen, ob 'url' gesetzt ist und bereinigen
if (!empty($_GET['url'])) {
    $seite = filter_var($_GET['url'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Überprüfen, ob die bereinigte Seite in der Liste der erlaubten Seiten ist
    if (!in_array($seite, $allowed_pages)) {
        $error_message = "404 - Ungültige URL, bitte Pfad überprüfen";
        $seite = null;
    }
} else {
    $seite = 'Startseite'; // Fallback-Seite, wenn 'url' nicht gesetzt ist
}

// Debugging-Ausgabe
#echo "Seite: " . $seite . "<br>";


// Neuer Code
switch ($seite) {
    case "Startseite":
        $directory_path = $base_path . "Startseite/";
        break;		
    case "Katinka":
        $directory_path = $base_path . 'Katinka/';
        break;
    case "Daniel":
        $directory_path = $base_path . "Daniel/";
        break;
    case "Maeuschen":
        $directory_path = $base_path . "Maeuschen/";
        break;				
    case "Linkliste":
        $directory_path = $base_path . "Linkliste/";
        break;
    case "Impressum":
        $directory_path = $base_path . 'Impressum/';
        break;
    case "WebInfo":
        $directory_path = $base_path . "Websiteinfo/"; // Korrigierter Pfad
        break;
    case "Login":
        $directory_path = $base_path . 'Login/';
        break;
    case "Logout":
        $directory_path = $base_path . 'Logout/';
        break;
    default:
        $error_message = "404 - Ungültige URL, bitte Pfad überprüfen";
        $seite = null;
}

// Standard-CSS-Pfad
$default_css_path = $base_path . 'style.php';

if (file_exists($default_css_path)) {
    include $default_css_path;
} 



$filepath = $directory_path . "Site.php";
$stylepath = $directory_path. "style.php";

if (file_exists($stylepath)) {
    include $stylepath;

} 



// Debugging-Ausgabe
//echo "Filepath: " . $filepath . "<br>";

// Überprüfen, ob die Datei existiert
if ($seite && !file_exists($filepath)) {
    $error_message = "404 - Fehler, Datei nicht vorhanden";
    $seite = null;
}


?>

<!doctype html>
<html lang="de">
<head>
 <charset="UTF-8">
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DaKaChi Startseite</title>

  <style>
 @font-face {
    font-family: 'Parisienne';
    src: url('font.php?font=Parisienne') format('truetype');
}
    body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    
}
h1 {
    font-family: 'Parisienne', Arial, sans-serif;
    justify-content: center;
    text-align: center;
}


section {
    width: 60%; /* Breite des übergeordneten Elements */
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  background-color: <?php echo $background?>;
}

.layout-wrapper {
    display: flex;
    flex-direction: row; /* Ensure the layout-wrapper's children are side by side */
    flex-grow: 1; /* Allow the layout-wrapper to grow and fill the section */
    
}

.link-liste {
    width: 11%; /* Breite in Prozent des übergeordneten Elements */
    max-width: 11%; /* Maximalbreite in Prozent des übergeordneten Elements */
    outline: solid;
    border-width: 5px;
    margin: 0;
    box-sizing: border-box;
    order: 1;
    /* height: 100%;*/
    position: fixed; /* Fixierte Position */
    /*top: 0; *//* Positioniere das Element oben im Viewport */

background-color: <?php echo $background?>;
}


.Inhalt {
    flex-grow: 1;
    outline: solid;
    width: 77%;
    max-width: 77%;
    border-width: 5px;
    margin: 0;
    margin-left: 19.5%;
    box-sizing: border-box;
    margin-bottom: 0.2%;
    overflow: hidden;
    order: 2;
}

.link-links, .link-mitte, .link-rechts {
    width: 100%;
    float: left;
    text-align: left;
    clear: both;
    border-style: solid;
    box-sizing: border-box;
    word-wrap: break-word;
}


    .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .top-row {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin-bottom: 20px;
        }

        .top-row img {
            width: 45%;
            height: auto;
        }

        .bottom-row {
            display: flex;
            justify-content: center;
            width: 80%;
        }

        .bottom-row img {
            width: 30%;
            height: auto;
        }
  </style>
</head>

<body>
<section>

 <div>
 <h1>Willkommen auf der Webseite von Daniel, Katinka und Mäuschen (Chihuahua)</h1>
</div>


<div class="layout-wrapper">

<div class="Inhalt">
<?php 
if (isset($error_message)) {
    echo $error_message;
} else {
    require $filepath;
}
?>
</div>

<div class="link-liste">
<a class="link-links" href="?url=Startseite">Startseite</a>
<a class="link-links" href="?url=Katinka">Katinka</a>
<a class="link-links" href="?url=Daniel">Daniel</a>
<a class="link-links" href="?url=Maeuschen">Mäuschen</a>
<a class="link-links" href="?url=Linkliste">Linkliste</a>
<a class="link-links" href="?url=WebInfo">Webhosting-Info</a>
<a class="link-links" href="?url=Impressum">Impressum/Kontakt/Datenschutzhinweis</a>

<?php
if(!isset($_SESSION['user'])){
    echo '<a class="link-links" href="?url=Login">Login</a>';
    }



    if (isset($_COOKIE['user_data'])) { 
    echo '<a class="link-links" href="?url=Logout">Logout</a>';

    }



?>
</div>
</div>
</section>
</body>
</html>

<?php


if (isset($_COOKIE['cookies_accepted']) && $_COOKIE['cookies_accepted'] == 'true') {

     // Session starten, falls noch nicht gestartet
     if (session_status() == PHP_SESSION_NONE) {
        // Sicherheitsoptionen für Session-Cookies setzen
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => 'dakachi.de',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        
        session_start();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    }else{



        //in ner else, da hier sonst möglichkeit des angrifs eventuell ist
    



// setzen von session-cookie wenn verlangt.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validierung der POST-Daten
    if (isset($_POST['accept_cookies']) && $_POST['accept_cookies'] === 'gib keks!') {

        setcookie('cookies_accepted', 'true', time() + (86400 * 30), "/"); // Cookie für 30 Tage setzen
        header("Location: " . $_SERVER['PHP_SELF']);


       
            echo 'hier gibts nen Keks!';
        }
    }
}


require '../etc/Seite/befehle.php';

// Basisverzeichnis für die Seiten und CSS-Dateien
$base_path = '../etc/Seite/';

// Standard-CSS-Pfad
$css_path = $base_path . 'style.css';

// Liste der erlaubten Seiten
$allowed_pages = ['Startseite', 'Katinka', 'Daniel', 'Maeuschen', 'Linkliste', 'Impressum', 'WebInfo','Login', 'Logout'];









echo session_id();


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
echo "Seite: " . $seite . "<br>";

/*
switch ($seite) {
    case "Startseite":
        $filepath = $base_path . "Startseite/Startseite.php";
        break;		
    case "Katinka":
        $filepath = $base_path . 'Katinka/Katinka.php';
        break;
    case "Daniel":
        $filepath = $base_path . "Daniel/Daniel.php";
        break;
    case "Maeuschen":
        $filepath = $base_path . "Maeuschen/Maeuschen.php";
        break;				
    case "Linkliste":
        $filepath = $base_path . "Linkliste/Linkliste.html";
        break;
    case "Impressum":
        $filepath = $base_path . 'Impressum/impressum.html';
        break;
    case "WebInfo":
        $filepath = $base_path . "Websiteinfo/WebInfo.php"; // Korrigierter Pfad
        break;
    case "Login":
        $filepath = $base_path  . 'Login/Login.php';
        break;
    case "Logout":
        $filepath = $base_path  . 'Logout/Logout.php';
        break;
    default:
        $error_message = "404 - Ungültige URL, bitte Pfad überprüfen";
        $seite = null;
}
*/

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

$filepath = $directory_path . "Site.php";
$Stylepath = $directory_path."style.php";

if (file_exists($Stylepath)) {
    include $Stylepath;
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
 
    body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

section {
    width: 60%; /* Breite des übergeordneten Elements */
    margin: 0 auto;
    background-color: whitesmoke;
    color: #4b3302;
    overflow: hidden;
    display: flex;
    flex-direction: column;
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


if (isset($_SESSION['token'])) {
  
    echo '<a class="link-links" href="?url=Logout">Logout</a>';
}


?>
</div>
</div>
</section>
</body>
</html>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Zustimmung</title>
</head>
<body>
    <?php
    if (isset($_COOKIE['user_data'])) {
        echo '<form method="POST" action="">
                <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                <label for="remove_cookie">Mach Keks weg</label>
                <button type="submit" name="remove_cookies" value="mach keks weg">Remove Cookies</button>
              </form>';
    } 

    ?>
</body>
</html>






<?php



/*
if (session_status() == PHP_SESSION_ACTIVE) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
        // CSRF-Token überprüfen
        if (isset($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            // Alle Session-Variablen löschen
            $_SESSION = array();

            // Das Session-Cookie löschen
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Die Session zerstören
            session_destroy();

            // Alle Cookies durchlaufen
foreach ($_COOKIE as $key => $value) {
    // Cookie löschen, indem das Verfallsdatum in die Vergangenheit gesetzt wird
    setcookie($key, '', time() - 3600, '/');
}


            echo "Ihre Session wurde vollständig beendet. Sie haben bis zum nächsten Login keine Berechtigungen mehr.";
        } else {
            echo "Ungültiger CSRF-Token.";
        }
    } else {
        echo '
        <html>
        <body>
            <form method="post">
                <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                <p>Wenn Sie sich abmelden, wird Ihre Session vollständig beendet und Sie haben bis zum nächsten Login keine Berechtigungen mehr.</p>
                <button type="submit" name="logout">Logout</button>
            </form>
        </body>
        </html>
        ';
    }
} else {
    echo "Kein Session-Token vorhanden.";
}
// Debugging-Ausgaben
echo '<pre>';
print_r($_POST);
print_r($_SESSION);
echo '</pre>';
*/
?>

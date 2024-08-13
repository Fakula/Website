<?php

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

?>

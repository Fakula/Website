<?Php


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_cookies'])) {
    $remember_me = isset($_POST['remember_me']) ? true : false;
    $cookie_expiration = $remember_me ? time() + (30 * 24 * 60 * 60) : 0; // 30 Tage oder beim Schließen löschen

    $cookie_data = json_encode([
        'cookies_accepted' => true,
        'UserID' => 'Null',
        'Loginkey' => 'Null',
        'Timestamp' => 'Null'
    ]);
    session_start();
    setcookie('user_data', $cookie_data, $cookie_expiration, "/");

    echo '<p>Das Cookie wurde gesetzt. Willkommen $User !</p>';

        // Seite neu laden
        header("Location: /index.php?url=Login");
        exit();
}






if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_cookies'])){
    session_start();
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 3600, '/');
         }
    
     // Alle Session-Variablen löschen
     $_SESSION = array();

     // Falls die Session gelöscht werden soll, lösche auch das Session-Cookie
     $params = session_get_cookie_params();
     setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);


     // Zum Schluss die Session zerstören
     session_destroy();
    
    echo '<p>Remove Cookie: ' . $remove_cookie . '</p>';
        // Seite neu laden
        header("Location: /index.php?url=Logout");
        exit();
}



if (isset($_COOKIE['user_data'])) {
    session_start();
    #echo '<p>Session gestartet, da das Cookie bereits gesetzt ist.</p>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_COOKIE['user_data']) && isset($_POST['login_button'])) {
    // Aktion ausführen, wenn das Cookie 'user_data' gesetzt ist und der Login-Button geklickt wurde
    # echo "Cookie 'user_data' ist gesetzt und der Login-Button wurde geklickt.";
    $server = '192.168.178.2';
    $pingResult = exec("ping -c 1 -W 1 $server", $output, $result);

    if ($result === 0) {
    echo "Debug: Login-server erreichbar.";
    





// Konfigurationsparameter
$ldap_host = "ldaps://dc1.dakachi.de";
#$ldap_host = "ldaps://192.168.178.2";
$service_user = "Username";
$service_password = "Passw0rd"; // Passwort des Service-Kontos
$base_dn = "dc=Dakachi,dc=de";
$realm = 'DAKACHI.DE';

// Benutzerdaten aus POST-Request
$user_cn =  $_POST['uname']; // Der Benutzername, den du über POST erhältst
$user_password = $_POST['psw']; // Das Passwort, das der Benutzer eingegeben hat

// Verbindung zum LDAP-Server herstellen
$ldap_conn = ldap_connect($ldap_host);

if ($ldap_conn) {
    // LDAP-Version setzen
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

    // Service-DN erstellen
    $service_dn = "cn=" . $service_user . ",cn=Users," . $base_dn;

    // Mit dem Service-Konto binden
    $bind = ldap_bind($ldap_conn, $service_dn, $service_password);

    if ($bind) {
        // Benutzer-DN erstellen
        $user_dn = "cn=" . $user_cn . ",cn=Users," . $base_dn;

        // Benutzer-DN und Passwort überprüfen
        $user_bind = ldap_bind($ldap_conn, $user_dn, $user_password);

        if ($user_bind) {
            // Benutzerinformationen abrufen
            $search = ldap_search($ldap_conn, $base_dn, "(cn=$user_cn)");
            $entries = ldap_get_entries($ldap_conn, $search);

            if ($entries["count"] > 0) {
                $user_name = $entries[0]["displayname"][0];
                $string=implode(",", $entries[0]);
                echo $string;
                echo "Debug:Hallo, " . $user_name . "!";
                $uid = $entries[0]["samaccountname"][0];
                echo "Die UID des Benutzers ist: " . $uid;
                // Überprüfe, ob die Erweiterung erfolgreich geladen wurde
                if (extension_loaded('krb5')) {
                echo 'Debug: Erweiterung krb5 erfolgreich geladen!';

              print_r(get_extension_funcs('krb5'));
              $functions = get_extension_funcs('krb5');
              echo 'Verfügbare Funktionen: <br>';
              print_r($functions);

                
                #phpinfo();phpinfo();
                // Kerberos-Kontext erstellen
                $krb5_context = krb5_init_context();

                // Kerberos-Ticket erhalten
               $ccache = krb5_cc_default($krb5_context);
                krb5_get_init_creds_password($krb5_context, $ccache, $user_cn, $user_password, $realm);

                // Überprüfen, ob das Ticket erfolgreich erstellt wurde
                if ($ccache) {
                echo "Kerberos-Ticket erfolgreich erstellt!";
                } else {
                echo "Fehler beim Erstellen des Kerberos-Tickets.";
                }

                // Kerberos-Kontext freigeben
                krb5_free_context($krb5_context);
            } else {
                echo 'Debug: Erweiterung krb5 ist nicht geladen.';
               }
                
            } else {
                echo "Debug: Benutzer nicht gefunden.";
            }
        } else {
            echo "Debug: Passwort ist falsch.";
        }
    } else {
        echo "Debug: Service-Konto konnte sich nicht binden.";
    }

    // Verbindung schließen
    ldap_unbind($ldap_conn);
} else {
    echo "Verbindung zum LDAP-Server fehlgeschlagen.";
}



} else {
    echo "Login-server gerade nicht erreichbar, bitte später probieren :) .";
}
} 


/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // LDAP server details
    $ldap_server = "ldaps://DC1.dakachi.de";
    $ldap_dn = "DC=dakachi,DC=de";

    // Connect to LDAP server
    $ldap_conn = ldap_connect($ldap_server);
    if (!$ldap_conn) {
        die("Could not connect to LDAP server.");
    }

    // Set LDAP options
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ldap_conn, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_ALLOW);

    // Bind to LDAP server
    $ldap_bind = @ldap_bind($ldap_conn, "CN=Administrator,CN=Users," . $ldap_dn, $password);
    if ($ldap_bind) {
        echo "Login successful!";
    } else {
        $error = ldap_error($ldap_conn);
        echo "Login failed: " . $error;
    }

    // Close the LDAP connection
    ldap_unbind($ldap_conn);
}




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // LDAP server details
    $ldap_server = "ldap://DC1";
    $ldap_dn = "DC=dakachi,DC=de";


    // Connect to LDAP server
    $ldap_conn = ldap_connect($ldap_server);
    if (!$ldap_conn) {
        die("Could not connect to LDAP server.");
    }

    // Set LDAP options
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

    // Bind to LDAP server
    $ldap_bind = @ldap_bind($ldap_conn, "CN=Administrator,CN=Users," . $ldap_dn, $password);
    if ($ldap_bind) {
        echo "Login successful!";
    } else {
        $error = ldap_error($ldap_conn);
        echo "Login failed: " . $error;
    }

    // Close the LDAP connection
    ldap_unbind($ldap_conn);
}

*/
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['psw'];

    // LDAP server details
    $ldap_server = "ldap://DC1.DAKACHI.DE";
    $ldap_dn = "DC=DAKACHI.DE,DC=DE";

    // Connect to LDAP server
    $ldap_conn = ldap_connect($ldap_server);
    if (!$ldap_conn) {
        die("Could not connect to LDAP server.");
    }

    // Set LDAP options
    ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap_conn, LDAP_OPT_REFERRALS, 0);

    // Bind to LDAP server
    $ldap_bind = @ldap_bind($ldap_conn, "yourdomain\\" . $username, $password);
    if ($ldap_bind) {
        echo "Login successful!";
        // Perform further actions after successful login
    } else {
        echo "Login failed. Please check your username and password.";
    }

    // Close the LDAP connection
    ldap_unbind($ldap_conn);
}


*/
/*
if (isset($_COOKIE['cookies_accepted']) && $_COOKIE['cookies_accepted'] == 'true') {
    // Session starten, falls noch nicht gestartet
    if (session_status() == PHP_SESSION_NONE) {
        session_set_cookie_params([
            'lifetime' => 0, // Session-Cookie, das beim Schließen des Browsers gelöscht wird
            'path' => '/',
            'domain' => 'dakachi.de',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        session_start();
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        echo "hier hast keks ";
    }
}
*/



/*
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

*/


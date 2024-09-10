<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $ldap_servers = [
        "ldaps://ldap.example.com",
        "ldap://ldap.example.com"
    ];
    $ldap_dn = "ou=users,dc=example,dc=com";
    $authenticated = false;

    foreach ($ldap_servers as $ldap_server) {
        $ldap_conn = ldap_connect($ldap_server);
        if ($ldap_conn) {
            ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            $user_dn = "uid=$username,$ldap_dn";

            if (@ldap_bind($ldap_conn, $user_dn, $password)) {
                $authenticated = true;
                break;
            }

            ldap_unbind($ldap_conn);
        }
    }

    if ($authenticated) {
        echo "Hallo $username - Testlogin erfolgreich!";
    } else {
        echo "Anmeldung fehlgeschlagen!";
    }
} else {
    echo "Bitte senden Sie die Anmeldeinformationen per POST.";
}
?>

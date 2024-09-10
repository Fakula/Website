
    <?php
    if (!isset($_COOKIE['user_data'])) {
        echo '<form method="POST" action="/?url=Login">
                <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                <label for="remember_me">Vergiss mich nicht</label>
                <input type="checkbox" id="remember_me" name="remember_me" value="true">
                <button type="submit" name="accept_cookies" value="gib keks!">Accept Cookies</button>
              </form>';
    }


    if (isset($_COOKIE['user_data']) || json_decode($_COOKIE['user_data'])->User === 'Null') {
        echo '<form method="POST" action="/?url=Login">
                <input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">
                <label for="uname">Benutzername</label>
                <input type="text" id="uname" name="uname" required>
                <label for="psw">Passwort</label>
                <input type="password" id="psw" name="psw" required>
                <button type="submit" name="login_button">Login</button>
              </form>';
    }
   



    ?>






<?php 

/*

if (session_status() == PHP_SESSION_ACTIVE && !isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // CSRF-Token überprüfen und bereinigen
    $csrf_token = htmlspecialchars($_POST['csrf_token'], ENT_QUOTES, 'UTF-8');
    if (!isset($csrf_token) || $csrf_token !== $_SESSION['csrf_token']) {
        die('Ungültiges CSRF-Token');
    }

    // Eingaben bereinigen
    $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['user'] = $username;
        header('Location: index.php'); 
        exit();
    } else {
        echo 'Ungültiger Benutzername oder Passwort.';
    }
}



if (session_status() == PHP_SESSION_NONE) {
    echo '
    <form method="post" >
        <p>Für den Login wird ein Session-Token gesetzt (siehe Datenschutzerklärung).</p>
        <button type="submit" name="accept_cookies" value="gib keks!">Annehmen</button>
    </form>
    ';
}

if (session_status() == PHP_SESSION_ACTIVE && !isset($_SESSION['user'])) {
    // Wenn eine Session aktiv ist, aber kein Benutzer eingeloggt ist, zeige das Login-Formular
    echo '
    <form action="/?url=Login" method="post">
        <input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">
        <label for="username">Benutzername:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>';
} 



*/




?>

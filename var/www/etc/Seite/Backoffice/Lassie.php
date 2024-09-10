<?php
if (isset($_SERVER['REMOTE_USER'])) {
    $username = $_SERVER['REMOTE_USER'];
    echo "Willkommen, " . htmlspecialchars($username) . "!";
} else {
   # echo "Willkommen, Gast!";
}
?>

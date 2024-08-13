<?php
// Base64-codierte Bilder
$bildpath = $directory_path . "Bilder/";

$bild1 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($bildpath .'Bild1.jpg'));
$bild2 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($bildpath .'Bild2.jpg'));
$bild3 = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($bildpath .'Bild3.jpg'));
?>

    <div class="container">
        <div class="top-row">
            <img src="<?php echo $bild1; ?>" alt="Katinka" class="left">
            <img src="<?php echo $bild2; ?>" alt="Daniel" class="right">
        </div>
        <div class="bottom-row">
            <img src="<?php echo $bild3; ?>" alt="Mäuschen" class="center">
        </div>
    </div>

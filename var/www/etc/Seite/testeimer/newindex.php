<!doctype html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css" type="text/css">
  <title>Monis Steinwelt</title>
</head>

<body>
<section>
 <div>
	<h2>Monis Steinwelt.</h2>
</div>
<?php 
switch ($_GET['url'])
		{
			case "Impressum":
				require 'impressum.html';
			break
			
			case "Kalender"
  				require 'Kalender.php';
			break
			
			case  "Linkliste":
				require 'Linkliste.html';
			break
			
			default: 
				require 'Hauptseite.html';

}


?>

<div class="link-liste">
<p class="link-links" ><a href="index.php?url=Impressum">Impressum/Kontakt</a></p>
<p class="link-links" ><a href="index.php?url=Kalender">Kalender</a></p>
<p class="link-links" ><a href="index.php?url=Blog">Blog</a></p>
<p class="link-links" ><a href="index.php?url=Linkliste">Linkliste</a></p>
</div>


</body>
</html>
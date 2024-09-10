<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
//Reinholen der Datenbank-verbindung
require '../etc/Seite/Verbindung.php';
$Ueberschrift = "hier Überschrift einfügen";
$Teaser='hier kurzinhalt einfügen';
$Bildbeschreibung ="hier Bildbeschreibung einfügen";
$Bild='default/default';
$Text='hier bitte Text einfügen...';
$Artnr="1";
$sichtbar=1;

$Datum_tag=date("d");
$Datum_Monat=date("m");
$Datum_Jahr=date("Y");

//höchste zahl auslesen
function maxnr (){
$maxquery="Select MAX(ArtNr) from Hauptseite"; 
$ergebniss=mysqli_query($mysqli, $maxquery);
$row = $ergebniss ->fetch_assoc();
$maxnummer = $row['MAX(ArtNr)'];
echo 'Die höchste zahl beträgt'.$maxnummer;
return $maxnr;
}


// leider gibt es noch ältere Installationen als PHP 5.5 - die password_verify() nicht kennen
if (! function_exists('password_verify') ) {
	// Wenn es crypt() nicht gibt, dann ist das PHP so alt, dass sicherheitsrelaventes damit
	// nicht gemacht werden sollte:
	if (! function_exists('crypt') ) { 
		// es gibt auch noch ältere ...
		die ("Sorry: Aber Sie sollten Ihr PHP wirklich updaten!");
	}

	// Wenn es password_verify() nicht gibt, dann bauen wir eine:

	function password_verify($password, $HashedPassword) {
		if ( $HashedPassword == crypt($password, $HashedPassword) ) {
			return true;
	 } else {
	 	return false;
	 }
	}
}
function securemail($email){
	if ( (substr_count($email,'@'))!=1)
		{
			echo "@zeichen falsch";
			return false;	
		};
		
	$verbotene_zeichen=array('{', '}', '#', '=', ';' , '%','<','>','/' );
	if (in_array($email, $verbotene_zeichen))
		{
			echo "keine sonderzeichen (auser @) über Benutzereingaben erlaubt. ";
			return false;
		}
	if (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
		{
			echo "FILTER_VALIDATE_EMAIL-nicht bestanden";
			return false;			
		}
	return true;
};



function thumbnail($inputfile, $outputfile, $maxwith, $maxheigh){
	
	$imagefile = $inputfile;
	$imagesize = getimagesize($imagefile);
	$imagewidth = $imagesize[0];
	$imageheight = $imagesize[1];
	$imagetype = $imagesize[2];
	switch ($imagetype)
	{
		// Bedeutung von $imagetype:
		// 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(intel byte order), 8 = TIFF(motorola byte order), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM
		case 1: // GIF
			$image = imagecreatefromgif($imagefile);
			break;
		case 2: // JPEG
			$image = imagecreatefromjpeg($imagefile);
			break;
		case 3: // PNG
			$image = imagecreatefrompng($imagefile);
			break;
		default:
			echo 'Unsupported imageformat';
			return false;
			
	}

// Maximalausmaße
$maxthumbwidth = $maxwith;
$maxthumbheight = $maxheigh;
// Ausmaße kopieren, wir gehen zuerst davon aus, dass das Bild schon Thumbnailgröße hat
$thumbwidth = $imagewidth;
$thumbheight = $imageheight;
// Breite skalieren falls nötig
if ($thumbwidth > $maxthumbwidth)
{
	$factor = $maxthumbwidth / $thumbwidth;
	$thumbwidth *= $factor;
	$thumbheight *= $factor;
}
// Höhe skalieren, falls nötig
if ($thumbheight > $maxthumbheight)
{
	$factor = $maxthumbheight / $thumbheight;
	$thumbwidth *= $factor;
	$thumbheight *= $factor;
}
// Thumbnail erstellen
$thumb = imagecreatetruecolor($thumbwidth, $thumbheight);

//Bild skalieren
imagecopyresampled(
		$thumb,
		$image,
		0, 0, 0, 0, // Startposition des Ausschnittes
		$thumbwidth, $thumbheight,
		$imagewidth, $imageheight
		);

//Thumbnail speichern
//header('Content-Type: image/png');
//imagepng($thumb);
// In Datei speichern
$thumbfile = $outputfile;
imagepng($thumb, $thumbfile);
imagedestroy($thumb);
}
//
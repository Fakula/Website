<?php 
// Vorbereitung


error_reporting(E_ALL);
ini_set("display_errors", 1);
//Reinholen der befehle
require '../etc/befehle.php';
error_reporting(E_ALL);
// file anzeigen, später auskommentieren
echo "<pre>";
print_r ( $_FILES );
echo "</pre>";


//zahl generieren
$name=maxnr() + 1;
echo $name.'<p>';


//Ausführung

//Bild hochladen

// Verzeichniss anlegen
$upload_folder = 'Bilder/'.$name;
echo $upload_folder;
if (!mkdir($upload_folder, 0777, true)) {
	die('Erstellung der Verzeichnisse schlug fehl...');
	}
//vorbereitung für Bild
	$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
	$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
 
 //Überprüfung der Dateiendung
	$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
	if(!in_array($extension, $allowed_extensions)) {
		rmdir ($upload_folder);
		die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
		}
 
//Überprüfung der Dateigröße
$max_size = 2000*1024; //500 KB
if($_FILES['datei']['size'] > $max_size) {
	rmdir ($upload_folder);
	die("Bitte keine Dateien größer 500KB hochladen");
}
 
//Überprüfung dass das Bild keine Fehler enthält
$allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
$detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
if(!in_array($detected_type, $allowed_types)) {
	rmdir ($upload_folder);
	die("Die Bildatei scheint beschädigt. Bitte noch einmal versuchen");
}
 
//Pfad zum Upload
$new_path = $upload_folder.'/'.$name.'.'.$extension;
//Alles okay, verschiebe Datei an neuen Pfad
move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
echo 'Groses Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';

$inputfile = $new_path;
$outputfile= $upload_folder.'/'. $name.'-klein';
$maxwith= 350;
$maxheigh= 350;
thumbnail($inputfile, $outputfile, $maxwith, $maxheigh);
/*
$imagefile = $new_path;
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
		die('Unsupported imageformat');
}




// Maximalausmaße
$maxthumbwidth = 350;
$maxthumbheight = 350;
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
$thumbfile = $upload_folder.'/'. $name.'-klein';
imagepng($thumb, $thumbfile);
imagedestroy($thumb);

*/

//statement vorbereiten
$stmt=$mysqli->prepare("INSERT INTO `Hauptseite`(`Datum`, `Ueberschrift`, `Kurzinhalt`, `Bildbeschreibung`,`Text`,`Sichtbar`)
			VALUES (?, ?, ?, ?, ?, ? )");

$stmt->bind_param("ssssss", $Datum, $Ueberschrift, $Teaser, $Bildbeschreibung, $Text, $sichtbar );

//Text einfügen

$Ueberschrift =  $_POST['ueberschrift'];
$Teaser= $_POST['kurztext'];
$Bildbeschreibung = $_POST['Bildbeschreibung'];
$Text= $_POST['text'];
if ($_POST['sichtbarkeit']="eingeblendet"){
											$sichtbar=1;
										}

$Datum_tag=$_POST['Datum-Tag'];
$Datum_Monat=$_POST['Datum-Monat'];
$Datum_Jahr=$_POST['Datum-Jahr'];
$Datum= "$Datum_Jahr-$Datum_Monat-$Datum_tag" ;
var_dump($Datum);

if($stmt->execute()){
	echo 'Datenbank eintrag erfolgreich angelegt. - ID ist'.$name.'.';}
	
?>
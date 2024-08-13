
<?php 
$Datum_Monat=date("m");
$Datum_Jahr=date("Y");

/*if ($_GET['Jahr'] or $_GET['Monat']){
	if ($_GET['Jahr']){
		$Datum_Jahr=intval($_GET['Jahr']);		
		}
	if ($_GET['Monat']){
		$Datum_Monat=intval($_GET['Monat']);
	}
	$zeitraum=date("Y-m-d", mktime(0,0,0,$Datum_Monat,"01",$Datum_Jahr));
	$zeitraum2=date("Y-m-d", mktime(0,0,0,$Datum_Monat,"31",$Datum_Jahr));
	$querry= "Select * from Hauptseite Where Datum Between '" . $zeitraum .'"'.'and'. $zeitraum2 ;
	}
else {
*/
$querry= "Select * from Hauptseite" ;
$Content=mysqli_query ($mysqli, $querry);
if (! $Content){
	die('Ungültige Abfrage: ' . mysqli_error());
}

while ($zeile = mysqli_fetch_array($Content,MYSQL_ASSOC)){
	//Überschrift auslesen
	$Ueberschrift=$zeile['Ueberschrift'];
	$Teaser=$zeile['Kurzinhalt'];
	$Artnr=$zeile['Artnr'];
	$Bild=$Artnr.'/'.$Artnr;
	$Bildbeschreibung=$zeile['Bildbeschreibung'];
	$sichtbar=$zeile['Sichtbar'];
	$delete=$zeile['delete'];
	
	if ($sichtbar=='1' && !$delete=='1'){		
		echo '<h3><a href="?ArtNR='.$Artnr.'">'.$Ueberschrift.'</a></h3>';
		echo '<div class="Container">';
		echo '<p class="Text">'.$Teaser.'</p>';
		echo '</div>';
		echo '<div class="Bilderrahmen">';
		echo '<img class="Bild" src="Bilder/'.$Bild.'" alt="'.$Bildbeschreibung.'" >
		</div>';
		};

}
mysqli_free_result( $Content );
?>

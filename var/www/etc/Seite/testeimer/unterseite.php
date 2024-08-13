<?php

$Artnr=intval($_GET['ArtNR']);
$querry= "SELECT `Datum` , `Ueberschrift` , `Bildbeschreibung` , `Text` , `Sichtbar` , `delete` 
		FROM `Hauptseite` WHERE `Artnr` =".$Artnr;
$Content=mysqli_query ($mysqli, $querry);
if (! $Content){
	die('Ungültige Abfrage: ' . mysqli_error());
}
$zeile = mysqli_fetch_array($Content,MYSQL_ASSOC);

$sichtbar=$zeile['Sichtbar'];
$delete=$zeile['delete'];
if ($sichtbar=='1' && !$delete=='1')
	{
	$Datum=$zeile['Datum'];
	$Ueberschrift=$zeile['Ueberschrift'];
	$Bildbeschreibung=$zeile['Bildbeschreibung'];
	$Text=$zeile['Text'];
	$Bild=$Artnr.'/'.$Artnr;
	}
?>
<
<h3><?php if ($sichtbar=='1' && !$delete=='1')
	{ echo $Ueberschrift;}
	else {echo "hier gibts nichts zu sehen, weitergehen";}
	?></h3>
<div class="Bild-gross">
	<p><?php echo $Text;?></p>
</div>

<?php if ($sichtbar=='1' && !$delete=='1')
	{
		echo '<img class="Bild" src="Bilder/'.$Bild.'" alt="'.$Bildbeschreibung.'">';
	}
else {
	echo '<img class="Bild-gross" src="mobile-home-156914_1280.png" alt="" >';
	}
?>
<img class="Bild-gross" src="mobile-home-156914_1280.png" alt="" >
</article>

</section>
<footer>
            <p class="footer">Impressum | Kontakt </p>
</footer>
</body>
</html>
<?php mysqli_free_result( $Content );?>
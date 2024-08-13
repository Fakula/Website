<?php error_reporting(E_ALL);?>
<form action="upload.php" method="post" enctype="multipart/form-data"> 
<input id="text" name="ueberschrift" placeholder="Hier die überschrifte eintragen" 
value="<?php if ($Ueberschrift){echo $Ueberschrift;}?>">
<textarea id="text" name="kurztext" placeholder="Hier den kurztext eintragen" cols="32" rows="5">
<?php if ($input_kurztext){echo $input_kurztext;}?>
</textarea> 	
<textarea id="text" name="text" placeholder="Hier den text eintragen" cols="32" rows="5">
<?php if ($input_text){echo $input_text;}?>
</textarea> 	
<select name=Datum-Tag>
	<?php 
		$day=1;
		While ($day < 32){
			if (date("d")==$day){
				echo "<option selected >".$day."</option>";
				}
			else{		 
				echo "<option>".$day."</option>";
				}
			$day++;
		}
	
	?>
</select>

<select name="Datum-Monat">
	<?php 
  $Monatsnamen=array(1=>'Januar','Febraur','März','April','Mai','Juni','July','August','September','Oktober','November','Dezember');
	$Monat=1;
	while ($Monat<13){
		if (date("m")==$Monat){
		 echo "<option selected >".$Monatsnamen[$Monat]."</option>";			
		}else 	{
			echo "<option>".$Monatsnamen[$Monat]."</option>";
				}
		$Monat++;
	}
  	?>
</select>
	
	
<select name="Datum-jahr">
	<?php 
	$J=2015;
	$Jend=date("Y")+2;
	while($J<$Jend){
		if( date("Y")==$J){
			echo'<option selected>'.$J.'</option>';
		} else {echo'<option>'.$J.'</option>';}
		$J++;
	};?>
	</select>
<input type="file" name="Bild-klein"><br>
<input type="radio" name="Sichtbarkeit" value="eingeblendet" <?php if( $sichtbar=1){echo 'checked="checked"';}?>/>
<input type="radio" name="Sichtbarkeit" value="ausgeblendet" <?php if(!$sichtbar=1){echo 'checked="checked"';}?>/>
<input type="submit" value="Feuer!">

</form>
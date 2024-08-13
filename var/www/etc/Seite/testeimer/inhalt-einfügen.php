<?php 
// Vorbereitung


error_reporting(E_ALL);
ini_set("display_errors", 1);
//Reinholen der befehle
require '../etc/befehle.php';
error_reporting(E_ALL);

$email="stegerdaniel@yahoo.de";
$passwort="fail";

if (empty($_POST['Username']) && empty($_POST['Passwort']))
	{
		require '../etc/Passwortfeld.html';	
		die;
	}
if (!securemail($_POST['Username']))
	{
		require '../etc/Passwortfeld.html';
		die;
	}
$email=$_POST['Username'];
	
	{ 	//passwort holen
		$userstatement=$mysqli->prepare("SELECT `passwort` FROM `user` WHERE `email`= ?");
		$userstatement->bind_param("s", $email);
		
		$userstatement->execute();
		
		mysqli_stmt_bind_result($userstatement, $passwort);
		$userstatement->fetch();
		//Passwort existiert nicht
		if ($passwort=="fail")
		{
			echo "user existiert nicht";
			require '../etc/Passwortfeld.html';
			die;
		}}
//passwort vergleichen
 $passwd=$_POST['Passwort'];
if (!password_verify($passwd, $passwort))
		{
			echo "falsches Passwort";
			echo $passwort;
			require '../etc/Passwortfeld.html';
			die;
		}
/*if($_POST['Username']!=$username && $_POST['Passwort']!=$passwort)
	{
	require '../etc/Passworteingabe.php';	
	die; 
	}	*/
	?>

<form action="upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="datei"><br>
<label>Bild</label>
<input type= "text" name="Bildbeschreibung" placeholder="hier die Bildbeschreibung eintragen">
<label>Bildbeschreibung</label>
<input id="text" name="ueberschrift" placeholder="Hier die überschrifte eintragen" >
<label>Überschrift</label>
<textarea id="text" name="kurztext" placeholder="Hier den kurztext eintragen" cols="32" rows="5">
</textarea> 
<label>Teaser</label>
<textarea id="text" name="text" placeholder="Hier den text eintragen" cols="32" rows="5">
</textarea>
<label>Content</label>
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
		 echo '<option selected value="'.$Monat.'">'.$Monatsnamen[$Monat].'</option>';			
		}else 	{
			echo '<option value="'.$Monat.'">'.$Monatsnamen[$Monat]."</option>";
				}
		$Monat++;
	}
  ?>
 </select>
 <select name="Datum-Jahr">
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
<input type="radio" name="Sichtbarkeit" value="eingeblendet" <?php if( $sichtbar=1){echo 'checked="checked"';}?>/>
<label>sichtbar</label>
<input type="radio" name="Sichtbarkeit" value="ausgeblendet" <?php if(!$sichtbar=1){echo 'checked="checked"';}?>/>
<label>unsichtbar</label>

<input type="submit" value="Hochladen">
</form>
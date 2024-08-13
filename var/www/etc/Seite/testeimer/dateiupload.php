<form name="uploadformular" enctype="multipart/form-data" action="dateiupload.php" method="post" >
Datei: <input type="file" name="uploaddatei" size="60" maxlength="255" >
<input type="Submit" name="submit" value="Datei hochladen">
</form>

<?php
error_reporting(E_ALL);
echo "<pre>";
print_r ( $_FILES );
echo "</pre>";
/* hier kommt nun das Formular ? am Ende !! */
?>

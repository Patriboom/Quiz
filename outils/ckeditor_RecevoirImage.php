<?php
	if (!isset($_SESSION)) { session_start(); }

	if ($_FILES["upload"]['size'] > 0 && isset($NumMbre) ) {
		$destination_dir = $prefixe."images/".substr($_SESSION["Repertoire"], 5);
		include_once "TraiterImage.php";

		$_POST["Confirmer"] = "oui";
		$NomFinal = substr($_FILES["upload"]["name"],0, (strlen($_FILES["upload"]["name"])-4));
		$NomFinal = str_replace(" ", "", $NomFinal);
		Telechargement ($_FILES["upload"], $destination_dir, $NomFinal, $LargeurFinale = 450, $HauteurFinale = 300, $Sens = "Horiz", $NumMbre);
?>
		<script>
			for(NumRef=90; NumRef<1900; NumRef++) {
				if (parent.document.getElementById('cke_' + NumRef + '_label')) {
					if (parent.document.getElementById('cke_' + NumRef + '_label').innerHTML == 'OK') {
						break; 
					}
				}
			}
			//De base, on peut attendre que le bouton OK porte le numéro 138
			//Dans ce cas, les valeurs qui nous intéressent seront 57, 67, 70, 76, 79, 82, 85 et 138
			//Ddonc les valeurs calculées se font en soustrayant   81, 71, 68, 62, 59, 56, 53 et 0
			parent.document.getElementById('cke_' + (NumRef - 81) + '_textInput').value = "<?php echo ((in_array($_SERVER['SERVER_NAME'], array('127.0.0.1','127.0.0.2','localhost'))) ? 'http://localhost/MesSites/Plongee/' : 'https://plongee.ca/' ); ?><?php echo substr($destination_dir, 3).'/'.$NumMbre.'_'.$_FILES["upload"]["name"]; ?>";
			parent.document.getElementById('cke_' + (NumRef - 71) + '_textInput').value = "200";
//			parent.document.getElementById('cke_' + (NumRef - 68) + '_textInput').value = "150";
			parent.document.getElementById('cke_' + (NumRef - 62) + '_textInput').value = "0";
			parent.document.getElementById('cke_' + (NumRef - 59) + '_textInput').value = "15";
			parent.document.getElementById('cke_' + (NumRef - 56) + '_textInput').value = "15";
			parent.document.getElementById('cke_' + (NumRef - 53) + '_select').selectedIndex = 1;
			parent.document.getElementById('cke_' + (NumRef - 45) + '_uiElement').style.display = 'block';
//			parent.document.getElementById('cke_' + (NumRef - 0) + '_label').click();
		</script>
		
<?php
	} else {
		$MsgErr = array($LngOutils[0], 
			$LngOutils[1], 
			$LngOutils[2], 
			$LngOutils[3]."( ".sys_get_temp_dir()." ) ", 
			$LngOutils[4], 
			$LngOutils[5], 
			$LngOutils[6], 
			$LngOutils[7] 
			);
		echo '<script>alert("'.$LngOutils[8].'.\n'.$MsgErr[$_FILES['upload']['error']].'");</script>';
	}

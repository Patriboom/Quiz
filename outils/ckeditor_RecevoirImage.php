<?php
	if (!isset($_SESSION)) { session_start(); }
	$file_max_size = 2000000;
	$prefixe = "../";

	if ($_FILES["upload"]['size'] > 0 && $_FILES["upload"]['size'] < $file_max_size) {
		$_SESSION["Repertoire"] = $_SESSION["Repertoire"] ?? ".";
		$destination_dir = $prefixe."images/".$_SESSION["Repertoire"]."/";

		//$lastPos = strrchr($_FILES["upload"]["name"], ".");
		$lastPos = strrpos($_FILES["upload"]["name"], ".");
		$typeFile = strtolower(substr($_FILES["upload"]["name"], $lastPos));
		$NomFinal = substr($_FILES["upload"]["name"],0, (strlen($_FILES["upload"]["name"])-4));
		$NomFinal = str_replace(" ", "", $NomFinal);
		$NomFinal .= strtolower($typeFile);
		$authorized_extensions = array('image/jpeg', 'image/jpeg', 'image/png' );

		if (is_dir($destination_dir) && is_writeable($destination_dir) && $lastPos !== false && in_array(strToLower($_FILES["upload"]["type"]), $authorized_extensions)) {
			copy ($_FILES["upload"]['tmp_name'], $destination_dir.$NomFinal);
			$object = new stdClass();
			return $object;
		}
	} else { 
		echo 'Pas de fichier recu.<br />'; return false; 
	} 

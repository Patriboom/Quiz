<?php
session_start();
if (isset($_SESSION["PlongeePSEUDO"])) {
	$CeFichier 	= $_FILES["Fichier_".$_GET["Num"]]; 
	$fileName 	= $CeFichier["name"]; 		//Le nom du fichier
	$fileTmpLoc = $CeFichier["tmp_name"]; 	//Le répertoire temporaire de destination
	$fileType 	= $CeFichier["type"]; 		//Le type de fichier
	$fileSize 	= $CeFichier["size"]; 		//La taille du fichier (en octets)
	$fileErrorMsg 	= $CeFichier["error"]; 	// 0 for false... and 1 for true	//Correct (0) ou erroné(1)
	$RepDest = (isset($_GET["LaDest"])) ? "../".$_GET["LaDest"]."/" : "../temp/Reception/";

	if (!$fileTmpLoc) { 							// Aucun fichier n'a été choisi
		echo 'ERREUR: Veuillez pointer vers un fichier existant ou respectant les limites imposées.<br />';
		exit();
	}
	$msg = '<font color="990000">Fichier '.$fileName.' trop gros. </font><br />';
	if ($fileSize > 2000000) {
		//Erreur de fichier, taille dépassant les limites fixées 
		echo 'Fichier trop gros'; 
		return false; 
	} else {
		if (!file_exists($RepDest)) { mkdir ($RepDest, 0775, true); }
		if(move_uploaded_file($fileTmpLoc, $RepDest.$fileName)) {
			//Message de succès du téléchargement
			$msg  = 'Nous avons téléchargé `<font color="009900">'.$fileName.'</font>´ en entier.<br />';
			if ($fileType == 'image/jpeg') { 
				//Traitement des images JPG
				include_once "../outils/TraiterImage.php";
				$_POST["Confirmer"] = "Confirmer";
				$CeFichier["tmp_name"] = $RepDest.$CeFichier["name"];
				if (Telechargement ($CeFichier, $RepDest, $_GET["NomFichier"], $_GET["TailleX"], $_GET["TailleY"], "Horiz", $_GET["NumMbre"])) {
					include_once "../outils/Securite/AccesBase.php";
					include_once "../outils/FonctionsCommunes.php";
					//Inscription dans les archives
					Requis("INSERT INTO plongee_archives VALUES (NULL, ".$_SESSION["NumMbre"].", NOW(), '<img src=\"".substr($RepDest, 3).$_SESSION["NumMbre"]."_".$_GET["NomFichier"].".jpg\" width=\"150\" style=\"vertical-align: text-top; \" />')");
				}
			} elseif ($fileType == 'image/png') {
				//Traitement des images PNG 
				include_once "../outils/TraiterImagePNG.php"; 
				$_POST["Confirmer"] = "Confirmer";
				$CeFichier["tmp_name"] = "../temp/Reception/".$CeFichier["name"];
				TelechargementPNG ($CeFichier, $RepDest, $_GET["NomFichier"], $_GET["TailleX"], $_GET["TailleY"], "Horiz", $_GET["NumMbre"]);
			} else {
				//Autres types de fichier, nous ne traitons pas.
				$msg = 'Vous devrez déplacer votre fichier manuellement';
			}
		} else {
			//Erreur de téléchargement
			$msg =  'La fonction `move_uploaded_file` ne put réaliser son travail. `<font color="990000">'.$fileName.'</font>´ ne put être téléchargé.';
		}
	}
	echo $msg;
}
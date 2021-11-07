<?php
session_start();
$prefixe = "../";
$contenu = "";

if ($_SESSION["Pseudo"] == 'Patriboom') {
	if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Reponses.htm")) {
		$contenu = file_get_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Reponses.htm");
	}
	echo $contenu;
}
?>
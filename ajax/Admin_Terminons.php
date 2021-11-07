<?php
session_start();
$prefixe = "../";
$contenu = "";

if ($_SESSION["Pseudo"] == 'Patriboom') {
//	if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Prof.htm")) {
		unlink ($prefixe."temp/".$_SESSION["ChxQuiz"]."/Prof.htm");
//	}
	echo "Au revoir!";
}
?>
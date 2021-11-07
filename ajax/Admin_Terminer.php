<?php
session_start();
$prefixe = "../";
$contenu = "";

if ($_SESSION["Pseudo"] == 'Patriboom') {
	if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Reponses.htm")) {
		if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Reponses.htm")) { unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/Reponses.htm"); }
		if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm")) { unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm"); }
		if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Prof.htm")) { unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/Prof.htm"); }
		if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm")) { unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm"); }
		file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Prof.htm", "Fini");
	}
	echo "La fenêtre des joueurs se fermera automatiquement.<br />Veuillez patienter quelques secondes et <b>NE PAS FERMER</b> la préssente fenêtre (elle sera fermée automatiquement).";
}
?>
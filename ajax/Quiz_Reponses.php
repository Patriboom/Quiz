<?php
	session_start();
	$contenu = "Vous n`avez pas accès à ces fonctions";
	$prefixe = "../../";
	if (!isset($_SESSION["Eleves"])) { return true; exit(); }
	if (!isset($_SESSION["AdminEcole"])) { return true; exit(); }

	if ($_GET["Quoi"] == 'Lire') {
		$contenu = "";
		foreach($_SESSION["Eleves"] as $NumEleve) {
				if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm")) { $contenu .= file_get_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm").'<br />'; }
		}
	}
	echo $contenu;
?>
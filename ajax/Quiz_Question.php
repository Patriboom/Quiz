<?php
	session_start();
	$prefixe = "../";
	include $prefixe."Langues/FR/Quiz.php";
	$contenu = "";
	$present = true;

if (isset($_SESSION["ChxQuiz"])) {
	if (!file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm") && file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Quest.htm")) {
			unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Quest.htm");
			if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm")) { unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm"); }
			$contenu = "En attente de l`animateur";
	}
	if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm") && !file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Quest.htm")) {
			if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm")) { unlink($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm"); }
			$contenu = file_get_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm");
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Quest.htm", $contenu);
	}
	if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm")) {
		if (!file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm")) {
			$contenu = file_get_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm");
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm", $contenu);
		}
	}
	if (file_get_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Prof.htm") == 'Fini') {
		$contenu = 'Fini';
	}
}
echo $contenu;
?>
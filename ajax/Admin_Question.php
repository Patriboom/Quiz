<?php
	session_start();
	$prefixe = "../";
	include $prefixe."Langues/FR/Quiz.php";
	$contenu = "";
	$present = true;

if ($_SESSION["Pseudo"] == 'Patriboom') {
	if (isset($_SESSION["ChxQuiz"])) {
		if ($_GET["Quoi"] == 'Question') {
			if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm")) { unlink ($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm"); }
			if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm")) 	{ unlink ($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm"); }
			$_SESSION["QuestionsPassees"][] = $_GET["Quelle"]; 
			$contenu .= file_get_contents($prefixe."Jeux/".$_SESSION["ChxQuiz"]."/Quest_".$_GET["Quelle"].".htm");
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm", $contenu);
		} elseif ($_GET["Quoi"] == 'Reponse') {
			if (file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm")) { unlink ($prefixe."temp/".$_SESSION["ChxQuiz"]."/Quest.htm"); }
			$contenu = file_get_contents($prefixe."Jeux/".$_SESSION["ChxQuiz"]."/Rep_".$_GET["Quelle"].".htm");
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Rep.htm", $contenu);
		}
	}
	echo $contenu;
}
?>
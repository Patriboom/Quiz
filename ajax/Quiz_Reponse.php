<?php
	session_start();
	$prefixe = "../";
	$contenu = "";

include $prefixe."Langues/FR/Quiz.php";

	$Dossier = $prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"];
	if (file_exists($Dossier)) {
		$NumQuest = trim(substr($_POST["Quest"], 0, strpos($_POST["Quest"], ".")));
		if (!file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/MesRep.txt")) { 
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/MesRep.txt", "Joueur: ".$_SESSION["NumMbre"].";\nJeu: ".$_SESSION["ChxQuiz"].", ".date("Y-m-d H\hi:s").";\n", FILE_APPEND); 
		}
		file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/Reponses.htm", "<li>".$_SESSION["Pseudo"].": ".$_POST["MaRep"].".".$_POST["Rep"]." en ".$_POST["Duree"]." sec. </li>");
		file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/MesRep.txt", $NumQuest.":".$_POST["MaRep"].";\n", FILE_APPEND);
	} else { 
		$contenu = $Lng_Cours_Quiz[11];
	}
	$contenu = $Lng_Cours_Quiz[10].".<br />".$Lng_Cours_Quiz[6]." : ".$_POST["Duree"]." sec.";

	echo $contenu;
?>
<?php
	session_start();
	$prefixe = "../";
	$contenu = "";

$contenu = implode("<br />", $_POST);
include $prefixe."Langues/FR/Quiz.php";

	if (@$_POST["Quoi"] == 'Repondre') {
		//$Dossier = $prefixe."documents/Eleves/Quiz/".$_SESSION["NumMbre"]."/".$_SESSION["ChxQuiz"]."_".date("Ymd");
		$Dossier = $prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"];
		if (file_exists($Dossier)) {
			$NumQuest = trim(substr($_POST["Quest"], 0, strpos($_POST["Quest"], ".")));
			if (!file_exists($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/MesRep.txt")) { 
				file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/MesRep.txt", "Joueur: ".$_SESSION["NumMbre"].";\nJeu: ".$_SESSION["ChxQuiz"].", ".date("Y-m-d H\hi:s").";\n", FILE_APPEND); 
			}
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/Rep.htm", "<b>".$_POST["MaRep"]."</b>. ".$_SESSION["NumMbre"]." : <span style=\"color:black;\">".$_POST["Rep"]."</span> ( ".$_POST["Duree"]." sec. ) ");
			file_put_contents($prefixe."temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."/MesRep.txt", $NumQuest.":".$_POST["MaRep"].";\n", FILE_APPEND);
			$contenu = $Lng_Cours_Quiz[10].".<br />".$Lng_Cours_Quiz[6]." : ".$_POST["Duree"]." sec.";
		} else { 
			$contenu = $Lng_Cours_Quiz[11];
		}
	}
	echo $contenu;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Amusons-nous un peu</title>
<link rel=stylesheet HREF="general.css" TYPE="text/css">
<style>
.Options {
	border: 2px solid navy;
	float: left;
	margin: 20px;
	max-width: 50%;
}
</style>
</head>
<body>
<script type="text/javascript" src="scripts/Anim.js" ></script>
<?php 
session_start();
include_once "Langues/FR/Quiz.php";
include_once "Langues/FR/Anim_Quiz.php";

echo '<img src="images/Quiz.png" width="154" height="150" align="left" style="position: absolute; top: 3px; left: 15px;") />';
echo '<br />';
echo '<h1 style="position: absolute; top: 5px; left: 175px;">'.$_SESSION["ChxQuiz"].'</h1>';
$NbQuest = 0;

//Troisième section : le jeu est en cours
if (isset($_POST["Resultat"]) && isset($_POST["Quel"])) {
	//Définition des outils de travail
	////Variables
	$_SESSION["Eleves"] = $_SESSION["Eleves"] ?? $_POST["Eleve"];
	$_SESSION["IDcrs"] = $_SESSION["IDcrs"] ?? $_POST["IDcrs"]; 
	$_SESSION["Jeu"] = $_SESSION["Jeu"] ?? $_POST["Jeu"]; 
	$_SESSION["QuestionsPassees"] = $_SESSION["QuestionsPassees"] ?? array();
	$Dossier = "temp/".$_SESSION["ChxQuiz"];
	$_SESSION["Quiz"] = $Dossier;
	

	//Affichage du panneau de jeu
	////Choix des questions
	echo '<br /><br />';
	echo '<div id="Questions" style="position: absolute; top: 75px; left: 400px;">';
	$LesQuest = scandir("Jeux/".$_SESSION["ChxQuiz"]);
	
	//Affichage des numéros des questions
	foreach ($LesQuest as $Quest ) {
		if (in_array($Quest, array(".","..","index.php","index.html","index.htm"))) { continue; }
		if (substr($Quest, -1) == "~") { continue; }
		if (substr($Quest, 0, 5) != "Quest") { continue; }
		$x = substr($Quest, 6, 2);
		$NbQuest = $NbQuest + 1;
		$faite = ((in_array($x, $_SESSION["QuestionsPassees"]))) ? true : false; 
		echo '&nbsp;';
		echo '<a id="a_Quest_'.$x.'" href="javascript:ChxQuestion(\''.$x.'\');" class="AdminQuest"/>'.($x+1).'</a>';
		echo '&nbsp;';
	}
	echo '</div>';
	echo '<br clear="all" />';
	echo '<div id="Question" style="position: absolute; width: 100%; left: 0; top: 210px;"></div>';
	echo '<div id="Reponse"></div>';
	echo '<div id="RepQuestion" style="position: absolute; top: 550px;"></div>';
	echo '<div id="StatsPerso"></div>';
	echo '&nbsp;&nbsp;';
	echo '<div style="position: absolute; top: 20px; left: 90%; z-index: 100;" >';
	echo '<input name="Clore" id="input_clore" value="'.$Lng_Admin_Cours_Quiz[16].'" type="button" onclick="Terminer();" style="background-color: red; color: white; font-size: 140%; border-spacing: 3px; border-color: black; border-style: solid; margin: 3px; border-radius: 6px;" onmouseover="this.style.color=\'black\';" onmouseout="this.style.color=\'white\';" />';
	echo '</div>';
	echo '&nbsp;&nbsp;';
	echo '</ul>';
	////Espace d'affichage de la progression
	echo '
		<div id="div_jeuQuestion" style="font-size: 120%;"></div>
		<br clear="all" />
		<script>var NbQuest = '.$NbQuest.';</script>
		<input name="chronoDebut" id="StatsImage" value="" type="hidden" />
		<input name="chronoDebut" id="chrono_debut" value="" type="hidden" />
		<input name="chronoFin" id="chrono_fin" value="" type="hidden" />
		<div id="div_jeuResultat" style="background-color: #CCCCCC; color: darkgreen; float: none; text-align: left;"></div>
		<div id="div_jeuReponses" style="background-color: #323232; color: #9898CC; position: absolute; top: 650px; left: 900px;">Ici</div>
		<input name="Soumettre" value="Soumettre" type="hidden" />
		<input name="mod" value="Admin" type="hidden" />
		<input name="fct" value="Cours" type="hidden" />
		<input name="Agit" value="Quiz" type="hidden" />
		<input name="Quoi" value="Clore" type="hidden" />
		<input name="Resultat" value="Fin" type="hidden" />
		';
} else {
	//Deuxième section : choix des élèves et de la forme de jeu	
	$compte = 0;
	unset($_SESSION["QuestionsPassees"]);
	echo '<form name="ChoisissonsEleves" action="Anim.php" method="POST">';
	//Liste des élèves
	echo '<br clear="all" />';
	echo '<br clear="all" />';
	echo '<br clear="all" />';
	echo '<br clear="all" />';
	echo '<br clear="all" />';
	echo '<br clear="all" />';
	$resu = scandir("temp/".$_SESSION["ChxQuiz"]."/");
	if (count($resu) == 0) {
		echo $Lng_Admin_Cours_Quiz[5];
	} else {
		echo $Lng_Admin_Cours_Quiz[6].'<br />';
		echo '<ul>';
		foreach ($resu as $Eleve) {
			if ($Eleve == '.' || $Eleve == '..') { continue; }
			if (substr($Eleve, 0, 9) == "Patriboom") { continue; }
			if (substr($Eleve, strpos($Eleve, "_")+1, 8) != date("Ymd")) { continue; }
			if (file_exists("temp/".$_SESSION["ChxQuiz"]."/".$_SESSION["NumMbre"]."_Fini.txt")) { continue; }
			echo ++$compte.'. <input name="Eleve[]" value="'.$Eleve.'" type="checkbox" checked="checked" />'.substr($Eleve, 0, strpos($Eleve, "_")) .'<br />';
		}
		echo '<br /><br /><br />';
		
		if ($compte == 0) {
					echo $Lng_Admin_Cours_Quiz[5];
					echo '<br />';
					echo '<a href="index.php">Retour à l`accueil</a>';
		} else {
			//Délai de réponse
			echo $Lng_Admin_Cours_Quiz[12].' : <input name="DelaiMax" value="30" type="number" size="4" max="100" min="0" style="background-color: #666666; color: #FFFFFF; font-size: 12pt;" /> sec.';
			echo '<br /><br />';
			echo '<input type="submit" name="Soumettre" id="Form_Questionne" value="Lançons le jeu" class="Bouton_Turquoise" />';	
			echo '<br /><br /><br />';
	
			echo '</ul>';
			
			
			//Liste des révsions de connaissance et quiz disponibles
			$rendu = "NousVerronsBien";
			echo '<input type="hidden" name="Jeu" value="'.$_SESSION["ChxQuiz"].'"/>';
			//var_dump($LesQuiz);
			echo '<br /><br />';
			echo '<input name="Agir" value="Quiz" type="hidden" />';
			echo '<input name="Quel" value="'.$_SESSION["ChxQuiz"].'" type="hidden" />';
			echo '<input name="IDcrs" value="'.$_SESSION["ChxQuiz"].'" type="hidden" />';
			echo '<input name="Resultat" value="Debut" type="hidden" />';
			echo '</form>';
		}
	}
}

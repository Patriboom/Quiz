<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Quiz pour tout, quiz pour tous</title>
<link rel=stylesheet HREF="general.css" TYPE="text/css">
<?php
	session_start();
	$prefixe = "";

	//Chargement du fichier de configurations
	if (!file_exists("config.app.php")) { 
		////S'il n'existe pas, nous en créons un à partir du modèle
		copy ("config.app.example", "config.app.php"); 
	}
	include "config.app.php";

	//Modifications demandées par l'usager
	if (isset($_POST["Soumettre"]) && isset($_GET["Quoi"])) {
		if ($_GET["Quoi"] == 'Options') {
			//Sauvegarde du fichier précédent
			$SavFichier = "config.app.".date("Ymdhis").".php";
			copy ($prefixe."config.app.php", $prefixe.$SavFichier);
			unset($_POST["Soumettre"]);

			//Modifications au fichier de configuration
			$rendu = 0;
			$RefFichier = fopen("config.app.php", "r");
			while (!feof($RefFichier)) {
				$MesLignes[$rendu] = fgets($RefFichier);
				foreach($_POST as $ind => $val) {
					if (strpos($MesLignes[$rendu], "'".$ind."'") !== false && !isset($NumLigne[$ind]))  { 
						$NumLigne[$ind] = $rendu; 
						$MesLignes[$rendu] = substr($MesLignes[$rendu], 0, strpos($MesLignes[$rendu], '=>')+2)." '".$val."',
	";
					}
				}
				++$rendu;
			}
			fclose($RefFichier);

			//Enregistrement du nouveau fichier corrigé  
			$NeoFichier = fopen("config.app.php", "w");
			foreach ($MesLignes as $ind => $val) {
				fwrite($NeoFichier, $val);
			}
			fclose($NeoFichier);
			$config = $_POST;
			////Fin de la modification du fichier config.app.php
			
		} elseif ($_GET["Quoi"] == 'Creons') {
			//Modidfications à un questionnaire
			if ($_POST["Fonction"] == "Creons") {
				////Première étape de création:  le nom
				$_SESSION["Repertoire"] = $prefixe."Jeux/".$_POST["NomJeu"];
				if (!file_exists($prefixe."images/".$_POST["NomJeu"])) 	{ mkdir ($prefixe."images/".$_POST["NomJeu"]); }
				if (!file_exists($_SESSION["Repertoire"])) 					{ mkdir ($_SESSION["Repertoire"]); }
				$_SESSION["Repertoire"] = "Jeux/".$_POST["NomJeu"];
				file_put_contents($_SESSION["Repertoire"]."/index.htm", "<script>document.location.href='../../index.php';</script>");
				file_put_contents($_SESSION["Repertoire"]."/index.html", "<script>document.location.href='../../index.php';</script>");
				file_put_contents($_SESSION["Repertoire"]."/index.php", "<script>document.location.href='../../index.php';</script>");
				$_SESSION["CreonsCeci"] = 'Question';
				$_SESSION["NumQuestion"] = 1;
			} elseif ($_POST["Fonction"] == "Question") {
				////Deuxième étape de création:  une questions, ses réponses, ses explications
				$_SESSION["Repertoire"] = $_POST["NomJeu"];
				$_SESSION["NumQuestion"] = $_POST["NumQuestion"] + 1;
				$_SESSION["CreonsCeci"] = 'Question';
				$NumeroFi = substr("00".($_POST["NumQuestion"]-1), -2);
				$NumQuest = substr("00".($_POST["NumQuestion"]-0), -2);
				$Options  = "";
				$Details = addslashes($_POST["Explication"]);
				$NumRep = 1;
				foreach ($_POST["Reponse"] as $ind => $val) {
					if (trim($val) != '') {
						$Options .= "<div  id=\"Rep".($NumRep++)."\" class=\"Options\" onclick=\"MaRep(".$ind.");\">
".$val."
</div>
";
					} 
				}
				file_put_contents($_SESSION["Repertoire"]."/Quest_".$NumeroFi.".htm", "Questions|".$NumQuest."|<div id=\"div_question\" class=\"Question\">".intval($NumQuest).". ".$_POST["Question"]."</div>".$Options);
				file_put_contents($_SESSION["Repertoire"]."/Rep_".$NumeroFi.".htm", "Reponse|".$_POST["BonneRep"]."|".$Details."");
			}
		}
	}
?>
</head>
<body>
<img src="images/Quiz_1.jpg" alt="" />
	<div style="text-align: center; font-size: 140%;">
	<h1>Quiz pour tout, quiz pour tous / Quiz for all</h1>
	<h2>Administration du système / System administrator</h2>


	<br /><br />
	<h3>Options de configuration / Config options</h3>
	<form name="Questionne" id="FormQuestionne" action="Administrateur.php?Quoi=Options" method="POST">
		<?php
			foreach ($config as $ind => $val) {
				echo '<label>'.$ind.'</label>&nbsp;&nbsp;&nbsp;:&nbsp;<input name="'.$ind.'" value="'.$val.'" /><br />';
			}
		?>	
		<br /><br />
		<input name="Soumettre" type="submit" id="input_SoumettreConf" value="Soumettre / Submit" class="Bouton_Turquoise"/>
		
	</form>
	<br /><br />
	<hr />
	<br /><br />
	<h3>Créer un quiz / Create new quiz</h3>
	<form name="Questionne" id="FormQuestionne" action="Administrateur.php?Quoi=Creons" method="POST">
		<?php
		echo '<br /><br />';
			$_SESSION["CreonsCeci"] = $_SESSION["CreonsCeci"] ?? 'Rien';
			$_SESSION["Repertoire"] = $_SESSION["Repertoire"] ?? 'Rien';  
			if ($_SESSION["CreonsCeci"] == 'Rien' || !file_exists($_SESSION["Repertoire"]) ) {
				echo '<input name="Fonction" value="Creons" type="hidden" />';
				echo 'Nom du jeu / Game`s name : <input name="NomJeu" type="text" value="" maxlenght="30" placeholder="NomDuJeu / GamesName" /><br />';
				echo '<br /><br />';
				unset ($_SESSION["CreonsCeci"]);
			} else {
				echo '<input name="NomJeu" value="'.$_SESSION["Repertoire"].'" type="hidden" />';
				echo '<input name="Fonction" value="Question" type="hidden" />';
				echo 'Numéro de la question / Question number : <input name="NumQuestion" value="'.$_SESSION["NumQuestion"].'" type="number" min="1" max="99" size="4" />';
				echo '<br /><br />';
//				echo 'Libellé de la question / Question phrase : <input name="Question" value="" type="text" size="60" />';
				echo 'Libellé de la question / Question phrase';
				echo '<div style="position: relative; left: 25%;">';
				echo '<textarea name="Question" value="" /></textarea>';
				echo '</div>';
				echo '<br /><br />';
				echo '<input name="BonneRep" value="1" type="radio" />';
				echo 'Réponse 1 / Answer 1 : <input name="Reponse[1]" value="" type="text" />';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input name="BonneRep" value="2" type="radio" />';
				echo 'Réponse 2 / Answer 2 : <input name="Reponse[2]" value="" type="text" />';
				echo '<br /><br />';
				echo '<input name="BonneRep" value="3" type="radio" />';
				echo 'Réponse 3 / Answer 3 : <input name="Reponse[3]" value="" type="text" />';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input name="BonneRep" value="4" type="radio" />';
				echo 'Réponse 4 / Answer 4 : <input name="Reponse[4]" value="" type="text" />';
				echo '<br /><br />';
				echo '<input name="BonneRep" value="5" type="radio" />';
				echo 'Réponse 5 / Answer 5 : <input name="Reponse[5]" value="" type="text" />';
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				echo '<input name="BonneRep" value="6" type="radio" />';
				echo 'Réponse 6 / Answer 6 : <input name="Reponse[6]" value="" type="text" />';
				echo '<br /><br />';
				echo 'Explications de la bonne réponse / Explain here the correct answer<br />';
				echo '<div style="position: relative; left: 25%;">';
				echo '<textarea id="Explication" name="Explication" rows="5" cols="70"></textarea>';
				echo '</div>';
				echo '<br /><br />';
		?>		
		<script src="outils/ckeditor/ckeditor.js"></script>
		<script>
			CKEDITOR.replace( 'Question', { 
				toolbar : 'Full',
				filebrowserImageBrowseUrl : 'outils/ckeditor_ChoisirImage.php', 
				filebrowserImageUploadUrl : 'outils/ckeditor_RecevoirImage.php',
				width : '800'
			} );
			CKEDITOR.replace( 'Explication', { 
				toolbar : 'Full',
				filebrowserImageBrowseUrl : 'outils/ckeditor_ChoisirImage.php', 
				filebrowserImageUploadUrl : 'outils/ckeditor_RecevoirImage.php',
				width : '800'
			} );
		</script>
		<?php	} ?>
		<input name="Soumettre" type="submit" id="input_SoumettreConf" value="Soumettre / Submit" class="Bouton_Turquoise"/>
	</form>
	<br /><br />
	<hr />
	<a href="index.php">Lancer un quiz (Jouer) / start a game (Let play!)</a>
	<br /><br />
</body>
</html>


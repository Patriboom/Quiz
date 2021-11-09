<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Quiz pour tout, quiz pour tous</title>
<link rel=stylesheet HREF="general.css" TYPE="text/css">
</head>
<body>
<img src="images/Quiz_1.jpg" alt="" />
<?php
	if (!file_exists("config.app.php")) { 
		echo '<script>document.location.href="Administrateur.php";</script>'; 
	}
	include "config.app.php";
?>
	<br /><br />
	<div style="text-align: center; font-size: 140%;">
	<h1>Quiz pour tout, quiz pour tous / Quiz for all</h1>
	<h2>Veuillez choisir votre jeu  /  Choose your quiz</h2>


	<br /><br />
	<form name="Questionne" id="FormQuestionne" action="Quiz.php" method="POST">
	<?php
		//Liste des jeux disponibles
		$MesJeux = scandir("Jeux");
		$Choix = ' checked="checked"';
		foreach ($MesJeux as $Jeu) {
			if (in_array($Jeu, array(".", "..", "Fini.txt", "index.php", "index.htm", "index.html", "Prof.htm"))) { continue; }
			if (strpos($Jeu, ".") > 0)  { continue; }
			echo '<input name="ChxQuiz" value="'.$Jeu.'" type="radio" style="font-size: 150%;" '.$Choix.' />'.$Jeu.'<br />';
			$Choix = '';
		}
	?>
	
	<br /><br />
	
	<label>Votre nom de joueur</label>&nbsp;:&nbsp;<input name="pseudo" type="text" size="15" maxlength="30" />
	<br /><br />
	<input type="submit" id="input_submit" name="Soumettre" value="Allons-y!&nbsp;&nbsp;/&nbsp;&nbsp;Let`s go !"  class="Bouton_Turquoise" />	
	</form>
	</div>
</body>
</html>
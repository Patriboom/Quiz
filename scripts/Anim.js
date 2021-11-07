var attendre = 0;
var delai;
var DernRep = 0;
var duree = 30;
var faites = new Array;
var Jeu;
var NbQuest = 0;
var NbBnRep = 0;
var Question = 0;
var rendu = 0;

function ChxQuestion(Quelle) {
	if (attendre == 0) {
		attendre = 1;
		var allons = true;
		var Exactement = "ajax/Admin_Question.php?Quoi=Question&Quelle=" + Quelle;
		var quest = true;
		if (document.getElementById('a_Quest_' + Quelle).style.backgroundColor == 'rgb(137, 137, 0)') {
			Exactement = "ajax/Admin_Question.php?Quoi=Reponse&Quelle=" + Quelle;
			quest = false;
		}
		if (document.getElementById('a_Quest_' + Quelle).style.backgroundColor == 'rgb(39, 70, 39)') {
			if (confirm("Cette question a déjà été posée.\n\nVoulez-vous la poser de nouveau ? ")) {
				document.getElementById('a_Quest_' + Quelle).style.backgroundColor = '#008000';
				quest = true;
			} else {
				allons = false;
				attendre = 0;
			}				
		}
		if (allons == true) {
			document.getElementById('a_Quest_' + Quelle).style.backgroundColor = "#898900";
			document.getElementById('a_Quest_' + Quelle).onclick = "AffichonsRep(" + Quelle + ")";
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			    	if (this.responseText != "") {
						var contenus = this.responseText;
						var contenu = contenus.split("|");
						if (quest) {
							AffichonsQuest(contenu[2], Jeu);
						} else {
							AffichonsRep(contenu, Jeu, Quelle);
						}
			    	}
			    	attendre = 0;
			    	this.responseText = "";
			    }
			};
			xhttp.open("GET", Exactement, true);
			xhttp.send(); 
		}
	}
}

function LesReponses() {
	var Exactement = "ajax/Admin_Reponses.php";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != "") {
				document.getElementById('div_jeuReponses').innerHTML = "<ul>" + this.responseText + "</ul>";
			}
		}
	};
	xhttp.open("GET", Exactement, true);
	xhttp.send(); 
}

function AffichonsQuest(Quoi, Quelle) {
	document.getElementById('RepQuestion').innerHTML = "";
  	document.getElementById('chrono_debut').value = (new Date()).getTime();
	document.getElementById('Question').innerHTML = Quoi;
 	document.getElementById('Reponse').innerHTML = "";
 	document.getElementById('StatsImage').innerHTML = '';
	DernRep = 0;
	NbQuest = NbQuest + 1; 
	delai = setInterval(function() { LesReponses(); }, 1000);
}

function AffichonsRep(contenu, Jeu, Quelle) {
	clearInterval(delai);
	document.getElementById('a_Quest_' + Quelle).style.backgroundColor = '#274627';
	document.getElementById('a_Quest_' + Quelle).style.color = '#879878';
	document.getElementById('RepQuestion').innerHTML = contenu[2];
	document.getElementById('div_question').style.backgroundColor = '#000000'; 
	document.getElementById('div_question').style.color = '#CCCC99'; 
	for (x=1; x<5; x++) {
		if (document.getElementById('Rep' + x)) {
			document.getElementById('Rep' + x).className = 'NonRep';
		}
	}
	document.getElementById('Rep' + contenu[1]).className = 'BonneRep';
}

function Commencons(Quoi, Choix) {
	Jeu = Choix;
	clearInterval(delayons);  
	document.getElementById('H2_rebours').innerHTML = "<h2 style=\"color: green;\">" + Choix + "</h2>";
	document.getElementById('Questions').innerHTML = "";
	delai = setInterval(function() { ChxQuestion(); }, 1000);
}

function Terminer() {
	clearInterval(delai);
	document.getElementById('Questions').innerHTML = "";
	document.getElementById('Reponse').innerHTML = "";
	document.getElementById('RepQuestion').innerHTML = "";
	document.getElementById('StatsPerso').innerHTML = "";
	var Exactement = "ajax/Admin_Terminer.php";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != "") {
				document.getElementById('Questions').innerHTML = "<span style=\"font-size: 150%; color: wheat;\">" + this.responseText + "</span>";
			}
		}
	};
	xhttp.open("GET", Exactement, true);
	xhttp.send(); 
	setTimeout(function() { Terminons(); }, 7543);
}

function Terminons() {
	var Exactement = "ajax/Admin_Terminons.php";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != "") {
				document.getElementById('Questions').innerHTML = "<span style=\"font-size: 150%; color: wheat;\">" + this.responseText + "</span>";
				document.location.href = "index.php";
			}
		}
	};
	xhttp.open("GET", Exactement, true);
	xhttp.send(); 
}

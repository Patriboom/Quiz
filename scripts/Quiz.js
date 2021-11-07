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

function ChxQuestion(Jeu) {
	if (attendre == 0) {
		attendre = 1;
		var Exactement = "ajax/Quiz_Question.php?Quoi=Lire&Jeu=" + Jeu;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	if (this.responseText != "") {
					var contenus = this.responseText;
					var contenu = contenus.split("|");
					if (contenu[0] == 'Questions') {
						AffichonsQuest(contenu[2], Jeu); 
		    		} else if (contenu[0] == 'Reponse' ) {
		    			AffichonsRep(contenu);
					} else if (contenu[0] == 'Fini') {
						document.location.href = "index.php";
		    		} else if (contenus != '') { 
		    			//document.getElementById('Questions').innerHTML =  this.responseText; 
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

function AffichonsQuest(Quoi, Quelle) {
  	document.getElementById('chrono_debut').value = (new Date()).getTime();
	document.getElementById('Questions').innerHTML = Quoi;
 	document.getElementById('Reponse').innerHTML = "";
 	document.getElementById('StatsImage').innerHTML = '';
	DernRep = 0;
	NbQuest = NbQuest + 1; 
}

function AffichonsRep(contenu) {
	var LaRep = parseInt(contenu[1]);
	for (x=1; x<5; x++) {
		if (document.getElementById('Rep' + x)) {
			document.getElementById('Rep' + x).className = 'NonRep';
			if (x == LaRep ) { document.getElementById('Rep' + x).className = 'BonneRep';  } 
			if (x == LaRep && x == DernRep ) { 
				NbBnRep = NbBnRep + 1;
				var ok = Math.ceil(Math.random() * 2);
				document.getElementById('StatsImage').innerHTML = '<img src="images/OK_ClinDoeil_300_' + ok + '.png" />';
				setTimeout(function() {document.getElementById('StatsImage').innerHTML = ''; },3567) 
			} 
			if (x != LaRep && x == DernRep) { document.getElementById('Rep' + x).className = 'ErreurRep'; } 
		}
	}
	document.getElementById('Reponse').innerHTML = '<div style="text-align: left;"><ul>' + contenu[2] + '</ul></div>';
//	document.getElementById('Reponse').innerHTML = '<iframe src="Jeux/LesAmisDabord/Rep_04.htm">' + contenu[2] + '</iframe>';
	document.getElementById('StatsPerso').innerHTML = NbBnRep + " / " + NbQuest;
}

function Commencons(Quoi, Choix) {
	Jeu = Choix;
	clearInterval(delayons);  
	document.getElementById('H2_rebours').innerHTML = "<h2 style=\"color: green;\">" + Choix + "</h2>";
	document.getElementById('Questions').innerHTML = "";
	delai = setInterval(function() { ChxQuestion(); }, 1000);
}

function MaRep(Rep) {
	if (DernRep != 0) { return true;  }
	DernRep = Rep;
	for (x=1; x<5; x++) {
		if (document.getElementById('Rep' + x)) { 
			document.getElementById('Rep' + x).className = 'NonRep';
		}
	}
	document.getElementById('Rep' + Rep).className = "MaRep";
  	document.getElementById('chrono_fin').value = (new Date()).getTime();
	var Exactement = "ajax/Quiz_Reponse.php";
	var xhttp = new XMLHttpRequest();
	var valeurs = "Voici mes valeurs";
	valeurs = valeurs + "&MaRep=" + Rep;
	valeurs = valeurs + "&Quest=" + document.getElementById('div_question').innerHTML;
	valeurs = valeurs + "&Rep=" + document.getElementById('Rep' + Rep).innerHTML;
	valeurs = valeurs + "&Duree=" + ((document.getElementById('chrono_fin').value - document.getElementById('chrono_debut').value )/1000);
	valeurs = valeurs + "&Question=" + (++Question);
	xhttp = new XMLHttpRequest(); 
	xhttp.open("POST", Exactement, true);
	xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.onreadystatechange = function() {
		if (this.status == 200 && this.readyState == 4 ) {
			if (this.responseText != 'Non') {
				var reponses = this.responseText;
		    	document.getElementById('Reponse').innerHTML = this.responseText;
			}
		}
	}
	xhttp.send(valeurs);
}

function Terminer() {
	clearInterval(delai);
	document.getElementById('FormQuestionne').submit();
	setTimeout(function() { document.location.href = "index.php?mod=Cours"; }, 7543);
}

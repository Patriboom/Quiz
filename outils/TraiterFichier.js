/* Script written by Adam Khoury @ DevelopPHP.com */
/* Video Tutorial: http://www.youtube.com/watch?v=EraNFJiY0Eg */
var NumActif = 99;
var NumMbreActif = 0;
var DestActive = "Baboom";
var NomFichierActif = "MegaBoom";

function _(el){
	return document.getElementById(el);
}
function uploadFile(CeNum,LaDest,NomFichier,NumMbre,TailleX,TailleY){
	NumActif = CeNum;
	DestActive = LaDest;
	NumMbreActif = NumMbre;
	NomFichierActif = NomFichier;
	var file = _("Fichier_"+NumActif).files[0];
	var formdata = new FormData();
	var NomImg = (CeNum == 0) ? "images/Log/PasDeCarte.jpg?" : "images/Log/PasDePhoto.png?";
	formdata.append("Fichier_"+NumActif, file);
	_("CetteImg_"+NumActif).src = NomImg + new Date().getTime();
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "outils/TraiterFichier.php?Num="+CeNum+"&LaDest="+LaDest+"&NomFichier="+NomFichier+"&NumMbre="+NumMbre+"&TailleX="+TailleX+"&TailleY="+TailleY);
	ajax.send(formdata);
}

function progressHandler(event){
	var percent = (event.total == 0) ? 1 : Math.round((event.loaded / event.total) * 100);
	_("progressBar_"+NumActif).value = percent;
	_("status_"+NumActif).innerHTML = percent+"% téléchargement en cours";
}

function completeHandler(event){
	if (!NumActif) { NumActif = 1; }
	if (document.getElementById('OffreModifImage_' + NumActif)) { document.getElementById('OffreModifImage_' + NumActif).style.display = 'none'; }
	if (event.target.responseText == 'Fichier trop gros') {
		_("status_"+NumActif).innerHTML = "<font color=\"990000\">" + event.target.responseText + "</font>";
		_("progressBar_"+NumActif).style.display = 'none'; 
	} else { 
		_("status_"+NumActif).innerHTML = event.target.responseText;
		_("progressBar_"+NumActif).value = 100; 
		if (DestActive.substr(0,15)  == "images/Membres/" || DestActive.substr(0,17)  == "images/Log/Cartes" || NomFichierActif.substr(0,15) == 'LogoTemporaire_' || NomFichierActif.substr(0,13) == 'ImageSondage_' || DestActive.substr(0,11)  == "temp/Sites/") {
			AjusterJPG(NumActif);
		}
	}
}
function errorHandler(event){
	_("status_"+NumActif).innerHTML = "Le téléchargement ne réussit pas";
}
function abortHandler(event){
	_("status_"+NumActif).innerHTML = "Le téléchargement a été abruptement interrompu.";
}

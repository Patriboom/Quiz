


function Banane() {
	var Exactement = "outils/ckeditor_RecevoirImage.php";
	var valeurs = "Voici mes valeurs";
	valeurs = valeurs + "&MaRep=" + Rep;
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", Exactement, true);
	xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText != "") {
				alert( this.responseText);
			}
		}
	};
	xhttp.send(valeurs); 
}








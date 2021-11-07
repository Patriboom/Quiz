if (document.getElementById('text_MonCommentaireSurleCours')) {
	var CKcontenu2 = CKEDITOR.replace( 'MonComm', { toolbar : 'Minus',
		filebrowserImageBrowseUrl : 'outils/ckeditor_ChoisirImage.php',
		filebrowserImageUploadUrl : 'outils/ckeditor_RecevoirImage.php',
	} );
}
	
if (document.getElementById('form_CourrielEntreInscrits')) {
	var CKcontenu = CKEDITOR.replace( 'txtContenuCourriel', { toolbar : 'Minus',
		filebrowserImageBrowseUrl : 'outils/ckeditor_ChoisirImage.php',
		filebrowserImageUploadUrl : 'outils/ckeditor_RecevoirImage.php',
	} );
}

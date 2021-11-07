/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
		sconfig.language = 'fr',
		config.uicolor = '#6E9BFF',
		config.baseHref = 'https://plongee.ca/',
		config.contentsLanguage = 'fr',
		config.cloudServices_tokenUrl = '../../temp/cs-token-endpoint',
		config.cloudServices_uploadUrl = '../../temp/Reception/',
		config.defaultLanguage = 'fr',
		config.entities = false,
		config.entities_greek = false,
		config.entities_latin = false,
		config.enterMode = CKEDITOR.ENTER_BR,
		config.extraPlugins = 'autolink,keystrokes,language,linkayt',
		config.filebrowserImageBrowseUrl = 'outils/ckeditor_ChoisirImage.php', 
		config.filebrowserImageUploadUrl = 'outils/ckeditor_RecevoirImage.php',
		config.forcePasteAsPlainText = true,
		config.linkJavaScriptLinksAllowed = false,
		linkShowTargetTab = false,
		config.language = 'fr-ca',
		config.language_list =[ 'fr-ca:French:Canada', 'en:English', 'es:Spanish' ],
		config.protectedSource.push( /<\?[\s\S]*?\?>/g ),
		config.scayt_autoStartup = true,
		config.scayt_ignoreDomainNames = true,
		config.scayt_multiLanguageMode = true,
		config.scayt_multiLanguageStyles = {'fr': 'color: yellow', 'en': 'color: red', 'es': 'color: purple'},
		config.scayt_sLang = 'fr_CA',
		config.shiftEnterMode = CKEDITOR.ENTER_P,
		config.wsc_lang = 'fr_CA',
		// The toolbar groups arrangement, optimized for two toolbar rows.
		config.toolbar = 'Full';
		config.smiley_path = "plugins/smiley/images/";
//	config.smiley_path = "outils/ckeditor/plugins/smiley/images/";
 
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colordialog' },
		{ name: 'about' }
	];

config.toolbar_Basic =
[
    { name: 'Fichiers', items: ['Source']},
    { name: 'FaireDefaire', items: ['Undo','Redo','-','Find','Replace','-','SelectAll']},
    { name: 'Polices', items: ['Bold','Italic','Underline','Subscript','Superscript']},
    { name: 'CopieColle', items: ['Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat']},
    { name: 'Tableaux', items: ['TextColor','BGColor']},
    { name: 'Redaction', items: ['Smiley'	, 'Scayt']} 
];

config.toolbar_Full =
[
    { name: 'Fichiers', items: ['Source','-','Save','NewPage','Preview','-','Templates']},
    { name: 'CopieColle', items: ['Cut','Copy','Paste','PasteText','PasteFromWord','PasteCode','-','Print', 'SpellChecker', 'Scayt']},
    { name: 'FaireDefaire', items: ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat']},
    { name: 'Formulaire', items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField']},
    '/',
    { name: 'Polices', items: ['Bold','Italic','Underline','Strike','-','Subscript','Superscript']},
    { name: 'ListeDec', items: ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']},
    { name: 'Justifie', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
    { name: 'codeHTML', items: ['Link','Unlink','Anchor']},
    { name: 'Speciaux', items: ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak']},
    '/',
    { name: 'Polices', items: ['Styles','Format','Font','FontSize']},
    { name: 'Couleurs', items: ['TextColor','BGColor']},
    { name: 'Fenetre', items: ['Maximize', 'ShowBlocks','-','About']}
];
 
config.toolbar_Promo =
[
    { name: 'Fichiers', items: ['Source']},
    { name: 'FaireDefaire', items: ['Undo','Redo','-','Find','Replace','Cut','Copy','Paste','PasteText','PasteFromWord']},
    { name: 'CopieColle', items: ['RemoveFormat','Bold','Image','Link','Unlink']}
];

config.toolbar_Reduite = 
[
    { name: 'Fichiers', items: ['Source']},
    { name: 'FaireDefaire', items: ['Undo','Redo','-', 'Scayt', 'SpellChecker']},
    { name: 'Polices', items: ['Bold','Italic','Underline','Subscript']},
    { name: 'CopieColle', items: ['Cut','Copy','Paste','PasteText']},
    { name: 'ListeDec', items: ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']},
    { name: 'Justifie', items: ['Image','Link','Unlink']},
    { name: 'Tableaux', items: ['Table','TextColor','BGColor']}
];

config.toolbar_PeuReduite = 
[
    { name: 'Fichiers', items: ['Source']},
    { name: 'FaireDefaire', items: ['Undo','Redo','-', 'Scayt', 'SpellChecker']},
    { name: 'Polices', items: ['Bold','Italic','Underline','Subscript','Superscript','RemoveFormat']},
    { name: 'CopieColle', items: ['Cut','Copy','Paste','PasteText','PasteFromWord']},
    { name: 'ListeDec', items: ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']},
    { name: 'Justifie', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Link','Unlink']},
    { name: 'Tableaux', items: ['Table','HorizontalRule','TextColor','BGColor']}
];

config.toolbar_Minus = 
[
    { name: 'FaireDefaire', items: ['Undo','Redo','-', 'Scayt', 'SpellChecker']},
    { name: 'Polices', items: ['Bold','Italic','Underline','Superscript']},
    { name: 'CopieColle', items: ['Cut','Copy','Paste']},
    { name: 'Justifie', items: ['Image','Link','Unlink','smiley']}
];


 
	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	//config.removeButtons = 'Underline,Subscript,Superscript';
	config.removeButtons = 'Subscript';
};


//CKEDITOR.on("keyup", function(event) {
//	alert("Voici la valeur de la touche touchée : " + event.data.getKeystroke());
//   if( event.data.getKeystroke() == 13 ) {
//      globalChatEditor.setData("");
//      globalChatEditor.focus();
//      ajaxUpdates();
//      event.data.preventDefault();
//      return false;
//   }
//});	

CKEDITOR.on('instanceReady', function( ev ) {
	var blockTags = ['blockquote','div','h1','h2','h3','h4','h5','h6','hr','img','li','ol','p','pre','table','thead','tbody','tfoot','td','th','ul'];
	for (var i = 0; i < blockTags.length; i++) {
		ev.editor.dataProcessor.writer.setRules( blockTags[i], {
			indent : false,
			breakBeforeOpen : false,
			breakAfterOpen : false,
			breakBeforeClose : false,
			breakAfterClose : false
		});
	}
});

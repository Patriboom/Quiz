/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html
		config.language = 'fr',
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
		config.extraPlugins = 'keystrokes,language,linkayt',
		config.filebrowserImageBrowseUrl = 'outils/ckeditor_ChoisirImage.php', 
		config.filebrowserImageUploadUrl = 'outils/ckeditor_RecevoirImage.php',
		config.forcePasteAsPlainText = true,
		config.linkJavaScriptLinksAllowed = false,
		linkShowTargetTab = false,
		config.language_list =[ 'fr-ca:French:Canada', 'en:English', 'es:Spanish' ],
		config.protectedSource.push( /<\?[\s\S]*?\?>/g ),
		config.scayt_autoStartup = true,
		config.scayt_ignoreDomainNames = true,
		config.scayt_multiLanguageMode = true,
		config.scayt_multiLanguageStyles = {'fr': 'color: yellow', 'en': 'color: red', 'es': 'color: purple'},
		config.scayt_sLang = 'fr_CA',
		config.shiftEnterMode = CKEDITOR.ENTER_P,
		config.toolbar = 'Full';

	// The toolbar groups arrangement, optimized for two toolbar rows.
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
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

config.toolbar_Full =
[
    { name: 'Polices', items: ['Bold','Italic','Underline','Strike','-','Subscript','Superscript']},
    { name: 'CopieColle', items: ['Cut','Copy','Paste','PasteText','PasteFromWord','PasteCode','-','Print', 'SpellChecker', 'Scayt']},
    { name: 'FaireDefaire', items: ['Undo','Redo','-','Find','Replace','-','SelectAll']},
    { name: 'ListeDec', items: ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']},
    { name: 'codeHTML', items: ['Link','Unlink','Image','Table','HorizontalRule']}
];
 


 
	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	//config.removeButtons = 'Underline,Subscript,Superscript';
	config.removeButtons = 'Subscript';

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};

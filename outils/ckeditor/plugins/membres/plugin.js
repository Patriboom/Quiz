/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

( function() {
	'use strict';

	// Regex by Imme Emosol.
	var validUrlRegex = /^(https?|ftp):\/\/(-\.)?([^\s\/?\.#]+\.?)+(\/[^\s]*)?[^\s\.,]$/ig,
		doubleQuoteRegex = /"/g;

	CKEDITOR.plugins.add( 'membres', {
		requires: 'clipboard',

		init: function( editor ) {
s			editor.on( 'paste', function( evt ) {
				var data = evt.data.dataValue;

				if ( evt.data.dataTransfer.getTransferType( editor ) == CKEDITOR.DATA_TRANSFER_INTERNAL ) {
					return;
				}

				// If we found "<" it means that most likely there's some tag and we don't want to touch it.
				if ( data.indexOf( '<' ) > -1 ) {
					return;
				}
			
				var ajouts = ' style="font-decoration: underline; " alt="' + data + '" ';
				var plongee = 0;
				if (data.substr(0, 18) == 'http://plongee.ca/' ) { plongee = 18; }
				if (data.substr(0, 19) == 'https://plongee.ca/' ) { plongee = 19; }
				if (plongee > 0) {
					data = data.substr(plongee);
					if (data == '') { data = 'index.php'; }
					data = '<a href="' + data + '" ' + ajouts + '>Cliquez ici</a> ';
				} else {
					// https://dev.ckeditor.com/ticket/13419
					ajouts = ajouts + ' target="_blank" ';
					data = data.replace( validUrlRegex , '<a href="' + data.replace( doubleQuoteRegex, '%22' ) + '" ' + ajouts + '>$&</a> ' );
				}

				// If link was discovered, change the type to 'html'. This is important e.g. when pasting plain text in Chrome
				// where real type is correctly recognized.
				if ( data != evt.data.dataValue ) {
					evt.data.type = 'html';
				}

				evt.data.dataValue = data;
			} );
		}
	} );
} )();

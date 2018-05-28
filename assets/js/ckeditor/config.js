/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.height = 250;
	config.width = 750;
//	config.skin = 'moono';
	
	config.toolbar_Broncha = [	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript'] },
								{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Blockquote','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
								{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
								{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'] }
							];
	
	config.toolbar_F1soft = [	{ name: 'document',    items : [ 'Source'] },
								{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
								{ name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
								{ name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
								{ name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
								{ name: 'styles',      items : [ 'Format','FontSize' ] },
								{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
   								{ name: 'tools',       items : [ 'Maximize', 'ShowBlocks'] }
							];
							
	//config.toolbar = 'Broncha';
	//config.baseHref = base_url;
	//config.contentsCss = base_url+'assets/themes/sbi/css/editor.css';
	config.enterMode = CKEDITOR.ENTER_BR;
};

$(function() {
    CKEDITOR.config.extraPlugins = 'justify';
});  


/*,
								'/',
								{ name: 'styles', items : [ 'Styles','Format','FontSize' ] },
								{ name: 'colors', items : [ 'TextColor','BGColor' ] },
								{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }*/
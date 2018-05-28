<?php


function gallery_permissions()
{
	return array(	'administer gallery'	=>	'Create, edit and delete gallery.');
}

if(!CI::$APP->db->table_exists('dtn_image'))
{
	$schemaImage = CI::$APP->doctrine->em->getClassMetadata('gallery\models\Image');
	$schemaAlbum = CI::$APP->doctrine->em->getClassMetadata('gallery\models\Album');
	CI::$APP->doctrine->tool->createSchema(array($schemaImage    ,$schemaAlbum));
}


register_shortcode('gallery','show_gallery');

function show_gallery()
{	
	return Modules::run('gallery/showall');
}

$_gallery_shortcut = array(	'name'			=>	'Gallery',
							'icon'			=>	'gallery.png',
							'controller'	=>	'gallery',
							'permission'	=>	'administer gallery'
					);
		
register_dashboard_shortcut($_gallery_shortcut);
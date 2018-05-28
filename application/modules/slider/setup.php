<?php

use slider\models\Slider;

//$permissions['administer slider'] = 'Add, edit and delete slider images.';

function slider_permissions()
{
	return array('administer slider'	=>	'Add, edit and delete slider images.');
}

if(!CI::$APP->db->table_exists('f1_slider'))
{
	$schema = CI::$APP->doctrine->em->getClassMetadata('slider\models\Slider');
	CI::$APP->doctrine->tool->createSchema(array($schema));
}

$_shortcut = array(	'name'			=>	'Slider',
					'icon'			=>	'slider.png',
					'controller'	=>	'slider',
					'permission'	=>	'administer slider'
				);

register_dashboard_shortcut($_shortcut);

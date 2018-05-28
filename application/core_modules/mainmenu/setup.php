<?php

function mainmenu_permissions()
{
	return array('administer mainmenu'	=>	'Create, edit and delete mainmenu.');
}

$_shortcut = array(	'name'			=>	'Mainmenu',
					'icon'			=>	'mainmenu.png',
					'controller'	=>	'mainmenu',
					'permission'	=>	'administer mainmenu'
				);

register_dashboard_shortcut($_shortcut);

if(!CI::$APP->db->table_exists('dtn_mainmenu'))
{
	$schema = CI::$APP->doctrine->em->getClassMetadata('mainmenu\models\Mainmenu');
	CI::$APP->doctrine->tool->createSchema(array($schema));
}
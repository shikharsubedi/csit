<?php

function footer_permissions()
{
	return array('administer footer'	=>	'Add, edit and delete footer.');
}
								
if(!CI::$APP->db->table_exists('f1_footer'))
{
	$index = CI::$APP->doctrine->em->getClassMetadata('footer\models\Footer');
	CI::$APP->doctrine->tool->createSchema(array($index));
}

if(!CI::$APP->db->table_exists('f1_footer_group'))
{
	$index = CI::$APP->doctrine->em->getClassMetadata('footer\models\FooterGroup');
	CI::$APP->doctrine->tool->createSchema(array($index));
}



$_shortcut = array(	'name'			=>	'Footer',
					'icon'			=>	'footer.png',
					'controller'	=>	'footer',
					'permission'	=>	'administer footer'
				);

register_dashboard_shortcut($_shortcut); 

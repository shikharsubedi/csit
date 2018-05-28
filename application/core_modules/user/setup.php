<?php

function user_permissions()
{
	return array(
			'administer user'	=>	'Create, edit and delete users.',
			'administer group'	=>	'Create, edit and delete groups.',
			);
}

if(!CI::$APP->db->table_exists('dtn_user_meta'))
{
	$schema = CI::$APP->doctrine->em->getClassMetadata('user\models\UserMeta');
	CI::$APP->doctrine->tool->createSchema(array($schema));
}

?>
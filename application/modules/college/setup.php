<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function college_permissions() {
    return array('college list' => 'Add, edit and delete items to/from the college');
}

if (!CI::$APP->db->table_exists('dtn_college')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('college\models\College');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}

$_college_shortcut = array('name' => 'College',
    'icon' => 'college.png',
    'controller' => 'college',
    'permission' => 'college list'
);

register_dashboard_shortcut($_college_shortcut);
?>
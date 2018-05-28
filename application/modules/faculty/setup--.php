<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function faculty_permissions() {
    return array('faculty list' => 'Add, edit and delete items to/from the management team and the board of directors.');
}

if (!CI::$APP->db->table_exists('dtn_faculty')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('faculty\models\Faculty');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}
if (!CI::$APP->db->table_exists('dtn_apply_to_faculty')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('faculty\models\Applytofaculty');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}


$_faculty_shortcut = array('name' => 'faculty',
    'icon' => 'faculty.png',
    'controller' => 'faculty',
    'permission' => 'faculty list'
);

register_dashboard_shortcut($_faculty_shortcut);
?>
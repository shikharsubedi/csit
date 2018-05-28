<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function management_permissions() {
    return array('administer management list' => 'Add, edit and delete items to/from the management team and the board of directors.');
}


if (!CI::$APP->db->table_exists('dtn_management')) {
    $type_schema = CI::$APP->doctrine->em->getClassMetadata('management\models\ManagementType');
    $schema = CI::$APP->doctrine->em->getClassMetadata('management\models\Management');    
    CI::$APP->doctrine->tool->createSchema(array($schema, $type_schema));
}



register_shortcode('management', 'management');

function management($args) {


    return Modules::run('management/index');
}

register_shortcode('bod', 'bod');

function bod() {

    return Modules::run('management/bod', 'board-of-directors');
}

$_management_shortcut = array('name' => 'Management',
    'icon' => 'mgmt.png',
    'controller' => 'management',
    'permission' => 'administer management list'
);

register_dashboard_shortcut($_management_shortcut);
?>
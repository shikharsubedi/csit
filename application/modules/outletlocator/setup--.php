<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function outletlocator_permissions() {
    return array('administer outlets' => 'Add, edit and delete ATM and branches outlets.');
}

if (!CI::$APP->db->table_exists('dtn_outlets')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('outletlocator\models\Outlet');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}


register_shortcode('outlet_locator_map', 'outlet_locator_map');

function outlet_locator_map($args = NULL) {

    return Modules::run('outletlocator');
}

$_shortcut = array('name' => 'My Map',
    'icon' => 'map.png',
    'controller' => 'outletlocator',
    'permission' => 'administer outletlocator'
);

register_dashboard_shortcut($_shortcut);

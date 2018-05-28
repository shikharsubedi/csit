<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function quicklinks_permissions() {
    return array('quick links' => 'Add, edit and delete items to/from the management team and the board of directors.');
}

if (!CI::$APP->db->table_exists('dtn_quick_links')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('quicklinks\models\QuickLinks');
    CI::$APP->doctrine->tool->createSchema(array($schema));
//    $type_schema = CI::$APP->doctrine->em->getClassMetadata('razen\models\RazenType');
//    CI::$APP->doctrine->tool->createSchema(array($schema, $type_schema));
}

$_shortcut = array('name' => 'Quicklinks\'s',
    'icon' => 'quicklinks.png',
    'controller' => 'quicklinks',
    'permission' => 'quick links'
);

register_dashboard_shortcut($_shortcut);

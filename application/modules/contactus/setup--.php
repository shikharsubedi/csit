<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function contactus_permissions() {
    return array('contact us list' => 'Add, edit and delete items to/from the management team and the board of directors.');
}

if (!CI::$APP->db->table_exists('dtn_contactus')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('contactus\models\ContactUs');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}

$_management_shortcut = array('name' => 'contactus',
    'icon' => 'contact.png',
    'controller' => 'contactus',
    'permission' => 'contact us list'
);

register_dashboard_shortcut($_management_shortcut);
?>
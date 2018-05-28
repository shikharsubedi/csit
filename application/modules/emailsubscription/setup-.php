<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function emailsubscription_permissions() {
    return array('email subscription list' => 'Add, edit and delete items to/from the management team and the board of directors.');
}

if (!CI::$APP->db->table_exists('dtn_email_subscription')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('emailsubscription\models\EmailSubscription');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}


$_emailSubscription_shortcut = array('name' => 'Email Subscription',
    'icon' => 'emailsubscription.png',
    'controller' => 'emailsubscription',
    'permission' => 'email subscription list'
);

register_dashboard_shortcut($_emailSubscription_shortcut);
?>
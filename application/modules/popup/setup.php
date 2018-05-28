<?php

function popup_permissions() {
    return array('administer popup' => 'Create, edit and delete popups.');
}

if (!CI::$APP->db->table_exists('dtn_popup')) {
    $schemaPopup = CI::$APP->doctrine->em->getClassMetadata('popup\models\Popup');
    CI::$APP->doctrine->tool->createSchema(array($schemaPopup));
}


$_popup_shortcut = array('name' => 'Popup',
    'icon' => 'popup.png',
    'controller' => 'popup',
    'permission' => 'administer popup'
);

register_dashboard_shortcut($_popup_shortcut);
?>
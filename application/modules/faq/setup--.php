<?php

function faq_permissions() {
    return array('administer faq' => 'Create, edit and delete faq.');
}

if (!CI::$APP->db->table_exists('dtn_faqcat')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('faq\models\Faqcat');
    CI::$APP->doctrine->tool->createSchema(array($schema));

    $schema = CI::$APP->doctrine->em->getClassMetadata('faq\models\Faqs');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}


$_shortcut = array('name' => 'Faq',
    'icon' => 'faqs.png',
    'controller' => 'faq',
    'permission' => 'administer faq'
);

register_dashboard_shortcut($_shortcut);


register_shortcode('faqs', 'faqs');

function faqs() {
    return Modules::run('faq/faqs');
}

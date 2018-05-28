<?php

use slider\models\Slider;

//$permissions['administer slider'] = 'Add, edit and delete slider images.';

function slider_permissions() {
    return array('administer slider' => 'Add, edit and delete slider images.');
}

if (!CI::$APP->db->table_exists('dtn_slider') && !CI::$APP->db->table_exists('dtn_slider_group')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('slider\models\SliderGroup');
    $schema1 = CI::$APP->doctrine->em->getClassMetadata('slider\models\Slider');
    CI::$APP->doctrine->tool->createSchema(array($schema, $schema1));
}

$_shortcut = array('name' => 'Slider',
    'icon' => 'slider.png',
    'controller' => 'slider',
    'permission' => 'administer slider'
);

register_dashboard_shortcut($_shortcut);

register_shortcode('home', 'home');

function home() {
    redirect(site_url());
}

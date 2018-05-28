<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function testimonial_permissions() {
    return array('testimonial list' => 'Add, edit and delete items to/from the management team and the board of directors.');
}

if (!CI::$APP->db->table_exists('dtn_testimonial')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('testimonial\models\Testimonial');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}


$_testimonial_shortcut = array('name' => 'Testimonial',
    'icon' => 'testimonials.png',
    'controller' => 'testimonial',
    'permission' => 'testimonial list'
);

register_dashboard_shortcut($_testimonial_shortcut);
?>
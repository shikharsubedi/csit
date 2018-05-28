<?php

function video_permissions() {
    return array('administer video' => 'Create, edit and delete video.');
}

if (!CI::$APP->db->table_exists('dtn_video')) {
    $schemae = CI::$APP->doctrine->em->getClassMetadata('video\models\Video');
    CI::$APP->doctrine->tool->createSchema(array($schemae));
}

if (!CI::$APP->db->table_exists('dtn_video_category')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('video\models\Category');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}

if (!CI::$APP->db->table_exists('dtn_video_subtopic')) {
    $schemas = CI::$APP->doctrine->em->getClassMetadata('video\models\Subtopic');
    CI::$APP->doctrine->tool->createSchema(array($schemas));
}

$_shortcut = array('name' => 'Video',
                    'icon' => 'video.png',
                    'controller' => 'video',
                    'permission' => 'administer video'
);

register_dashboard_shortcut($_shortcut);



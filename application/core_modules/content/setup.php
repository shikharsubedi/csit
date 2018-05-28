<?php

function content_permissions() {
    return array('administer content' => 'Create, edit and delete contents.');
}

if (!CI::$APP->db->table_exists('dtn_content_meta')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('content\models\ContentMeta');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}
if (!CI::$APP->db->table_exists('dtn_content')) {
    $schema = CI::$APP->doctrine->em->getClassMetadata('content\models\Content');
    CI::$APP->doctrine->tool->createSchema(array($schema));
}


$_new_article_shortcut = array('name' => 'Add Article',
    'icon' => 'add_content.png',
    'controller' => 'content/add',
    'permission' => 'administer content'
);

register_dashboard_shortcut($_new_article_shortcut);
?>
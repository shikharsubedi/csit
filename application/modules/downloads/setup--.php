<?php

function downloads_permissions() {
    return array('administer downloads' => 'Add, edit and delete download items.');
}

if (!CI::$APP->db->table_exists('dtn_download')) {
    $schemaDownload = CI::$APP->doctrine->em->getClassMetadata('downloads\models\Download');
    $schemaDownloadCategory = CI::$APP->doctrine->em->getClassMetadata('downloads\models\Download_category');
    CI::$APP->doctrine->tool->createSchema(array($schemaDownload, $schemaDownloadCategory));
}

register_shortcode('downloads', 'downloads');

function downloads($args) {
    if ($args) {
        $key = array_keys($args);
        $val = array_values($args);
        if ($key[0] == 'type')
            return Modules::run('downloads/_type', $val[0]);

        if ($key[0] == 'item') {
            $item = CI::$APP->doctrine->em->find('downloads\models\Download', $val[0]);
            if ($item) {
                return site_url('downloads/get/' . $item->getSlug());
            }
        }

        return '&nbsp;';
    } else
        return Modules::run('downloads/index');
}

register_shortcode('downloadsmobile', 'downloadsmobile');

function downloadsmobile() {

    return Modules::run('downloads/downloadsmobile');
}

$_downloads_shortcut = array('name' => 'Downloads',
    'icon' => 'downloads.png',
    'controller' => 'downloads',
    'permission' => 'administer downloads'
);

register_dashboard_shortcut($_downloads_shortcut);

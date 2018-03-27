<?php
$plugins = $data->getPlugins();
foreach($plugins as $plugin) {
    $pluginObj = pzk_obj_once('Plugin.' . ucfirst($plugin['name']));
    $pluginObj->display();
}
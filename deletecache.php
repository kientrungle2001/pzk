<?php
define('DELETE_ALL', true);
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
/*
require_once 'config.php';
require_once 'include.php';
$sys = pzk_parse('system/full');
require_once 'app/'.pzk_request()->getAppPath().'/configuration.php';

$config = pzk_global()->getConfig();
*/
$time_cache_web = -1; // $config['time_cache_web'];
$time_cache_session = -1; // $config['time_cache_session'];
echo $time_cache_session .'<br />';
echo $time_cache_web . '<br />';
$cachefiles = glob('cache/*.**');
foreach($cachefiles as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_web;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('cache/'.basename($file));
		echo 'cache/'.basename($file) . '<br />';
    }
}

$cachelayout = glob('cache/*/*.*');
foreach($cachelayout as $file) {
    if(strpos($file, 'session') !== false) continue;
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink($file);
		echo $file . '<br />';
    }
}

$compileobjects = glob('compile/*/*.php');
foreach($compileobjects as $file) {
    $timefile = @filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink($file);
		echo $file . '<br />';
    }
}

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

/*
$cachesission = glob('cache/session/*.txt*');
foreach($cachesission as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(time() > $timedelete) {
        unlink('cache/session/'.basename($file));
		echo 'cache/session/'.basename($file) . '<br />';
    }
}*/

$cachelayout = glob('cache/layouts/*.*');
foreach($cachelayout as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('cache/layouts/'.basename($file));
		echo 'cache/layouts/'.basename($file) . '<br />';
    }
}

$cachelayout = glob('cache/pages/*.*');
foreach($cachelayout as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('cache/pages/'.basename($file));
		echo 'cache/pages/'.basename($file) . '<br />';
    }
}

$cachelayout = glob('cache/objects/*.*');
foreach($cachelayout as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('cache/objects/'.basename($file));
		echo 'cache/objects/'.basename($file) . '<br />';
    }
}

$cachelayout = glob('cache/controller/*.*');
foreach($cachelayout as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('cache/controller/'.basename($file));
		echo 'cache/controller/'.basename($file) . '<br />';
    }
}

$cachelayout = glob('cache/varexport/*.*');
foreach($cachelayout as $file) {
    $timefile = filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('cache/varexport/'.basename($file));
		echo 'cache/varexport/'.basename($file) . '<br />';
    }
}

$compileobjects = glob('compile/objects/*.php');
foreach($compileobjects as $file) {
    $timefile = @filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('compile/objects/'.basename($file));
		echo 'compile/objects/'.basename($file) . '<br />';
    }
}

$compilecontrollers = glob('compile/controllers/*.php');
foreach($compilecontrollers as $file) {
    $timefile = @filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('compile/controllers/'.basename($file));
		echo 'compile/controllers/'.basename($file) . '<br />';
    }
}

$compilelayouts = glob('compile/layouts/*.php');
foreach($compilelayouts as $file) {
    $timefile = @filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('compile/layouts/'.basename($file));
		echo 'compile/layouts/'.basename($file) . '<br />';
    }
}

$compilemodels = glob('compile/models/*.php');
foreach($compilemodels as $file) {
    $timefile = @filemtime($file);
    $timedelete = $timefile + $time_cache_session;

    if(DELETE_ALL || time() > $timedelete) {
        unlink('compile/models/'.basename($file));
		echo 'compile/models/'.basename($file) . '<br />';
    }
}


?>
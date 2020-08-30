<?php
$startTime = microtime(true);
require_once 'config.php';

// Chạy chế độ compile
// include các thư viện và file hệ thống
require_once BASE_DIR . DS . 'include.php';

// chạy hệ thống
require_once BASE_DIR . DS . COMPILE_FOLDER . DS . PAGES_FOLDER . DS . 'system_full.php';

// load configuration & application instance
pzk_loader()->loadApplication();

// run application
pzk_app()->run();
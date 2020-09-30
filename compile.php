<?php
require_once 'config.php';
@mkdir(COMPILE_DIR);
@mkdir(COMPILE_DIR . DS . CONTROLLER_FOLDER);
@mkdir(COMPILE_DIR . DS . OBJECTS_FOLDER);
@mkdir(COMPILE_DIR . DS . MODEL_FOLDER);
@mkdir(COMPILE_DIR . DS . PAGES_FOLDER);
@mkdir(COMPILE_DIR . DS . LAYOUTS_FOLDER);

@mkdir(CACHE_DIR);
@mkdir(CACHE_DIR . DS . 'data');
@mkdir(CACHE_DIR . DS . LAYOUTS_FOLDER);
@mkdir(CACHE_DIR . DS . 'session');
@mkdir(CACHE_DIR. DS . PAGES_FOLDER);
@mkdir(CACHE_DIR . DS . CONTROLLER_FOLDER);
@mkdir(CACHE_DIR . DS . MODEL_FOLDER);
@mkdir(CACHE_DIR . DS . OBJECTS_FOLDER);
@mkdir(CACHE_DIR . DS . 'css');
@mkdir(CACHE_DIR . DS . 'js');
@mkdir(CACHE_DIR . DS . 'themes');
@mkdir(CACHE_DIR . DS . 'user');
@mkdir(CACHE_DIR . DS . 'route');
$includes = array(
	__DIR__ . '/lib/string.php',
	__DIR__ . '/lib/error.php',
	__DIR__ . '/lib/array.php',
	__DIR__ . '/lib/condition.php',
	__DIR__ . '/lib/format.php',
	__DIR__ . '/lib/thumb.php',
	__DIR__ . '/lib/recursive.php',
	__DIR__ . '/lib/dir.php',
	__DIR__ . '/lib/browser.php',
	__DIR__ . '/lib/util.php',
	__DIR__ . '/core/SG.php',
	__DIR__ . '/core/SG/Store.php',
	__DIR__ . '/core/SG/Store/Cluster.php',
	__DIR__ . '/core/SG/Store/Crypt.php',
	__DIR__ . '/core/SG/Store/Driver.php',
	__DIR__ . '/core/SG/Store/Driver/Php.php',
	__DIR__ . '/core/SG/Store/Driver/File.php',
	__DIR__ . '/core/SG/Store/Driver/VarexportFile.php',
	__DIR__ . '/core/SG/Store/Driver/Memcache.php',
	__DIR__ . '/core/SG/Store/Driver/Redis.php',
	__DIR__ . '/core/SG/Store/Lazy.php',
	__DIR__ . '/core/SG/Store/Stat.php',
	__DIR__ . '/core/SG/Store/Format.php',
	__DIR__ . '/core/SG/Store/Format/Json.php',
	__DIR__ . '/core/SG/Store/Format/Xml.php',
	__DIR__ . '/core/SG/Store/Format/Serialize.php',
	__DIR__ . '/core/SG/Store/Prefix.php',
	__DIR__ . '/core/SG/Store/Session.php',
	__DIR__ . '/core/SG/Store/App.php',
	__DIR__ . '/core/SG/Store/Domain.php',
	__DIR__ . '/core/SG/Store/init.php',
	__DIR__ . '/core/Object.php',
	__DIR__ . '/core/Object/LightWeight.php',
	__DIR__ . '/core/Object/LightWeightSG.php',

	__DIR__ . '/core/Parser.php',
	// __DIR__ . '/core/controller/Constant.php',
	__DIR__ . '/core/controller/Constant/List.php',
	__DIR__ . '/core/controller/Constant/Validator.php',
	__DIR__ . '/core/controller/Constant/Sort.php',
	__DIR__ . '/core/controller/Constant/Parent.php',
	__DIR__ . '/core/controller/Constant/Join.php',
	__DIR__ . '/core/controller/Constant/Filter.php',
	__DIR__ . '/core/controller/Constant/Edit.php',
	__DIR__ . '/core/Controller.php',
	__DIR__ . '/core/controller/Backend.php',
	__DIR__ . '/core/controller/Admin.php',
	__DIR__ . '/core/controller/GridAdmin.php',
	__DIR__ . '/core/controller/Report.php',
	__DIR__ . '/core/controller/ConfigAdmin.php',

	__DIR__ . '/core/controller/Frontend.php',
	__DIR__ . '/model/Entity.php',
	__DIR__ . '/objects/Core/System.php',
	__DIR__ . '/objects/Core/Loader.php',
	__DIR__ . '/objects/Core/Request.php',
	__DIR__ . '/objects/Core/Application.php',
	__DIR__ . '/objects/Core/Database.php',
	__DIR__ . '/objects/Core/Database/ArrayCondition.php',
	__DIR__ . '/objects/Core/Database/Schema.php',
	__DIR__ . '/objects/Core/Db/List.php',
	__DIR__ . '/objects/Core/Themes.php',
	__DIR__ . '/objects/Core/Rewrite/Request.php',
	__DIR__ . '/objects/Core/Rewrite/Table.php',
	__DIR__ . '/objects/Core/Rewrite/Controller.php',
	__DIR__ . '/objects/Core/Rewrite/Action.php',
	__DIR__ . '/objects/Core/Mailer.php',
	__DIR__ . '/objects/Core/Notifier.php',
	__DIR__ . '/objects/Core/Validator.php',



	__DIR__ . '/objects/Page.php',
	__DIR__ . '/objects/Block.php',
	__DIR__ . '/objects/Container.php',
	__DIR__ . '/objects/Html/Head.php',
	__DIR__ . '/objects/Html/Body.php',
	__DIR__ . '/objects/Html/Css.php',
	__DIR__ . '/objects/Html/Js.php',

	__DIR__ . '/objects/Home/Header.php',
	__DIR__ . '/objects/Home/Footer.php',

	__DIR__ . '/objects/User/Account/Registersn.php',
	__DIR__ . '/objects/User/Account/Loginsn.php',
	__DIR__ . '/objects/User/Account/User.php',
	__DIR__ . '/objects/Fulllook/Menu.php',
	__DIR__ . '/objects/Cms/Banner/Region.php',
	__DIR__ . '/objects/Education/Test/List.php',
	__DIR__ . '/objects/Education/Achievement/Achievement.php',

);
$includeContent = '<?php ' . "\r\n";
foreach ($includes as $include) {
	$content = file_get_contents($include);
	$content = preg_replace('/^<\?php/', '', $content);
	$content = preg_replace('/\?>$/', '', $content);
	$content = str_replace('require_once __DIR__ . \'/Constant.php\';', '', $content);
	$includeContent .= $content . "\r\n";
}

$includeContent = preg_replace('/pzk_import\(\'[^\']+\'\);/', '', $includeContent);

file_put_contents('compile/includes.php', $includeContent);

ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

// cac ham xu ly thong thuong
mb_language('uni');
mb_internal_encoding('UTF-8');
//define('COMPILE_MODE', true);

require_once 'include.php';
require_once 'core/Compilers.php';

$objectCompiler = new PzkObjectCompiler();
$objectCompiler->compileDir('objects');

$pageCompiler = new PzkPageCompiler();
$pageCompiler->compileDir('system');
$pageCompiler->setSource('app/nobel/application.php')->compile();
$pageCompiler->setSource('app/nobel/test/application.php')->compile();
$pageCompiler->setSource('app/nobel/hns/application.php')->compile();
$pageCompiler->setSource('app/nobel/cms/application.php')->compile();
//$pageCompiler->setSource('app/nobel/olympic/application.php')->compile();
//$pageCompiler->setSource('app/nobel/ptnn/application.php')->compile();
$pageCompiler->setSource('app/nobel/test/pmtv/application.php')->compile();
$pageCompiler->setSource('app/course/fun/application.xml')->compile();
$pageCompiler->compileDir('Default/pages');
$pageCompiler->compileDir('app/*/pages');
$pageCompiler->compileDir('app/*/*/pages');
$pageCompiler->compileDir('Themes/*/pages');

//$modelCompiler = new PzkModelCompiler();
//$modelCompiler->compileDir('model');


//$controllerCompiler = new PzkControllerCompiler();
//$controllerCompiler->compileDir('default/controller');
//$controllerCompiler->compileDir('app/*/controller');
//$controllerCompiler->compileDir('app/*/*/controller');
//$controllerCompiler->compileDir('themes/*/controller');
/*
compileInclude();
compileObjects();
compileXmlFile('system/full.php',true);
require_once 'compile/pages/system_full.php';
define('regenerate', true);
compileObjects();
compileModels();
compileXmls();
compileControllers();
compileLayouts();
//compileXmlFile('system/full.php', regenerate);
//compileXmlFile('app/ptnn/offapplication.php', regenerate);
//compileXmlFile('app/cms/pages/home/index.php', regenerate);
//pzk_element()->getPage()->display();
//require_once 'compile/pages/system_full.php';
//require_once 'compile/pages/app_ptnn_offapplication.php';
*/
